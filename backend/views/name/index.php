<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Globálne Eventy';
$this->params['breadcrumbs'][] = ['label' => 'Globálne Eventy', 'url' => ['event/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="name-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Vytvoriť Globálny Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'name',
			[
				'attribute' => 'description',
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
