<?php

use kartik\sidenav\SideNav;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\i18n\Formatter;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Eventy';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-sm-3" style="margin-top: 135px;">
	<?=
	SideNav::widget([
		'type'    => SideNav::TYPE_DEFAULT,
		'heading' => 'Ďalšie Možnosti',
		'items'   => [
			[
				'url'   => Url::to(['/name/index']),
				'label' => 'Globálne Eventy',
				'icon'  => 'list-alt'
			],
            [
				'url'   => Url::to(['/category/index']),
				'label' => 'Kategórie',
				'icon'  => 'wrench'
			],
            [
				'url'   => Url::to(['/location/index']),
				'label' => 'Miesta',
				'icon'  => 'home'
			],
			[
				'url'   => Url::to(['/paid/index']),
				'label' => 'Typy Platieb',
				'icon'  => 'euro',
//				'items' => [
//					['label' => 'About', 'icon' => 'info-sign', 'url' => '#'],
//					['label' => 'Contact', 'icon' => 'phone', 'url' => '#'],
//				],
			],
			[
				'url'   => Url::to(['/admin']),
				'label' => 'Nastavnie Admina',
				'icon'  => 'user'
			],
			[
				'label' => 'Fotky',
				'icon'  => 'camera',
				'items' => [
					['label' => 'Nahrať', 'url' => Url::to(['/files/upload'])],
					['label' => 'Vymazať', 'url' => Url::to(['/files/delete'])],
				],
			],
		],
	]);
	?>
</div>
<div class="event-index col-sm-9">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Vytvoriť Event', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Vymazať súbor Eventov', ['delete-more'], ['class' => 'btn btn-warning']) ?>
    </p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'name',
			'category',
			'paid',
			'day',
			'at',
			'location',
			'address',
			[
				'attribute' => 'date',
				'value'     => function ($data) {
					return \Yii::$app->formatter->asDatetime($data->date, 'php:d-m-Y');
				},
			],
			'price',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
