<?php 
namespace backend\components;
use Yii;
use yii\web\Controller;
use backend\modules\subject\models\Subjects;
use backend\modules\questions\models\Questions;
use backend\modules\answerQuestion\models\AnswersQuestion;

class SubQuesAns 
{
	//CHECK SUBJECT

	public function checkSubject($chude,$status = 1){
    	$baseUrl   = Yii::$app->params['baseUrl'];
        $model = Subjects::find()
                        ->where(['ALIAS'=>$chude]);
        if($status != 1 ){
            $model->andWhere(['!=','STATUS',1]);
        }else{
            $model->andWhere(['=','STATUS',1]);
        }
                        // ->asArray()
        $dataSubject = $model->one();
    	return $dataSubject;
    }
    public function checkSubjectId($id,$status = 1){
    	$baseUrl   = Yii::$app->params['baseUrl'];
        $model = Subjects::find()
                        ->where(['ID'=>$id]);
        if($status != 1 ){
            $model->andWhere(['!=','STATUS',1]);
        }else{
            $model->andWhere(['=','STATUS',1]);
        }
                        // ->asArray()
        $dataSubject = $model->one();
    	return $dataSubject;
    }
	// CHECK QUESTION
    public function checkQuestion($cauhoi,$status = 1){
        // echo $status;
        $baseUrl   = Yii::$app->params['baseUrl'];
        $model = Questions::find()
                        ->where(['ALIAS'=>$cauhoi]);
        if($status != 1 ){
            $model->andWhere(['!=','STATUS',1]);
        }else{
            $model->andWhere(['=','STATUS',1]);
        }
                        // ->asArray()
        $dataQuestion = $model->one();
        return $dataQuestion;
    }
    // CHECK QUESTION VS SUBJECT
	public function checkQuestionSubject($cauhoi,$idSubject,$status = 1){
    	// echo $status;
    	$baseUrl   = Yii::$app->params['baseUrl'];
    	$model = Questions::find()
    					->where(['ALIAS'=>$cauhoi,'PARENT_SUBJECT'=>$idSubject]);
    	if($status != 1 ){
    		$model->andWhere(['!=','STATUS',1]);
    	}else{
    		$model->andWhere(['=','STATUS',1]);
    	}
    					// ->asArray()
    	$dataQuestion = $model->one();
    	return $dataQuestion;
    }
    public function checkQuestionId($id,$status = 1){
    	$baseUrl   = Yii::$app->params['baseUrl'];
        $model = Questions::find()
                        ->where(['ID'=>$id]);
        if($status == 1 ){
            $model->andWhere(['=','STATUS',1]);
        }
                        // ->asArray()
        $dataQuestion = $model->one();
    	return $dataQuestion;
    }
}