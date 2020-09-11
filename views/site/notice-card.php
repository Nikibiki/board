
<?
use yii\helpers\Html;
use yii\helpers\Url;
/**@var $model app\models\Notice*/

?>

<div class="col-lg-3"></div>
<div class="col-lg-6">
    <a href="<?= Url::to(['site/view', 'id' => $model->id])?>" class="thumbnail" style="text-decoration: none; display:block; border: none;">
        <div class="caption">
            <?= Html::img( $model->image, ['class' => 'img-rounded img-responsive', 'style' => 'max-width: 253px; max-height: 146px'])?>
            <h4><?= $model->title ?></h4>
            <span>Цена: <?=$model->price?> руб</span>
            <br>
            <span><?= Yii::$app->formatter->asDate($model->created_at, 'php:j F H:i');?></span>
        </div>
    </a>
</div>

<div class="col-lg-3"></div>