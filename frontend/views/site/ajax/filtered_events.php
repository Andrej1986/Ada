
<?php foreach ( $events as  $event): ?>
    <h3> <?= $event?></h3>
<?php endforeach;?>

<?php if (!$events):?>
    <h3>pozadovanemu vyberu nevyhovuje ziadny event</h3>
<?php endif;?>

