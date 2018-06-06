<?php

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
			<?= $form->field($event, 'name')->dropDownList(['Po', 'Ut', 'St', 'Št', 'Pi', 'So', 'Ne'], ['onchange' => 'getFilteredEvents()', 'prompt' => 'Všetky'])->label('Kedy') ?>
        </div>
        <div class="clearfix"></div>
    </div>

        <div class="ajax-data"></div>

    <div class="clearfix"></div>


    <div class="all-events">
		<?php foreach ($dataEvent as $event): ?>
            <div class="col-sm-6"><h2><a href="<?= Url::to(['event', 'name' => $event]) ?>"><?= $event ?></a></h2></div>
		<?php endforeach; ?>
    </div>

	<?php
	$this->registerJs("
	
function getFilteredEvents(){
    let category = $('.category select :selected').text(),
        paid = $('.paid select :selected').text(),
        when = $('.when select :selected').text();
    $('.all-events').hide();
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
    $('.container .paid').empty();
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



