<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->getSession()->getFlash('success');

$this->title = 'Vymazať - Vyber Kategóriu';
$this->params['breadcrumbs'][] = ['label' => 'Eventy', 'url' => ['event/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'name')->dropDownList($events, ['prompt' => '']) ?>

<button>Potvrdiť</button>

<?php ActiveForm::end() ?>
