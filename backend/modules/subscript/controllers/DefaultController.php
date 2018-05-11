<?php

namespace backend\modules\subscript\controllers;

use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\dealers\models\Dealers;
use backend\modules\subscript\models\Subscript;
use backend\modules\subscript\models\SubscriptRequest;


use backend\components\Quick;
use backend\components\MyEnum;
use backend\components\PhoneNumber;

/**
 * Default controller for the `subscript` module
 */
class DefaultController extends Controller
{
    const LIMIT            = 10;
	// const URL_SUB_SCRIPT = "service/subscript?";
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
                        'actions' => ['change_service','dealerid','serviceid','msisdn','sendone','demo'],
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
    public function actionDemo(){
    	$serviceIds  = Quick::findByService();
    	echo '<pre>';
    	print_r($serviceIds);

    }
    public function actionChange_service(){
    	$dataJson = [
			'status'  =>false,
			'message' =>"Xác nhận thất bại",
    	];
		$request   = Yii::$app->request;
		$dataPosts = $request->post();
		if(isset($dataPosts['getContent']) && $dataPosts['getContent']){
			$options = [];
			if($dataPosts['serviceCode'] != "all"){
				$options['SERVICE_CODE'] = $dataPosts['serviceCode']; 
			}
			$dataProductOfServices = Quick::findProductOfServices($options);
			// print_r($dataProductOfService);
			if(isset($dataProductOfServices) && $dataProductOfServices){
				$htmlSelect = '';
				foreach ($dataProductOfServices as $key => $val) {
						$htmlSelect .='<option value="'.$key.'">'.$val.'</option>';
				}
				$dataJson['status'] = true;
				$dataJson['message'] = "Xử lý thành công";
			}else{
				$htmlSelect ='<option value="">Không có gói cước nào</option>';
			}
			$dataJson['selectOption'] = $htmlSelect;
		}
		// sleep(2);
		echo json_encode($dataJson);
    }
    public function actionDealerid(){

    	$dataJson = [
			'status'  =>false,
			'message' =>"Xác nhận thất bại",
    	];
		$request   = Yii::$app->request;
		$dataPosts = $request->post();
		$dealerId = 0;
		if(isset($dataPosts['dealerId']) && $dataPosts['dealerId'] && is_numeric($dataPosts['dealerId']) && $dataPosts['dealerId'] > 0){
			$dealerId =  $dataPosts['dealerId']	;
		}
		$session = Yii::$app->session;
		// sleep(1);
		if ($session->isActive){
			if ($session->has('sendPhoneSingle')){
				$arrsendPhoneSingle = $session->get('sendPhoneSingle');
				// print_r($arrsendPhoneSingle);
				$arrsendPhoneSingle['dealerId'] = $dealerId;
				$session->set('sendPhoneSingle',$arrsendPhoneSingle);
				// print_r($arrsendPhoneSingle);
			}else{
				// echo 'khong co ss key';
				$arrsendPhoneSingle['dealerId'] = $dealerId;
				$session->set('sendPhoneSingle',$arrsendPhoneSingle);
			}
				// print_r($arrsendPhoneSingle);
			$dataJson['message'] = "Xác nhận thành công";
			$dataJson['status'] = true;
		}else{
			$dataJson['message'] = "Không tồn tại session";
			// echo 'khong co ss';
		}
		return json_encode($dataJson);
    }
    public function actionServiceid(){

    	$dataJson = [
			'status'  =>false,
			'message' =>"Xác nhận thất bại",
    	];
		$request   = Yii::$app->request;
		$dataPosts = $request->post();
		$serviceId = 0;
		if(isset($dataPosts['serviceId']) && $dataPosts['serviceId'] && is_numeric($dataPosts['serviceId']) && $dataPosts['serviceId'] > 0){
			$serviceId =  $dataPosts['serviceId']	;
		}
		$session = Yii::$app->session;
		// sleep(1);
		if ($session->isActive){
			if ($session->has('sendPhoneSingle')){
				$arrsendPhoneSingle = $session->get('sendPhoneSingle');
				// print_r($arrsendPhoneSingle);
				$arrsendPhoneSingle['serviceId'] = $serviceId;
				$session->set('sendPhoneSingle',$arrsendPhoneSingle);
				// print_r($arrsendPhoneSingle);
			}else{
				// echo 'khong co ss key';
				$arrsendPhoneSingle['serviceId'] = $serviceId;
				$session->set('sendPhoneSingle',$arrsendPhoneSingle);
			}
			// print_r($arrsendPhoneSingle);
			$dataJson['message'] = "Xác nhận thành công";
			$dataJson['status'] = true;
		}else{
			$dataJson['message'] = "Không tồn tại session";
			// echo 'khong co ss';
		}
		return json_encode($dataJson);
    }
    public function actionMsisdn(){

    	$dataJson = [
			'status'  =>false,
			'message' =>"Xác nhận thất bại",
    	];
		$request   = Yii::$app->request;
		$dataPosts = $request->post();
		$msisdn = "";
		if(isset($dataPosts['msisdn']) && !empty(trim($dataPosts['msisdn']))){
			 $msisdn =  $dataPosts['msisdn']	;
			 $msisdn = PhoneNumber::PhoneTo84($msisdn);
			// check xem dung so vina khong
			$result = PhoneNumber::detect_phone_vina($msisdn);
			// $result = true;
	        if($result){
	           
				$session = Yii::$app->session;
				// sleep(1);
				if ($session->isActive){
					if ($session->has('sendPhoneSingle')){
						$arrsendPhoneSingle = $session->get('sendPhoneSingle');
						// print_r($arrsendPhoneSingle);
						$arrsendPhoneSingle['msisdn'] = $msisdn;
						$session->set('sendPhoneSingle',$arrsendPhoneSingle);
						// print_r($arrsendPhoneSingle);
					}else{
						// echo 'khong co ss key';
						$arrsendPhoneSingle['msisdn'] = $msisdn;
						$session->set('sendPhoneSingle',$arrsendPhoneSingle);
					}
					$dataJson['message'] = "Xác nhận thành công";
					$dataJson['status'] = true;
				}else{
					$dataJson['message'] = "Không tồn tại session";
					// echo 'khong co ss';
				}
	        }else{
				$dataJson['message'] = "Không phải số Vinaphone";
	        }
		}
		return json_encode($dataJson);
    }
    public function actionSendone(){
    	$dataJson = [
			'status'  =>false,
			'message' =>"Gửi lời mời thất bại",
    	];
		// $request   = Yii::$app->request;
		// $dataPosts = $request->post();
		
		$session = Yii::$app->session;
		// sleep(1);
		if ($session->isActive){
			if ($session->has('sendPhoneSingle')){
				$arrsendPhoneSingle = $session->get('sendPhoneSingle');

				// print_r($arrsendPhoneSingle);
				if(isset($arrsendPhoneSingle['dealerId']) && isset($arrsendPhoneSingle['serviceId']) && isset($arrsendPhoneSingle['msisdn']) && !empty($arrsendPhoneSingle['msisdn'])){

					// xu ly goi moi khach hang
					$requestId =  Yii::$app->helper->RandomNumber(9);
					$dealerId  =  $arrsendPhoneSingle['dealerId'];
					$serviceId =  $arrsendPhoneSingle['serviceId'];
					$msisdn    =  $arrsendPhoneSingle['msisdn'];
					
					$model             = new Subscript();
					$model->REQUEST_ID = $requestId;
					$model->DEALER_ID  = $dealerId;
					$model->SERVICE_ID = $serviceId;
					$model->MSISDN     = $msisdn;


					$dataJsonApi = '';
					$dataParams = [
						'requestId' => $requestId,
						'dealerId'  => $dealerId,
						'serviceId' => $serviceId,
						'msisdn'    => $msisdn,
						'userName'  => USERNAME,
						'password'  => PASSWORD,
						'masterId'  => MASTER_ID,
						'checkSum'  => base64_encode(sha1($requestId.$dealerId.$serviceId.$msisdn.USERNAME.PASSWORD.MASTER_ID.SHAREKEY,true)),
	                ];	
					if($model->validate()){
						$urlAPI = URL_SUB_SCRIPT;
		                $dataJsonApi = Yii::$app->helper->serviceAPI($urlAPI,$dataParams,$method = "GET");
		                // print_r($dataJsonApi);
	                	$dataParams['status'] = 1;
					}else{
	                	$dataParams['status'] = 0;
						// print_r($model->errors);
					}
	                $arrDataApi = json_decode($dataJsonApi);
	                // print_r($dataParams);
	                // print_r($arrDataApi);
	                $log = $this->logRequestSubscript($dataParams,$arrDataApi);
	                if(isset($arrDataApi) && $arrDataApi){

						$dataJson['message'] = "Gửi lời mời thành công";
						$dataJson['status'] = true;
	                    	
	                }else{
	                    $dataJson['message'] = "Lỗi kết nối";
	                }
					
				}else{
					$dataJson['message'] = "Vui lòng thực hiện lại";
				}
			}else{
				// khong co key sendPhoneSingle
				$dataJson['message'] = "Không thể gửi lời mời";
			}
			// huy session 
			// $arrsendPhoneSingle = [];
   //      	$session->set('sendPhoneSingle',$arrsendPhoneSingle);
		}else{
			$dataJson['message'] = "Không thể gửi lời mời";
			// echo 'khong co ss';
		}
		return json_encode($dataJson);
    }

   
    public function actionIndex()
    {
    	
        // $this->layout = "@app/views/layouts/adminLte";
        
		$module         = Yii::$app->controller->module->id;
		$baseUrl        = Yii::$app->params['baseUrl'];
		$modelSubscript = new Subscript;
		$model          = new SubscriptRequest;
		$page           = 1;
		if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page = $_GET['page'];
        }
        $session = Yii::$app->session;
        
