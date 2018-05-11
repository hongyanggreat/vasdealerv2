<?php

namespace backend\modules\userPermissionAdvanced\controllers;
use Yii;
use backend\modules\userPermissionAdvanced\models\UserPermission;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\modules\users\models\Accounts;
use backend\modules\users\models\AccountsSearch;
use backend\modules\moduleManager\models\Modules;
/**
 * Default controller for the `userPermissionAdvanced` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        $actions = Yii::$app->acl->getRole();
        $actions = [];

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
           $this->layout = "@app/views/layouts/layoutTable";
            //$this->layout = "@app/views/layouts/adminLayoutForm";
        //$this->layout = "@app/views/layouts/main";
    }
    /**
     * Lists all UserPermission models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new AccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserPermission model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       //echo $id;
        $dataUserPermission = UserPermission::find()->select(['ID'])->where(['ACC_ID'=>$id])->one();
        if(!$dataUserPermission){
            return $this->redirect(['index']);
        }

        $dataUser    = Accounts::find()->select(['ACC_ID','USERNAME'])->where(['ACC_ID'=>$id])->one();
        $dataProviders = Modules::find()
                                ->select([
                                        'modules.MODULE_ID',
                                        'modules.NAME',
                                        'modules.STATUS',
                                        'ALL_RIGHT',
                                        'LIST_RIGHT',
                                        'VIEW_RIGHT',
                                        'ADD_RIGHT',
                                        'EDIT_RIGHT',
                                        'DEL_RIGHT',
                                        'UP_RIGHT',
                                        'DOWN_RIGHT',
                                        'u.STATUS  statusUserPermission',
                                    ])
                                 ->leftJoin('user_permission u', 'u.MODULE_ID=modules.MODULE_ID  AND u.ACC_ID='.$id)
                                 ->asArray()
                                 ->orderBy(['modules.MODULE_ID' => SORT_DESC])
                                 ->all();
        
        return $this->render('view', [
            'dataUser'      =>$dataUser,
            'dataProviders' =>$dataProviders,
        ]);
    }

    /**
     * Creates a new UserPermission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $dataUserPermission = UserPermission::find()->select(['ID'])->where(['ACC_ID'=>$id])->one();
        if($dataUserPermission){
            return $this->redirect(['index']);
        }

        $dataUser = Accounts::find()->select(['ACC_ID','USERNAME'])->where(['ACC_ID'=>$id])->one();
        if(!$dataUser){
            return $this->redirect(['index']);
        }
        //echo $dataUser->USERNAME.'<br>';
         $dataProviders = Modules::find()
                                ->select([
                                        'modules.MODULE_ID',
                                        'modules.NAME',
                                        'modules.STATUS',
                                        'ALL_RIGHT',
                                        'LIST_RIGHT',
                                        'VIEW_RIGHT',
                                        'ADD_RIGHT',
                                        'EDIT_RIGHT',
                                        'DEL_RIGHT',
                                        'UP_RIGHT',
                                        'DOWN_RIGHT',
                                        'u.STATUS  statusUserPermission',
                                    ])
                                 ->leftJoin('user_permission u', 'u.MODULE_ID=modules.MODULE_ID  AND u.ACC_ID='.$id)
                                 ->asArray()
                                 ->orderBy(['modules.MODULE_ID' => SORT_DESC])
                                 ->all();
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
                    return $this->redirect(['update', 'id' =>  $_POST['idUser']]);
                    

                }/*else{
                    //echo 'khong cap nhat vi khong co module nao';
                }*/
            }elseif(isset($_POST['updateone'])){
                //echo 'chi cap nhat module '.$_POST['updateone'];
                $idModule = $_POST['updateone'];
                $result = $this->setPermission($_POST,$idModule);
                if($result){
                    return $this->redirect(['update', 'id' =>  $_POST['idUser']]);
                }else{
                   return $this->redirect(['index']);
                }
            }

        }
        return $this->render('_form', [
            'dataUser'           =>$dataUser,
            'dataProviders'        =>$dataProviders,
        ]);
    }

    /**
     * Updates an existing UserPermission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        
        $dataUserPermission = UserPermission::find()->select(['ID'])->where(['ACC_ID'=>$id])->one();
        if(!$dataUserPermission){
            return $this->redirect(['index']);
        }
        $dataProviders = Modules::find()
                        ->select([
                                'modules.MODULE_ID',
                                'modules.NAME',
                                'modules.STATUS',
                                'ALL_RIGHT',
                                'LIST_RIGHT',
                                'VIEW_RIGHT',
                                'ADD_RIGHT',
                                'EDIT_RIGHT',
                                'DEL_RIGHT',
                                'UP_RIGHT',
                                'DOWN_RIGHT',
                                'u.STATUS  statusUserPermission',
                            ])
                         ->leftJoin('user_permission u', 'u.MODULE_ID=modules.MODULE_ID  AND u.ACC_ID='.$id)
                         ->asArray()
                         ->orderBy(['modules.MODULE_ID' => SORT_DESC])
                         ->all();
        $dataUser = Accounts::find()->select(['ACC_ID','USERNAME'])->where(['ACC_ID'=>$id])->one();
        
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
                    return $this->redirect(['update', 'id' =>  $_POST['idUser']]);
                    

                }/*else{
                    //echo 'khong cap nhat vi khong co module nao';
                }*/
            }elseif(isset($_POST['updateone'])){
                //echo 'chi cap nhat module '.$_POST['updateone'];
                $idModule = $_POST['updateone'];
                $result = $this->setPermission($_POST,$idModule);
                if($result){
                    return $this->redirect(['update', 'id' =>  $_POST['idUser']]);
                }else{
                   return $this->redirect(['index']);
                }
            }

        }
       /* echo '<pre>';
        print_r($dataProviders);
        die;*/
        return $this->render('_form', [
            'dataUser'     =>$dataUser,
            'dataProviders' =>$dataProviders,
        ]);
    }

    protected function setPermission($post,$idModule){
        //echo '<pre>';
        //print_r($post);
        $idUser      = $post['idUser'];
        $allRight    = 'allRight'.$idModule;
        $listRight   = 'listRight'.$idModule;
        $viewRight   = 'viewRight'.$idModule;
        $addRight    = 'addRight'.$idModule;
        $editRight   = 'editRight'.$idModule;
        $deleteRight = 'deleteRight'.$idModule;
        $upRight     = 'upRight'.$idModule;
        $downRight   = 'downRight'.$idModule;
        $status      = 'status'.$idModule;
        
        $arrPermisstion = [
            'idUser'   =>$idUser,
            'idModule' =>$idModule,
            'tyle'     =>'',
        ];
       
        if(isset($post[$allRight])){
             $arrPermisstion['permissionAll'] = 1;
        }else{
             $arrPermisstion['permissionAll'] = 0;
        }
        if(isset($post[$listRight])){
             $arrPermisstion['permissionList'] = 1;
        }else{
             $arrPermisstion['permissionList'] = 0;
        }
        if(isset($post[$viewRight])){
             $arrPermisstion['permissionView'] = 1;
        }else{
             $arrPermisstion['permissionView'] = 0;
        }
        if(isset($post[$addRight])){
             $arrPermisstion['permissionAdd'] = 1;
        }else{
             $arrPermisstion['permissionAdd'] = 0;
        }
        if(isset($post[$editRight])){
             $arrPermisstion['permissionEdit'] = 1;
        }else{
             $arrPermisstion['permissionEdit'] = 0;
        }
        if(isset($post[$deleteRight])){
             $arrPermisstion['permissionDel'] = 1;
        }else{
             $arrPermisstion['permissionDel'] = 0;
        }
        if(isset($post[$upRight])){
             $arrPermisstion['permissionUp'] = 1;
        }else{
             $arrPermisstion['permissionUp'] = 0;
        }
        if(isset($post[$downRight])){
             $arrPermisstion['permissionDown'] = 1;
        }else{
             $arrPermisstion['permissionDown'] = 0;
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
        $data = UserPermission::find()->where(['ACC_ID'=>$arrPermisstion['idUser'],'MODULE_ID'=>$arrPermisstion['idModule']])->one();
        
        $idUser             = (int) Yii::$app->user->id;
        $time               = time();
        
        if($data){
            $model              =  $this->findModel($data->ID);
            $model->UPDATE_BY   = $idUser;
            $model->UPDATE_DATE = $time ;
        }else{
            $model = new UserPermission();
            $model->CREATE_BY   = $idUser;
            $model->CREATE_DATE = $time;
            
            $model->ACC_ID      = $arrPermisstion['idUser'];
            $model->MODULE_ID   = $arrPermisstion['idModule'];
        }
        $model->ALL_RIGHT  = $arrPermisstion['permissionAll'];
        $model->LIST_RIGHT = $arrPermisstion['permissionList'];
        $model->VIEW_RIGHT = $arrPermisstion['permissionView'];
        $model->ADD_RIGHT  = $arrPermisstion['permissionAdd'];
        $model->EDIT_RIGHT = $arrPermisstion['permissionEdit'];
        $model->DEL_RIGHT  = $arrPermisstion['permissionDel'];
        $model->UP_RIGHT   = $arrPermisstion['permissionUp'];
        $model->DOWN_RIGHT = $arrPermisstion['permissionDown'];

        $model->STATUS      = $arrPermisstion['status'];
        //print_r($model);
        
        if($model->save()){
            return  true;
        }else{
             return  false;
        }
       
    }
    protected function findModel($id)
    {
        if (($model = UserPermission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
