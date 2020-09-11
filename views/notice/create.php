<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notice */

$this->title = 'Добавить объявление';
$this->params['breadcrumbs'][] = ['label' => 'Мои объявления', 'url' => ['/user/notices']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
