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


    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
<!--    --><?//= $form->field($model, 'category')->dropDownList((new Category())->selectAllCategories(), ['prompt' => '']) ?>
    <?= $form->field($model, 'category')->dropDownList($dataCategory, ['prompt' => '']) ?>

    <?= $form->field($model, 'paid')->dropDownList($dataPaid, ['prompt' => '']) ?>

<!--    --><?//= $form->field($model, 'day')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'at')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model,'at')->widget(TimePicker::className(), [
		'language' => 'sk',
		'mode' => 'time',
		'clientOptions' => [
//			'dateFormat' => 'yy-mm-dd',
			'timeFormat' => 'HH:mm',
		]
	]); ?>


	<?= $form->field($model, 'location')->dropDownList($dataLocation, ['prompt' => '']) ?>



    <!--    <p><strong> Date</strong></p>-->
	<?= $form->field($model,'date')->widget(TimePicker::className(), [
		'language' => 'sk',
		'mode' => 'date',
		'clientOptions' => [
			'dateFormat' => 'dd.mm.yy',
//			'timeFormat' => 'HH:mm:ss',
		]
	]);?>


    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
