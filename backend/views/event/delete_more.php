<?php

use yii\helpers\Html;

use janisto\timepicker\TimePicker;
use kartik\sidenav\SideNav;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Vymazať Eventy: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Eventy', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Vymazať';
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="event-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'name')->dropDownList($dataName, ['prompt' => '']) ?>

		<?= $form->field($model, 'category')->dropDownList($dataCategory, ['prompt' => '']) ?>

		<?= $form->field($model, 'paid')->dropDownList($dataPaid, ['prompt' => '']) ?>

		<?= $form->field($model, 'at')->widget(TimePicker::className(), [
//		'language'      => 'sk',
			'mode'          => 'time',
			'clientOptions' => [
//			'dateFormat' => 'yy-mm-dd',
				'timeFormat' => 'HH:mm',
			]
		]); ?>

		<?= $form->field($model, 'location')->dropDownList($dataLocation, ['prompt' => '']) ?>

		<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
			<?= Html::submitButton('Potvrdiť', ['class' => 'btn btn-success']) ?>
        </div>
		<?php ActiveForm::end(); ?>

    </div>


</div>
