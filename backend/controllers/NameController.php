<?php

namespace backend\controllers;

use Yii;
use backend\models\Name;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NameController implements the CRUD actions for Name model.
 */
class NameController extends Controller
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
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Name models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Name::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Name model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);

		if (is_dir(Yii::$app->basePath . "/web/uploads/main/$model->name")) {
			$image = FileHelper::findFiles(Yii::$app->basePath . "/web/uploads/main/$model->name", ['only' => ['*.jpg', '*.png']]);
		}

		return $this->render('view', [
			'model' => $model,
			'image' => $image??'',
		]);
	}

	/**
	 * Creates a new Name model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Name();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');

			if ($model->upload()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Name model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');

			if ($model->upload()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		if (is_dir(Yii::$app->basePath . "/web/uploads/main/$model->name")) {
			$image = FileHelper::findFiles(Yii::$app->basePath . "/web/uploads/main/$model->name", ['only' => ['*.jpg', '*.png']]);
		}

		return $this->render('update', [
			'model' => $model,
			'image' => $image ?? '',
		]);
	}

	/**
	 * Deletes an existing Name model.
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

	public function actionDeleteImage($name, $id)
	{
		if (Yii::$app->basePath . '/web/uploads/main/' . $name) {
			FileHelper::removeDirectory(Yii::$app->basePath . '/web/uploads/main/' . $name);
		}

		return $this->redirect(['/name/update', 'id' => $id]);
	}

	/**
	 * Finds the Name model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Name the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Name::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
