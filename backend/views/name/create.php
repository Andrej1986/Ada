<?php

use common\models\UploadForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Name */

$this->title = 'Vytvoriť Globálny Event';
$this->params['breadcrumbs'][] = ['label' => 'Globálne Eventy', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="name-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
