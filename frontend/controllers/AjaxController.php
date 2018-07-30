<?php


namespace frontend\controllers;


use backend\models\Name;
use common\models\Comment;
use frontend\models\Event;
use frontend\models\Paid;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AjaxController extends Controller
{
	public function getColumn($column)
	{
		return \Yii::$app->request->get($column);
	}

	public function actionSetActivityValues()
	{
		if (\Yii::$app->request->isAjax) {
			$category = $this->getColumn('category');
			$activity = $this->getColumn('activity');

			$activity_values = ArrayHelper::map(Event::find()->asArray()->where(['category' => $category])->distinct()->all(), 'id', 'name');
			$category === 'Všetky' ? $activity_values = ArrayHelper::map(Event::find()->asArray()->distinct()->all(), 'id', 'name') : false;
			$activity !== 'Všetky' ? $activity_values[] = 'Všetky' : false;

			$activity_values = array_unique($activity_values);
			if ($key = array_search($activity, $activity_values)) {
				unset($activity_values[$key]);
			}

			return $this->renderPartial('/site/ajax/set_activity_values', [
				'category'       => $activity_values,
				'model'          => new Event(),
				'activity_value' => $activity,
			]);

//			return 'true';

		}

		return 'activity fail';
	}

	public function actionSetWhenValues()
	{
		if (Yii::$app->request->isAjax) {
			$category = $this->getColumn('category');
			$activity = $this->getColumn('activity');
			$when     = $this->getColumn('when');

			$when_values = ArrayHelper::map(Event::find()->asArray()
				->andWhere([$category == 'Všetky' ? '!=' : '=', 'category', $category,])
				->andWhere([$activity == 'Všetky' ? '!=' : '=', 'name', $activity])
				->distinct()->all(), 'id', 'day');

			$when !== 'Všetky' ? $when_values[] = 'Všetky' : false;

			$when_values = array_unique($when_values);

			if ($element = array_search($when, $when_values)) {
				unset($when_values[$element]);
			}

			return $this->renderPartial('/site/ajax/set_when_values', [
				'model'       => new Event(),
				'when_values' => $when_values,
				'when'        => $when,
			]);
		}

		return 'when fail';
	}

	public function actionSetPaidValues()
	{
		if (\Yii::$app->request->isAjax) {
			$category = $this->getColumn('category');
			$activity = $this->getColumn('activity');
			$when     = $this->getColumn('when');
			$paid     = $this->getColumn('paid');

			$paid_values = ArrayHelper::map(Event::find()->asArray()
				->andWhere([$category == 'Všetky' ? '!=' : '=', 'category', $category,])
				->andWhere([$activity == 'Všetky' ? '!=' : '=', 'name', $activity])
				->andWhere([$when == 'Všetky' ? '!=' : '=', 'day', $when])
				->distinct()->all(), 'id', 'paid');

			$category === 'Všetky' ? $paid_values = ArrayHelper::map(Event::find()->asArray()->distinct()->all(), 'id', 'paid') : false;
			$paid !== 'Všetky' ? $paid_values[] = 'Všetky' : false;

			$paid_values = array_unique($paid_values);
			if ($element = array_search($paid, $paid_values)) {
				unset($paid_values[$element]);
			}

			return $this->renderPartial('/site/ajax/set_paid_values', [
				'category'   => $paid_values,
				'model'      => new Event(),
				'paid_value' => $paid,
			]);
		}

		return 'paid fail';
	}

	public function actionSetLocationValues()
	{
		if (\Yii::$app->request->isAjax) {
			$category = $this->getColumn('category');
			$activity = $this->getColumn('activity');
			$when     = $this->getColumn('when');
			$paid     = $this->getColumn('paid');
			$location = $this->getColumn('location');

			$location_values = ArrayHelper::map(Event::find()->asArray()
				->andWhere([$category == 'Všetky' ? '!=' : '=', 'category', $category,])
				->andWhere([$activity == 'Všetky' ? '!=' : '=', 'name', $activity])
				->andWhere([$when == 'Všetky' ? '!=' : '=', 'day', $when])
				->andWhere([$paid == 'Všetky' ? '!=' : '=', 'paid', $paid])
				->distinct()->all(), 'id', 'location');

			$category === 'Všetky' ? $location_values = ArrayHelper::map(Event::find()->asArray()->distinct()->all(), 'id', 'location') : false;
			$location !== 'Všetky' ? $location_values[] = 'Všetky' : false;

			$location_values = array_unique($location_values);
			if ($element = array_search($location, $location_values)) {
				unset($location_values[$element]);
			}

			return $this->renderPartial('/site/ajax/set_location_values', [
				'category'       => $location_values,
				'model'          => new Event(),
				'location_value' => $location,
			]);
		}

		return 'location fail';
	}

	public function actionSaveComment($name)
	{
		if (Yii::$app->request->isAjax) {

			$model          = new Comment();
			$model->name_id = (int)Yii::$app->request->post('name_id');
			$model->text    = Yii::$app->request->post('text');

			if ($model->save()) {
				$event = Name::findOne(['name' => $name]);

				$query      = Comment::find()->where(['name_id' => $event['id']]);
				$pagination = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
				return $this->renderPartial('/site/ajax/comments', [
					'comments' => $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('id desc')->all(),
					'event'    => $event,

				]);
			} else {
				return 'not saved';
			}
		} else {
			return 'ble';
		}
	}


}