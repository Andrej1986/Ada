<?php

use yii\widgets\ActiveForm;

ob_start();
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
ob_get_clean();

?>


<?php if ($when_values): ?>
	<?= $form->field($model, 'day')->dropDownList($when_values, ['onchange' => 'setPaidValues(), setLocationValues()', 'prompt' => $when])->label('Kedy') ?>
<?php endif; ?>

<?php if (!$when_values): ?>
	<?= $form->field($model, 'day')->dropDownList($when_values, ['onchange' => 'setPaidValues(), setLocationValues()', 'prompt' => $when])->label('Kedy') ?>
<?php endif; ?>
