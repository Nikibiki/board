<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */

?>


<!--<div class="col-lg-12">-->

    <div class="col-lg-9">
        <div class="col-lg-12">
            <div class="col-xs-9" style="padding-left: 0">
                <h3><?= $model->title ?>
                    <?if($model->status):?>
                        <a href="<?= Url::to( ['notice/update', 'id' => $model->id ] )?>"><span class="glyphicon glyphicon-pencil small" aria-hidden="true"></span></a>
                        <a href="<?= Url::to( ArrayHelper::merge(['notice/deactivate', 'id' => $model->id ], Yii::$app->request->queryParams) )?>" class="small btn btn-danger" style="color: white;">Закрыть</a>
                    <?endif;?>
                </h3>
            </div>

        </div>
        <div class="col-lg-12">
            <b><?= Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y H:i:s');?></b> &nbsp;
            <b>Категория: </b><?= $model->category->title ?>&nbsp;
            <b>Город: </b><?= $model->city->title ?>

        </div>
        <div class="col-lg-12">
            <div class="help-block"></div>
            <p>
                Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
            </p>
            <p>
                Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.
            </p>
        </div>
<!--        <div class="col-lg-12">-->
<!--            <img src="/img/2.jpeg" class="img-responsive" alt="Responsive image">-->
<!--        </div>-->

    </div>

    <div class="col-lg-3">
        <p><b>Статус:</b> <?= $model->getStatus()?></p>

        <p><b>Цена:</b> <?= $model->price ?> руб</p>

        <img src="<?= $model->image?>" class="img-responsive" alt="" style=" max-height:150px; border:1px solid black; border-radius: 6px; margin: 10px 0 5px 0;">
<!--        <p><b>Имя:</b> --><?//= $model->owner->nm?><!--</p>-->
<!---->
<!--        <p><b>На сайте:</b> c --><?//= Yii::$app->formatter->asDate($model->owner->created_at, 'php:d.m.y');?><!--</p>-->
<!---->
<!--        -->
<!---->
<!--        <p><b>О себе:</b> --><?//= $model->owner->about?><!--</p>-->

    </div>

<!--</div>-->

<!--<div class="row">-->
<!--    <div class="help-block"></div>-->
<!--    <div class="col-lg-9">-->
<!--        <div class="col-lg-12">-->
<!--            <p>-->
<!--                Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.-->
<!--            </p>-->
<!--            <p>-->
<!--                Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.-->
<!--            </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<script>-->
<!--    var par = document.getElementById( "user_card" ).parentNode,-->
<!--        height = getComputedStyle(par).height;-->
<!--    document.getElementById( "user_card" ).style.height = height;-->
<!--</script>-->
