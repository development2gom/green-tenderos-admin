<?php

namespace app\controllers;

use Yii;
use app\models\EntVideos;
use app\models\EntVideosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\CatConcurso;


/**
 * VideosController implements the CRUD actions for EntVideos model.
 */
class VideosController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * Lists all EntVideos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntVideosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $videos = EntVideos::find()->all();
        $concursos = CatConcurso::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'videos' => $videos,
            'concursos' => $concursos
        ]);
    }

    /**
     * Displays a single EntVideos model.
     * @param string $id
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
     * Creates a new EntVideos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntVideos();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {

            $model->fileUpload = UploadedFile::getInstance($model, 'fileUpload');
           $model->b_publicado = 1;
                if ($model->guardarRegistro()) {
                    return $this->redirect(['index']);
                } 

            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EntVideos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_video]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EntVideos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EntVideos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EntVideos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntVideos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPublicarVideo($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $video = EntVideos::find()->where(['id_video'=>$id])->one();
        $video->scenario = 'update';

        $video->b_publicado = 1;
        if($video->save()){

            return ['status'=>'success'];
        }else{
            print_r($video->errors);
        }

        return ['status'=>'error'];
    }
}
