<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $category
 * @property string $paid
 * @property string $day
 * @property string $at
 * @property string $location
 * @property string $date
 * @property string $price
 *
 * @property Comment[] $comments
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date', 'price', 'name', 'at','category', 'paid', 'location'], 'required'],
//            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['name', 'category', 'paid', 'at', 'location'], 'string', 'max' => 255],
            [['day'], 'string', 'max' => 3],
            [['price'], 'number', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Názov',
            'description' => 'Popis',
            'category' => 'Kategória',
            'paid' => 'Platené?',
            'day' => 'Deň',
            'at' => 'O koľkej',
            'location' => 'Miesto',
            'date' => 'Dátum',
            'price' => 'Cena (eur/h)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['event_id' => 'id']);
    }

	public function tranformEnglishDaysToSlovak($day)
	{
		if ($day == 'Mon'){return 'Po';}
		if ($day == 'Tue'){return 'Ut';}
		if ($day == 'Wed'){return 'St';}
		if ($day == 'Thu'){return 'Št';}
		if ($day == 'Fri'){return 'Pi';}
		if ($day == 'Sat'){return 'So';}
		if ($day == 'Sun'){return 'Ne';}

		return $day;
    }
}
