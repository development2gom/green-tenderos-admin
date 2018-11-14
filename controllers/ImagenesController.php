<?php

namespace app\controllers;

use Yii;
use app\models\EntImagenes;
use app\models\EntImagenesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\EntVideos;

/**
 * ImagenesController implements the CRUD actions for EntImagenes model.
 */
class ImagenesController extends Controller
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
     * Lists all EntImagenes models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new EntImagenesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EntImagenes model.
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
     * Creates a new EntImagenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EntImagenes();
        $imagen->scenario = 'create';

        $model->b_habilitado = 1;
        if ($model->load(Yii::$app->request->post())) {
            $model->fileUpload = UploadedFile::getInstance($model, 'fileUpload');
            if ($model->subirFoto()) {
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id_imagen]);

                } else {
                    print_r($model->errors);
                    exit;
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EntImagenes model.
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
            return $this->redirect(['view', 'id' => $model->id_imagen]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EntImagenes model.
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
     * Finds the EntImagenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return EntImagenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EntImagenes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPublicarImagen($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $imagen = EntImagenes::find()->where(['id_imagen'=>$id])->one();
        $imagen->scenario = 'update';
        
        $imagen->b_publicado = 1;
        if($imagen->save()){

            return ['status'=>'success'];
        }else{
            print_r($imagen->errors);
        }

        return ['status'=>'error'];
    }
}
