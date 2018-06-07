<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Program';

?>
<div class="site-schedule">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Deň</th>
            <th scope="col">Dátum</th>
            <th scope="col">Event</th>
            <th scope="col">Hodnotenie</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0 ?>
		<?php foreach ($events as $event): ?>
            <?php $i++ ?>
            <tr class="<?php if($i%2=='0'){echo 'table-row-color';} ?>">
                <td><?= $event['day'] ?></td>
                <td><?=  date('d.m.Y', strtotime($event['date']))  ?></td>
                <td><?= $event['name'] ?></td>
                <td>***</td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
</div>
