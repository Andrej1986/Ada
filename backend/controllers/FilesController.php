<?php

namespace backend\controllers;

use backend\models\Name;
use common\models\UploadForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class FilesController extends \yii\web\Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionUpload()
	{
		$model  = new UploadForm();
		$events = ArrayHelper::map(Name::find()->asArray()->all(), 'name', 'name');

		if (Yii::$app->request->isPost) {
			$model->imageFile = UploadedFile::getInstances($model, 'imageFile');
			$model->name      = Yii::$app->request->post('UploadForm')['name'];
			if ($model->upload()) {
				// file is uploaded successfully
				Yii::$app->getSession()->setFlash('success', 'Fotka bola úspeňe pridaná! :)');
				return $this->redirect(['/files/upload']);
			}
		}

		return $this->render('/files/upload', [
			'model'  => $model,
			'events' => $events,
		]);
	}

	public function actionDelete()
	{
		$model  = new UploadForm();

		if (Yii::$app->request->isPost) {
			$model->name = Yii::$app->request->post('UploadForm')['name'];
			$this->redirect(['/files/delete-group', 'name' => $model->name]);
		}

		return $this->render('/files/delete', [
			'model'  => $model,
			'events' => ArrayHelper::map(Name::find()->asArray()->all(), 'name', 'name'),
		]);
	}

	public function actionDeleteGroup($name)
	{
		$model = new UploadForm();

		if (Yii::$app->request->isGet) {
			$images      = $model->selectImagesByName($name);
			if ($image_name =  Yii::$app->request->get('image')){
				$model->deleteByName($image_name, $name);

				$this->redirect(['/files/delete-group', 'name' => $name]);
			}
		}

		return $this->render('/files/delete_group', [
//			'events' => $events,
			'images' => $images??'',
			'name' => $name,
		]);
	}
}
