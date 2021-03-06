<?php

namespace backend\controllers;

use backend\models\Calendar;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use	yii\helpers\Url;

class CalendarController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow' => true,
					],
					[
						'allow' => true,
						'roles' => ['superadmin'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

    public function actionIndex($month, $year)
    {
        return $this->render('index', [
        	'calendar' => $this->calendar($month, $year),
			'calendar_controllers' => $this->calendarControllers(),

		]);
    }
    public function actionTest($month, $year)
    {
    	return 'test';
    }

	public function calendar($month , $year)
	{
		/* draw table */
		$calendar = '<table cellpadding="0" cellspacing="0" class="table">';

		/* table headings */
		$headings = array( 'Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota', 'Nedeľa');
		$calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

		/* days and weeks vars now ... */
		$running_day       = date('w', mktime(0, 0, 0, $month, 0, $year));
		$days_in_month     = date('t', mktime(0, 0, 0, $month, 0, $year));
		$days_in_this_week = 1;
		$day_counter       = 0;
		$dates_array       = array();

		/* row for week one */
		$calendar .= '<tr class="calendar-row">';

		/* print "blank" days until the first of the current week */
		for ($x = 0; $x < $running_day; $x++):
			$calendar .= '<td class="calendar-day-np"> </td>';
			$days_in_this_week++;
		endfor;

		/* keep going with days.... */
		for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
			$calendar .= '<td class="calendar-day">';
			/* add in the day number */
			$calendar .= '<div class="day-number">' . $list_day . '</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar .= str_repeat('<p> </p>', 2);

			$calendar_model = new Calendar();
			$events = $calendar_model->selectEvents($year, $month, $list_day);
			foreach ($events as $event){
				$calendar .=  '<br><span>' . $event['name'] . '</span> <br>';
				$calendar .=  '<span>' . $event['category'] . '</span> <br>';
				$calendar .=  '<span>' . $event['at'] . '</span> <hr>';
			}
//			 var_dump($year);
//			 var_dump($month);
//			 var_dump($list_day);
//			var_dump($year .'-' . $month . '-' . $list_day);


			$calendar .= '</td>';
			if ($running_day == 6):
				$calendar .= '</tr>';
				if (($day_counter + 1) != $days_in_month):
					$calendar .= '<tr class="calendar-row">';
				endif;
				$running_day       = -1;
				$days_in_this_week = 0;
			endif;
			$days_in_this_week++;
			$running_day++;
			$day_counter++;
		endfor;

		/* finish the rest of the days in the week */
		if ($days_in_this_week < 8):
			for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
				$calendar .= '<td class="calendar-day-np"> </td>';
			endfor;
		endif;

		/* final row */
		$calendar .= '</tr>';

		/* end the table */
		$calendar .= '</table>';

		/* all done, return result */
		return $calendar;
    }

	public function calendarControllers()
	{
		/* date settings */
		$month = (int) ($_GET['month'] ?? date('m'));
		$year = (int)  ($_GET['year'] ?? date('Y'));

		/* select month control */
		$select_month_control = '<select name="month" id="month">';
		for($x = 1; $x <= 12; $x++) {
			$select_month_control.= '<option value="'.$x.'" '.($x != $month ? '' : ' selected="selected"').'>
			'.date('m',mktime(0,0,0,$x,1,$year)).'
			</option>';
		}
		$select_month_control.= '</select>';

		/* select year control */
		$year_range = 10;
		$select_year_control = '<select name="year" id="year">';
		for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
			$select_year_control.= '<option value="'.$x.'" '.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
		}
		$select_year_control.= '</select>';

		/* "next month" control */
		$next_month_link = '<a href="?r=calendar%2Findex&month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control"> Nasledujúci Mesiac >> </a>';

		/* "previous month" control */
		$previous_month_link = '<a href="?r=calendar%2Findex&month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control"> << Predchádzajúci Mesiac : </a>';

		/* bringing the controls together */
		$controls = '<form method="get"><input type="hidden" name="r" value="calendar">'.$select_month_control.$select_year_control.' <input type="submit" name="submit" value="Potvrdiť" />      '.$previous_month_link.'     '.$next_month_link.' </form>';

//		$controls = '<form method="get">'.$previous_month_link.'     '.$next_month_link.' </form>';


		return $controls;
	}

}
