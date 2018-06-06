<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = $event['name'];
?>
<div class="site-schedule">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= $event['description'] ?></p>
    <!--	--><?php //var_dump($images) ?>
    <?php if (!empty($images)):?>
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


</div>





















