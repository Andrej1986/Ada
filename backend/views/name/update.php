<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Name */

$this->title = 'Upraviť Názov: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Názvy', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Upraviť';
?>
<div class="name-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
