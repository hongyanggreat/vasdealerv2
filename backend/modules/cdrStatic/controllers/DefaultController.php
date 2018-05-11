<?php

namespace backend\modules\cdrStatic\controllers;

use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\Quick;
use backend\modules\cdrRequest\models\CdrRequest;

/**
 * Default controller for the `cdrStatic` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    const LIMIT = 100;
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
        $module  = Yii::$app->controller->module->id;
        $baseUrl = Yii::$app->params['baseUrl'];

        $request = Yii::$app->request;
        $dataGets = $request->get();

        $model = new CdrRequest;
        $page = 1;
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $page = $_GET['page'];
        }  
        $dateNow = date('Y-m-d');
        
        $startDate = $dateNow;
        $endDate   = $dateNow;
        if(isset($_GET['startDate']) && $_GET['startDate']){
            $startDate = $_GET['startDate'];
        } 
        if(isset($_GET['endDate']) && $_GET['endDate']){
            $endDate = $_GET['endDate'];
        }  
        if(isset($dataGets['dealerId']) && $dataGets['dealerId']){
            $model->DEALER_ID = (int)trim($dataGets['dealerId']);
        } 
        if(isset($dataGets['action']) && $dataGets['action']){
            if($dataGets['action'] != "all"){
                $model->ACTION = (int)trim($dataGets['action']);
            }else{
                $model->ACTION = "";
            }
        }       
        if($model->load(Yii::$app->request->post())){
            // echo '<pre>';print_r($model);
            // die;
            $collapse = true;
            $startDate = Yii::$app->helper->convertDate($model->START_DATE,'Y-m-d');
            $endDate   = Yii::$app->helper->convertDate($model->END_DATE,'Y-m-d');
            $page = 1;
        }
        // echo $startDate;
        $model->START_DATE = Yii::$app->helper->convertDate($startDate,'m/d/Y');
        $model->END_DATE = Yii::$app->helper->convertDate($endDate,'m/d/Y');

        $page          = 1;
        $collapse      = true;
        $dealerIds     = Quick::findDealers();
        $modelDataProviders = CdrRequest::find()
                            ->select(['COUNT(REQUEST_ID) as TOTAL_REQUEST','SUM(PRICE) as PRICE','DEALER_ID','ACTION'])
                            ->groupBy(['DEALER_ID','ACTION'])
                            ->asArray()
                            ;
        if(isset($startDate) && $startDate){
            $modelDataProviders->where(['>=','CREATE_AT',$startDate." 00:00:00"]);
        }
        if(isset($endDate) && $endDate){
            $modelDataProviders->andWhere(['<=','CREATE_AT',$endDate." 23:59:59"]);
        }
        if(isset($model->DEALER_ID) && $model->DEALER_ID){
            $modelDataProviders->andWhere(['=','DEALER_ID',trim($model->DEALER_ID)]);
        }
        if(isset($model->ACTION) && $model->ACTION){
            $modelDataProviders->andWhere(['=','ACTION',trim($model->ACTION)]);
        }
        $countData =  $modelDataProviders->count();

        $limit = self::LIMIT;
        $totalPage = ceil($countData/$limit);
        
        if($page > $totalPage){
            $page = $totalPage;
        }
        $offset    = ($page-1)*($limit);
        //================= dieu kien tim kiem o day
        $modelDataProviders->limit($limit)
                            ->offset($offset);
        $dataProviders = $modelDataProviders->all();
    	// echo '<pre>';
    	// print_r($dataProviders);
    	// die;
        $queryString = "&startDate={$startDate}&endDate={$endDate}&action={$model->ACTION}&dealerId={$model->DEALER_ID}&action={$model->ACTION}&order={$model->ORDER}&by={$model->BY}";
        $myPagination = [
                'totalPage'   =>$totalPage,
                'page'        =>$page,
                'limit'       =>$limit,
                'action'      =>$baseUrl.$module,
                'queryString' =>$queryString,
            ];
        return $this->render('index',[
            'model'         =>$model,
            'collapse'      =>$collapse,
            'dataProviders' =>$dataProviders,
            'dealerIds'     =>$dealerIds,
        ]);
    }
}
