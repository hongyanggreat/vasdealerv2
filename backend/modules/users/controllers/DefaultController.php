<?php

namespace backend\modules\users\controllers;

use Yii;
use backend\modules\users\models\Accounts;
use backend\modules\users\models\AccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * DefaultController implements the CRUD actions for Accounts model.
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
    public function actionFault()
    {
        
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();
            
            $this->layout = "@app/views/layouts/layoutTable";
            
            return $this->render('fault', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message
            ]);
        }else{
            echo 'khong co loi';
        }
    }
    public function actions()
    {
        $this->layout = "@app/views/layouts/layoutTable";

        
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Accounts models.
     * @return mixed
     */
   
     public function actionIndex()
    {
        if(isset($_GET['search'])){
            $model = new Accounts;
            if ($model->load(Yii::$app->request->post())) {
                $dataPost = Yii::$app->request->post()['Accounts'];
                /*echo '<pre>';print_r($dataPost);
                die;*/
                $username  = trim($dataPost['USERNAME']);
                $cpCode    = trim($dataPost['CP_CODE']);
                $strParent = trim($dataPost['PARENT_ID']);
                //$startTime = $endTime  = date('d-m-Y');
                $startTime = $endTime  = time();
                if($dataPost['CREATE_DATE']){
                    $startTime = strtotime(trim($dataPost['CREATE_DATE']));
                }
                if($dataPost['UPDATE_DATE']){
                    //$endTime   = (int)strtotime(trim($dataPost['UPDATE_DATE']));
                    $endTime   = (int)strtotime(trim($dataPost['UPDATE_DATE'])) + 86400;
                }
                $arrayStatus = $dataPost['STATUS'];
                
                if($dataPost['OPTION_DATA'] && $dataPost['OPTION_DATA']== 'all' ){
                    $limit = "";
                }else{
                    $limit = $dataPost['OPTION_DATA'];
                }
                if($dataPost['TEXT_LIMIT'] && trim($dataPost['TEXT_LIMIT']) !="" ){
                    $limit = $dataPost['TEXT_LIMIT'];
                }
                //Xap xep theo
                if($dataPost['AUTH_KEY'] && $dataPost['AUTH_KEY']){
                     $order = $dataPost['AUTH_KEY'];
                }
                if($dataPost['USER_TYPE'] && $dataPost['USER_TYPE']){
                     $by = $dataPost['USER_TYPE'];
                }
               
                $parent = '';
                if(isset($strParent) && !empty($strParent)){
                    $dataPerent = Accounts::find()
                                ->select(['ACC_ID'])
                                ->where(['like','USERNAME', $strParent])
                                ->one();
                    if(isset($dataPerent) && $dataPerent){
                        $parent     = $dataPerent->ACC_ID;
                    }else{
                        $parent = 100;
                    }
                }
                //echo $parent;
                $modelSearch = Accounts::find()
                            ->select([
                                        'ACC_ID',
                                        'USERNAME',
                                        'CP_CODE',
                                        'STATUS',
                                        'STATUS',
                                        'PHONE',
                                        'EMAIL',
                                        'PARENT_ID',
                                        'CREATE_DATE',
                                    ])
                            ->asArray();
                //theo thoi gian

                $modelSearch->andWhere(['>=','CREATE_DATE',$startTime]);
                $modelSearch->andWhere(['<=','CREATE_DATE',$endTime]);

                if(isset($username) && !empty($username)){
                   $modelSearch->andWhere(['like','USERNAME',$username]); 
                }
                if(isset($cpCode) && !empty($cpCode)){
                   $modelSearch->andWhere(['like','CP_CODE',$cpCode]); 
                }
                if(isset($parent) && !empty($parent)){
                   $modelSearch->andWhere(['=','PARENT_ID',$parent]); 
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
                $dataProviders = $modelSearch->with([    // this is for the related models
                                'parent' => function($query) {
                                    $query->select(['ACC_ID','USERNAME']);
                                },
                            ])->all();


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
            //print_r($_GET);
            $limit = 100;
            $page  = 1;
            if(isset($_GET['page']) && is_numeric($_GET['page'])){
                $page = $_GET['page'];
            }
            $offset = ($page-1)*$limit;
            $dataProviders = Accounts::find()
                            ->where(['<>','STATUS', 2])
                            ->select([
                                    'ACC_ID',
                                    'USERNAME',
                                    'CP_CODE',
                                    'STATUS',
                                    'PHONE',
                                    'EMAIL',
                                    'PARENT_ID',
                                    'CREATE_DATE',
                                ])
                            ->with([    // this is for the related models
                                'parent' => function($query) {
                                    $query->select(['ACC_ID','USERNAME']);
                                },
                            ])
                            ->limit($limit)
                            ->offset($offset)
                            ->orderBy(['ACC_ID'=>SORT_DESC])
                            ->asArray()
                            ->all();
            //echo '<pre>';print_r($dataProviders);
            //die;
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
        $field2 = "Tài khoản";
        $field3 = "Mã code";
        $field4 = "Trạng thái";
        $field5 = "Parent";
        $field6 = "Ngày tạo";
        echo $field1.", ".$field2.",".$field3.", ".$field4.",".$field5.",".$field6."\n";
        if(isset($data) && $data){
            foreach($data as $item){
                 echo $item["ACC_ID"].",".$item["USERNAME"].",".$item["CP_CODE"].",".$item["STATUS"].",".$item["parent"]["USERNAME"].",".$item["CREATE_DATE"]."\n";
            }
        }else{
            echo 'Dữ liệu trống';
        }
        $session->remove($ss_Seach);
    }
    /**
     * Displays a single Accounts model.
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
     * Creates a new Accounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $userLogin      =  Yii::$app->user->identity;
        $levelUserLogin = $userLogin->LEVEL;
        // print_r('<pre>');
        // print_r($userLogin);
        // die;
        if($levelUserLogin > 1){
            return $this->redirect(['/site/login']);
        }
        $levelUser = $levelUserLogin + 1;
        $model = new Accounts();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            
            $pass = '';
            $auth_key = '';
            if(isset($model->PASSWORD) && trim($model->PASSWORD) !=""){
                $pass               = Yii::$app->security->generatePasswordHash($model->PASSWORD);
                $auth_key           = Yii::$app->security->generateRandomString();
            }
            $model->PASSWORD    = $pass;
            $model->AUTH_KEY    = $auth_key;
            $model->CP_CODE     = strtoupper(Yii::$app->helper->RandomString(5));
            
            $idUser             = (int) Yii::$app->user->id;
            $model->PARENT_ID   = $idUser;
            $model->CREATE_BY   = $idUser;
            $time               = time();
            $model->CREATE_DATE = $time ;
            $model->LEVEL       = $levelUser ;

            /*$model->ACC_ID    = 152115;
            $model->USER_TYPE = 0;
            $model->PASSWORD_RESET_TOKEN = NULL;
            $model->UPDATE_DATE = $time;
            $model->UPDATE_BY = $idUser;*/

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->ACC_ID]);
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
     * Updates an existing Accounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //print_r($model);
        $username = $model->USERNAME;
        $pass = $model->PASSWORD;
        
        if ($model->load(Yii::$app->request->post())) {

            $model->USERNAME = $username;
            if(isset($model->PASSWORD) && trim($model->PASSWORD) !=""){
                $pass               = Yii::$app->security->generatePasswordHash($model->PASSWORD);
                $auth_key           = Yii::$app->security->generateRandomString();
                $model->AUTH_KEY    = $auth_key;
            }
            

            $model->PASSWORD    = $pass;
            $idUser             = (int) Yii::$app->user->id;
            $model->UPDATE_BY   = $idUser;
            $time               = time();
            $model->UPDATE_DATE = $time ;


            if($model->save()){
                return $this->redirect(['view', 'id' => $model->ACC_ID]);
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
     * Deletes an existing Accounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
         $model->STATUS = 2;
         if($model->save()){
            $module       = Yii::$app->controller->module->id;
            return $this->redirect(['/'.$module]);
         }else{
            return $this->redirect(['site/error']);
         }

    }
    public function actionErase($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Accounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Accounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Accounts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
