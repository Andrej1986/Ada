<?php


namespace frontend\models;


use Yii;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

class File extends ActiveRecord
{
	public function imagesByEventName($name)
	{
		if (is_dir('/Users/andrejsoukup/yii' . Yii::$app->urlManagerBackend->baseUrl . "/uploads/$name")) {
			return FileHelper::findFiles('/Users/andrejsoukup/yii' . Yii::$app->urlManagerBackend->baseUrl . "/uploads/$name", ['only' => ['*.jpg', '*.png']]);
		}
		return false;
	}
}