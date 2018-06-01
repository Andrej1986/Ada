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
            [['date', 'price'], 'required'],
            [['date'], 'safe'],
            [['name', 'category', 'paid', 'at', 'location'], 'string', 'max' => 255],
            [['day'], 'string', 'max' => 3],
            [['price'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'category' => 'Category',
            'paid' => 'Paid',
            'day' => 'Day',
            'at' => 'At',
            'location' => 'Location',
            'date' => 'Date',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['event_id' => 'id']);
    }
}
