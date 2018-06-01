<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form ActiveForm */
?>
<div class="event-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'price') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'category') ?>
        <?= $form->field($model, 'paid') ?>
        <?= $form->field($model, 'at') ?>
        <?= $form->field($model, 'location') ?>
        <?= $form->field($model, 'day') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- event-index -->
