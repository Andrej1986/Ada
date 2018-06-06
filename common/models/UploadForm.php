<?php

namespace common\models;

use backend\models\Name;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile
	 */
	public $imageFile;
	public $name;

	public function rules()
	{
		return [
			[['name'], 'string'],
			[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
			[['imageFile', 'name'], 'required']
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'name'      => 'Názov',
			'imageFile' => 'Nahrajte súbor',
		];
	}


	public function upload()
	{
		if ($this->validate()) {
			if (!is_dir(Yii::$app->basePath . '/web/uploads/' . $this->name)) {
				mkdir(Yii::$app->basePath . '/web/uploads/' . $this->name);
			}
			foreach ($this->imageFile as $file) {
				$file->saveAs('uploads/' . ($this->name ?: null) . ($this->name ? '/' : null) . $file->baseName . '.' . $file->extension);
			}
			return true;
		} else {
			return false;
		}
	}

	public function selectImagesByName($name)
	{
		if (is_dir(Yii::$app->basePath . "/web/uploads/$name")) {
			$raw_images = \yii\helpers\FileHelper::findFiles(
				Yii::$app->basePath . "/web/uploads/$name", ['only' => ['*.jpg', '*.png']]
			);
			$images = [];
			foreach ($raw_images as $image) {
				$explodeImg = explode('/', $image);
				$imgName    = end($explodeImg);
				$images[]   = $imgName;
			}
		}

		return $images??'';
	}

	public function deleteByName($image_name, $directory_name)
	{
		unlink(Yii::$app->basePath . "/web/uploads/$directory_name/$image_name");
	}
}