<?php


namespace frontend\controllers;


use frontend\models\Event;
use frontend\models\Paid;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AjaxController extends Controller
{
	public function getColumn($column)
	{
		return \Yii::$app->request->get($column);
	}

	public function actionFilteredEvents()
	{
		if (\Yii::$app->request->isAjax) {
			$paid     = $this->getColumn('paid');
			$category = $this->getColumn('category');
			$when     = $this->getColumn('when');

			if ($paid !== 'Všetky' && $category !== 'Všetky' && $when !== 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'paid'     => $paid,
							'category' => $category,
							'day'      => $when
						])->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid === 'Všetky' && $category !== 'Všetky' && $when !== 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'category' => $category,
							'day'      => $when
						])->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid === 'Všetky' && $category === 'Všetky' && $when !== 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'day' => $when
						])->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid === 'Všetky' && $category === 'Všetky' && $when === 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid === 'Všetky' && $category !== 'Všetky' && $when === 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'category' => $category,
						])
						->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid !== 'Všetky' && $category !== 'Všetky' && $when === 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'category' => $category,
							'paid'     => $paid,
						])
						->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid !== 'Všetky' && $category === 'Všetky' && $when === 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'paid' => $paid,
						])
						->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			} elseif ($paid !== 'Všetky' && $category === 'Všetky' && $when !== 'Všetky') {
				return $this->renderPartial('/site/ajax/filtered_events', [
					'events' => array_unique(ArrayHelper::map(Event::find()->asArray()
						->where([
							'paid' => $paid,
							'day' => $when,
						])
						->all(), 'id', 'name')),
					'paid'     => $paid,
					'category' => $category,
					'day'      => $when
				]);
			}
		}
		return 'fail';
	}

	public function actionSetPaidValues()
	{
		if (\Yii::$app->request->isAjax) {
			$category = $this->getColumn('category');
			$paid     = $this->getColumn('paid');

			$paid_values = ArrayHelper::map(Event::find()->asArray()->where(['category' => $category])->distinct()->all(), 'id', 'paid');
			$category === 'Všetky' ? $paid_values = ArrayHelper::map(Event::find()->asArray()->distinct()->all(), 'id', 'paid') : false;
			$paid_values[] = 'Všetky';

			$paid_values =  array_unique($paid_values);
			if ($element = array_search($paid, $paid_values)) {
				unset($paid_values[$element]);
			}

			return $this->renderPartial('/site/ajax/set_paid_values', [
				'category'    => $paid_values,
				'paid'        => new Paid(),
				'paid_value'  => $paid,
			]);
		}

		return 'paid fail';
	}

	public function actionSetWhenValues()
	{
		if (\Yii::$app->request->isAjax) {
			$category = $this->getColumn('category');
			$paid     = $this->getColumn('paid');
			$when     = $this->getColumn('when');

			$when_values = ArrayHelper::map(Event::find()->asArray()->where(['category' => $category, 'paid' => $paid])->distinct()->all(), 'id', 'day');

			if ($category === 'Všetky' && $paid === 'Všetky'){
				$when_values = ArrayHelper::map(Event::find()->asArray()->distinct()->all(), 'id', 'day');
			}
			if ($category === 'Všetky' && $paid !== 'Všetky') {
				$when_values = ArrayHelper::map(Event::find()->asArray()->where(['paid' => $paid])->distinct()->all(), 'id', 'day');
			}
			if ($category !== 'Všetky' && $paid === 'Všetky') {
				$when_values = ArrayHelper::map(Event::find()->asArray()->where(['category' => $category])->distinct()->all(), 'id', 'day');
			}


			if ($when !== 'Všetky') {
				$when_values[] = 'Všetky';
			}

			$when_values = array_unique($when_values);

			if ($element = array_search($when, $when_values)) {
				unset($when_values[$element]);
			}

			return $this->renderPartial('/site/ajax/set_when_values', [
				'event'       => new Event(),
				'when_values' => $when_values,
				'when'        => $when,
			]);
		}

		return 'when fail';
	}


}