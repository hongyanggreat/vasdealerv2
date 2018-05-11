<?php

namespace backend\modules\dealers\controllers;

use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\dealers\models\Dealers;
use backend\modules\dealerRequest\models\DealerRequest;
use backend\modules\dealerRequestStatus\models\DealerStatusRequest;

/**
 * Default controller for the `dealers` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
   const LIMIT = 20;
   
   // const URL_CREATE_DEALER   = "http://localhost/vasDealer/service/dearler?";
   // const URL_UPDATE_DEALER   = "http://localhost/vasDealer/service/dearlerupdate?";
   // const URL_STATUS_DEALER   = "http://localhost/vasDealer/service/dearlerstatus?";


   // const URL_CREATE_DEALER   = "http://210.211.98.80:8989/api/createDealer?";
   // const URL_UPDATE_DEALER   = "http://210.211.98.80:8989//api/updateDealer?";
   // const URL_STATUS_DEALER   = "http://210.211.98.80:8989/api/getStatusDealer?";

    public function behaviors()
    {
        $actions   = Yii::$app->acl->getRole();
        $actions[] = 'search';
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => $actions,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['status'],
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
        // $this->layout = "@app/views/layouts/layoutTable";
        $this->layout = "@app/views/layouts/adminLteForm";

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

     public function actionIndex()
    {
        $this->layout = "@app/views/layouts/adminLte";
        
        $module  = Yii::$app->controller->module->id;
        $baseUrl = Yii::$app->params['baseUrl'];
        $model = new Dealers;
        $page  = 1;

        
        $request = Yii::$app->request;
        $dataGets = $request->get();
        if(isset($dataGets['name']) && !empty(trim($dataGets['name']))){
            $model->NAME = trim($dataGets['name']);
        }
        if(isset($dataGets['code']) && !empty(trim($dataGets['code']))){
            $model->CODE = trim($dataGets['code']);
        }
        if(isset($dataGets['msisdn']) && !empty(trim($dataGets['msisdn']))){
            $model->MSISDN = trim($dataGets['msisdn']);
        }
        if(isset($dataGets['email']) && !empty(trim($dataGets['email']))){
            $model->EMAIL = trim($dataGets['email']);
        }
        if(isset($dataGets['status']) && !empty(trim($dataGets['status']))){
            $model->STATUS = trim($dataGets['status']);
        }
        $model->ORDER = "ID";
        if(isset($dataGets['order']) && !empty(trim($dataGets['order']))){
            $model->ORDER = trim($dataGets['order']);
        }
        $model->BY = "SORT_DESC";
        if(isset($dataGets['by']) && !empty(trim($dataGets['by']))){
            $model->BY = trim($dataGets['by']);
        }
        $dataProvidersModel = Dealers::find()
                            // ->asArray()
                            ;
        
        //================= dieu kien tim kiem o day

        $model->load(Yii::$app->request->post());
        if($model->STATUS == ""){
            $dataProvidersModel->where(['>','STATUS',0]);
        }else{
            $dataProvidersModel->where(['=','STATUS',$model->STATUS]);
        }
        
        
        if(!empty(trim($model->NAME))){
            $dataProvidersModel ->andWhere(['like','NAME',trim($model->NAME)]);
        }  
        if(!empty(trim($model->CODE))){
            $dataProvidersModel ->andWhere(['like','CODE',trim($model->CODE)]);
        }  
        if(!empty(trim($model->MSISDN))){
            $dataProvidersModel ->andWhere(['like','MSISDN',trim($model->MSISDN)]);
        } 
        if(!empty(trim($model->EMAIL))){
            $dataProvidersModel ->andWhere(['like','EMAIL',trim($model->EMAIL)]);
        } 


        $lvUserLogin =  Yii::$app->user->identity->LEVEL;
        $userLogin =  Yii::$app->user->identity->USERNAME;
        if($lvUserLogin > 0){
            $dataProvidersModel ->andWhere(['=','USER_ACCOUNT',$userLogin]);
        }                
        $countData =  $dataProvidersModel->count();
        // echo $model->ORDER;
        // echo '<pre>';print_r($model);die;
        $limit = self::LIMIT;
        $totalPage = ceil($countData/$limit);
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page = $_GET['page'];
        }
        if($page > $totalPage){
            $page = $totalPage;
        }
        $offset    = ($page-1)*($limit);
        //================= dieu kien tim kiem o day
        $dataProvidersModel->limit($limit)
                            ->offset($offset);
        if($model->BY == "SORT_DESC"){
            $dataProvidersModel->orderBy(["{$model->ORDER}"=>SORT_DESC]);
        }else{
            $dataProvidersModel->orderBy(["{$model->ORDER}"=>SORT_ASC]);
        }

        $dataProviders =  $dataProvidersModel->all();
        // $queryString = '&name=duongnh&code=duong123&msisdn=3333&email=ddd&status=1';
        $queryString = "&name={$model->NAME}&code={$model->CODE}&msisdn={$model->MSISDN}&email={$model->EMAIL}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
        $myPagination = [
                'totalPage' =>$totalPage,
                'page'      =>$page,
                'limit'     =>$limit,
                'action'    =>$baseUrl.$module,
                'queryString'    =>$queryString,
            ];
        return $this->render('index', [
            'model'         => $model,
            'dataProviders' => $dataProviders,
            'myPagination'  => $myPagination,
        ]);
    }
    public function actionCreate()
    {

        $userLogin     = Yii::$app->user->identity;
        $idUser        = (int) $userLogin->ID;
        $userName      = $userLogin->USERNAME;
        $cpCodeAccount =  $userLogin->CP_CODE;
        $model    = new Dealers();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $requestId = Yii::$app->helper->RandomNumber(8);
                $dataParams = [
                    'requestId' => $requestId,
                    'name'      => $model->NAME,
                    'code'      => $model->CODE,
                    'msisdn'    => $model->MSISDN,
                    'email'     => $model->EMAIL,
                    'userName'  => USERNAME,
                    'password'  => PASSWORD,
                    'masterId'  => MASTER_ID,
                    'checkSum'  => base64_encode(sha1($requestId.$model->NAME.$model->CODE.$model->MSISDN.$model->EMAIL.USERNAME.PASSWORD.MASTER_ID.SHAREKEY,true)),
                ];
                // echo '<br>';
                // echo $requestId.$model->NAME.$model->CODE.$model->MSISDN.$model->EMAIL.USERNAME.PASSWORD.MASTER_ID.SHAREKEY;
                // echo '<br>';
                // echo '<pre>';
                // print_r($dataParams);
                // die;
                $result = Yii::$app->helper->serviceAPI(URL_CREATE_DEALER,$dataParams,$method = "GET");

                // print_r($result);
                // die;
                if($result){

                    $dataJson            = json_decode($result);
                    $dataParams['typeAction'] = 0;
                    $rs = $this->logRequestDealer($dataParams,$dataJson);
                    // echo '<pre>';
                    // print_r($rs);
                    // print_r($dataJson);
                    // die;

                    if(!isset($dataJson->dealerId) || !$dataJson->dealerId){
                        $dataJson->dealerId = 0;
                    }
                    $model->ACCOUNT_ID      = $idUser;
                    $model->USER_ACCOUNT    = $userName;
                    $model->CP_CODE_ACCOUNT = $cpCodeAccount;
                    $model->DEALER_ID       = $dataJson->dealerId;
                    // die;
                    $model->CREATE_AT       = date("Y-m-d H:i:s");
                    $model->STATUS          = 5;
                    // echo '<pre>';
                    // print_r($dataJson);
                    // die;

                    if($dataJson->errorCode == 1){
                            // echo '<pre>';
                            // print_r($model);
                            // die;
                        if($model->save()){
                            Yii::$app->session->setFlash('showAlert', ['classAlert'=>'success','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Đăng ký Dealer thành công']);
                            return $this->redirect(['view', 'id' => $model->ID]);
                        }else{

                            Yii::$app->session->setFlash('showAlert', ['classAlert'=>'warning','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Có lỗi lưu hệ thống']);
                            return $this->render('create', [
                               'model' => $model,
                            ]);
                        }
                    }else{
                        Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Đăng ký Dealer thất bại']);
                        return $this->render('create', [
                           'model' => $model,
                        ]);
                    }
                    
                }else{
                    Yii::$app->session->setFlash('showAlert', ['classAlert'=>'warning','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Không thể kết nối']);
                    return $this->render('create', [
                       'model' => $model,
                    ]);
                }
                
            }else{
                // print_r($model->errors);
                Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Xem lại thông tin điền vào']);
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

     public function actionUpdate($id)
    {

        $idUser   = (int) Yii::$app->user->identity->ID;
        $userName = Yii::$app->user->identity->USERNAME;
        $model    = $this->findModel($id);
        if($model->USER_ACCOUNT != $userName){
            Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Bạn không có quyền. ok!']);
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $requestId = Yii::$app->helper->RandomNumber(8);
                $dealerId = $model->DEALER_ID;
                $dataParams = [
                    'requestId' => $requestId,
                    'dealerId'  => $dealerId,
                    'name'      => $model->NAME,
                    'code'      => $model->CODE,
                    'msisdn'    => $model->MSISDN,
                    'email'     => $model->EMAIL,
                    'userName'  => USERNAME,
                    'password'  => PASSWORD,
                    'masterId'  => MASTER_ID,
                    'checkSum'  => base64_encode(sha1($requestId.$dealerId.$model->NAME.$model->CODE.$model->MSISDN.$model->EMAIL.USERNAME.PASSWORD.MASTER_ID.SHAREKEY,true)),
                ];
                // echo '<pre>';
                // print_r(Yii::$app->request->post());
                // die;
                $result = "";
                if($model->USER_ACCOUNT == $userName){
                     $result    = Yii::$app->helper->serviceAPI(URL_UPDATE_DEALER,$dataParams,$method = "GET");
                }else{
                    Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Bạn không có quyền. ok!']);
                    
                }
                $dataJson                 = json_decode($result);
                $dataParams['typeAction'] = 1;
                $this->logRequestDealer($dataParams,$dataJson);
                
                if($model->USER_ACCOUNT != $userName){
                    return $this->redirect(['index']);
                }
                if($result){

                    $model->ACCOUNT_ID   = $idUser;
                    $model->USER_ACCOUNT = $userName;

                    if($dataJson->errorCode == 1){
                        
                        if($model->save()){
                            Yii::$app->session->setFlash('showAlert', ['classAlert'=>'success','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Cập nhật  Dealer thành công']);
                            return $this->redirect(['view', 'id' => $model->ID]);
                        }else{
                            Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: CÓ lỗi lưu hệ thống']);
                            return $this->render('update', [
                               'model' => $model,
                            ]);
                        }
                    }else{
                        Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Thông tin không được cập nhật']);
                        return $this->redirect(['index']);
                    }

                }else{
                    Yii::$app->session->setFlash('showAlert', ['classAlert'=>'warning','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Không thể kết nối']);
                    return $this->render('update', [
                       'model' => $model,
                    ]);
                }
                
            }else{
                
                Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>'Thông báo: Xem lại thông tin điền vào']);
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

    
     public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionStatus(){

        $request = Yii::$app->request;
        $dataPosts = $request->post();
        $dataJson = [
                'status'    =>7,
                'errorCode' =>0,
                // 'errorDesc' =>'Không được phép',
                'errorDesc' =>'Error',
        ];
        if(isset($dataPosts['id']) && $dataPosts['id'] > 0){
            $idInDealer = $dataPosts['id'];
            // $model = Dealers::find()
            //             ->select(['ID','DEALER_ID'])
            //             ->where(['ID'=>$idInDealer])
            //             // ->asArray()
            //             ->one();
            $model = $this->findModel($idInDealer);
            if($model){
                $dealerId = $model->DEALER_ID;
                $dataParams = [
                    'dealerId' => $dealerId,
                    'userName' => USERNAME,
                    'password' => PASSWORD,
                    'masterId' => MASTER_ID,
                    'checkSum' => base64_encode(sha1($dealerId.USERNAME.PASSWORD.MASTER_ID.SHAREKEY,true)),
                ];
                // echo '<pre>';
                // print_r(Yii::$app->request->post());
                // die;
                $dataJsonApi = Yii::$app->helper->serviceAPI(URL_STATUS_DEALER,$dataParams,$method = "GET");
                $arrDataApi = json_decode($dataJsonApi);
                $this->logRequestStatusDealer($dataParams,$arrDataApi);
                // die;
                if($arrDataApi){
                    $model->STATUS = $arrDataApi->status;
                    // print_r($model);
                    $model->save();
                    if($model->save()){
                        return $dataJsonApi;
                    }else{
                        // $dataJson['errorDesc'] = "Không lấy luu ";
                        $dataJson['errorDesc'] = "Không cập nhật được";
                        return json_encode($model->errors);
                        // return json_encode($dataJson);
                    }
                }else{
                    // $dataJson['errorDesc'] = "Không lấy được thông tin API";
                    $dataJson['errorDesc'] = "Error";
                    return json_encode($dataJson);
                }
            }else{
                // $dataJson['errorDesc'] = "Không tồn tại đối tượng";
                $dataJson['errorDesc'] = "Error";
                return json_encode($dataJson);
            }
        }else{
            return json_encode($dataJson);
        }
      
    }
    function logRequestDealer($data,$dataJson){
        $userLogin = Yii::$app->user->identity;

        $useAccount             = $userLogin->USERNAME;
        $cpCodeAccount          =  $userLogin->CP_CODE;

        $model              = new DealerRequest();
        $model->USERNAME    = $data['userName'];
        $model->PASSWORD    = $data['password'];
        $model->MASTER_ID   = $data['masterId'];
        $model->CHECKSUM    = $data['checkSum'];
        $model->REQUEST_ID  = $data['requestId'];
        $model->NAME        = $data['name'];
        $model->CODE        = $data['code'];
        $model->EMAIL       = $data['email'];
        $model->MSISDN      = $data['msisdn'];
       
        $errorCode = "";
        if(isset($dataJson->errorCode) && $dataJson->errorCode){
            $errorCode = $dataJson->errorCode;
        }
        $model->ERROR_CODE = $errorCode;


        $errorDesc = "";
        if(isset($dataJson->errorDesc) && $dataJson->errorDesc){
            $errorDesc = $dataJson->errorDesc;
        }
        $model->ERROR_DESC = $errorDesc;


        $dealerId = "";
        if(isset($dataJson->dealerId) && $dataJson->dealerId){
            $dealerId = $dataJson->dealerId;
        }
        $model->DEALER_ID   = $dealerId;
        
        $model->TYPE_ACTION = $data['typeAction'];
        $userName           = Yii::$app->user->identity->USERNAME;
        $model->USER_ACTION = $userName;
        $model->USER_ACCOUNT = $userName;
        $model->CP_CODE_ACCOUNT = $cpCodeAccount;
        $model->CREATE_AT   = date("Y-m-d H:i:s");

        if(!$model->save()){
            // print_r($model->errors);
            // die;
            return $model->errors;
        }

    }
    function logRequestStatusDealer($data,$dataJson){
        $userLogin = Yii::$app->user->identity;
        $useAccount             = $userLogin->USERNAME;
        $cpCodeAccount          =  $userLogin->CP_CODE;
        // die;
        // print_r($data);
        // print_r($dataJson);
        // die;
        $model             = new DealerStatusRequest();
        $model->USERNAME   = $data['userName'];
        $model->PASSWORD   = $data['password'];
        $model->MASTER_ID  = $data['masterId'];
        $model->CHECKSUM   = $data['checkSum'];
        $model->DEALER_ID  = $data['dealerId'];
        //================================
        $status = "";
        if(isset($dataJson->status) && $dataJson->status){
            $status = $dataJson->status;
        }
        $model->STATUS     = $status;
        //================================
        $errorCode = "";
        if(isset($dataJson->errorCode) && $dataJson->errorCode){
            $errorCode = $dataJson->errorCode;
        }
        $model->ERROR_CODE = $errorCode;
        //================================
        $errorDesc = "";
        if(isset($dataJson->errorDesc) && $dataJson->errorDesc){
            $errorDesc = $dataJson->errorDesc;
        }
        $model->ERROR_DESC = $errorDesc;
        //================================

        $model->USER_ACCOUNT    = $useAccount;
        $model->CP_CODE_ACCOUNT = $cpCodeAccount;
        // print_r($model);
        // die;

        $model->CREATE_AT  = date("Y-m-d H:i:s");
        if(!$model->save()){
            // print_r($model->errors);
        }

    }
    protected function findModel($id)
    {
        return $model = Dealers::findOne($id);
    }
}