        $request = Yii::$app->request;
        $dataGets = $request->get();
        // $dataPosts = $request->post();
        
        // $queryString = "&reqId={$model->REQUEST_ID}&dealerId={$model->DEALER_ID}&serviceId={$model->SERVICE_ID}&msisdn={$model->MSISDN}&dealerCode={$model->DEALER_CODE}&userAcc={$model->USER_ACCOUNT}&cpCodeAcc={$model->CP_CODE_ACCOUNT}&errorCode={$model->ERROR_CODE}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
        if(isset($dataGets['reqId']) && !empty(trim($dataGets['reqId']))){
            $model->REQUEST_ID = trim($dataGets['reqId']);
        }
        if(isset($dataGets['dealerId']) && !empty(trim($dataGets['dealerId']))){
            $model->DEALER_ID = trim($dataGets['dealerId']);
        }
        if(isset($dataGets['SERVICE_ID']) && !empty(trim($dataGets['serviceId']))){
            $model->PRODUCT_CODE = trim($dataGets['serviceId']);
        }
        if(isset($dataGets['msisdn']) && !empty(trim($dataGets['msisdn']))){
            $model->MSISDN = trim($dataGets['msisdn']);
        }
        if(isset($dataGets['dealerCode']) && !empty(trim($dataGets['dealerCode']))){
            $model->DEALER_CODE = trim($dataGets['dealerCode']);
        }
        if(isset($dataGets['cpCodeAcc']) && !empty(trim($dataGets['cpCodeAcc']))){
            $model->USER_ACCOUNT = trim($dataGets['cpCodeAcc']);
        }
        if(isset($dataGets['errorCode']) && !empty(trim($dataGets['errorCode']))){
            $model->ERROR_CODE = trim($dataGets['errorCode']);
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
        $dataProvidersModel = SubscriptRequest::find()
                            // ->asArray()
                            ;
        
        //================= dieu kien tim kiem o day

        if($model->load(Yii::$app->request->post())){
        	$page = 1;
        }
        if($model->STATUS == ""){
            $dataProvidersModel->where(['>=','STATUS',0]);
        }else{
            $dataProvidersModel->where(['=','STATUS',$model->STATUS]);
        }
        
        if(!empty(trim($model->REQUEST_ID))){
            $dataProvidersModel ->andWhere(['=','REQUEST_ID',trim($model->REQUEST_ID)]);
        }  
        if(!empty(trim($model->DEALER_ID))){
            $dataProvidersModel ->andWhere(['=','DEALER_ID',trim($model->DEALER_ID)]);
        }  
        if(!empty(trim($model->SERVICE_ID))){
            $dataProvidersModel ->andWhere(['=','SERVICE_ID',trim($model->SERVICE_ID)]);
        } 
        if(!empty(trim($model->MSISDN))){
            $dataProvidersModel ->andWhere(['=','MSISDN',trim($model->MSISDN)]);
        } 
        if(!empty(trim($model->DEALER_CODE))){
            $dataProvidersModel ->andWhere(['=','DEALER_CODE',trim($model->DEALER_CODE)]);
        } 
        if(!empty(trim($model->USER_ACCOUNT))){
            $dataProvidersModel ->andWhere(['=','USER_ACCOUNT',trim($model->USER_ACCOUNT)]);
        } 
        if(!empty(trim($model->CP_CODE_ACCOUNT))){
            $dataProvidersModel ->andWhere(['=','CP_CODE_ACCOUNT',trim($model->CP_CODE_ACCOUNT)]);
        }   
        if(!empty(trim($model->ERROR_CODE))){
            $dataProvidersModel ->andWhere(['=','ERROR_CODE',trim($model->ERROR_CODE)]);
        }   
        if(!empty(trim($model->HAVE_COMMISSION))){
            $dataProvidersModel ->andWhere(['=','HAVE_COMMISSION',trim($model->HAVE_COMMISSION)]);
        }if(!empty(trim($model->TRANSACTION_ID))){
            $dataProvidersModel ->andWhere(['=','TRANSACTION_ID',trim($model->TRANSACTION_ID)]);
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
        
        if($page > $totalPage){
            $page = $totalPage;
        }
        $offset    = ($page-1)*($limit);
        //================= dieu kien tim kiem o day
        $dataProvidersModel->limit($limit)
                            ->offset($offset);
        // echo $model->ORDER;
        // echo $model->BY;
        if($model->BY == "SORT_DESC"){
            $dataProvidersModel->orderBy(["{$model->ORDER}"=>SORT_DESC]);
        }else{
            $dataProvidersModel->orderBy(["{$model->ORDER}"=>SORT_ASC]);
        }

        // echo '<pre>';print_r($dataProvidersModel);die;
        $dataProviders =  $dataProvidersModel->all();

        $queryString = "&reqId={$model->REQUEST_ID}&dealerId={$model->DEALER_ID}&serviceId={$model->SERVICE_ID}&msisdn={$model->MSISDN}&dealerCode={$model->DEALER_CODE}&userAcc={$model->USER_ACCOUNT}&cpCodeAcc={$model->CP_CODE_ACCOUNT}&errorCode={$model->ERROR_CODE}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
        $myPagination = [
				'totalPage'   =>$totalPage,
				'page'        =>$page,
				'limit'       =>$limit,
				'action'      =>$baseUrl.$module,
				'queryString' =>$queryString,
            ];
        
		$dealerIds         = Quick::findDealers();
		$serviceCodes      = Quick::findByServices();
		$serviceProductIds = Quick::findProductOfServices();

	    $arrsendPhoneSingle = [
			'dealerId'  =>current(array_keys($dealerIds)),
			'serviceId' =>current(array_keys($serviceProductIds)),
			'msisdn'    =>"",
	    ];
	    $serviceCodes['all'] = "Tất cả";
	 //    echo '<pre>';
	 //    print_r($dataProviders);
		// die;
        $session->set('sendPhoneSingle',$arrsendPhoneSingle);
        return $this->render('index', [
			'model'             => $model,
			'modelSubscript'    => $modelSubscript,
			'dataProviders'     => $dataProviders,
			'myPagination'      => $myPagination,
			'dealerIds'         => $dealerIds,
			'serviceCodes'      => $serviceCodes,
			'serviceProductIds' => $serviceProductIds,
        ]);
    }
    public function actionCreate(){
		$modelSubscript    = new Subscript();
		$dealerIds         = Quick::findDealers();
		$serviceCodes      = Quick::findByServices();
		$serviceProductIds = Quick::findProductOfServices();
          $arrDataApi  = [];
          $dataJsonApi = "";
		 if($modelSubscript->load(Yii::$app->request->post())){
        	// echo '<pre>';print_r($modelSubscript);	
			$requestId                  =  Yii::$app->helper->RandomNumber(10);
			$modelSubscript->REQUEST_ID = $requestId;
			$dealerId                   =  $modelSubscript->DEALER_ID;
			$serviceId                  =  $modelSubscript->SERVICE_ID;
			$msisdn                     =  PhoneNumber::PhoneTo84($modelSubscript->MSISDN);
                    
            $dataParams = [
				'requestId' => $requestId,
				'dealerId'  => $dealerId,
				'serviceId' => $serviceId,
				'msisdn'    => $msisdn,
				'userName'  => USERNAME,
				'password'  => PASSWORD,
				'masterId'  => MASTER_ID,
				'checkSum'  => base64_encode(sha1($requestId.$dealerId.$serviceId.$msisdn.USERNAME.PASSWORD.MASTER_ID.SHAREKEY,true)),
	        ];	  

            if($modelSubscript->validate()){
                
                $dataJsonApi = Yii::$app->helper->serviceAPI(URL_SUB_SCRIPT,$dataParams,$method = "GET");
                $arrDataApi = json_decode($dataJsonApi);

                $errorCode = $arrDataApi->errorCode;
                $errorMessage = MyEnum::errorCodeStatus($errorCode);
                // echo '<br>';
                if($errorCode != 1){
            		Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>' Thông báo: '.$errorMessage]);
                }else{
            		Yii::$app->session->setFlash('showAlert', ['classAlert'=>'success','iconAlert'=>'fa-info','messAlert'=>' Thông báo: Gửi lời mời thành công']);
                }

	            // print_r($arrDataApi);
	            // die;
	            $dataParams['status'] = 1;
            }else{
            	Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>' Thông báo: Xem lại thông tin điền vào']);
            	$dataParams['status'] = 0;
	            // print_r($modelSubscript->errors);
            }
	        $log = $this->logRequestSubscript($dataParams,$arrDataApi);

         }
         
        return $this->render('create', [
			'modelSubscript'    => $modelSubscript,
			'dealerIds'         => $dealerIds,
			'serviceCodes'      => $serviceCodes,
			'serviceProductIds' => $serviceProductIds,
			'arrDataApi'        => $arrDataApi,
        ]);
     }

      function logRequestSubscript($dataParams,$dataJson){

    	$userLogin = Yii::$app->user->identity;

		$useAccount             = $userLogin->USERNAME;
		$cpCodeAccount          =  $userLogin->CP_CODE;
		
		
		$dealerCode             = "0";
		$model                  = new SubscriptRequest();
		
		$model->USERNAME        = $dataParams['userName'];


		$model->PASSWORD        = $dataParams['password'];
		$model->MASTER_ID       = $dataParams['masterId'];
		$model->CHECKSUM        = $dataParams['checkSum'];
		$model->REQUEST_ID      = $dataParams['requestId'];
		
		$model->DEALER_ID       = $dataParams['dealerId'];
		$dealer = $this->findDealerByDealerId($model->DEALER_ID);
		if(isset($dealer) && $dealer){
			$dealerCode         = $dealer->CODE;
		}

		$model->SERVICE_ID      = $dataParams['serviceId'];
		$model->MSISDN          = $dataParams['msisdn'];
		$model->DEALER_CODE     = $dealerCode;
		$model->USER_ACCOUNT    = $useAccount;
		$model->CP_CODE_ACCOUNT = $cpCodeAccount;
		
		if(isset($dataJson->errorCode)){
			$model->ERROR_CODE      = $dataJson->errorCode;
		}
		if(isset($dataJson->errorDesc)){
			$model->ERROR_DESC      = $dataJson->errorDesc;
		}

		if(isset($dataJson->haveCommission)){
			$model->HAVE_COMMISSION     = $dataJson->haveCommission;
		}
		if(isset($dataJson->transactionId)){
			$model->TRANSACTION_ID      = $dataJson->transactionId;
		}
		
		$model->TIME_START      = date("Y-m-d H:i:s");
		$model->TIME_END        = date("Y-m-d H:i:s");
		$model->STATUS          =  $dataParams['status'];
		
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
    function findDealerByDealerId($dealerId){
         $res = Dealers::find()
              ->select(['ID','CODE','DEALER_ID'])
              ->where(['DEALER_ID'=>$dealerId])
              ->one()
              ;
              // print_r($res);
        return $res;

    }
    
}
