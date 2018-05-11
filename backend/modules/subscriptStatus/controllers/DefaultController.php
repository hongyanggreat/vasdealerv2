<?php

namespace backend\modules\subscriptStatus\controllers;


use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\Quick;
use backend\modules\subscriptStatus\models\SubscriptStatusRequest;
use backend\components\PhoneNumber;
/**
 * Default controller for the `subscriptStatus` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    const LIMIT            = 10;
    // const URL_SUB_SCRIPT_STATUS = "service/subscriptstatus?";
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
                        'actions' => ['dealerid','serviceid','msisdn','sendone'],
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
        $model = new SubscriptStatusRequest;
        $page  = 1;

        
        $request = Yii::$app->request;
        $dataGets = $request->get();

        if(isset($dataGets['status'])){
            $model->STATUS = (int)trim($dataGets['status']);
        }

        // echo $model->STATUS;
        // echo '<hr>';
        if(isset($dataGets['msisdn'])){
            $model->MSISDN = trim($dataGets['msisdn']);
        }
        $model->ORDER = "ID";
        if(isset($dataGets['order']) && !empty(trim($dataGets['order']))){
            $model->ORDER = trim($dataGets['order']);
        }
        $model->BY = "SORT_DESC";
        if(isset($dataGets['by']) && !empty(trim($dataGets['by']))){
            $model->BY = trim($dataGets['by']);
        }
        $dataProvidersModel = SubscriptStatusRequest::find()
                            // ->asArray()
                            ;
        
        //================= dieu kien tim kiem o day
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page = $_GET['page'];
        }                    
        if($model->load(Yii::$app->request->post())){
            $page = 1;
        }
        // echo $model->STATUS;
        // echo '<hr>';
        if(isset($model->STATUS) && $model->STATUS >=0){
            $dataProvidersModel->where(['=','STATUS',$model->STATUS]);
        }else{
            $dataProvidersModel->where(['>=','STATUS',0]);
        }
         if(!empty(trim($model->MSISDN))){
            $dataProvidersModel ->andWhere(['like','MSISDN',trim($model->MSISDN)]);
        }  
                    
        $countData =  $dataProvidersModel->count();
        // echo $model->ORDER;
        // echo '<pre>';print_r($model);die;
        $limit = self::LIMIT;
        $totalPage = ceil($countData/$limit);
        
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
        // echo '<pre>';print_r($dataProviders);die;

        // $queryString = '&name=duongnh&code=duong123&msisdn=3333&email=ddd&status=1';
        $queryString = "&msisdn={$model->MSISDN}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
        $myPagination = [
                'totalPage'   =>$totalPage,
                'page'        =>$page,
                'limit'       =>$limit,
                'action'      =>$baseUrl.$module,
                'queryString' =>$queryString,
            ];
        return $this->render('index', [
            'model'         => $model,
            'dataProviders' => $dataProviders,
            'myPagination'  => $myPagination,
        ]);
    }
    public function actionCreate(){
     	$modelSubscript = new SubscriptStatusRequest();
     	$dealerIds  = Quick::findDealers();
        $serviceCodes      = Quick::findByServices();
         $serviceCodes['all'] = "Tất cả";
        $serviceProductIds = Quick::findProductOfServices();
          $arrDataApi  = [];
          $dataJsonApi = "";
		 if($modelSubscript->load(Yii::$app->request->post())){
        	// echo '<pre>';print_r($modelSubscript);	
            $dealerId  =  $modelSubscript->DEALER_ID;
            $serviceId =  $modelSubscript->SERVICE_ID;
            $msisdn    =  $modelSubscript->MSISDN;
            $msisdn = PhoneNumber::PhoneTo84($msisdn);         
            $dataParams = [
                'dealerId'  => $dealerId,
                'serviceId' => $serviceId,
                'msisdn'    => $msisdn,

                'userName'  => USERNAME,
                'password'  => PASSWORD,
                'masterId'  => MASTER_ID,
                'checkSum'  => base64_encode(sha1($dealerId.$serviceId.$msisdn.USERNAME.PASSWORD.MASTER_ID.SHAREKEY,true)),
            ];  
            // echo '<pre>';
            // print_r($dataParams);
            // die;
            if($modelSubscript->validate()){
                $urlAPI = URL_SUB_SCRIPT_STATUS;
                $dataJsonApi = Yii::$app->helper->serviceAPI($urlAPI,$dataParams,$method = "GET");
            }else{
                // echo 'khong validate';
            }

            $arrDataApi = json_decode($dataJsonApi);

            // print_r($arrDataApi);
            // die;
            $log = $this->logRequestSubscriptStatus($dataParams,$arrDataApi);
         }
         // if($arrDataApi){
         //     print_r($arrDataApi);
         //     die;
         // }
        return $this->render('create', [
            'modelSubscript'    => $modelSubscript,
            'dealerIds'         => $dealerIds,
            'serviceCodes'      => $serviceCodes,
            'serviceProductIds' => $serviceProductIds,
            'arrDataApi'        => $arrDataApi,
        ]);
     }
     function logRequestSubscriptStatus($dataParams,$dataJson){
        // return;
        $userLogin = Yii::$app->user->identity;

        $useAccount             = $userLogin->USERNAME;
        $cpCodeAccount          =  $userLogin->CP_CODE;
        
        
        $dealerCode             = "?";
        $model                  = new SubscriptStatusRequest();
        
        $model->USERNAME        = $dataParams['userName'];
        $model->PASSWORD        = $dataParams['password'];
        $model->MASTER_ID       = $dataParams['masterId'];
        $model->CHECKSUM        = $dataParams['checkSum'];
        
        $model->DEALER_ID       = $dataParams['dealerId'];
        $model->SERVICE_ID      = $dataParams['serviceId'];
        $model->MSISDN          = $dataParams['msisdn'];


        if(isset($dataJson->errorCode)){
            $model->ERROR_CODE      = $dataJson->errorCode;
        }
        if(isset($dataJson->errorDesc)){
            $model->ERROR_DESC      = $dataJson->errorDesc;
        }

        if(isset($dataJson->status)){
            $model->STATUS      = $dataJson->status;
        }
        if(isset($dataJson->lastSubscribe)){
            $model->LAST_SUBSCRIBE     = Yii::$app->helper->formatDate($dataJson->lastSubscribe,"Y-m-d H:i:s");
        }
        if(isset($dataJson->lastUnsubscribe)){
            $model->LAST_UNSUBSCRIBE     = Yii::$app->helper->formatDate($dataJson->lastUnsubscribe,"Y-m-d H:i:s");
        }
        if(isset($dataJson->lastRenew)){
            $model->LAST_RENEW     = Yii::$app->helper->formatDate($dataJson->lastRenew,"Y-m-d H:i:s");
        }
        if(isset($dataJson->lastRetry)){
            $model->LAST_RETRY     = Yii::$app->helper->formatDate($dataJson->lastRetry,"Y-m-d H:i:s");
        }
        if(isset($dataJson->expireTime)){
            $model->EXPIRE_TIME     = Yii::$app->helper->formatDate($dataJson->expireTime,"Y-m-d H:i:s");
        }

        $model->DEALER_CODE     = $dealerCode;
        $model->USER_ACCOUNT    = $useAccount;
        $model->CP_CODE_ACCOUNT = $cpCodeAccount;
        
        $model->CREATE_AT       = date("Y-m-d H:i:s");
        // echo 'chuan bi luu du lieu';
        if(!$model->save()){
            // echo 'co loi xay ra';
            // print_r($model->errors);
            return false;
        }else{
            // echo 'luu log thanh cong';
            return true;
        }

    }

}
