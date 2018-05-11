<?php

namespace backend\modules\sortVinaphone\controllers;


use yii;
use yii\web\Controller;
use backend\modules\sortVinaphone\models\Posts;
use backend\modules\sortVinaphone\models\TermRelationships;
use backend\modules\sortVinaphone\models\TermTaxonomy;
/**
 * Default controller for the `sortVinaphone` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
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
    public function actionListPostByCate(){
        $data = [
            'status'  =>false,
            'info'    =>"",
            'message' =>"Không được phép",
        ];
        $module    = Yii::$app->controller->module->id;
         $dataPosts = Yii::$app->request->post();
         if(isset($dataPosts['idCate']) && $dataPosts['idCate']){
                $idCate = $dataPosts['idCate'];
                $postInCates = TermRelationships::find()
                        ->where(['term_taxonomy_id'=>$idCate])
                        // ->asarray()
                        ->all();
                $arrPost = [];
                foreach ($postInCates as $key => $postInCate) {
                    $arrPost[] = $postInCate->object_id;
                }                
                $dataSorteds = Posts::find()
                                ->select(['ID','post_title','menu_order','post_name','post_status'])
                                ->where(['in','ID',$arrPost])
                                ->andWhere(['post_status'=>"publish"])
                                ->asarray()
                             ->orderBy(['menu_order'=>SORT_ASC])
                             ->all();
                $info = "";
                if($dataSorteds){
                    foreach ($dataSorteds as $key => $dataSorted) {
                        $id         = $dataSorted['ID'];
                        $post_title = $dataSorted['post_title'];
                        $menu_order = $dataSorted['menu_order'];
                        if($menu_order == 0){
                            $colorBtn = "blue";
                        }else{
                            $colorBtn = "green";
                        }
                        $datas[] = $id; 

                        // $info .='<label for="drop-remove"><div class="external-event bg-'.$colorBtn.'"><input checked type="checkbox" class="minimal-red" name="'.$id.'" > '.$post_title.'</div></label>'; 
                        $info .='<label for="drop-remove" class="ui-sortable-handle">
                        
                                <div class="external-event bg-'.$colorBtn.'"><div class="icheckbox_minimal-red checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input checked="" type="checkbox" class="minimal-red" name="'.$id.'" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> '.$menu_order  .' - '.$post_title.'</div>
                              </label><br>'; 
                    }
                    $data['message'] = "Cập nhật thông tin mới";
                }else{
                    $info = "Không có bản ghi";
                    $data['message'] = "Không có bản ghi";
                }
                $data['status'] = true;
                $data['info'] = $info;
         }

        return json_encode($data);
    }
    public function actionIndex()
    {
        $idCate = 0;
        if(Yii::$app->request->post()){
            $dataPosts = Yii::$app->request->post();
            $idCate    = $dataPosts['cate'];
            $keyRemove = ['cate','_csrf','dataJson','phantach'];
            // $dataPosts = array_diff($dataPosts, ['cate','_csrf']);
            $dataPosts = array_diff_key($dataPosts, array_flip($keyRemove));
            $arrPostActive = [];
            // echo '<pre>';
            $position = 1;
            foreach ($dataPosts as $idPostAct => $dataPost) {
                 // $arrPostActive[] = $idPostAct;
                // echo $idPostAct .'-';
                $model = $this->findModel($idPostAct);
                // echo $model->post_title;
                $model->menu_order = $position;
                $position ++;
                        // print_r($model);
                        // break;
                // print_r($model);
                // ;
                if($model->save()){
                    Yii::$app->session->setFlash('showAlert', ['classAlert'=>'success','iconAlert'=>'fa-info','messAlert'=>' Thông báo: Cập nhật vị trí thành công']);
                }else{
                    Yii::$app->session->setFlash('showAlert', ['classAlert'=>'danger','iconAlert'=>'fa-info','messAlert'=>' Thông báo: Cập nhật thất bại']);
                    print_r($model->errors);
                    // break;
                }
                // echo '<br>';
                // break;
                // echo '<hr>';
             } 
             // die;
        } 

        $cates = TermTaxonomy::find()
                ->select(['term_id','description'])
                ->where(['taxonomy'=>'category'])
                // ->asarray()
                ->all();
        // echo '<pre>';
        // print_r($cates);
        // die;
        if($idCate ==  0){
            foreach ($cates as $key => $cate) {
                $idCate = $cate->term_id;
               if($key == 0){
                 break;
               }
                
            }
        }
        $postInCates = TermRelationships::find()
                        ->where(['term_taxonomy_id'=>$idCate])
                        // ->asarray()
                        ->all();
        $arrPost = [];
        foreach ($postInCates as $key => $postInCate) {
            $arrPost[] = $postInCate->object_id;
        }                
        $dataSorteds = Posts::find()
                        ->select(['ID','post_title','menu_order','post_name','post_status'])
                        ->where(['in','ID',$arrPost])
                        ->andWhere(['post_status'=>"publish"])
                        ->asarray()
                     ->orderBy(['menu_order'=>SORT_ASC])
                     ->all();

        return $this->render('index',[
                'idCate'      => $idCate,
                'cates'       => $cates,
                'dataSorteds' => $dataSorteds,
        ]);
    }
     protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
