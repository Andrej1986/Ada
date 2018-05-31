<?php


namespace frontend\models;


use yii\db\ActiveRecord;

class Event extends ActiveRecord
{
	public $name;

	public function rules()
	{
		return[
			[['id'], 'integer'],
			[['name'], 'string'],
			[['category'], 'string'],
		];
	}



}