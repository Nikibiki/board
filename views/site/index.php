<?php


use yii\widgets\ListView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\NoticeSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объявления';
//$this->params['breadcrumbs'][] = $this->title;
?>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <h1 class="col-lg-12 text-center">Актуальные объявления</h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'notice-card',
        'itemOptions' => ['class' => 'col-lg-6'],
        'options' => ['class' => 'row'],
        'layout' => "{items}",

    ]);?>

    <div class="row text-center">
        <?=  LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
