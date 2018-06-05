<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = $event['name'];
?>
<div class="site-schedule">
    <h1><?= Html::encode($this->title) ?></h1>

        <p><?= $event['description'] ?></p>
</div>




















