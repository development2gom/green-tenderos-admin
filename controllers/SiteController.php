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
use yii\web\HttpException;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControlExtend::className(),
                'only' => ['index', 'logout', 'about', 'importar-data'],
                'rules' => [
                    [
                        'actions' => ['index', 'logout', 'importar-data'],
                        'allow' => true,
                        'roles' => ['super-admin'],
                    ],
                   
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

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

        if(Yii::$app->request->isPost){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $file = UploadedFile::getInstanceByName('file-import');
            
            if($file){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadsheet = $reader->load($file->tempName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                
                $transaction = Yii::$app->db->beginTransaction();

                foreach($sheetData as  $key => $data){
                    if($key == 0)
                        continue;
                    
                    try{
                        $bodega = CatBodegas::find()->where(['txt_clave_bodega'=>$data[2]])->one();
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
                                $puntajeActual->num_puntuaje_actual = $historial->num_saldo_acumulado;
                                $puntajeActual->num_saldo_anterior = $historial->num_saldo_anterior;
                                $puntajeActual->num_saldo_mes = $historial->num_saldo_mes;
                                $puntajeActual->num_saldo_acumulado = $historial->num_saldo_acumulado;
                                $puntajeActual->num_puntos_sig_experiencia = $siguienteNivel;
                            }else{
                                $puntajeActual->id_nivel = $idNivel;
                                $puntajeActual->num_puntuaje_actual = $historial->num_saldo_acumulado;
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
                            $nuevaBodega = new CatBodegas();
                            $nuevaBodega->txt_clave_bodega = $data[2];
                            $nuevaBodega->txt_nombre = $data[2];

                            if(!$nuevaBodega->save()){
                                $transaction->rollBack();
                                echo "No se encontro la bodega";
                                
                                return [
                                    'status' => 'error'
                                ];
                            }
                        }
                        // foreach($data as $d){
                        //     echo $d."<br/>";
                        // }
                    }catch(\Exception $e){
                        $transaction->rollBack();
                        throw $e;

                        return [
                            'status' => 'error'
                        ];
                    }
                }
                $transaction->commit();

                return [
                    'status' => 'success'
                ];
            }

            return [
                'status' => 'error'
            ];
        }

        return $this->render('importar_datos');
    }

    public function actionImportarDataTest(){  
        
        if(Yii::$app->request->isPost){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $respuesta = [];
            try{
                $file = UploadedFile::getInstanceByName('file-import');
                
        
            
                if(!$file->saveAs('temporales/data.' . $file->extension)){
                    throw new HttpException(500, "El archivo no se pudo guardar temporalmente falla de escritura en el disco.");   
                }


                $this->importData();
                $respuesta= [
                    "status"=>"success"
                ];

                
            }catch(\Exception $e){
                $respuesta= [
                    "status"=>"error",
                    "message"=>$e->getMessage()
                ];
            }
            
            return $respuesta; 
        }
    }


    public function importData(){

        $sql = "
        LOAD DATA LOW_PRIORITY LOCAL INFILE 'temporales/data.csv' 
        INTO TABLE `gomcommx_dev-green-tenderos`.`wrk_concursos_resultados` 
        FIELDS TERMINATED BY ',' 
        OPTIONALLY ENCLOSED BY '\"' 
        ESCAPED BY '\"'
        LINES TERMINATED BY '\\r\\n' 
        IGNORE 1 LINES
        (@uddi, @txt_region, @txt_zona, @txt_bodega, @txt_descripcion, @txt_nud, @txt_nombre, @num_anterior, @num_mes, @num_total, @txt_folio, @txt_leyenda, @txt_sorteo)
        SET uddi = @uddi,
            txt_region = @txt_region, 
            txt_zona = @txt_zona, 
            txt_bodega = @txt_bodega, 
            txt_descripcion = @txt_descripcion, 
            txt_nud = @txt_nud, 
            txt_nombre = @txt_nombre, 
            num_anterior = @num_anterior, 
            num_mes = @num_mes, 
            num_total = @num_total, 
            txt_folio = @txt_folio, 
            txt_leyenda = @txt_leyenda, 
            txt_sorteo = @txt_sorteo;";

        $items = Yii::$app->db->createCommand($sql);

        $items = $items->query();

        $tiendasFaltantes = "INSERT INTO cat_tiendas (txt_clave_tienda, txt_clave_bodega, txt_nud, txt_nombre)
        (select G.uddi, G.txt_bodega, G.txt_nud, G.txt_nombre FROM wrk_concursos_resultados G where G.uddi not in (select T.txt_clave_tienda FROM cat_tiendas T))";

        $items = Yii::$app->db->createCommand($sql);

    }

    public function actionImportarDatos(){  

        if(Yii::$app->request->isPost){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $file = UploadedFile::getInstanceByName('file-import');
            
            if($file){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadsheet = $reader->load($file->tempName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                
                $transaction = Yii::$app->db->beginTransaction();

                foreach($sheetData as  $key => $data){
                    if($key == 0 )
                        continue;

                    if($data[0] == null){
                        break;
                    }
                    
                    $claveTienda = $data[0] . $data[3] . $data[7];
                    
                    try{
                        $bodega = CatBodegas::find()->where(['txt_clave_bodega'=>$data[2]])->one();
                        if(!$bodega){

                            $bodega = new CatBodegas();
                            $bodega->txt_clave_bodega = "".$data[2];
                            $bodega->txt_nombre = "".$data[2];

                            if(!$bodega->save()){
                                $transaction->rollBack();
                                echo "No se encontro la bodega -- ".$key;
                                
                                return [
                                    'status' => 'error1',
                                    'result' => $bodega->errors
                                ];
                            }
                        }

                        $tienda = CatTiendas::find()->where(['txt_clave_tienda'=>$claveTienda, 'txt_clave_bodega'=>$bodega->txt_clave_bodega])->one();
                        if(!$tienda){
                            $tienda = new CatTiendas();
                            $tienda->txt_clave_tienda = $claveTienda;
                            $tienda->txt_clave_bodega = $bodega->txt_clave_bodega;
                            $tienda->txt_nombre = $data[8];
                            $tienda->txt_nud = "".$data[7];

                            if(!$tienda->save()){
                                $transaction->rollBack();
                                echo " -- ".$key;

                                return [
                                    'status' => 'error2',
                                    'result' => $tienda->errors
                                ];
                            }   
                        }

                        $historial = new WrkHistorial();
                        $historial->id_concurso = 1;
                        $historial->txt_clave_bodega = $bodega->txt_clave_bodega;
                        $historial->txt_clave_tienda = $tienda->txt_clave_tienda;
                        //$fecha = date("Y-m-d", strtotime(new Date()));
                        $historial->fch_compra = '2018-08-15';
                        $historial->num_saldo_anterior = $data[15];//acumulado
                        $historial->num_saldo_mes = $data[14];//agosto
                        $historial->num_saldo_acumulado = $data[16];//saldo total

                        if(!$historial->save()){
                            $transaction->rollBack();
                            echo " -- ".$key;
                            
                            return [
                                'status' => 'error3',
                                'result' => $historial->errors
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
                            $puntajeActual->num_puntuaje_actual = $historial->num_saldo_acumulado;
                            $puntajeActual->num_saldo_anterior = $historial->num_saldo_anterior;
                            $puntajeActual->num_saldo_mes = $historial->num_saldo_mes;
                            $puntajeActual->num_saldo_acumulado = $historial->num_saldo_acumulado;
                            $puntajeActual->num_puntos_sig_experiencia = $siguienteNivel;
                            $puntajeActual->txt_leyenda = $data[19];
                        }else{
                            $puntajeActual->id_nivel = $idNivel;
                            $puntajeActual->num_puntuaje_actual = $historial->num_saldo_acumulado;
                            $puntajeActual->num_saldo_anterior = $historial->num_saldo_anterior;
                            $puntajeActual->num_saldo_mes = $historial->num_saldo_mes;
                            $puntajeActual->num_saldo_acumulado = $historial->num_saldo_acumulado;
                            $puntajeActual->num_puntos_sig_experiencia = $siguienteNivel;
                            $puntajeActual->txt_leyenda = $data[19];
                        }

                        if(!$puntajeActual->save()){
                            $transaction->rollBack();
                            echo " -- ".$key;
                            
                            return [
                                'status' => 'error4',
                                'result' => $puntajeActual->errors
                            ];
                        }
                    }catch(\Exception $e){
                        $transaction->rollBack();
                        throw $e;
                        echo " -- ".$key;

                        return [
                            'status' => 'error5',
                            'result' => $e
                        ];
                    }
                }
                $transaction->commit();

                return [
                    'status' => 'success'
                ];
            }

            return [
                'status' => 'error6'
            ];
        }

        return $this->render('importar_datos');
    }
}
