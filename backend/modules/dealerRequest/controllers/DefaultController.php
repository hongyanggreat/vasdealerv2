<?php

namespace backend\modules\dealerRequest\controllers;
use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\dealerRequest\models\DealerRequest;
/**
 * Default controller for the `dealerRequest` module
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
        // $this->layout = "@app/views/layouts/adminLte";
        
        $module  = Yii::$app->controller->module->id;
        $baseUrl = Yii::$app->params['baseUrl'];
        $model = new DealerRequest;
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
        $dataProvidersModel = DealerRequest::find()
                            // ->asArray()
                            ;
        
        //================= dieu kien tim kiem o day

        if($model->load(Yii::$app->request->post())){
         //    echo '<pre>';
	        // print_r($model);
	        // die;
        }
		
		$timeStart = date('Y-m')."-01 00:00:00";
		$timeEnd   = date('Y-m-d H:i:s');

        $dataProvidersModel->where(['>=','CREATE_AT',$timeStart]);
        $dataProvidersModel->andWhere(['<=','CREATE_AT',$timeEnd]);
        
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

	    // echo '<pre>';
     //    print_r($dataProvidersModel);
     //    die;            
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
        $queryString = "&name={$model->NAME}&code={$model->CODE}&msisdn={$model->MSISDN}&email={$model->EMAIL}&timeStart={$timeStart}&timeEnd={$timeEnd}&order={$model->ORDER}&by={$model->BY}";
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
}
