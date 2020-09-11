<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\NoticeSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-index">


    <h1 class="col-lg-12 text-center"><?= $this->title ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>







    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'notice-card',
        'itemOptions' => ['class' => 'col-lg-12', 'style' => 'margin-bottom:20px;'],
        'options' => ['class' => 'row'],
        'layout' => "{items}<br>",

    ]);?>

</div>

<div class="row text-center">
    <?=  LinkPager::widget([
        'pagination' => $pages,
    ])?>

</div>

