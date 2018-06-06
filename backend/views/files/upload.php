<?php
use yii\widgets\ActiveForm;
Yii::$app->getSession()->getFlash('success');

$this->title = 'Nahrať Fotky';
$this->params['breadcrumbs'][] = ['label' => 'Eventy', 'url' => ['event/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'name')->dropDownList($events, ['prompt' => '']) ?>

<?= $form->field($model, 'imageFile[]')->fileInput(['multiple' => true]) ?>

    <button>Potvrdiť</button>

<?php ActiveForm::end() ?>