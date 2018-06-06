<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Paid */

$this->title = 'Update Paid: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paid-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
