<?php

namespace backend\models;

use frontend\models\Event;
use Yii;

/**
 * This is the model class for table "calendar".
 *
 * @property int $id
 * @property string $event_title
 * @property string $event_date
 */
class Calendar extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'calendar';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['event_date'], 'safe'],
			[['event_title'], 'string', 'max' => 150],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id'          => 'ID',
			'event_title' => 'Event Title',
			'event_date'  => 'Event Date',
		];
	}

	public function selectAll()
	{
		return Event::find()->asArray()->all();
	}

	public function selectEvents($year, $month, $day)
	{
		return Event::find()->asArray()->where(['date' => "{$year}-{$month}-{$day}"])->all();
	}

	public function insertEvent($event_title, $event_description, $event_category, $event_date, $repeat_weekly = false, $weeks_count = 0, $time, $location, $paid, $price)
	{

		if ($repeat_weekly && $weeks_count >= 1) {
			for ($i = 1; $i <= $weeks_count; $i++) {
				$event_date = date('Y-m-d', strtotime($event_date . ' + 7 days'));


				$event              = new Event();
				$event->title       = $event_title;
				$event->description = $event_description;
				$event->category    = $event_category;
				$event->date        = $event_date;
				$event->at          = $time;
				$event->location    = $location;
				$event->paid        = $paid;
				$event->price       = $price;

				return $event->save();
			}
		}


		$event              = new Event();
		$event->title       = $event_title;
		$event->description = $event_description;
		$event->category    = $event_category;
		$event->date        = $event_date;
		$event->at          = $time;
		$event->location    = $location;
		$event->paid        = $paid;
		$event->price       = $price;

		return $event->save();
	}


}
