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
        <div class="category">
			<?= $form->field($model, 'category')->dropDownList($dataCategory, ['onchange' => 'setActivityValues(),  setWhenValues(), setPaidValues(), setLocationValues()', 'prompt' => 'Všetky'])->label('Kategórie') ?>
        </div>
        <div class="activity">
			<?= $form->field($model, 'name')->dropDownList($dataEvent, ['onchange' => ' setWhenValues(), setPaidValues(), setLocationValues()', 'prompt' => 'Všetky'])->label('Aktivita') ?>
        </div>
        <div class="when">
			<?= $form->field($model, 'day')->dropDownList(['Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota', 'Nedeľa'], ['onchange' => 'setPaidValues(), setLocationValues()', 'prompt' => 'Všetky'])->label('Kedy') ?>
        </div>
        <div class="paid">
			<?= $form->field($model, 'paid')->dropDownList($dataPaid, ['onchange' => ' setLocationValues()', 'prompt' => 'Všetky'])->label('Platené?') ?>
        </div>
        <div class="town">
			<?= $form->field($model, 'location')->dropDownList($dataCategory, ['prompt' => 'Všetky'])->label('Miesto') ?>
        </div>
    </div>

    <div class="form-group">
		<?= Html::submitButton('Potvrdiť výber', ['class' => 'btn btn-lg btn-success']) ?>
    </div>

	<?php ActiveForm::end() ?>

	<?php
	$this->registerJs("
	
function setActivityValues(){
    let category = $('.category select :selected').text();
    let activity = $('.activity select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/set-activity-values']) . "\",
           data: {category: category, activity:activity},
           type: 'GET',
           success: function(data){
               $(\".container .activity\").html(data);
           }
       })
    }
    
 function setWhenValues(){
    let category = $('.category select :selected').text(),
        activity = $('.activity select :selected').text(),
        when = $('.when select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/set-when-values']) . "\",
           data: {category: category, activity:activity, when:when},
           type: 'GET',
           success: function(data){
               $(\".container .when\").html(data);
           }
       })
   }
   
 function setPaidValues(){
    let category = $('.category select :selected').text(),
        activity = $('.activity select :selected').text(),
        when = $('.when select :selected').text(),
        paid = $('.paid select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/set-paid-values']) . "\",
           data: {category: category, activity:activity, when:when, paid:paid},
           type: 'GET',
           success: function(data){
               $(\".container .paid\").html(data);
           }
       })
   }   

 function setLocationValues(){
    let category = $('.category select :selected').text(),
        activity = $('.activity select :selected').text(),
        when = $('.when select :selected').text(),
        paid = $('.paid select :selected').text(),
        location = $('.town select :selected').text();
        $.ajax({
           url: \"" . Url::to(['ajax/set-location-values']) . "\",
           data: {category: category, activity:activity, when:when, paid:paid, location:location},
           type: 'GET',
           success: function(data){
               $(\".container .town\").html(data);
           }
       })
   }   

    
", yii\web\View::POS_END);
	?>

