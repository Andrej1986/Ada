<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Paid */

$this->title = 'Vytvoriť platbu';
$this->params['breadcrumbs'][] = ['label' => 'Platby', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
