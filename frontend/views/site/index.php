<?php

use backend\models\Name;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'Eventy pre deti';

?>
<div class="site-index container">
    <div class="body-content">
		<?php $form = ActiveForm::begin([
			'id'      => 'select-event-form',
			'options' => ['class' => 'form-horizontal'],
		]) ?>
        <div class="col-sm-3 category">
			<?= $form->field($category, 'name')->dropDownList($dataCategory, ['onchange' => 'getFilteredEvents(), setPaidValues(), setWhenValues()', 'prompt' => 'Všetky'])->label('Kategórie') ?>
        </div>
        <div class="col-sm-offset-1 col-sm-3 paid">
			<?= $form->field($paid, 'paid')->dropDownList($dataPaid, ['onchange' => 'getFilteredEvents(), setWhenValues()', 'prompt' => 'Všetky'])->label('Platené?') ?>
        </div>
        <div class="col-sm-offset-1 col-sm-3 when">
			<?= $form->field($event, 'day')->dropDownList(['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota', 'Nedeľa'], ['onchange' => 'getFilteredEvents()', 'prompt' => 'Všetky'])->label('Kedy') ?>
        </div>
        <div class="clearfix"></div>
    </div>


    <div class="clearfix"></div>


    <div class="all-events">
        <div class="ajax-data">
			<?php $i = 0; ?>
			<?php foreach ($dataEvent as $event): ?>
                <div class="col-sm-6 event">
                    <h2><a href="<?= Url::to(['/site/event', 'name' => $event]) ?>"><?= $event ?></a></h2>
                    <pre>
                        <?php
						if (strlen(Name::findOne(['name' => $event])->description) >= 200) {
							$pos = strpos(Name::findOne(['name' => $event])->description, ' ', 200);
							echo substr(Name::findOne(['name' => $event])->description, 0, $pos) . '...' .
								Html::a('viac', Url::to(['/site/event/', 'name' => $event]));
						} else {
							echo Name::findOne(['name' => $event])->description;
						}
						?>
                    </pre>

						<?php
						if (is_dir("/Users/andrejsoukup/yii/Ada/backend/web/uploads/main/$event/")) {
							$image = FileHelper::findFiles("/Users/andrejsoukup/yii/Ada/backend/web/uploads/main/$event/", ['only' => ['*.jpg', '*.png']]) ?? '';
						} else {
							$image = '';
						}
						?>
						<?php if (!empty($image)): ?>
							<?php
							$explodeImg = explode('/', $image[0]);
							$imgName    = end($explodeImg);
							echo Html::img("/Ada/backend/web/uploads/main/$event/" . $imgName, ['class' => 'pull-left img-responsive img-main-page col-sm-6']);
							?>
						<?php endif; ?>
                </div>

				<?php
				$i++;
				if ($i % 2 == 0) {
					echo '<div class="clearfix"></div><hr>';
				}
				?>

			<?php endforeach; ?>
        </div>
    </div>
    <div class="cleearfix"></div>

	<?php
	$this->registerJs("
	
function getFilteredEvents(){
    let category = $('.category select :selected').text(),
        paid = $('.paid select :selected').text(),
        when = $('.when select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/filtered-events']) . "\",
           data: {category: category, paid:paid, when:when},
           type: 'GET',
           success: function(data){
               $(\".ajax-data\").html(data);
           }
       })
    }
   
 function setPaidValues(){
    let category = $('.category select :selected').text(),
            paid = $('.paid select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/set-paid-values']) . "\",
           data: {category: category, paid:paid},
           type: 'GET',
           success: function(data){
               $(\".container .paid\").html(data);
           }
       })
   }   
   
 function setWhenValues(){
    let category = $('.category select :selected').text(),
            paid = $('.paid select :selected').text(),
            when = $('.when select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/set-when-values']) . "\",
           data: {category: category, paid:paid, when:when},
           type: 'GET',
           success: function(data){
               $(\".container .when\").html(data);
           }
       })
   }
    
", yii\web\View::POS_END);
	?>



