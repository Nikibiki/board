<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */

$this->title = $model->title;
$this->params['breadcrumbs'] = [];
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row">

    <div class="col-lg-9">
        <div class="col-lg-12">
            <div class="col-xs-9" style="padding-left: 0">
                <h4><?= $model->title ?></h4>
            </div>
            <div class="col-xs-3">
                <h5><b>Цена:</b> <?= $model->price ?> руб</h5>
            </div>
        </div>
        <div class="col-lg-12">
            <b><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i:s');?></b> &nbsp;
            <b>Город: </b><?= $model->city->title ?>

        </div>
        <div class="col-lg-12">
            <img src="<?= $model->image;?>" class="img-responsive" alt="Responsive image">
        </div>

    </div>

    <div class="col-lg-3"  style="border:1px solid black; border-radius: 6px;" id="user_card">

        <img src="<?= $model->owner->avatar?>" class="img-responsive" alt="" style="  height:100px; border:1px solid black; border-radius: 6px; margin: 10px 0 5px 0;">
        <p><b>Имя:</b> <?= $model->owner->nm?></p>

        <p><b>На сайте:</b> c <?= Yii::$app->formatter->asDate($model->owner->created_at, 'php:d.m.y');?></p>

        <p><b>Объявлений:</b> <?= $model->owner->totalNotices?></p>

        <p><b>Телефон:</b> +7<?= $model->owner->phone?></p>

        <p><b>О себе:</b> <?= $model->owner->about?></p>

    </div>
</div>

<div class="row">
    <div class="help-block"></div>
    <div class="col-lg-9">
        <div class="col-lg-12">
            <p>
               <?= $model->desc;?>
            </p>

        </div>
    </div>
</div>

<script>
    var par = document.getElementById( "user_card" ).parentNode,
        height = getComputedStyle(par).height;
    document.getElementById( "user_card" ).style.height = height;
</script>
