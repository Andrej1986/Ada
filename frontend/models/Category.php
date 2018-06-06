<?php


namespace frontend\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord
{
	public $name;

	public function rules()
	{
		return[
			[['id'], 'integer'],
			[['name'], 'string'],
		];
	}

	public function selectUsedCategories()
	{
		$categories =  ArrayHelper::map(Event::find()->asArray()->distinct()->all(), 'id', 'category');
		return array_unique($categories);
	}

	public function selectAllCategories()
	{
		return $categories =  ArrayHelper::map(self::find()->asArray()->all(), 'id', 'name');
	}
}