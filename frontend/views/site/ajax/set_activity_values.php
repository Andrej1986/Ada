<?php

use yii\widgets\ActiveForm;

ob_start();
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
ob_get_clean();

//var_dump($category);
?>

<?php if ($category): ?>
	<?= $form->field($model, 'name')->dropDownList($category, ['onchange' => 'setWhenValues(), setPaidValues(), setLocationValues()', 'prompt' => $activity_value])->label('Aktivita') ?>
<?php endif; ?>


<?php if (!$category): ?>

	<?= $form->field($model, 'name')->dropDownList($category, ['onchange' => 'setWhenValues(), setPaidValues(), setLocationValues()', 'prompt' => $activity_value])->label('Aktivita') ?>

<?php endif; ?>

