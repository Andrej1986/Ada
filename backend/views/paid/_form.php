<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Paid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'paid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
