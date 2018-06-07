<?php

use yii\widgets\ActiveForm;

ob_start();
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
ob_get_clean();

?>

<?= $form->field($event, 'day')->dropDownList($when_values, ['onchange' => 'getFilteredEvents()', 'prompt' => $when])->label('Kedy') ?>
