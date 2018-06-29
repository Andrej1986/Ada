<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Location */

$this->title = 'Vytvoriť Miesto';
$this->params['breadcrumbs'][] = ['label' => 'Miesta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
