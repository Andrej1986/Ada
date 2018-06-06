<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->getSession()->getFlash('success');

$this->title = 'Vymazať Fotku';
$this->params['breadcrumbs'][] = ['label' => 'Eventy', 'url' => ['event/index']];
$this->params['breadcrumbs'][] = ['label' => 'Vymazať - Vyber Kategóriu', 'url' => ['files/delete']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= $name ?></h2>

<?
if (!empty($images) ): ?>
	<?php foreach ($images as $key => $image): ?>
    <div class="col-sm-6">
        <p onclick="confirm('Naozaj chcete fotku vymazat?')" class="text-center"><?= Html::a('Vymazať', Url::to(["/files/delete-group", 'name' => $name, 'image' => $image])) ?></p>
        <?= Html::img("uploads/" . $name . '/' . $image, ['class' => 'pull-left img-responsive col-sm-10']) ?>
    </div>
		<?php if ($key % 2 == 1): ?>
            <div class="clearfix"></div>
            <hr>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
