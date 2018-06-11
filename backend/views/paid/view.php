<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Paid */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Platby', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paid-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Upraviť', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Vymazať', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'paid',
        ],
    ]) ?>

</div>
