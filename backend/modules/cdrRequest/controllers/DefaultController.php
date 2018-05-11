<?php

namespace backend\modules\cdrRequest\controllers;


use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\modules\cdrRequest\models\CdrRequest;

/**
 * Default controller for the `cdrRequest` module
 */
class DefaultController extends Controller
{
	const LIMIT            = 10;
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

        // $this->layout = "@app/views/layouts/adminLte";
        
        $module  = Yii::$app->controller->module->id;
        $baseUrl = Yii::$app->params['baseUrl'];
        $model = new CdrRequest;
        $page  = 1;
        $collapse = false;
        
        $request = Yii::$app->request;
        $dataGets = $request->get();

        if(isset($dataGets['status']) && $dataGets['status']){
            $model->STATUS = (int)trim($dataGets['status']);
        }
        if(isset($dataGets['reqId']) && $dataGets['reqId']){
            $model->REQUEST_ID = (int)trim($dataGets['reqId']);
        }

        // echo $model->STATUS;
        // echo '<hr>';
        
        $model->ORDER = "ID";
        if(isset($dataGets['order']) && !empty(trim($dataGets['order']))){
            $model->ORDER = trim($dataGets['order']);
        }
        if(isset($dataGets['action']) && !empty(trim($dataGets['action']))){
            $model->ACTION = trim($dataGets['action']);
        }
        $model->BY = "SORT_DESC";
        if(isset($dataGets['by']) && !empty(trim($dataGets['by']))){
            $model->BY = trim($dataGets['by']);
        }
        $dataProvidersModel = CdrRequest::find()
                            // ->asArray()
                            ;
        
        //================= dieu kien tim kiem o day
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
       
        // echo $model->STATUS;
        // echo '<hr>';
        if(isset($model->STATUS) && $model->STATUS >=0){
            $dataProvidersModel->where(['=','STATUS',$model->STATUS]);
        }else{
            $dataProvidersModel->where(['>=','STATUS',0]);
        }
        if(isset($model->REQUEST_ID) && $model->REQUEST_ID){
            $dataProvidersModel->andWhere(['=','REQUEST_ID',trim($model->REQUEST_ID)]);
        }
        if(isset($model->ACTION) && $model->ACTION){
            $dataProvidersModel->andWhere(['=','ACTION',trim($model->ACTION)]);
        }
        if(isset($startDate) && $startDate){
            $dataProvidersModel->andWhere(['>=','CREATE_AT',$startDate." 00:00:00"]);
        }
        if(isset($endDate) && $endDate){
            $dataProvidersModel->andWhere(['<=','CREATE_AT',$endDate." 23:59:59"]);
        }
        $countData =  $dataProvidersModel->count();
        // echo $model->ORDER;
        
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
        $dataProvidersModel->asArray();
        // echo '<pre>';print_r($dataProvidersModel);
        // die;
        $dataProviders =  $dataProvidersModel->all();
        // echo '<pre>';print_r($dataProviders);die;

        // $queryString = '&name=duongnh&code=duong123&msisdn=3333&email=ddd&status=1';
        $queryString = "&startDate={$startDate}&endDate={$endDate}&action={$model->ACTION}&reqId={$model->REQUEST_ID}&status={$model->STATUS}&order={$model->ORDER}&by={$model->BY}";
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
            'collapse'         => $collapse,
        ]);
    }
    
}
