<?php use backend\models\Name;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$i = 0;
foreach ($events as $event): ?>
    <div class="col-sm-6 event">
        <h2><a href="<?= Url::to(['/site/event', 'name' => $event]) ?>"><?= $event ?></a></h2>
        <pre>
            <?php
			if (strlen(Name::findOne(['name' => $event])->description) >= 200) {
				$pos = strpos(Name::findOne(['name' => $event])->description, ' ', 200);
				echo substr(Name::findOne(['name' => $event])->description, 0, $pos) . '...' .
					Html::a('viac', Url::to(['/site/event/', 'name' => $event]));
			} else {
				echo Name::findOne(['name' => $event])->description;
			}
			?>
        </pre>

		<?php
		if (is_dir("/Users/andrejsoukup/yii/Ada/backend/web/uploads/main/$event/")) {
			$image = FileHelper::findFiles("/Users/andrejsoukup/yii/Ada/backend/web/uploads/main/$event/", ['only' => ['*.jpg', '*.png']]) ?? '';
		} else {
			$image = '';
		}
		?>
		<?php if (!empty($image)): ?>
			<?php
			$explodeImg = explode('/', $image[0]);
			$imgName    = end($explodeImg);
			echo Html::img("/Ada/backend/web/uploads/main/$event/" . $imgName, ['class' => 'pull-left img-responsive img-main-page col-sm-6']);
			?>
		<?php endif; ?>
    </div>
	<?php
	$i++;
	if ($i % 2 == 0) {
		echo '<div class="clearfix"></div><hr>';
	}
	?>
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

