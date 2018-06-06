<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Paid */

$this->title = 'Create Paid';
$this->params['breadcrumbs'][] = ['label' => 'Paids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
