<?php


namespace frontend\models;


use yii\db\ActiveRecord;

class Event extends ActiveRecord
{
	public $name;

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['name'], 'string'],
			[['category'], 'string'],
		];
	}


	public function findLocationAddressByNameCatetoryPaidDay($name, $category, $paid, $day)
	{
		$addresses = Event::find()->select('location, address')->distinct()->asArray()
			->andWhere(['name' => $name])
			->andWhere($category == ('Všetky') ? ['!=', 'category', 'bla'] : ['category' => $category])
			->andWhere($paid == ('Všetky') ? ['!=', 'paid', 'bla'] : ['paid' => $paid])
			->andWhere($day == ('Všetky') ? ['!=', 'day', 'bla'] : ['day' => $day])
			->all();

		for ($i = 0; $i < count($addresses); $i++) {
			$addresses[$i]['days'] = $this->findDayCategoryByNameCatetoryPaidLocationAddress($name, $category, $paid, $day, $addresses[$i]['location'], $addresses[$i]['address']);
		}

		return ['addresses' => $addresses];
	}

	public function findDayCategoryByNameCatetoryPaidLocationAddress($name, $category, $paid, $day, $location, $address)
	{
		$days = Event::find()->select('day, category')->distinct()->asArray()
			->andWhere(['name' => $name])
			->andWhere($category == ('Všetky') ? ['!=', 'category', 'bla'] : ['category' => $category])
			->andWhere($paid == ('Všetky') ? ['!=', 'paid', 'bla'] : ['paid' => $paid])
			->andWhere($day == ('Všetky') ? ['!=', 'day', 'bla'] : ['day' => $day])
			->andWhere($location == ('Všetky') ? ['!=', 'location', 'bla'] : ['location' => $location])
			->andWhere($address == ('Všetky') ? ['!=', 'address', 'bla'] : ['address' => $address])
			->all();

		for ($i = 0; $i < count($days); $i++) {
			$days[$i]['at'] = $this->findAtByNameCatetoryPaidLocationAddress($name, $days[$i]['category'], $paid, $days[$i], $location, $address);
		}

		return $days;
	}

	public function findAtByNameCatetoryPaidLocationAddress($name, $category, $paid, $day, $location, $address)
	{
		$ats = Event::find()->select('at')->distinct()->asArray()
			->andWhere(['name' => $name])
			->andWhere($category == ('Všetky') ? ['!=', 'category', 'bla'] : ['category' => $category])
			->andWhere($paid == ('Všetky') ? ['!=', 'paid', 'bla'] : ['paid' => $paid])
			->andWhere($day == ('Všetky') ? ['!=', 'day', 'bla'] : ['day' => $day])
			->andWhere($location == ('Všetky') ? ['!=', 'location', 'bla'] : ['location' => $location])
			->andWhere($address == ('Všetky') ? ['!=', 'address', 'bla'] : ['address' => $address])
			->all();

		for ($i = 0; $i < count($ats); $i++) {
			$ats[$i]['price'] = $this->findPriceByNameCatetoryPaidLocationAddress($name, $category, $paid, $day, $location, $address, $ats[$i]['at']);
		}


		return $ats;
	}

	public function findPriceByNameCatetoryPaidLocationAddress($name, $category, $paid, $day, $location, $address, $at)
	{
		$at = Event::find()->select('price')->distinct()->asArray()
			->andWhere(['name' => $name])
			->andWhere($category == ('Všetky') ? ['!=', 'category', 'bla'] : ['category' => $category])
			->andWhere($paid == ('Všetky') ? ['!=', 'paid', 'bla'] : ['paid' => $paid])
			->andWhere($day == ('Všetky') ? ['!=', 'day', 'bla'] : ['day' => $day])
			->andWhere($location == ('Všetky') ? ['!=', 'location', 'bla'] : ['location' => $location])
			->andWhere($address == ('Všetky') ? ['!=', 'address', 'bla'] : ['address' => $address])
			->andWhere($address == ('Všetky') ? ['!=', 'at', 'bla'] : ['at' => $at])
			->all();

		return $at;
	}


	public function tranformSlovakDaysToEnglish($day)
	{
		if ($day == 'Pondelok') {
			return 'Mon';
		}
		if ($day == 'Utorok') {
			return 'Tue';
		}
		if ($day == 'Streda') {
			return 'Wed';
		}
		if ($day == 'Štvrtok') {
			return 'Thu';
		}
		if ($day == 'Piatok') {
			return 'Fri';
		}
		if ($day == 'Sobota') {
			return 'Sat';
		}
		if ($day == 'Nedeľa') {
			return 'Sun';
		}

		return $day;
	}

	public function numbersToSlovakWeekdays($day)
	{
//		$days = [];

//		foreach ($days_array as $day) {
		if ($day == 1) {
			$transformed_day = 'Pondelok';
		}
		if ($day == 2) {
			$transformed_day = 'Utorok';
		}
		if ($day == 3) {
			$transformed_day = 'Streda';
		}
		if ($day == 4) {
			$transformed_day = 'Štvrtok';
		}
		if ($day == 5) {
			$transformed_day = 'Piatok';
		}
		if ($day == 6) {
			$transformed_day = 'Sobota';
		}
		if ($day == 7) {
			$transformed_day = 'Nedeľa';
		}

//			$days[] = $transformed_day;
//		}
		return $transformed_day;
	}

	public function sortNumbersAsc($days_array = [])
	{
		usort($days_array, function ($a, $b) {
			if ($a == $b) {
				return 0;
			}
			return ($a < $b) ? -1 : 1;
		});

		return $days_array;
	}

	public function sortDaysInWeek($days)
	{

		for ($i = 0; $i < count($days); $i++) {
			$days[$i]['day'] = $this->tranformSlovakDaysToEnglish($days[$i]['day']);
			$days[$i]['day'] = date('N', strtotime($days[$i]['day']));
		}


		$days = $this->sortNumbersAsc($days);

		for ($i = 0; $i < count($days); $i++) {
			$days[$i]['day'] = $this->numbersToSlovakWeekdays($days[$i]['day']);

		}

//		$days = array_unique($days);

//		var_dump($days);
//		exit();


		return $days;
	}


}