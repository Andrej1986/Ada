<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use frontend\models\Event;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = $event['name'];
?>
<div class="site-event-details">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="description">
        <pre class="event-description"><?= $event['description'] ?></pre>
    </div>
    <div class="event-details">

        <div class="row">
            <h3 class="col-sm-4">Kde</h3>
            <h3 class="col-sm-2">Deň</h3>
            <h3 class="col-sm-2">Hodina</h3>
            <h3 class="col-sm-2">Cena</h3>
            <h3 class="col-sm-2">Kategória</h3>

        </div>
        <hr>
		<?php foreach ($addresses['addresses'] as $address): ?>
            <div class="row">
                <div class="event-location col-sm-4 ">
                    <span><?= $address['location'] ?>, </span>
                    <span><?= $address['address'] ?></span>
                </div>

                <div class="event-day col-sm-8">
					<?php foreach ((new Event())->sortDaysInWeek($address['days']) as $day): ?>
                        <div class="row">
                            <div class="col-sm-3">
								<?= $day['day'] ?>
                            </div>
							<?php sort($day['at']) ?>
                            <div class="col-sm-6">
							<?php foreach ($day['at'] as $at): ?>
                                <div class="col-sm-6">
									<?= $at['at'] ?>
                                </div>
                                <div class="col-sm-6">
									<?= $at['price'][0]['price'] ?> &euro;/h
                                </div>
							<?php endforeach; ?>
                            </div>
                            <div class="col-sm-3">
								<?= $day['category'] ?>
                            </div>
                            <hr>
                        </div>
                        <hr>
					<? endforeach; ?>
                </div>
            </div>
            <hr>

		<?php endforeach; ?>
    </div>


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

		<?= $form->field($model, 'text')->textarea(['rows' => 2,]) ?>
        <p><span class="number-of-letter">0</span>/200 (maximálne 200 znakov)</p>
		<?= $form->field($model, 'name_id')->hiddenInput(['value' => $event['id']])->label(false) ?>

        <div class="form-group">
			<?= Html::submitButton('Pridať komentár', ['class' => 'btn btn-confirm', 'onClick' => 'saveComment()']) ?>
        </div>

		<?php ActiveForm::end(); ?>

    </div>

    <div class="clearfix"></div>

	<?php Pjax::begin() ?>

    <div class="all-comments">
		<?php foreach ($comments as $comment): ?>
            <div class="row">
                <pre> <?= trim(Html::encode($comment['text'])) ?> &nbsp;</pre>
				<?php if (Yii::$app->user->can('superadmin')): ?>
                    <span>
                        <?= Html::a('Vymazať', Url::to(['/comment/delete', 'id' => $comment['id'], 'name' => $event['name']]), ['onClick' => 'return confirm("Naozaj chcete komentár vymazať?")']) ?>
                    </span>
                    <span><a href="<?= Url::to(['/comment/update', 'id' => $comment['id'], 'name' => $event['name']]) ?>">Upraviť</a>
                    </span>
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
<?php

$script = <<< JS
$(document).ready(function(){
$('.site-event-details textarea').keyup(function(){
        let len = $(this).val().length;
        $('.site-event-details .number-of-letter').html(len);
});
});



JS;
$this->registerJs($script . "
    

function saveComment(){

    let comment = $('.site-event-details textarea').val(),
       name_id =  " . $event['id'] . ";
            $.ajax({
               url: \"" . Url::to(['ajax/save-comment', 'name' => $name]) . "\",
               data:{text:comment, name_id:name_id} ,
               method: 'POST',
               success: function(data){
                   $(\".site-event-details .all-comments\").html(data);
                   $('.site-event-details textarea').val('');
               }
           })
     $(\"form\").submit(function(event){
        event.preventDefault();
    });
}

    ", View::POS_END);

?>













