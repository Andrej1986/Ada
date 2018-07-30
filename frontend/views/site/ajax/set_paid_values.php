<?php

use yii\widgets\ActiveForm;

ob_start();
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
ob_get_clean();

?>

<?php if ($category): ?>
	<?= $form->field($model, 'paid')->dropDownList($category, ['onchange' => 'setLocationValues()', 'prompt' => $paid_value])->label('Platené?') ?>
<?php endif; ?>


<?php if (!$category): ?>

	<?= $form->field($model, 'paid')->dropDownList($category, ['onchange' => 'setLocationValues()', 'prompt' => $paid_value])->label('Platené?') ?>

<?php endif; ?>

