<?php

namespace backend\modules\moduleManager\controllers;

use Yii;
use backend\modules\moduleManager\models\Modules;

use backend\modules\moduleManager\models\ModulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DefaultController implements the CRUD actions for Modules model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $actions = Yii::$app->acl->getRole();

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => $actions,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
     public function actions()
    {

            $this->layout = "@app/views/layouts/layoutTable";
            //$this->layout = "@app/views/layouts/main";
        
    }
    /**
     * Lists all Modules models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(isset($_GET['search'])){
            $model = new Modules;
            if ($model->load(Yii::$app->request->post())) {
                $dataPost = Yii::$app->request->post();
                
                $resource    =  trim($model->RESOURCE);
                $name        =  trim($model->NAME);
                $description =  trim($model->DESCRIPTION);
                $startTime   = $endTime  = time();
                if($model->CREATE_DATE){
                    $startTime = strtotime(trim($model->CREATE_DATE));
                }
                if($model->UPDATE_DATE){
                    //$endTime   = (int)strtotime(trim($dataPost['UPDATE_DATE']));
                     $endTime   = (int)strtotime(trim($model->UPDATE_DATE)) + 86400;
                }
                
                $arrayStatus = $model->STATUS;
                //print_r($arrayStatus);
                //die;
                
                if($model->CREATE_BY && $model->CREATE_BY== 'all' ){
                    $limit = "";
                }else{
                    $limit = $model->CREATE_BY;
                }
                if($model->TEXT_LIMIT && trim($model->TEXT_LIMIT) !="" ){
                    $limit = $model->TEXT_LIMIT;
                }

                //Xap xep theo
                if($model->UPDATE_BY && $model->UPDATE_BY){
                    $order = $model->UPDATE_BY;
                }
                if($model->TYPE && $model->TYPE){
                    $by = $model->TYPE;
                }
               
                $modelSearch = Modules::find()
                             ->select([
                                    'MODULE_ID',
                                    'RESOURCE',
                                    'NAME',
                                    'DESCRIPTION',
                                    'CREATE_DATE',
                                    'CREATE_BY',
                                    'UPDATE_DATE',
                                    'UPDATE_BY',
                                    'TYPE',
                                    'STATUS',
                                ])
                            ->asArray();
                //theo thoi gian

                $modelSearch->andWhere(['>=','CREATE_DATE',$startTime]);
                $modelSearch->andWhere(['<=','CREATE_DATE',$endTime]);

                if(isset($resource) && !empty($resource)){
                   $modelSearch->andWhere(['like','RESOURCE',$resource]); 
                }
                if(isset($name) && !empty($name)){
                   $modelSearch->andWhere(['like','NAME',$name]); 
                }
                if(isset($description) && !empty($description)){
                   $modelSearch->andWhere(['like','DESCRIPTION',$nadescriptionme]); 
                }
              
                if(isset($arrayStatus) && !empty($arrayStatus)){
                   $modelSearch->andWhere(['in','STATUS',$arrayStatus]); 
                }else{
                   $modelSearch->andWhere(['=','STATUS',100]); 
                }
                if(isset($limit) && $limit ){
                    $modelSearch->limit($limit);
                }
                if($by == "DESC"){
                    $modelSearch->orderBy([$order=>SORT_DESC]);
                }else{
                    $modelSearch->orderBy([$order=>SORT_ASC]);
                }
                $dataProviders = $modelSearch->all();


                //echo '<pre>';print_r($dataProviders);
                //die;
                $this->createSsAccount($dataProviders);
                return $this->render('index', [
                    'dataProviders' => $dataProviders,
                ]);
            }else{

                return $this->render('search', [
                    'model' => $model,
                ]);    
            }

        }else{
            $limit = 100;
            $page  = 1;
            if(isset($_GET['page']) && is_numeric($_GET['page'])){
                $page = $_GET['page'];
            }
            $offset = ($page-1)*$limit;
            $dataProviders = Modules::find()
                            ->where(['<>','STATUS', 2])
                            ->select([
                                    'MODULE_ID',
                                    'RESOURCE',
                                    'NAME',
                                    'DESCRIPTION',
                                    'CREATE_DATE',
                                    'CREATE_BY',
                                    'TYPE',
                                    'STATUS',
                                ])
                            
                            ->limit($limit)
                            ->offset($offset)
                            ->orderBy(['MODULE_ID'=>SORT_DESC])
                            ->asArray()
                            ->all();
            $this->createSsAccount($dataProviders);
            return $this->render('index', [
                'dataProviders' => $dataProviders,
            ]);
        }
    }
    function createSsAccount($data = []){
        $module             = Yii::$app->controller->module->id;
        $session            = Yii::$app->session;
        $ss_Seach           = 'ss_Seach'.$module;
        $session[$ss_Seach] = $data;
       
    }
    public function actionDownload(){

        $module   = Yii::$app->controller->module->id;
        $session  = Yii::$app->session;
        $ss_Seach = 'ss_Seach'.$module;
        $data     = $session[$ss_Seach];
        //print_r($data);
        //die;

        $fileName = $module;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); 
        header('Content-Disposition: attachment; filename='.$fileName.'.csv');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        echo "\xEF\xBB\xBF"; // UTF-8 BOM

        $field1 = "ID";
        $field2 = "Source";
        $field3 = "Tên";
        $field4 = "Miêu tả";
        $field5 = "Trạng thái";
        $field6 = "Người tạo";
        $field7 = "Ngày tạo";
        echo $field1.", ".$field2.",".$field3.", ".$field4.",".$field5.",".$field6.",".$field7."\n";
        if(isset($data) && $data){
            foreach($data as $item){
                //print_r($item);
                //die;
                $status      = $item['STATUS'];   
                switch ($status) {
                  case '0':
                    $status = 'Chưa kích hoạt';
                    break;
                  case '1':
                    $status = 'Kích hoạt';
                   # code...
                   break;
                  case '2':
                    $status = 'Hủy kích hoạt';
                   # code...
                   break;
                  
                  default:
                    $status = '---';
                    # code...
                    break;
                }
                 echo $item["MODULE_ID"].",".$item["RESOURCE"].",".$item["NAME"].",".$item["DESCRIPTION"].",".$status.",".$item["CREATE_BY"].",".$item["CREATE_DATE"]."\n";
            }
        }else{
            echo 'Dữ liệu trống';
        }
        $session->remove($ss_Seach);
    }

    /**
     * Displays a single Modules model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Modules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Modules();

        if ($model->load(Yii::$app->request->post())) {

            /*echo '<pre>';
            print_r(Yii::$app->request->post());
            die;*/
            $idUser             = (int) Yii::$app->user->id;
            $model->CREATE_BY   = $idUser;
            $time               = time();
            $model->CREATE_DATE = $time ;

             if($model->save()){
                return $this->redirect(['view', 'id' => $model->MODULE_ID]);
            }else{
                return $this->render('create', [
                   'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Modules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $resource = $model->RESOURCE;
        if ($model->load(Yii::$app->request->post())) {
             $model->RESOURCE    = $resource;
             $idUser             = (int) Yii::$app->user->id;
             $model->UPDATE_BY   = $idUser;
             $time               = time();
             $model->UPDATE_DATE = $time ;

             if($model->save()){
                return $this->redirect(['view', 'id' => $model->MODULE_ID]);
            }else{
                return $this->render('update', [
                   'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Modules model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Modules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Modules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Modules::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
