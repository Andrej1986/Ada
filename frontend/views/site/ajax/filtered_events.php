
<?php use yii\helpers\Url;

foreach ($events as $event): ?>
    <h2> <a href="<?= Url::to(['/site/event', 'name' => $event]) ?>"><?= $event ?></a></h2>
<?php endforeach;?>

<?php if (!$events):?>
    <h3>pozadovanemu vyberu nevyhovuje ziadny event</h3>
<?php endif;?>

