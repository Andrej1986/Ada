<?php

use janisto\timepicker\TimePicker;
use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

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

	<?= $form->field($model, 'date')->widget(TimePicker::className(), [
		'language'      => 'sk',
		'mode'          => 'date',
		'clientOptions' => [
			'dateFormat' => 'dd.mm.yy',
//			'timeFormat' => 'HH:mm:ss',
		]
	]); ?>

    <hr>
    <label for="repeat-event">Opakovať Event?</label>
    <input type="checkbox" name="repeat-event" id="repeat-event">&nbsp;
    <label for="repeat">Koľkokrát?</label>
    <input type="number" name="repeat" id="repeat" min="1" max="52">
    <hr>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
		<?= Html::submitButton('Uložiť', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
