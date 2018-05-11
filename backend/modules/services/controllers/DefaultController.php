<?php

namespace backend\modules\services\controllers;
use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\modules\services\models\Services;
use backend\modules\serviceRequest\models\ServiceRequest;
/**
 * Default controller for the `services` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
	const LIMIT            = 200;
	// const URL_GET_SERVICES = "http://210.211.98.80:8989/api/getServiceList?";
	public function behaviors()
    {
        $actions   = Yii::$app->acl->getRole();
        $actions[] = 'search';
        $actions[] = 'shell';
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
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
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
        $model = new Services;
        $page  = 1;

        
        $request = Yii::$app->request;
        $dataGets = $request->get();
        // $queryString = "&idPackage={$model->ID_PACKAGE}&serviceCode={$model->SERVICE_CODE}&productCode={$model->PRODUCT_CODE}&price={$model->PRICE}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
        if(isset($dataGets['idPackage']) && !empty(trim($dataGets['idPackage']))){
            $model->ID_PACKAGE = trim($dataGets['idPackage']);
        }
        if(isset($dataGets['serviceCode']) && !empty(trim($dataGets['serviceCode']))){
            $model->SERVICE_CODE = trim($dataGets['serviceCode']);
        }
        if(isset($dataGets['productCode']) && !empty(trim($dataGets['productCode']))){
            $model->PRODUCT_CODE = trim($dataGets['productCode']);
        }
        if(isset($dataGets['price']) && !empty(trim($dataGets['price']))){
            $model->PRICE = trim($dataGets['price']);
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
        $dataProvidersModel = Services::find()
                            // ->asArray()
                            ;
        
        //================= dieu kien tim kiem o day

        $model->load(Yii::$app->request->post());
        if($model->STATUS == ""){
            $dataProvidersModel->where(['>','STATUS',0]);
        }else{
            $dataProvidersModel->where(['=','STATUS',$model->STATUS]);
        }
        
        
        if(!empty(trim($model->ID_PACKAGE))){
            $dataProvidersModel ->andWhere(['=','ID_PACKAGE',trim($model->ID_PACKAGE)]);
        }  
        if(!empty(trim($model->SERVICE_CODE))){
            $dataProvidersModel ->andWhere(['like','SERVICE_CODE',trim($model->SERVICE_CODE)]);
        }  
        if(!empty(trim($model->PRODUCT_CODE))){
            $dataProvidersModel ->andWhere(['like','PRODUCT_CODE',trim($model->PRODUCT_CODE)]);
        } 
        if(!empty(trim($model->PRICE))){
            $dataProvidersModel ->andWhere(['=','PRICE',trim($model->PRICE)]);
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

        $dataProvidersModel->asArray();
        $dataProviders =  $dataProvidersModel->all();
        // echo '<pre>';print_r($dataProviders);die;

        // $queryString = '&name=duongnh&code=duong123&msisdn=3333&email=ddd&status=1';
        $queryString = "&idPackage={$model->ID_PACKAGE}&serviceCode={$model->SERVICE_CODE}&productCode={$model->PRODUCT_CODE}&price={$model->PRICE}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
        $myPagination = [
				'totalPage'   =>$totalPage,
				'page'        =>$page,
				'limit'       =>$limit,
				'action'      =>$baseUrl.$module,
				'queryString' =>$queryString,
            ];
        // echo $timeStart = time();   
        // echo '<hr>'; 
        ArrayHelper::multisort($dataProviders, [ 'SERVICE_CODE','PRICE',], [SORT_ASC, SORT_DESC]);
        // echo $timeEnd = time();    
        // echo '<hr>'; 
        // echo $timeEnd - $timeStart;
        // echo '<hr>'; 
        // echo '<pre>';
        // print_r($dataProviders);
        // die;
        return $this->render('index', [
            'model'         => $model,
            'dataProviders' => $dataProviders,
            'myPagination'  => $myPagination,
        ]);
    }
    // $filePath = "D:xxxxx\vasDealer\fileScript";
    // $test=shell_exec("C:\php\php $filePath.php");
    public function actionShell(){
        echo 'actionShell';
        // $filePath = "D:xxxxx\vasDealer\fileScript";
        // $test=shell_exec("C:\php\php $filePath.php");
    }
    public function actionCreate(){

        $request = Yii::$app->request;
        $data    = $request->post();
        $dataJson = [
                'errorCode' =>99,
                'errorDesc' =>'Thất bại',
                'quantity'  =>0,
                'items'     => [
                    'id'             => "",        
                    'serviceCode'    => "",        
                    'productCode'    => "",        
                    'price'          => "",        
                    'cycles'         => "",        
                    'description'    => "",        
                    'type'           => "",        
                    'commissionType' => "",        
                ],
        ];
        $dataParams = [
                    'userName'  => USERNAME,
                    'password'  => PASSWORD,
                    'masterId'  => MASTER_ID,
                    'checkSum'  => base64_encode(sha1(USERNAME.PASSWORD.MASTER_ID.SHAREKEY, true)),
                ];
                // echo USERNAME.PASSWORD.MASTER_ID.SHAREKEY;
                // echo '<pre>';
                // print_r($dataParams);
                // die;
        // $result = [];
        $result = Yii::$app->helper->serviceAPI(URL_GET_SERVICES,$dataParams,$method = "GET");
        //
        // print_r($result);
        // die;
        if($result){
             $arrDataApi = json_decode($result);
             // $arrDataApi = json_decode($result,true);
            // echo '<pre>';
             // print_r($arrDataApi);
             // die;
            // $this->logRequestSynServices($dataParams,$result);
            $this->logRequestSynServices($dataParams,$arrDataApi);
            $items = $arrDataApi->items;
            foreach ($items as $key => $item) {
                // print_r($item);
                $idPackage = $item->id;
                $serviceModel = [];
                if(isset($idPackage) && is_numeric($idPackage) && $idPackage > 0){
                    $serviceModel = $this->findByIdPackageModel($idPackage);
                    // print_r($serviceModel);
                    $timeNow = date("Y-m-d H:i:s");
                    if(!isset($serviceModel) || !$serviceModel){
                        $serviceModel = new Services;   
                        $serviceModel->CREATE_AT       = $timeNow;
                    }else{
                        $serviceModel->UPDATE_AT       = $timeNow;
                    }
                    $serviceModel->ID_PACKAGE      = $item->id;
                    $serviceModel->SERVICE_CODE    = $item->serviceCode;
                    $serviceModel->PRODUCT_CODE    = $item->productCode;
                    $serviceModel->PRICE           = $item->price;
                    $serviceModel->CYCLES          = $item->cycles;
                    // $serviceModel->DESCRIPTION     = htmlspecialchars($item->description);
                    $serviceModel->TYPE            = $item->type;
                    $serviceModel->STATUS          = 1;
                    $serviceModel->CONMISSION_TYPE = $item->commissionType;
                    
                    $serviceModel->save();
                }else{
                    //phat trien them log file
                    // echo 'khong co idPackage';
                }
            }
            return $result;
        }
        return json_encode($dataJson);
    } 
    public function actionCreate_(){

		$request = Yii::$app->request;
		$data    = $request->post();
        $dataJson = [
                'errorCode' =>99,
                'errorDesc' =>'Thất bại',
                'quantity'  =>0,
                'items'     => [
                    'id'             => "",        
                    'serviceCode'    => "",        
                    'productCode'    => "",        
                    'price'          => "",        
                    'cycles'         => "",        
                    'description'    => "",        
                    'type'           => "",        
                    'commissionType' => "",        
                ],
        ];

        if(isset($data['getContent']) && $data['getContent']){
    		
    		$dataParams = [
                        'userName'  => USERNAME,
                        'password'  => PASSWORD,
                        'masterId'  => MASTER_ID,
                        'checkSum'  => base64_encode(sha1(USERNAME.PASSWORD.MASTER_ID.SHAREKEY, true)),
                    ];
                    // echo USERNAME.PASSWORD.MASTER_ID.SHAREKEY;
                    // echo '<pre>';
                    // print_r($dataParams);
                    // die;
            // $result = [];
            $result = Yii::$app->helper->serviceAPI(URL_GET_SERVICES,$dataParams,$method = "GET");
            //
            // print_r($result);
            // die;
            if($result){
            	$arrDataApi = json_decode($result);
                 // print_r($arrDataApi);
                 // die;
                // $this->logRequestSynServices($dataParams,$result);
            	$this->logRequestSynServices($dataParams,$arrDataApi);
            	$items = $arrDataApi->items;
            	foreach ($items as $key => $item) {
            		// print_r($item);
            		$idPackage = $item->id;
            		$serviceModel = [];
            		if(isset($idPackage) && is_numeric($idPackage) && $idPackage > 0){
            			$serviceModel = $this->findByIdPackageModel($idPackage);
            			// print_r($serviceModel);
            			$timeNow = date("Y-m-d H:i:s");
            			if(!isset($serviceModel) || !$serviceModel){
            				$serviceModel = new Services;	
            				$serviceModel->CREATE_AT       = $timeNow;
            			}else{
            				$serviceModel->UPDATE_AT       = $timeNow;
            			}
    					$serviceModel->ID_PACKAGE      = $item->id;
    					$serviceModel->SERVICE_CODE    = $item->serviceCode;
    					$serviceModel->PRODUCT_CODE    = $item->productCode;
    					$serviceModel->PRICE           = $item->price;
    					$serviceModel->CYCLES          = $item->cycles;
    					$serviceModel->DESCRIPTION     = htmlspecialchars($item->description);
    					$serviceModel->TYPE            = $item->type;
            			$serviceModel->STATUS          = 1;
    					$serviceModel->CONMISSION_TYPE = $item->commissionType;
    					
    					$serviceModel->save();
            		}else{
            			//phat trien them log file
            			// echo 'khong co idPackage';
            		}
            	}
        		return $result;
            }
        }
        return json_encode($dataJson);
    }
    function logRequestSynServices($dataParams,$dataJson){
        $userLogin = Yii::$app->user->identity;
        // print_r($userLogin);
        $useAccount             = "elinks";
        $cpCodeAccount          = "elinks";
        if($userLogin){
            $useAccount             = $userLogin->USERNAME;
            $cpCodeAccount          =  $userLogin->CP_CODE;
        }
        
        $model             = new ServiceRequest();
        $model->USERNAME   = $dataParams['userName'];
        $model->PASSWORD   = $dataParams['password'];
        $model->MASTER_ID  = $dataParams['masterId'];
        $model->CHECKSUM   = $dataParams['checkSum'];
        $model->ERROR_CODE = $dataJson->errorCode;
        $model->ERROR_DESC = $dataJson->errorDesc;
        $model->QUANTITY   = $dataJson->quantity;
        $model->ITEMS      = json_encode($dataJson->items);
		$model->CREATE_AT  = date("Y-m-d H:i:s");
        $model->USER_ACCOUNT = $useAccount;
        $model->CP_CODE_ACCOUNT = $cpCodeAccount;

        // echo $model->ITEMS;
        // die;
         // print_r($model);
         //         die;
        if(!$model->save()){
            //log file o day
            // echo 'loi nhe';
            // print_r($model->errors);
        }
        // else{
        //     echo 'luu object ok';
        // }

    }
    protected function findByIdPackageModel($idPackage)
    {
        return  Services::find()->where(['ID_PACKAGE'=>$idPackage])->one();
    }
}
