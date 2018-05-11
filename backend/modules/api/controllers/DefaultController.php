<?php

namespace backend\modules\api\controllers;

use yii;
use yii\web\Controller;
use backend\modules\dealers\models\Dealers;
use backend\modules\services\models\Services;
use backend\modules\subscript\models\Subscript;
use backend\modules\subscript\models\SubscriptRequest;
use backend\components\MyEnum;
use backend\components\PhoneNumber;
/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actions()
    {

		$this->layout = false;

    }
    public function actionIndex()
    {

        $dataJson = [
            'status'  =>false,
            'message' =>"Thất bại",
        ];
        $request     = Yii::$app->request;
        $dataGets    = $request->get();
        $arrDataApi  = [];
        $dataJsonApi = "";
        if(isset($dataGets['misidn']) &&isset($dataGets['dealerId']) &&isset($dataGets['serviceId']) && $dataGets['misidn'] && $dataGets['dealerId']&& $dataGets['serviceId']){
            $modelSubscript = new Subscript();

            $requestId                  =  Yii::$app->helper->RandomNumber(8);
            $modelSubscript->REQUEST_ID = $requestId;

            $dealerId                   =  $dataGets['dealerId'];
            $modelSubscript->DEALER_ID  =  $dealerId;

            $serviceId                  =  $dataGets['serviceId'];
            $modelSubscript->SERVICE_ID =  $serviceId;

            $msisdn                     =  $dataGets['misidn'];

            $msisdn                     = PhoneNumber::PhoneTo84($msisdn);
            $modelSubscript->MSISDN     =  $msisdn;

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
                // print_r($arrDataApi);
                // die;
                $errorCode = $arrDataApi->errorCode;
                // // echo '<br>';
                if($errorCode != 1){
                    $errorMessage = $arrDataApi->errorDesc;
                    $dataJson['message'] = $errorCode.' - '.$errorMessage;
                }else{
                    $dataJson['status']  = true;
                    $dataJson['message'] = "Gửi lời mời thành công";
                }
                $dataParams['status'] = 1;
            }else{
                $dataParams['status'] = 0;
                $dataJson['message']  = "Tham số truyền vào không hợp lệ";
            }
            $log = $this->logRequestSubscript($dataParams,$arrDataApi);
        }else{
            $dataJson['message'] = "Bạn truyền thiếu thông tin";
        }
        $dataJson['dataJsonApi'] = $dataJsonApi;
        // print_r($dataJson);
        // die;
         return $this->render('index', [
            'dataJson'         => $dataJson,
        ]);

    }
    function findAcc($dealerId){
       return Dealers::find()->select(['USER_ACCOUNT','CP_CODE_ACCOUNT'])->where(['STATUS'=>1,'DEALER_ID'=>$dealerId])->one();
    }
    function logRequestSubscript($dataParams,$dataJson){

        $userLogin     = $this->findAcc($dataParams['dealerId']);

        $useAccount    = $userLogin->USER_ACCOUNT;
        $cpCodeAccount =  $userLogin->CP_CODE_ACCOUNT;


        $dealerCode             = "?";
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

        $msisdn = $dataParams['msisdn'];


        $model->MSISDN          = $msisdn;

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
