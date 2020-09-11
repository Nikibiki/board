<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use app\models\City;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notice-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Заголовок') ?>

    <?= $form->field($model, 'category_id')->dropDownList(
            Category::find()->select(['title', 'id'])->indexBy('id')->column(),
            ['prompt' => 'Выберите катеогрию']
    ); ?>

    <?= $form->field( $model, 'desc')->textarea();?>

    <?= $form->field( $model, 'city_id')->dropDownList(
        City::find()->select(['title', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выберите город', 'value' => ($model->city_id) ? $model->city_id : Yii::$app->user->identity->city_id]
    );?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'photo', [
            'template' => "<div class='col-lg-12' style='padding-left: 0;'>
        <div class='col-lg-3' style='padding: 0;'>
            {label}{input}
            <a  class='btn btn-default' id='add_photo'>Обзор...</a>
        </div>
        
        <div class='col-lg-3' style='padding: 0;'>Вы можете загрузить фотографию в формате jpeg, jpg, png. весом не более 10 Мб</div>
        {error}
    </div>"
    ])->fileInput(['id' => 'photo_input', 'class' => 'hidden']) ?>

    <div class="col-lg-12" id="photo_block" style="padding: 0;">
        <? if($model->photo) :?>
            <div class="" id="help_photo_block">
                <div class="help-block"></div>
                <div class="col-lg-4" style="padding: 0;">
                    <div class="col-lg-11" style="padding: 8px 2px 0 0;">
                        <img src="<?= $model->image?>" alt="" id="photo" class="img-responsive" style="border:1px solid black; border-radius: 6px;">
                        <div class="help-block"></div>
                    </div>
                    <div class="col-lg-1" style="padding: 0; width: auto;">
                        <button type="button" id="remove_photo_btn" class="close" aria-label="Close" style="padding: 0;"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        <?endif?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field( $model, 'user_id')->textInput(['value' => Yii::$app->user->id, 'class' => 'hidden'])->label('');?>

    <?php ActiveForm::end(); ?>

</div>

<div class="hidden" id="help_photo_block">
    <div class="help-block"></div>
    <div class="col-lg-4" style="padding: 0;">
        <div class="col-lg-11" style="padding: 8px 2px 0 0;">
            <img src="" alt="" id="photo" class="img-responsive" style="border:1px solid black; border-radius: 6px;">
            <div class="help-block"></div>
        </div>
        <div class="col-lg-1" style="padding: 0; width: auto;">
            <button type="button" id="remove_photo_btn" class="close" aria-label="Close" style="padding: 0;"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
