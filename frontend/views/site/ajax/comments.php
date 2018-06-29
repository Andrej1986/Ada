<?php use yii\helpers\Html;
use yii\helpers\Url;

foreach ($comments as $comment): ?>
    <div class="row">
        <pre> <?= trim(Html::encode($comment['text'])) ?> &nbsp;</pre>
		<?php if (Yii::$app->user->can('superadmin')): ?>
            <span>
                        <?= Html::a('Vymazať', Url::to(['/comment/delete', 'id' => $comment['id'], 'name' => $event['name']]), ['onClick' => 'return confirm("Naozaj chcete komentár vymazať?")']) ?>
                    </span>
            <span><a href="<?= Url::to(['/comment/update', 'id' => $comment['id'], 'name' => $event['name']]) ?>">Upraviť</a>
                    </span>
		<?php endif; ?>
    </div>
<?php endforeach; ?>