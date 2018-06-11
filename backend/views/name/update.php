<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Name */

$this->title                   = 'Upraviť Globálny Event: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Globálne Eventy', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Upraviť';
?>
<div class="name-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

	<?php if (!empty($image)): ?>
    <?= Html::a('Vymazať fotku', Url::to(['/name/delete-image', 'name' => $model->name, 'id' => $model->id]), ['onClick' => 'return confirm("Naozaj chcete fotku vymazať?")']) ?>
		<?php
		$explodeImg = explode('/', $image[0]);
		$imgName    = end($explodeImg);
		echo Html::img("/Ada/backend/web/uploads/main/$model->name/" . $imgName, ['class' => 'pull-left img-responsive col-sm-6']);
		?>
	<?php endif; ?>
</div>
