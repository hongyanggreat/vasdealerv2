<?php 

namespace backend\components;
use Yii;
use yii\web\Controller;
use backend\modules\userPermission\models\UserPermission;
use backend\modules\groupPermissionAdvanced\models\GroupPermission;
class AirTimePermission 
{
    public function saveUserPermission($arrPermisstion,$strAcc){
        /*echo '<pre>';
        print_r($arrPermisstion);
        print_r($strAcc);
        die;*/
        $arrAcc = explode('-', $strAcc);

        $idGroupAccount = $arrPermisstion['idGroupAccount'];
        $idModule       = $arrPermisstion['idModule'];
        $idUser         = (int) Yii::$app->user->id;
        $time           = time();
        $flash = [];
        foreach ($arrAcc as $key => $idAccount) {
        

            //echo '<pre>';print_r($idAccount);
            $dataUserPermission = [];
            //kiem tra da ton tai quyen chua update
            $dataUserPermission = UserPermission::find()->where(['ACC_ID'=>$idAccount,'MODULE_ID'=>$arrPermisstion['idModule']])->asArray()->one();
            if($dataUserPermission){
                //Da ton tai quyen
                $model              =  $this->findModelUserPermission($dataUserPermission['ID']);
                $model->UPDATE_BY   = $idUser;
                $model->UPDATE_DATE = $time ;
                $accIDStrLike = 'q'.$idAccount.'q';
                //echo '<pre>';print_r($arrAcc);
                $dataGroupPermissions = GroupPermission::find()
                                        ->asArray()
                                        ->where(['MODULE_ID'=>$idModule])
                                        ->andWhere(['LIKE','ACC_ID',$accIDStrLike])
                                        ->all();
                //echo '<pre>';print_r($dataGroupPermissions);
                $model->ALL_RIGHT  = 0;
                $model->LIST_RIGHT = 0;
                $model->VIEW_RIGHT = 0;
                $model->ADD_RIGHT  = 0;
                $model->EDIT_RIGHT = 0;
                $model->DEL_RIGHT  = 0;
                $model->UP_RIGHT   = 0;
                $model->DOWN_RIGHT = 0;
                $model->STATUS     = 0;
                if($dataGroupPermissions){
                    //ton tai nhom quyen

                    foreach ($dataGroupPermissions as $key => $dataGroupPermission) {
                        //Kiem tra nhung nhom nao kich hoat thi cho phep map quyen
                        if($dataGroupPermission['STATUS']){
                           if($model->ALL_RIGHT or $dataGroupPermission['ALL_RIGHT']){
                                $model->ALL_RIGHT  = 1;
                           }
                           if($model->VIEW_RIGHT or $dataGroupPermission['LIST_RIGHT']){
                                $model->LIST_RIGHT  = 1;
                           }
                           if($model->VIEW_RIGHT or $dataGroupPermission['VIEW_RIGHT']){
                                $model->VIEW_RIGHT  = 1;
                           }
                           if($model->ADD_RIGHT or $dataGroupPermission['ADD_RIGHT']){
                                $model->ADD_RIGHT  = 1;
                           }
                           if($model->EDIT_RIGHT or $dataGroupPermission['EDIT_RIGHT']){
                                $model->EDIT_RIGHT  = 1;
                           }
                           if($model->DEL_RIGHT or $dataGroupPermission['DEL_RIGHT']){
                                $model->DEL_RIGHT  = 1;
                           }
                           if($model->UP_RIGHT or $dataGroupPermission['UP_RIGHT']){
                                $model->UP_RIGHT  = 1;
                           }
                           if($model->DOWN_RIGHT or $dataGroupPermission['DOWN_RIGHT']){
                                $model->DOWN_RIGHT  = 1;
                           }
                           if($model->STATUS or $dataGroupPermission['STATUS']){
                                $model->STATUS  = 1;
                           }
                        }
                    }
                    
                }
                
                //print_r($modelGroupPermission);
            }else{
                //chua ton tai quyen tao moi
                $model = new UserPermission;
                $model->ACC_ID     = $idAccount;
                $model->MODULE_ID  = $idModule;
                
                $model->CREATE_BY   = $idUser;
                $model->CREATE_DATE = $time;
                
                $model->ALL_RIGHT  = $arrPermisstion['allPermission'];
                $model->LIST_RIGHT = $arrPermisstion['listPermission'];
                $model->VIEW_RIGHT = $arrPermisstion['viewPermission'];
                $model->ADD_RIGHT  = $arrPermisstion['addPermission'];
                $model->EDIT_RIGHT = $arrPermisstion['editPermission'];
                $model->DEL_RIGHT  = $arrPermisstion['deletePermission'];
                $model->UP_RIGHT   = $arrPermisstion['upPermission'];
                $model->DOWN_RIGHT = $arrPermisstion['downPermission'];
                $model->STATUS     = $arrPermisstion['status'];
            }
            //print_r($arrPermisstion);
            $result = $model->save();
            if(!$result){
                $flash[] = $data['ID'];
            }
        }   
        if(count($flash)>0){
            return false;
        }else{
           return true;
        }      
         
    }
     protected function findModelUserPermission($id)
    {
        if (($model = UserPermission::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}