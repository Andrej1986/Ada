<?php

namespace backend\controllers;

use backend\models\Event;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
        	'model' => new Event(),
		]);
    }

}
