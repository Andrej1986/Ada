<?php

namespace backend\controllers;

use backend\models\Name;
use backend\models\Category;
use backend\models\Paid;
use backend\models\Location;
use Yii;
use backend\models\Event;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
	public $name;
	public $description;
	public $category;
	public $paid;
	public $at;
	public $location;
	public $date;
	public $repeat_event;
	public $repeat;
	public $price;

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow'   => true,
					],
					[
//						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['superadmin'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Event models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Event::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Event model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Event model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		if ((new Event())->load(Yii::$app->request->post())) {
			$request_data       = Yii::$app->request;
			$this->name         = $request_data->post('Event')['name'];
			$this->description  = $request_data->post('Event')['description'];
			$this->category     = $request_data->post('Event')['category'];
			$this->paid         = $request_data->post('Event')['paid'];
			$this->at           = $request_data->post('Event')['at'];
			$this->location     = $request_data->post('Event')['location'];
			$this->date         = $request_data->post('Event')['date'];
			$this->repeat_event = $request_data->post('repeat-event');
			$this->repeat       = $request_data->post('repeat');
			$this->price        = $request_data->post('Event')['price'];

			if ($this->repeat_event && $this->repeat >= 1) {
				for ($i = 1; $i <= $this->repeat; $i++) {
					$model              = new Event();
					$model->date        = date('Y-m-d', strtotime($this->date));
					$model->description = $this->description;
					$model->name        = $this->name;
					$model->category    = $this->category;
					$model->paid        = $this->paid;
					$model->at          = $this->at;
					$model->location    = $this->location;
					$model->price       = $this->price;

					$this->date = date('Y-m-d', strtotime($this->date . '+ 7 days'));

					$model->save();

				}
				if ($model->save()) {
					return $this->redirect(Url::to(['event/index']));
				}
			}
		}

		$model = new Event();
		$request_data = Yii::$app->request;
		if ($model->load($request_data->post())) {
			$model->date = date('Y-m-d', strtotime($model->date));
			if ($model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		return $this->render('create', [
			'model' => new Event(),
		]);
	}

	/**
	 * Updates an existing Event model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Event model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	public function actionDeleteMore()
	{
		$request_data       = Yii::$app->request;
		$this->name         = $request_data->post('Event')['name'];
		$this->category     = $request_data->post('Event')['category'];
		$this->paid         = $request_data->post('Event')['paid'];
		$this->at           = $request_data->post('Event')['at'];
		$this->location     = $request_data->post('Event')['location'];
		$this->price        = $request_data->post('Event')['price'];

		$models = Event::find()
			->where(['name'=>$this->name, 'category' => $this->category,
					 'paid' => $this->paid, 'at' => $this->at,
					 'location' => $this->location, 'price' => $this->price])->all();

		if ($models){
			foreach ($models as	$model){
				$model->delete();
			}

			return $this->redirect(['event/index']);
		}

		return $this->render('delete_more', [
			'model' => new Event(),
			'dataCategory' => ArrayHelper::map(Category::find()->asArray()->all(), 'name', 'name'),
			'dataPaid' => ArrayHelper::map(Paid::find()->asArray()->all(), 'paid', 'paid'),
			'dataName' => ArrayHelper::map(Name::find()->asArray()->all(), 'name', 'name'),
			'dataLocation' => ArrayHelper::map(Location::find()->asArray()->all(), 'name', 'name'),
		]);
	}

	/**
	 * Finds the Event model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Event the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Event::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
