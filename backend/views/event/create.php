<?php

use backend\models\Name;
use backend\models\Category;
use backend\models\Paid;
use backend\models\Location;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Vytvoriť Event';
$this->params['breadcrumbs'][] = ['label' => 'Eventy', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'dataCategory' => ArrayHelper::map(Category::find()->asArray()->all(), 'name', 'name'),
		'dataPaid' => ArrayHelper::map(Paid::find()->asArray()->all(), 'paid', 'paid'),
		'dataName' => ArrayHelper::map(Name::find()->asArray()->all(), 'name', 'name'),
		'dataLocation' => ArrayHelper::map(Location::find()->asArray()->all(), 'name', 'name'),
		'dataAddress' => ArrayHelper::map(Location::find()->asArray()->all(), 'address', 'address'),

	]) ?>

</div>
