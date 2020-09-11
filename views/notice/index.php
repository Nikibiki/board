<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\NoticeSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Notice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'price',
            'category_id',
//            'created_at',
//            'updated_at',
            //'photo',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'headerRowOptions' => ['class' => 'test']
    ]); ?>


</div>
