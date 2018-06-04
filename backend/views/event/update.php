<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Name;
use backend\models\Category;
use backend\models\Paid;
use backend\models\Location;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Update Event: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'dataCategory' => ArrayHelper::map(Category::find()->asArray()->all(), 'name', 'name'),
		'dataPaid' => ArrayHelper::map(Paid::find()->asArray()->all(), 'paid', 'paid'),
		'dataName' => ArrayHelper::map(Name::find()->asArray()->all(), 'name', 'name'),
		'dataLocation' => ArrayHelper::map(Location::find()->asArray()->all(), 'name', 'name'),
    ]) ?>

</div>
