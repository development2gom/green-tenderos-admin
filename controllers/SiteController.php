<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\AccessControlExtend;
use yii\web\UploadedFile;
use app\models\CatBodegas;
use app\models\CatTiendas;
use app\models\WrkHistorial;
use app\models\CatNiveles;
use app\models\WrkPuntuajeActual;
use app\models\Constantes;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
        // return [
        //     'access' => [
        //         'class' => AccessControlExtend::className(),
        //         'only' => ['logout', 'about'],
        //         'rules' => [
        //             [
        //                 'actions' => ['logout'],
        //                 'allow' => true,
        //                 'roles' => ['admin'],
        //             ],
                   
        //         ],
        //     ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        //];
    //}

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionTest(){
         //$auth = Yii::$app->authManager;
    
        //  // add "updatePost" permission
        //  $updatePost = $auth->createPermission('about');
        //  $updatePost->description = 'Update post';
        //  $auth->add($updatePost);
        //         // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "author" role
        // $admin = $auth->createRole('test');
         //$auth->add($admin);
        // $auth->addChild($admin, $updatePost);
        
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        
        // $usuario = Yii::$app->user->identity;
        // $auth = \Yii::$app->authManager;
        // $authorRole = $auth->getRole('test');
        // $auth->assign($authorRole, $usuario->getId());
        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionConstruccion(){

        $this->layout = "classic/topBar/mainBlank";

        return $this->render("construccion");
    }

    

    public function actionGetcontrollersandactions()
    {
        $controllerlist = [];
        if ($handle = opendir('../controllers')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                    $controllerlist[] = $file;
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        $fulllist = [];
        foreach ($controllerlist as $controller):
            $handle = fopen('../controllers/' . $controller, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    if (preg_match('/public function action(.*?)\(/', $line, $display)):
                        if (strlen($display[1]) > 2):
                            $fulllist[strtolower(substr($controller, 0, -14))][] = strtolower($display[1]);
                        endif;
                    endif;
                }
            }
            fclose($handle);
        endforeach;

        print_r($fulllist);
        exit;
        return $fulllist;
    }

    public function actionImportarData(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $errores = [];
        
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstanceByName('file-import');//print_r($file->tempName);exit;
            
            if($file){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadsheet = $reader->load($file->tempName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                //print_r($sheetData);
                foreach($sheetData as  $key => $data){
                    if($key == 0)
                        continue;
                    
                    //print_r($data);exit;

                    $transaction = Yii::$app->db->beginTransaction();
                    try{
                        $bodega = CatBodegas::find()->where(['id_bodega'=>$data[2]])->one();
                        if($bodega){
                            $tienda = CatTiendas::find()->where(['txt_clave_tienda'=>$data[0], 'txt_clave_bodega'=>$bodega->txt_clave_bodega])->one();
                            if(!$tienda){
                                $tienda = new CatTiendas();
                                $tienda->txt_clave_tienda = $data[0];
                                $tienda->txt_clave_bodega = $bodega->txt_clave_bodega;
                                $tienda->txt_nombre = $data[1];

                                if(!$tienda->save()){
                                    $transaction->rollBack();
                                    print_r($tienda->errors);

                                    return [
                                        'status' => 'error'
                                    ];
                                }   
                            }

                            $historial = new WrkHistorial();
                            $historial->id_concurso = 1;
                            $historial->txt_clave_bodega = $bodega->txt_clave_bodega;
                            $historial->txt_clave_tienda = $tienda->txt_clave_tienda;
                            $fecha = date("Y-m-d", strtotime($data[7]));
                            $historial->fch_compra = $fecha;
                            $historial->num_saldo_anterior = $data[5];
                            $historial->num_saldo_mes = $data[4];
                            $historial->num_saldo_acumulado = $data[6];

                            if(!$historial->save()){
                                $transaction->rollBack();
                                print_r($historial->errors);
                                
                                return [
                                    'status' => 'error'
                                ];
                            }


                            $idNivel;
                            $siguienteNivel;
                            $niveles = CatNiveles::find()->where(['b_habilitado'=>1])->all();
                            foreach($niveles as $nivel){
                                if($nivel->num_rango_inicial <= $historial->num_saldo_acumulado && $nivel->num_rango_final >= $historial->num_saldo_acumulado){
                                    $idNivel = $nivel->id_nivel;
                                    $siguienteNivel = $nivel->num_rango_final - $historial->num_saldo_acumulado;
                                    break;
                                }
                            }

                            $puntajeActual = WrkPuntuajeActual::find()->where(['txt_clave_tienda'=>$tienda->txt_clave_tienda, 'txt_clave_bodega'=>$bodega->txt_clave_bodega])->one();
                            if(!$puntajeActual){
                                $puntajeActual = new WrkPuntuajeActual();
                                $puntajeActual->txt_clave_bodega = $bodega->txt_clave_bodega;
                                $puntajeActual->txt_clave_tienda = $tienda->txt_clave_tienda;
                                $puntajeActual->id_nivel = $idNivel;
                                $puntajeActual->id_concurso = Constantes::CONCURSO;
                                $puntajeActual->num_puntuaje_actual = $historial->num_saldo_mes;
                                $puntajeActual->num_saldo_anterior = $historial->num_saldo_anterior;
                                $puntajeActual->num_saldo_mes = $historial->num_saldo_mes;
                                $puntajeActual->num_saldo_acumulado = $historial->num_saldo_acumulado;
                                $puntajeActual->num_puntos_sig_experiencia = $siguienteNivel;
                            }else{
                                $puntajeActual->id_nivel = $idNivel;
                                $puntajeActual->num_puntuaje_actual = $historial->num_saldo_mes;
                                $puntajeActual->num_saldo_anterior = $historial->num_saldo_anterior;
                                $puntajeActual->num_saldo_mes = $historial->num_saldo_mes;
                                $puntajeActual->num_saldo_acumulado = $historial->num_saldo_acumulado;
                                $puntajeActual->num_puntos_sig_experiencia = $siguienteNivel;
                            }

                            if(!$puntajeActual->save()){
                                $transaction->rollBack();
                                print_r($puntajeActual->errors);
                                
                                return [
                                    'status' => 'error'
                                ];
                            }

                        }else{
                            $transaction->rollBack();
                            echo "No se encontro la bodega";
                            
                            return [
                                'status' => 'error'
                            ];
                        }
                        // foreach($data as $d){
                        //     echo $d."<br/>";
                        // }
                        $transaction->commit();

                        return [
                            'status' => 'success'
                        ];
                    }catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;

                        return [
                            'status' => 'error'
                        ];
                    }
                }
            }
        }

        return [
            'status' => 'error'
        ];
    }
}
