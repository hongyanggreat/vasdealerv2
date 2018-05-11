<?php 

namespace backend\components;
use Yii;
use yii\web\Controller;
use backend\modules\users\models\Accounts;
use backend\modules\moduleManager\models\Modules;
use backend\modules\userPermissionAdvanced\models\UserPermission;
class Acl 
{
    public function getRole(){
        $session   = Yii::$app->session;
        $module    = Yii::$app->controller->module->id;
        $aclModule = 'acl_'.$module;
        if(isset($session[$aclModule])){
            $actions = $session[$aclModule];
        }else{
            $actions = $this->role();
            $session[$aclModule] = $actions;
        }
        return $actions;
    }
    public function role(){
         $data = $this->getpermission();
         //print_r($data);
         $actions = [];
         if(isset($data) && $data){
            if($data['ALL_RIGHT']){
                $actions = ['index','view', 'create','update','delete','upload','download'];
            }else{
                if($data['LIST_RIGHT'] == 1){
                    $actions[] = 'index';
                }
                if($data['VIEW_RIGHT'] == 1){
                    $actions[] = 'view';
                }
                if($data['ADD_RIGHT'] == 1){
                    $actions[] = 'create';
                }
                if($data['DEL_RIGHT'] == 1){
                    $actions[] = 'delete';
                }  
                if($data['EDIT_RIGHT'] == 1){
                    $actions[] = 'update';
                }
                if($data['UP_RIGHT'] == 1){
                    $actions[] = 'upload';
                }
                if($data['DOWN_RIGHT'] == 1){
                    $actions[] = 'download';
                }  
            }
         }else{
            $actions = ['fault'];
         }
         //$actions = ['index','view', 'create','update','delete','upload','download'];
         return $actions;

    }
   
    public function roleList(){
         $data = $this->getpermission();
          if($data['LIST_RIGHT']){
            //echo 'cho phep xem danh sach tat ca cac thong tin';
            return true;
          }
          //echo 'chi cho phep xem danh sach cua chinh minh tao';
          return false;
    }
    function getpermission(){
        $userID = 0;
        if (!Yii::$app->user->isGuest) {
            $userID     =  Yii::$app->user->identity->id;
        }
        $module = '';
        $module = Yii::$app->controller->module->id;
        $resultModule = Modules::find()
                                ->select(['MODULE_ID'])
                                ->asArray()
                                ->where(['RESOURCE' => $module,'STATUS'=>1])
                                ->one();   
        $moduleId = 0 ;
        if(isset($resultModule) && $resultModule){
            $moduleId = $resultModule['MODULE_ID'];
        }else{
            //echo 'Module chưa được khai báo hoặc chưa được kích hoạt';
            //Huong xu lý;
            //chuyen huong ve trang chu;
        } 
       
        $resultUserPermission = UserPermission::find()
                                    ->select(['ALL_RIGHT','LIST_RIGHT','VIEW_RIGHT','ADD_RIGHT','EDIT_RIGHT','DEL_RIGHT','UP_RIGHT','DOWN_RIGHT'])
                                    ->asArray()
                                    ->where(['ACC_ID' => $userID,'MODULE_ID'=>$moduleId,'STATUS'=>1])
                                    ->one();       
        return $resultUserPermission;     
    }
    function getPermissionMenu(){

        $session  = Yii::$app->session;
        $acl_Menu = 'acl_Menu';
        if(isset($session[$acl_Menu])){
            $permissions = $session[$acl_Menu];
        }else{
            $permissions = $this->getAllPermissions();
            $session[$acl_Menu] = $permissions;
        }
        return $permissions;
    }
        
    function getAllPermissions(){
        $idUser = 0;
        if (!Yii::$app->user->isGuest) {
            $idUser     =  Yii::$app->user->identity->id;
        }
        $resultUserPermissions = UserPermission::find()
                                    ->select(['user_permission.ALL_RIGHT','user_permission.LIST_RIGHT','user_permission.VIEW_RIGHT','user_permission.ADD_RIGHT','user_permission.EDIT_RIGHT','user_permission.DEL_RIGHT','user_permission.UP_RIGHT','user_permission.DOWN_RIGHT','user_permission.MODULE_ID','m.RESOURCE'])
                                    ->asArray()
                                    ->leftJoin('modules m', 'm.MODULE_ID=user_permission.MODULE_ID')
                                    ->where(['user_permission.ACC_ID' => $idUser])
                                    ->all(); 
        if($resultUserPermissions){
            $permissions = [];
            foreach ($resultUserPermissions as $key => $value) {
                if($value['ALL_RIGHT'] || $value['LIST_RIGHT'] || $value['VIEW_RIGHT'] || $value['ADD_RIGHT'] || $value['EDIT_RIGHT'] ||$value['DEL_RIGHT'] || $value['UP_RIGHT'] || $value['DOWN_RIGHT']){
                    //$permissions[$value['RESOURCE']]['CHECKPERMISSION'] = 1;
                    $permissions[] = $value['RESOURCE'];
                }/*else{
                    $permissions[$value['RESOURCE']]['CHECKPERMISSION'] = 0;
                }*/
            }
            return $permissions;
        }
    }

}