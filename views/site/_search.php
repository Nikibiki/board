<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use app\models\City;


/* @var $this yii\web\View */
/* @var $model app\models\filters\NoticeSerach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notice-search row text-center">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline', 'id' => 'filter_form']
    ]); ?>


    <?= $form->field($model, 'category_id')->dropDownList(
            Category::find()->select([ 'title', 'id' ])
                ->indexBy('id')
                ->column(),
            ['prompt' => $model->getAttributeLabel('category_id'), 'onchange' => "document.getElementById('filter_form').submit();"]
    )->label(false);?>

    <?= $form->field($model, 'city_id')->dropDownList(
            City::find()->select([ 'title', 'id' ])
                ->indexBy('id')
                ->column(),
            ['prompt' => $model->getAttributeLabel('city_id'), 'onchange' => "document.getElementById('filter_form').submit();"]
    )->label(false);?>

    <?= $form->field($model, 'title')->textInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
