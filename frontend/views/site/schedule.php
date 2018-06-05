<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Rozvrh';

?>
<div class="site-about">
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
		<?php foreach ($events as $event): ?>
            <tr>
                <td><?= $event['day'] ?></td>
                <td><?=  date('d.m.Y', strtotime($event['date']))  ?></td>
                <td><?= $event['name'] ?></td>
                <td>***</td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
</div>
