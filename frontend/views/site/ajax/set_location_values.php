<?php

use yii\widgets\ActiveForm;

ob_start();
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
ob_get_clean();

?>

<?php if ($category): ?>
	<?= $form->field($model, 'location')->dropDownList($category, ['prompt' => $location_value])->label('Miesto') ?>
<?php endif; ?>


<?php if (!$category): ?>
	<?= $form->field($model, 'location')->dropDownList($category, [ 'prompt' => $location_value])->label('Miesto') ?>

<?php endif; ?>

