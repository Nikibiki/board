<?php

namespace app\controllers;

use app\models\Image;
use Yii;
use app\models\Notice;
use app\models\filters\NoticeSerach;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * NoticeController implements the CRUD actions for Notice model.
 */
class NoticeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Notice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticeSerach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notice model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Notice();

        if( Yii::$app->request->isPost ){
            $model->load(Yii::$app->request->post());
            $file = UploadedFile::getInstance( $model, 'photo');

            if($file){
                $image = new Image();
                $model->photo = $image->uploadFile( $file );
            }

            if( $model->save() ) {
                Yii::$app->session->setFlash('success', 'Ваше объявление успешно добавлено');
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $session = Yii::$app->session;

        if( $model->user_id != Yii::$app->user->id ){
            $session->setFlash('error', "У Вас нет прав редактировать это объявление!");
            return $this->redirect( Url::to( ['user/notices'] ) );
        }

        if ( $model->status === 0 ) {
            $session->setFlash('error', "Вы не можете редактировать закрытое объявление!");
            return $this->redirect( Url::to( ['user/notices'] ) );
        }

        if( Yii::$app->request->isPost ){
            $model->load(Yii::$app->request->post());
            $image = new Image();
            $file = UploadedFile::getInstance( $model, 'photo');

            if(!$model->photo){
                $image->deleteCurrentImage($model->getOldAttributes()['photo']);
            }

            if($file){
                $model->photo = $image->uploadFile( $file );
            }

            if( $model->save() ) {
                Yii::$app->session->setFlash('success', 'Ваше объявление успешно изменено!');
                return $this->redirect(['site/index']);
            }
        }



//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeactivate( $id ){
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        $params = Yii::$app->request->queryParams;
        ArrayHelper::remove( $params, 'id' );

        if ($model->status === 0 ) {
            return $this->redirect( Url::to( ArrayHelper::merge( ['user/notices'], $params) ) );
        }

        if( $model->user_id == Yii::$app->user->id ){
            $model->deactivate();
            $session->setFlash('success', "Объявление \"{$model->title}\" успешно закрыто!");
        } else {
            $session->setFlash('error', "У Вас нет прав закрыть это объявление!");
        }

        return $this->redirect( Url::to( ArrayHelper::merge( ['user/notices'], $params) ) );

    }

    /**
     * Finds the Notice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notice::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
