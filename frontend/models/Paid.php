<?php


namespace frontend\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Paid extends ActiveRecord
{
	public $paid;

	public function rules()
	{
		return[
			[['id'], 'integer'],
			[['paid'], 'string'],
		];
	}

	public static function findByCategory($category = 'Všetky')
	{
		if ($category === 'Všetky') {
			return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'paid');
		}

		return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'paid');
	}
}