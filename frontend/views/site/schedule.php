<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Program: najbližších 20 Eventov ';

?>
<div class="site-schedule container">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th>Deň</th>
            <th>Dátum</th>
            <th>Event</th>
            <th>Kde</th>
            <th>Kedy</th>
        </tr>
        </thead>
        <tbody>
		<?php $i = 0 ?>
		<?php foreach ($events as $event): ?>
			<?php $i++ ?>
            <tr class="<?php if ($i % 2 == '0') {
				echo 'table-row-color';
			} else {
				echo 'table-row-color2';
			} ?>">
                <td><?= $event['day'] ?></td>
                <td><?= date('d.m.Y', strtotime($event['date'])) ?></td>
                <td><?= $event['name'] ?></td>
                <td><?= $event['location'] ?>, <?= $event['address'] ?></td>
                <td><?= $event['at'] ?></td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>

    function fadeIn(el) {
        el.style.opacity = 0;

        let last = +new Date();
        let tick = function () {
            el.style.opacity = +el.style.opacity + (new Date() - last) / 600;
            last = +new Date();

            if (+el.style.opacity < 1) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16);
            }
        };

        tick();
    }

    let trs = document.querySelectorAll('tbody tr');
    trs = Array.prototype.slice.call(trs);

    for (let i = 0; i < trs.length; i++) {
        window.setTimeout(function () {
            trs[i].classList.add('display-row');
            fadeIn(trs[i]);
        }, 200 * i)
    }


</script>