<?php 
    use yii\helpers\Html;
    use yii\grid\GridView;
    use backend\modules\Users\models\Accounts;
    use backend\modules\userPermissionAdvanced\models\UserPermission;
    use backend\widgets\ButtonWidget; 
    use backend\widgets\ButtonControlWidget; 
    $this->title = 'Accounts';
    $this->params['breadcrumbs'][] = $this->title;

 ?>

<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Data table</h5>
           
          <?php echo ButtonWidget::widget(['data'=>[
            'TITLE'=>'Danh sách tài khoản',
            'ID'=>null,
            ]]) ?>

          </div>
          <style>
            .widget-content::-webkit-scrollbar { 
                display: none; 
            }
            ul.pagination{
                  margin-left: 50%;
                  margin-bottom: 70px;
            }
            ul.pagination li{
                  line-height: 20px;
                  float: left;
                  margin: 3px;
                  list-style: none;
                  border: 1px solid #ccc;
                  border-radius: 7px;
            }
            ul.pagination li span,
            ul.pagination li a{
                padding: 2px 10px;
            }
            ul.pagination li.active{
                  font-weight: bold;
                  background: green;
            }
            ul.pagination li.active a{
                color: #fff
            }
        </style>
        
          <div class="widget-content nopadding" style="overflow-x: scroll;">
             <?php 
                $arrActions = Yii::$app->acl->role();
                $visible = false;
                if(in_array('create', $arrActions) || in_array('update', $arrActions) || in_array('view', $arrActions)){
                    $visible = true;
                    function role(){
                        return $arrActions = Yii::$app->acl->role();
                    }
                }

              ?>
            <?= GridView::widget([
              'dataProvider' => $dataProvider,
              //'filterModel' => $searchModel,
              'tableOptions' => ['class'=>'table table-bordered table-striped with-check'],
              'columns' => [
                  //['class' => 'yii\grid\SerialColumn'],

                  [
                    'headerOptions' => ['width' => '300','style'=>'text-align:center'],
                    'contentOptions' => ['width' => '300','style'=>'text-align:center'],
                    'attribute'=>'USERNAME',
                    'value' => function ($model){
                        return  $model->USERNAME;
                    },
                  ],
                 [
                  'class'          => 'yii\grid\ActionColumn',
                  'header'         => 'Quyền',
                  'visible'         => $visible,
                  'contentOptions' => ['width'=>'100','style' => 'width:100px;text-align:center'],
                  'headerOptions'  => ['width'=>'100','style' => 'color:green;'],
                  'template'       => '{update}',
                  'buttons'        => [
                        'update' => function ($url, $model) {
                            $idUser = $model->ACC_ID;
                            $dataUserPermission = UserPermission::find()->select(['ID'])->where(['ACC_ID'=>$idUser])->one();
                            $arrActions = role();
                            $baseUrl = Yii::$app->params['baseUrl'];
                            $suffix = Yii::$app->params['suffix'];
                            $module = Yii::$app->controller->module->id;
                            if($dataUserPermission){
                                $title = "Xem quyền"; 
                                if(in_array('update', $arrActions)){
                                   $url = $baseUrl.$module.'/update'.$suffix.'?id='.$idUser;
                                }else{
                                  if(in_array('view', $arrActions)){
                                   $url = $baseUrl.$module.'/view'.$suffix.'?id='.$idUser;
                                   
                                  }else{
                                    $title = "";
                                     $url = $baseUrl.$module;
                                  }
                                }
                            }else{
                                if(in_array('create', $arrActions)){
                                   $title = "Thêm quyền"; 
                                   $url = $baseUrl.$module.'/create'.$suffix.'?id='.$idUser;
                                }else{
                                   $title = ""; 
                                   $url = $baseUrl.$module;
                                }
                               
                            }
                            return Html::a($title, $url, [
                                        'title' => Yii::t('app', $title),
                                        'class' => 'marginAction',
                                        'style' => 'margin-left:5px;',
                            ]);
                        },
                      ],
                 
                  ],
                  
                  [
                    'headerOptions' => ['width' => '50','style'=>'text-align:center'],
                    'contentOptions' => ['width' => '50','style'=>'text-align:center'],
                    'attribute'=>'STATUS',
                    'value' => function ($model){
                         return  $model->STATUS == 1 ? 'Kích hoạt' : ( $model->STATUS == 0 ? 'Chờ kích hoạt':'Không kích hoạt');
                  },],
                  // 'OPTION_DATA',
              ],
          ]); ?>
          </div>
        </div>
      </div>
    </div>
</div>