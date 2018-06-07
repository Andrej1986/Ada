<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Name */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mená', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="name-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Upraviť', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Vymazať', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Naozaj chcete vymazať tento záznam?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description'
        ],
    ]) ?>


	<?php 			$explodeImg = explode('/', $image[0]);
	$imgName    = end($explodeImg);
	echo Html::img("/Ada/backend/web/uploads/main/$model->name/" . $imgName, ['class' => 'pull-left img-responsive col-sm-6']);
	?>
</div>
