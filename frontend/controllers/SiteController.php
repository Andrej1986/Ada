<?php

namespace frontend\controllers;

use backend\models\Name;
use common\models\Comment;
use frontend\models\Event;
use frontend\models\Paid;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\ArrayHelper;
use frontend\models\Category;


/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow'   => true,
						'roles'   => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index', [
			'category'     => new Category(),
			'dataCategory' => (new Category())->selectUsedCategories(),
			'paid'         => new Paid(),
			'dataPaid'     => Paid::findByCategory(),
			'event'        => new Event(),
			'dataEvent'    => array_unique(ArrayHelper::map(Event::find()->asArray()->all(), 'id', 'name')),
		]);
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending your message.');
			}

			return $this->refresh();
		} else {
			return $this->render('contact', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Displays schedule page.
	 *
	 * @return mixed
	 */
	public function actionSchedule()
	{
		return $this->render('schedule', [
			'events' => Event::find()->asArray()->where(['>', 'date', new Expression('NOW()')])->limit(20)->orderBy('date')->all(),
		]);
	}

	/**
	 * Displays event page.
	 *
	 * @return mixed
	 */
	public function actionEvent($name)
	{
		$event = Name::findOne(['name' => $name]);

		$query = Comment::find()->where(['name_id' => $event['id']]);
		$pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 2]);

		if (is_dir('/Users/andrejsoukup/yii' . Yii::$app->urlManagerBackend->baseUrl . "/uploads/$name")) {
			$images = FileHelper::findFiles('/Users/andrejsoukup/yii' . Yii::$app->urlManagerBackend->baseUrl . "/uploads/$name", ['only' => ['*.jpg', '*.png']]);
		}

		return $this->render('event', [
			'event' => $event,
			'images' => $images ?? '',
			'name'  => $name,
			'i'     => 0,
			'model' => new Comment(),
//			'comments' => Comment::find()->asArray()->where(['name_id' => $event['id']])->all(),
			'comments' => $query->offset($pagination->offset)->limit($pagination->limit)->all(),
			'pagination' => $pagination
		]);
	}

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 */
	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($user = $model->signup()) {
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

				return $this->goHome();
			} else {
				Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
			}
		}

		return $this->render('requestPasswordResetToken', [
			'model' => $model,
		]);
	}

	/**
	 * Resets password.
	 *
	 * @param string $token
	 * @return mixed
	 * @throws BadRequestHttpException
	 */
	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->session->setFlash('success', 'New password saved.');

			return $this->goHome();
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}
}
