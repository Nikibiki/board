<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

 ?>


<div class="help-block"></div>
    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>{error}",
                'labelOptions' => ['class' => 'control-label col-lg-3'],
            ],
    ]); ?>
    <div class="col-lg-5">
        <div class="col-lg-5 col-lg-offset-7">
            <div class="col-lg-12">
                <img src="<?= $model->avatar?>" alt="" class="img-responsive" id="photo" style="border:1px solid black; border-radius: 6px; max-height: 150px">
                <div class="help-block"></div>
            </div>

            <div class="col-lg-12">
                <a  class="btn btn-success" id="add_photo">Загрузить фото</a>
            </div>

            <?= $form->field( $model, 'photo' )->fileInput(['id' => 'photo_input', 'class' => 'hidden'])->label('');?>
        </div>
    </div>
    <div class="col-lg-6">
            <?= $form->field( $model, 'nm')->textInput() ?>
            <?= $form->field($model, 'city_id')->dropDownList(
                \app\models\City::find()->select(['title', 'id'])->indexBy('id')->column(), ['prompt' => 'Выберите город'])
                ->label('Город');
            ?>
            <?= $form->field( $model, 'phone')->textInput()->label('Телефон +7', ['class' => 'control-label col-lg-3 text-center']); ?>
            <?= $form->field( $model, 'about')->textarea()->label('О себе', ['class' => 'control-label col-lg-3']);?>
        <div class="form-group col-lg-12">
            <div class="col-lg-2 col-lg-offset-6">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>




<?php ActiveForm::end(); ?>

<script>
    // function showFile(input) {
    //     let file = input.files[0];
    //
    //     alert(`File name: ${file.name}`); // например, my.png
    //     alert(`Last modified: ${file.lastModified}`); // например, 1552830408824
    // }
    // var fileInput = document.getElementById('photo-input');
    // fileInput.addEventListener('change', showFile);
    //
    // function showFile() {
    //     let file = this.files[0];
    //
    //     alert(`File name: ${file.name}`); // например, my.png
    //     alert(`Last modified: ${file.lastModified}`); // например, 1552830408824
    // }
</script>




