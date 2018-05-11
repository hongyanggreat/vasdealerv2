<?php 
namespace backend\components;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use backend\modules\dealers\models\Dealers;
use backend\modules\services\models\Services;
class Quick 
{
	//CHECK SUBJECT

    public static function findDealers(){
        $lvUserLogin =  Yii::$app->user->identity->LEVEL;
        $userLogin =  Yii::$app->user->identity->USERNAME;
       
        // ArrayHelper::multisort($data, [ 'age','name',], [SORT_ASC, SORT_ASC]);
        $dataProvidersModel = Dealers::find()
                                ->select(['ID','DEALER_ID','NAME'])
                                ->where(['=','STATUS',1])
                                // ->asArray()
                                ;
        if($lvUserLogin > 0){
            $dataProvidersModel->andWhere(['=','USER_ACCOUNT',$userLogin]);
        } 
        $datas = $dataProvidersModel->all();
        return $dataProviders = ArrayHelper::map($datas,'DEALER_ID','NAME');
       
    }
     public static function findProductOfServices($options = []){
        
        // ArrayHelper::multisort($data, [ 'age','name',], [SORT_ASC, SORT_ASC]);
        $model = Services::find()
                                ->select(['ID','ID_PACKAGE','PRODUCT_CODE'])
                                // ->where(['=','ID',10000])
                                // ->asArray()
                                ;
        if(isset($options['SERVICE_CODE']) && $options['SERVICE_CODE']){
            $model->where(['=','SERVICE_CODE',$options['SERVICE_CODE']]);
        }
        $data = $model->all();
        return $dataProviders = ArrayHelper::map($data,'ID_PACKAGE','PRODUCT_CODE');
       
    }
    public static function findByServices(){
        
        // ArrayHelper::multisort($data, [ 'age','name',], [SORT_ASC, SORT_ASC]);
        $model = Services::find()
                                ->select(['SERVICE_CODE'])
                                // ->where(['=','ID',10000])
                                // ->asArray()
                                ->groupBy(['SERVICE_CODE']);
        
        $data = $model->all();
       
        return $dataProviders = ArrayHelper::map($data,'SERVICE_CODE','SERVICE_CODE');
       
    }
    // public static function findByService(){
        
    //     // ArrayHelper::multisort($data, [ 'age','name',], [SORT_ASC, SORT_ASC]);
    //     $model = Services::find()
    //                             ->select(['ID','ID_PACKAGE','SERVICE_CODE'])
    //                             ->distinct(['SERVICE_CODE'])
    //                             ->where(['=','STATUS',1])
    //                             // ->asArray()
    //                             ->all();
       
    //     return $dataProviders = ArrayHelper::map($model,'ID_PACKAGE','SERVICE_CODE');
       
    // }
   
}