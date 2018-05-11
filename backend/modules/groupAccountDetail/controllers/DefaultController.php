<?php

namespace backend\modules\groupAccountDetail\controllers;

use Yii;
use backend\modules\groupAccountDetail\models\GroupAccDetail;
use backend\modules\groupAccountDetail\models\GroupAccDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\ArrayHelper;
use backend\modules\users\models\Accounts;
use backend\modules\groupAccount\models\GroupAccount;
use backend\modules\groupPermissionAdvanced\models\GroupPermission;

/**
 * DefaultController implements the CRUD actions for GroupAccDetail model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }
     public function actions()
    {

        $this->layout = "@app/views/layouts/layoutTable";
        
    }
    /**
     * Lists all GroupAccDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupAccDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupAccDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GroupAccDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $dataUser = ArrayHelper::map(Accounts::find()->select(['ACC_ID','USERNAME'])->asArray()->where('STATUS=:status',['status'=>1])->all(),'ACC_ID','USERNAME'); 
        $dataGroupAccDetails = GroupAccDetail::find()->select(['GROUP_ID'])->asArray()->all();
        $arrGroupID = [];
        if(isset($dataGroupAccDetails) && count($dataGroupAccDetails)>0){
            foreach ($dataGroupAccDetails as $value) {
               $arrGroupID[] = $value['GROUP_ID'];
            }
        }
        $dataGroupAccount = ArrayHelper::map(GroupAccount::find()->select(['GROUP_ID','NAME'])->asArray()->where(['not in','GROUP_ID',$arrGroupID])->andWhere(['STATUS'=>1])->all(),'GROUP_ID','NAME'); 
       
        $model = new GroupAccDetail();

        if ($model->load(Yii::$app->request->post())) {
           
            $strAcountId   = '';
            $accountIdArr  = $model->ACC_ID;
            if(isset($accountIdArr) && $accountIdArr){
                $strAcountId   = implode('-', $accountIdArr);
            }
            $model->ACC_ID = $strAcountId;

            $idUser             = Yii::$app->user->id;
            $model->CREATE_BY   = $idUser;
            $time               = time();
            $model->CREATE_DATE = $time ;

            //print_r($accountIdArr);
           
            if($model->save()){
                //phan nay duoc chay sau khi save thanh cong
                # id cua nhom group acc
                $idGroupAccount = $model->GROUP_ID; 
                # id cua user thuoc nhom acc da duoc them
                $strAcc         = $model->ACC_ID;   
               //Xu ly kiem tra them du lieu vao groupPermission va them  quyen cho user
                $options = [
                      'strAccAll' =>$strAcc,  
                      'strAcc'    =>$strAcc,  
                ];
                $this->processGroupPermission($idGroupAccount,$options);
                return $this->redirect(['view', 'id' => $model->ID]);

            }else{

                return $this->render('create', [
                    'model'            => $model,
                    'dataUser'         => $dataUser,
                    'dataGroupAccount' => $dataGroupAccount,
                ]);
            }
        } else {
            return $this->render('create', [
                'model'            => $model,
                'dataUser'         => $dataUser,
                'dataGroupAccount' => $dataGroupAccount,
            ]);
        }
    }
    protected function processGroupPermission($idGroupAccount,$options){

          //Lay nhung module được phan quyen cho nhom nay
        $dataGrpAccount = $this->getGroupAccount($idGroupAccount);
        //print_r($dataGrpAccount);
        $strModule = $dataGrpAccount->MODULE_ID;

        $arrModules = explode('-', $strModule);
        foreach ($arrModules as $key => $idModule) {
            # code...
            $arrGrpPermission = $this->getGroupPermission($idGroupAccount,$idModule);
            if($arrGrpPermission){
                $arrAcc = explode('-', $options['strAccAll']);
                $newStrAccInGrpPermisstion = '';
                if($arrAcc){
                    foreach ($arrAcc as $key => $value) {
                        $newStrAccInGrpPermisstion .= 'q'.$value.'q ';
                    }
                }
                $modelGrpPermission = $this->findGroupPermission($arrGrpPermission['ID']);
                $modelGrpPermission->ACC_ID = $newStrAccInGrpPermisstion;
                $result = $modelGrpPermission->save();
               
                if(isset($result) && $result){
                   // //map quyen cho tai khoan voi groupPermission
                   $arrPermisstion = $this->getArrPermisstion($arrGrpPermission);
                   //echo '<pre>';print_r($arrPermisstion);
                   //map quyen cho tai khoan voi groupPermission
                   $resultUserPermission = Yii::$app->airTimePermission->saveUserPermission($arrPermisstion,$options['strAcc']);

                }else{

                }
            
            }else{
                return true;
            }
        }
    }
 
    protected function getArrPermisstion($arrGrpPermission){
            $arrPermisstion                     = [];
            $arrPermisstion['idGroupAccount']    = $arrGrpPermission['GROUP_ID'];
            $arrPermisstion['idModule']         = $arrGrpPermission['MODULE_ID'];
            $arrPermisstion['allPermission']    = $arrGrpPermission['ALL_RIGHT'];
            $arrPermisstion['listPermission']   = $arrGrpPermission['LIST_RIGHT'];
            $arrPermisstion['viewPermission']   = $arrGrpPermission['VIEW_RIGHT'];
            $arrPermisstion['addPermission']    = $arrGrpPermission['ADD_RIGHT'];
            $arrPermisstion['editPermission']   = $arrGrpPermission['EDIT_RIGHT'];
            $arrPermisstion['deletePermission'] = $arrGrpPermission['DEL_RIGHT'];
            $arrPermisstion['upPermission']     = $arrGrpPermission['UP_RIGHT'];
            $arrPermisstion['downPermission']   = $arrGrpPermission['DOWN_RIGHT'];
            $arrPermisstion['status']           = $arrGrpPermission['STATUS'];
            return $arrPermisstion;
    }
    
    protected function findGroupPermission($id){
        if (($model = GroupPermission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function getGroupPermission($idGroupAccount,$idModule){
        return $data = GroupPermission::find()->select(['ID','GROUP_ID','MODULE_ID','ACC_ID','ALL_RIGHT','LIST_RIGHT','VIEW_RIGHT','ADD_RIGHT','EDIT_RIGHT','DEL_RIGHT','UP_RIGHT','DOWN_RIGHT','STATUS'])->asArray()->where(['GROUP_ID'=>$idGroupAccount,'MODULE_ID'=>$idModule])->one();
    }
    protected function getGroupAccount($id){
        return $data = GroupAccount::find()->select(['GROUP_ID','MODULE_ID'])->where(['GROUP_ID'=>$id])->one();
    }

    /**
     * Updates an existing GroupAccDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
     public function actionUpdate($id)
    {
         $dataUser = ArrayHelper::map(Accounts::find()->select(['ACC_ID','USERNAME'])->asArray()->where('STATUS=:status',['status'=>1])->all(),'ACC_ID','USERNAME'); 

        $dataGroupAccount = ArrayHelper::map(GroupAccount::find()->select(['GROUP_ID','NAME'])->asArray()->where('STATUS=:status',['status'=>1])->all(),'GROUP_ID','NAME'); 
        $model = $this->findModel($id);
        
        //get tai khoan đa dược them vao db 
        $oldIdAccStr = $model->ACC_ID;
        $oldIdAccArr = explode('-', $oldIdAccStr);


        if ($model->load(Yii::$app->request->post())) {
            
            $newIdAccArr = $model->ACC_ID;
            
            //$idAccExist = array_intersect ($oldIdAccArr,$newIdAccArr);
            $idAccDel = array_diff ($oldIdAccArr,$newIdAccArr);
            // Data ID Moi them vao nhom
            $idAccNew = array_diff ($newIdAccArr,$oldIdAccArr);
            //ID nhom tai khoản
            $idGroupAccount = $model->GROUP_ID;
            if($newIdAccArr){
                $strAccNew = '';
                foreach ($newIdAccArr as $key => $idAcc) {
                    # code...
                    if($key == 0){
                        $strAccNew .= $idAcc;
                    }else{
                        $strAccNew .= '-'.$idAcc;
                    }
                }
            }
            $strAccNew;
            if($idAccNew || $idAccDel){
                //Du lieu ID user moi va cu cua nhom
                //$strAcc = array_merge($oldIdAccArr,$idAccNew);

                if($idAccNew){
                    foreach ($idAccNew as $key => $value) {
                        $oldIdAccStr .= '-'.$value;
                    }
                }
                 $options = [
                      'strAccAll' =>$strAccNew,  
                      'strAcc'    =>$oldIdAccStr,  
                      //'strAccDel' =>$idAccDel,  
                ];
                //echo '<pre>';print_r($options);
                $this->processGroupPermission($idGroupAccount,$options);
            }else{
                echo 'giu nguyen <br>';
            }

           /* $options = [
                  'strAccAll' =>$newIdAccArr,  
                  'strAccNew' =>$strAccNew,  
                  'strAccDel' =>'',  
            ];*/
            //$this->processGroupPermission($idGroupAccount,$options);


            $strAcountId   = '';
            $accountIdArr  = $model->ACC_ID;
            if(isset($accountIdArr) && $accountIdArr){
                $strAcountId   = implode('-', $accountIdArr);
            }
            $model->ACC_ID      = $strAcountId;
            $idUser             = (int) Yii::$app->user->id;
            $model->UPDATE_BY   = $idUser;
            $time               = time();
            $model->UPDATE_DATE = $time ;

            //die;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->ID]);
            }else{
                return $this->render('update', [
                   'model'            => $model,
                   'dataUser'         => $dataUser,
                   'dataGroupAccount' => $dataGroupAccount,
                ]);
            }
        } else {
            return $this->render('update', [
                 'model'            => $model,
                 'dataUser'         => $dataUser,
                 'dataGroupAccount' => $dataGroupAccount,
            ]);
        }
    }
    

    /**
     * Deletes an existing GroupAccDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        echo 'x';
        die;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupAccDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GroupAccDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupAccDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
