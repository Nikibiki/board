<?php


namespace app\controllers;


use app\models\filters\NoticeSerach;
use app\models\Image;
use app\models\User;
use app\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class UserController extends Controller
{

    public function actionIndex(){

        $model = new UserForm();

        if( Yii::$app->request->isPost ){
            $model->load( Yii::$app->request->post() );
            $this->user->attributes = $model->attributes;
            $this->user->photo = $this->user->getOldAttributes()['photo'];
            if( $file = UploadedFile::getInstance( $model, 'photo') ){
                $image = new Image();
                $this->user->photo = $image->uploadFile( $file, $this->user->photo, true );
            }

            $this->user->save();
            return $this->redirect( ['user/index'] );
        }

        $model->attributes = $this->user->attributes;
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionNotices(){
        $searchModel = new NoticeSerach();
        $searchModel->user_id = $this->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('notices', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => $dataProvider->getPagination(),
        ]);
    }



    public function getUser(){
        return Yii::$app->user->identity;
    }
}