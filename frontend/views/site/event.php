<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = $event['name'];
?>
<div class="site-schedule">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $event['description'] ?></p>
    <!--	--><?php //var_dump($images) ?>
	<?php if (!empty($images)): ?>
		<?php foreach ($images as $image): ?>
			<?php
			$i++;
			$explodeImg = explode('/', $image);
			$imgName    = end($explodeImg);
			echo Html::img("/Ada/backend/web/uploads/$name/" . $imgName, ['class' => 'pull-left img-responsive col-sm-6']);
			?>
			<?php if ($i % 2 == '0'): ?>
                <div class="clearfix"></div>
                <hr>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

    <div class="clearfix"></div>
    <hr>
    <div class="comment-form col-sm-6">

		<?php $form = ActiveForm::begin(['action' => Url::to(['/comment/create', 'name' => $name])]); ?>

		<?= $form->field($model, 'text')->textarea(['rows' => 2]) ?>
		<?= $form->field($model, 'name_id')->hiddenInput(['value' => $event['id']])->label(false) ?>

        <div class="form-group">
			<?= Html::submitButton('Pridať komentár', ['class' => 'btn btn-success']) ?>
        </div>

		<?php ActiveForm::end(); ?>

    </div>

    <div class="clearfix"></div>

	<?php Pjax::begin() ?>

    <div class="all-comments">
		<?php foreach ($comments as $comment): ?>
            <div class="row">
				<?= $comment['text'] ?> &nbsp;
				<?php if (Yii::$app->user->can('superadmin')): ?>
                    <p><a href="<?= Url::to(['/comment/delete', 'id' => $comment['id'], 'name' => $event['name']]) ?>">Vymazať</a>
                    </p>
                    <p><a href="<?= Url::to(['/comment/update', 'id' => $comment['id'], 'name' => $event['name']]) ?>">Upraviť</a>
                    </p>
				<?php endif; ?>
            </div>
		<?php endforeach; ?>
    </div>

	<?php
	echo LinkPager::widget([
		'pagination' => $pagination,
	]);
	Pjax::end();
	?>
</div>





















