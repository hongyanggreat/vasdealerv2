<?php

namespace backend\modules\groupPermissionAdvanced\controllers;
use Yii;
use backend\modules\groupPermissionAdvanced\models\GroupPermission;
use backend\modules\groupPermissionAdvanced\models\GroupPermissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\modules\groupAccount\models\GroupAccount;
use backend\modules\groupAccount\models\GroupAccountSearch;
use backend\modules\moduleManager\models\Modules;
use backend\modules\groupAccountDetail\models\GroupAccDetail;
/**
 * Default controller for the `groupPermissionAdvanced` module
 */
class DefaultController extends Controller
{
    
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
                    //'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actions()
    {
            $this->layout = "@app/views/layouts/layoutTable";
    }
    /**
     * Lists all UserPermission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCreate($id)
    {
        //Lay du lieu phan quyen cua 1 nhom
        $dataGroupPermission = $this->findGroupPermission($id);
        if($dataGroupPermission){
            return $this->redirect(['index']);
        }
        //Lay du lieu cua 1 nhom tai khoan
        $dataGroupAccount = $this->findGroupAccount($id);
        $moduleID = $dataGroupAccount->MODULE_ID;
        $arrModuleID = explode('-', $moduleID); 
        //Lay du lieu truyen ra view
        $dataProviders = $this->getDataProviders($id,$arrModuleID);
       
        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST['updateAll'])){
                if(isset($_POST['idModule']) && count($_POST['idModule']) > 0){
                    $flash = [];
                    foreach ($_POST['idModule'] as $key => $idModule) {
                        $result =  $this->setPermission($_POST,$idModule);
                        if(!$result){
                            $flash[] = $key;
                        }
                    }
                    if(count($flash)>0){
                        return $this->redirect(['index']);
                    }
                    return $this->redirect(['update', 'id' =>  $_POST['idGroupAccount']]);
                    

                }/*else{
                    //echo 'khong cap nhat vi khong co module nao';
                }*/
            }elseif(isset($_POST['updateone'])){
                //echo 'chi cap nhat module '.$_POST['updateone'];
                $idModule = $_POST['updateone'];
                
                $result = $this->setPermission($_POST,$idModule);
                if($result){
                    return $this->redirect(['update', 'id' =>  $_POST['idGroupAccount']]);
                }else{
                   return $this->redirect(['index']);
                }
            }

        }

        return $this->render('create', [
            'dataGroupAccount' =>$dataGroupAccount,
            'dataProviders'    =>$dataProviders,
        ]);
    }

    public function actionView($id)
    {
         //Su dụng layout trang de check
        //Lay du lieu phan quyen cua 1 nhom
        $dataGroupPermission = $this->findGroupPermission($id);

        
        //Lay du lieu cua 1 nhom tai khoan
        $dataGroupAccount = $this->findGroupAccount($id);

        $moduleID = $dataGroupAccount->MODULE_ID;
        $arrModuleID = explode('-', $moduleID); 
        //Lay du lieu truyen ra view
        $dataProviders = $this->getDataProviders($id,$arrModuleID);
        //neu đủ quyền ta sử dụng layout 
        
        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST['updateAll'])){
                if(isset($_POST['idModule']) && count($_POST['idModule']) > 0){
                    $flash = [];
                    foreach ($_POST['idModule'] as $key => $idModule) {
                        $result =  $this->setPermission($_POST,$idModule);
                        if(!$result){
                            $flash[] = $key;
                        }
                    }
                    if(count($flash)>0){
                        return $this->redirect(['index']);
                    }
                    return $this->redirect(['update', 'id' =>  $_POST['idGroupAccount']]);
                    

                }
            }elseif(isset($_POST['updateone'])){
                //echo 'chi cap nhat module '.$_POST['updateone'];
                $idModule = $_POST['updateone'];
                $result = $this->setPermission($_POST,$idModule);
                if($result){
                    return $this->redirect(['update', 'id' =>  $_POST['idGroupAccount']]);
                }else{
                   return $this->redirect(['index']);
                }
            }

        }
        return $this->render('view', [
            'dataGroupAccount' =>$dataGroupAccount,
            'dataProviders'    =>$dataProviders,
        ]);
    }

    public function actionUpdate($id)
    {
        //Su dụng layout trang de check
        //Lay du lieu phan quyen cua 1 nhom
        $dataGroupPermission = $this->findGroupPermission($id);
        if(!$dataGroupPermission){
            return $this->redirect(['index']);
        }
        //Lay du lieu cua 1 nhom tai khoan
        $dataGroupAccount = $this->findGroupAccount($id);
        
        $moduleID = $dataGroupAccount->MODULE_ID;
        $arrModuleID = explode('-', $moduleID); 
        //Lay du lieu truyen ra view
        $dataProviders = $this->getDataProviders($id,$arrModuleID);
      
        //neu đủ quyền ta sử dụng layout 

        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST['updateAll'])){
                if(isset($_POST['idModule']) && count($_POST['idModule']) > 0){
                    $flash = [];
                    foreach ($_POST['idModule'] as $key => $idModule) {
                        $result =  $this->setPermission($_POST,$idModule);
                        if(!$result){
                            $flash[] = $key;
                        }
                    }

                    if($flash){
                        return $this->redirect(['index']);
                    }
                    return $this->redirect(['update', 'id' =>  $_POST['idGroupAccount']]);
                    

                }else{
                    return $this->redirect(['index']);
                    //echo 'khong cap nhat vi khong co module nao';
                }
            }elseif(isset($_POST['updateone'])){
                //echo 'chi cap nhat module '.$_POST['updateone'];
                $idModule = $_POST['updateone'];
                $result = $this->setPermission($_POST,$idModule);
                if($result){
                    return $this->redirect(['update', 'id' =>  $_POST['idGroupAccount']]);
                }else{
                   return $this->redirect(['index']);
                }
            }

        }
        return $this->render('update', [
            'dataGroupAccount' =>$dataGroupAccount,
            'dataProviders'    =>$dataProviders,
        ]);
    }

    protected function setPermission($post,$idModule){

        $idGroupAccount = $post['idGroupAccount'];
        $allRight      = 'allRight'.$idModule;
        $listRight     = 'listRight'.$idModule;
        $viewRight     = 'viewRight'.$idModule;
        $addRight      = 'addRight'.$idModule;
        $editRight     = 'editRight'.$idModule;
        $deleteRight   = 'deleteRight'.$idModule;
        $upRight       = 'upRight'.$idModule;
        $downRight     = 'downRight'.$idModule;
        $status        = 'status'.$idModule;
        
        $arrPermisstion = [
            'idGroupAccount' =>$idGroupAccount,
            'idModule'      =>$idModule,
        ];
       
        if(isset($post[$allRight])){
             $arrPermisstion['allPermission'] = 1;
        }else{
             $arrPermisstion['allPermission'] = 0;
        }
        if(isset($post[$listRight])){
             $arrPermisstion['listPermission'] = 1;
        }else{
             $arrPermisstion['listPermission'] = 0;
        }
        if(isset($post[$viewRight])){
             $arrPermisstion['viewPermission'] = 1;
        }else{
             $arrPermisstion['viewPermission'] = 0;
        }
        if(isset($post[$addRight])){
             $arrPermisstion['addPermission'] = 1;
        }else{
             $arrPermisstion['addPermission'] = 0;
        }
        if(isset($post[$editRight])){
             $arrPermisstion['editPermission'] = 1;
        }else{
             $arrPermisstion['editPermission'] = 0;
        }
        if(isset($post[$deleteRight])){
             $arrPermisstion['deletePermission'] = 1;
        }else{
             $arrPermisstion['deletePermission'] = 0;
        }
        if(isset($post[$upRight])){
             $arrPermisstion['upPermission'] = 1;
        }else{
             $arrPermisstion['upPermission'] = 0;
        }
        if(isset($post[$downRight])){
             $arrPermisstion['downPermission'] = 1;
        }else{
             $arrPermisstion['downPermission'] = 0;
        }

        if(isset($post[$status])){
             $arrPermisstion['status'] = 1;
        }else{
             $arrPermisstion['status'] = 0;
        }
       
        return $result = $this->processData($arrPermisstion);

    }


    protected function processData($arrPermisstion)
    {
        $data   = $this->getGroupPermission($arrPermisstion['idGroupAccount'],$arrPermisstion['idModule']);
        
        $idUser = (int) Yii::$app->user->id;
        $time   = time();
        
        if($data){
            $model              =  $this->findModel($data->ID);
            $model->UPDATE_BY   = $idUser;
            $model->UPDATE_DATE = $time ;
        }else{
            $model = new GroupPermission();
            $model->CREATE_BY   = $idUser;
            $model->CREATE_DATE = $time;
            
            $model->GROUP_ID    = $arrPermisstion['idGroupAccount'];
            $model->MODULE_ID   = $arrPermisstion['idModule'];
        }
        $model->ALL_RIGHT  = $arrPermisstion['allPermission'];
        $model->LIST_RIGHT = $arrPermisstion['listPermission'];
        $model->VIEW_RIGHT = $arrPermisstion['viewPermission'];
        $model->ADD_RIGHT  = $arrPermisstion['addPermission'];
        $model->EDIT_RIGHT = $arrPermisstion['editPermission'];
        $model->DEL_RIGHT  = $arrPermisstion['deletePermission'];
        $model->UP_RIGHT   = $arrPermisstion['upPermission'];
        $model->DOWN_RIGHT = $arrPermisstion['downPermission'];
        $model->STATUS     = $arrPermisstion['status'];

        $groupAccDetail = $this->findGroupAccDetail($arrPermisstion['idGroupAccount']);
        if($groupAccDetail && $groupAccDetail['ACC_ID']){
            $arrAcc = explode('-', $groupAccDetail['ACC_ID']);
            $strAcc = '';
            if($arrAcc){
                foreach ($arrAcc as $key => $value) {
                    # code...
                    $strAcc .= 'q'.$value.'q ';
                }
            }
            $model->ACC_ID = $strAcc;
        }else{
            $model->ACC_ID = NULL;
        }

        if($model->save()){
               
                if($model->ACC_ID){
                    //$resultUserPermission = $this->saveUserPermission($arrPermisstion,$groupAccDetail['ACC_ID']);
                    $resultUserPermission = Yii::$app->airTimePermission->saveUserPermission($arrPermisstion,$groupAccDetail['ACC_ID']);
                }
                if(isset($resultUserPermission) && $resultUserPermission){
                    return  true;
                }else{
                    //co loi gi day
                    return  false;
                }
               //die;
        }else{
            //echo 'loi';
             return  false;
        }
       
    }
    protected function getDataProviders($id,$arrModuleID){
        return $dataProviders = Modules::find()
                ->select([
                        'tbl_modules.MODULE_ID',
                        'tbl_modules.NAME',
                        'tbl_modules.STATUS',
                        'ALL_RIGHT',
                        'LIST_RIGHT',
                        'VIEW_RIGHT',
                        'ADD_RIGHT',
                        'EDIT_RIGHT',
                        'DEL_RIGHT',
                        'UP_RIGHT',
                        'DOWN_RIGHT',
                        'g.STATUS  statusGroupPermission',
                    ])
                 ->leftJoin('tbl_group_permission g', 'g.MODULE_ID=tbl_modules.MODULE_ID  AND g.GROUP_ID='.$id)
                 ->asArray()
                 ->andWhere(['in','tbl_modules.MODULE_ID',$arrModuleID])
                 ->orderBy(['tbl_modules.MODULE_ID' => SORT_DESC])
                 ->all();
    }
    protected function getGroupPermission($idGroupAccount,$idModule){
        return $data = GroupPermission::find()->select(['ID'])->where(['GROUP_ID'=>$idGroupAccount,'MODULE_ID'=>$idModule])->one();
    }
    protected function findGroupPermission($id){
        return $dataGroupPermission = GroupPermission::find()->select(['ID'])->where(['GROUP_ID'=>$id])->one();
    }
    protected function findGroupAccount($id){
        return $dataGroupAccount = GroupAccount::find()->select(['GROUP_ID','MODULE_ID','NAME'])->where(['GROUP_ID'=>$id])->one();
    }
    protected function findModel($id)
    {
        if (($model = GroupPermission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
  
    protected function findGroupAccDetail($id)
    {
        if (($model = GroupAccDetail::find()->where(['GROUP_ID'=>$id])->asArray()->one()) !== null) {
            return $model;
        } else {
            return [];
        }
    }
}
