<?php

namespace backend\modules\VnpSynchronizeSubcriberTransaction\controllers;
use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\cdrRequest\models\CdrRequest;
use backend\modules\subscript\models\SubscriptRequest;
use backend\modules\dealers\models\Dealers;

/**
 * Default controller for the `VnpSynchronizeSubcriberTransaction` module
 */
class DefaultController extends Controller
{
   


    public  $enableCsrfValidation = false;



    public function actions()
    {
        $this->layout =false;
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    

    public function actionIndex(){
        $request   = Yii::$app->request;
        $dataGets  = $request->get();
        // echo '<pre>';
        // print_r($dataGets);
        // die;
        $model =  new CdrRequest();
        $model->ERROR_CODE = "0";
        $model->ERROR_DESC = "Hệ thống Platform quản lý tổng đại lý/bán hàng xử lý/nhận sự kiện cước do VasDealer đồng bộ về không thành công";
        if(!isset($dataGets) || !$dataGets){
            return $model->ERROR_CODE.'|'.$model->ERROR_DESC;
        }
        $model->REQUEST_ID     = $dataGets['request_id'];
        $model->MASTER_ID      = $dataGets['master_id'];
        $model->AGENT_ID       = $dataGets['agent_id'];
        $model->TRANSACTION_ID = $dataGets['transaction_id'];

        $channel       = "";
        $requestDealer = "";
        $mo            = "";
        $product_code  = "";
        $dealerCode    = "";
        $dealerId      = 0;
        $msisdn      = "";

        if(isset($dataGets['channel']) && $dataGets['channel']){
            $channel = $dataGets['channel'];
        }
        if(isset($dataGets['product_code']) && $dataGets['product_code']){
            $product_code = $dataGets['product_code'];
        }
        if(isset($dataGets['msisdn']) && $dataGets['msisdn']){
            $msisdn = $dataGets['msisdn'];
        }
        if($channel == "API"){
          //http://192.168.29.13:8891/VnpSynchronizeSubcriberTransaction?request_id=474508796&master_id=1019&agent_id=100011655&transaction_id=104571630&timestamp=20180426150402&action=SUBSCRIPT_SUCCESS&orginal_price=0&price=0&promotion=0&charge_count=0&resultcode=1&msisdn=841257696242&product_code=MB&channel=API&mo=

          $requestDealer = $this->findByRequestId($model->REQUEST_ID,$model->TRANSACTION_ID);
          if(isset($requestDealer) && $requestDealer){
                $dealerCode = $requestDealer->DEALER_CODE;
          }
          // echo '<pre>';print_r($requestDealer);
          // die;
        }
        if($channel == "SMS"){
            //http://192.168.29.13:8891/VnpSynchronizeSubcriberTransaction?request_id=108719154&master_id=1019&agent_id=100010281&transaction_id=104531111&timestamp=20180425052118&action=RENEW&orginal_price=1000&price=1000&promotion=0&charge_count=2&resultcode=1&msisdn=84941529583&product_code=MB&channel=SMS&mo=DT1%20MB

            if(isset($dataGets['mo']) && $dataGets['mo']){
                $mo = $dataGets['mo'];
            }
            $arrDealerCode = explode(" ",$mo);
            if(isset($arrDealerCode[0]) && $arrDealerCode[0]){
              $dealerCode = $arrDealerCode[0];
            }

            $requestDealer = $this->findDealerByCode($dealerCode);

        }


        if(isset($requestDealer) && $requestDealer){
            $dealerId = $requestDealer->DEALER_ID;
        }

        $model->CHANNEL       = $channel;
        $model->PRODUCT_CODE  = $product_code;
        $model->DEALER_CODE   = $dealerCode;
        $model->PHONE         = $msisdn;
        
        $model->DEALER_ID     = $dealerId;
        $model->TIMESTAMP     = $dataGets['timestamp'];
        $model->ACTION        = $dataGets['action'];
        $model->ORGINAL_PRICE = $dataGets['orginal_price'];
        $model->PRICE         = $dataGets['price'];
        $model->PROMOTION     = $dataGets['promotion'];
        $model->CHARGE_COUNT  = $dataGets['charge_count'];
        $model->RESULT_CODE   = $dataGets['resultcode'];
        
        $model->ERROR_CODE    = "1";
        $model->ERROR_DESC    = "Hệ thống nhận sự kiện thành công";
        
        $model->STATUS        = 1;
        $model->CREATE_AT     = date('Y-m-d H:i:s');
        
        if(!$model->save()){
            // print_r($model->errors);
        }
        return $model->ERROR_CODE.'|'.$model->ERROR_DESC;

    }
    
    public function actionIndex_bk(){
        $request   = Yii::$app->request;
        $dataGets  = $request->get();
        $model =  new CdrRequest();
        $model->ERROR_CODE = "0";
        $model->ERROR_DESC = "Hệ thống Platform quản lý tổng đại lý/bán hàng xử lý/nhận sự kiện cước do VasDealer đồng bộ về không thành công";
        if(!isset($dataGets) || !$dataGets){
            return $model->ERROR_CODE.'|'.$model->ERROR_DESC;
        }
        $model->REQUEST_ID     = $dataGets['request_id'];
        $model->MASTER_ID      = $dataGets['master_id'];
        $model->AGENT_ID       = $dataGets['agent_id'];
        $model->TRANSACTION_ID = $dataGets['transaction_id'];
        $channel = $dataGets['channel'];
        $requestDealer = "";
        if($channel == "API"){
          //http://192.168.29.13:8891/VnpSynchronizeSubcriberTransaction?request_id=474508796&master_id=1019&agent_id=100011655&transaction_id=104571630&timestamp=20180426150402&action=SUBSCRIPT_SUCCESS&orginal_price=0&price=0&promotion=0&charge_count=0&resultcode=1&msisdn=841257696242&product_code=MB&channel=API&mo=

          $requestDealer = $this->findByRequestId($model->REQUEST_ID,$model->TRANSACTION_ID);
        }
        if($channel == "SMS"){
            //http://192.168.29.13:8891/VnpSynchronizeSubcriberTransaction?request_id=108719154&master_id=1019&agent_id=100010281&transaction_id=104531111&timestamp=20180425052118&action=RENEW&orginal_price=1000&price=1000&promotion=0&charge_count=2&resultcode=1&msisdn=84941529583&product_code=MB&channel=SMS&mo=DT1%20MB
            $mo = $dataGets['mo'];
            $arrDealerCode = explode(" ",$mo);
            if(isset($arrDealerCode[0]) && $arrDealerCode[0]){
              $dealerCode = $arrDealerCode[0];
            }
            $requestDealer = $this->findDealerByCode($dealerCode);
        }
        $dealerId = 0;
        if(isset($requestDealer) && $requestDealer){
            $dealerId = $requestDealer->DEALER_ID;
        }
       
        $model->DEALER_ID      = $dealerId;
        $model->TIMESTAMP      = $dataGets['timestamp'];
        $model->ACTION         = $dataGets['action'];
        $model->ORGINAL_PRICE  = $dataGets['orginal_price'];
        $model->PRICE          = $dataGets['price'];
        $model->PROMOTION      = $dataGets['promotion'];
        $model->CHARGE_COUNT   = $dataGets['charge_count'];
        $model->RESULT_CODE    = $dataGets['resultcode'];
        
        $model->ERROR_CODE     = "1";
        $model->ERROR_DESC     = "Hệ thống nhận sự kiện thành công";
        
        $model->STATUS         = 1;
        $model->CREATE_AT      = date('Y-m-d H:i:s');
        
        if(!$model->save()){
            // print_r($model->errors);
        }
        return $model->ERROR_CODE.'|'.$model->ERROR_DESC;

    }
    

    function findByRequestId($requestId,$tranId){
         $res = SubscriptRequest::find()
              ->select(['ID','REQUEST_ID','TRANSACTION_ID','DEALER_ID','DEALER_CODE'])
              ->where(['REQUEST_ID'=>$requestId,'TRANSACTION_ID'=>$tranId])
              ->one()
              ;
        return $res;

    }
    function findDealerByCode($dealerCode){
         $res = Dealers::find()
              ->select(['ID','CODE','DEALER_ID'])
              ->where(['CODE'=>$dealerCode])
              ->one()
              ;
              // print_r($res);
        return $res;

    }
}
