<?php

namespace frontend\controllers;

use Yii;
use common\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
//                    'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Comment models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Comment::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Comment model.
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
	 * Creates a new Comment model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($name)
	{
		$model = new Comment();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['/site/event', 'name' => $name]);
		}

		return 'comment create failed';
	}

	/**
	 * Updates an existing Comment model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id, $name)
	{
		if (Yii::$app->user->can('superadmin')) {
			$model = $this->findModel($id);

			if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
				return $this->redirect(['/site/event', 'name' => $name]);

			}

			return $this->render('update', [
				'model' => $model,
			]);
		}
		return $this->goHome();
	}

	/**
	 * Deletes an existing Comment model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id, $name)
	{
		if (Yii::$app->user->can('superadmin')) {
			$this->findModel($id)->delete();

			return $this->redirect(['/site/event', 'name' => $name]);
		}

		return $this->goHome();
	}

	/**
	 * Finds the Comment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Comment the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Comment::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
