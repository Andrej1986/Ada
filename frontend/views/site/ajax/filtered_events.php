<?php use backend\models\Name;
use yii\helpers\Url;

foreach ($events as $event): ?>
    <div class="col-sm-6 event">
        <h2><a href="<?= Url::to(['/site/event', 'name' => $event]) ?>"><?= $event ?></a></h2>
        <pre><?= Name::findOne(['name' => $event])->description; ?></pre>
    </div>
<?php endforeach; ?>

<?php if (!$events): ?>
    <div class="info bg-info">
        <div class="container">
            <p>
                Požadovanému výberu: <br><br>
                kategória: <strong> <?= $category ?></strong><br>
                platené?: <strong> <?= $paid ?></strong><br>
                kedy: <strong> <?= $day ?></strong><br><br>
                nevyhovuje žiadny event.
            </p>
        </div>
    </div>
<?php endif; ?>

