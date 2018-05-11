<?php 
    use yii\helpers\Html;
    use yii\grid\GridView;
    use backend\modules\Users\models\Accounts;
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
                  'ID'=>null,
                  'TITLE'=>'Danh sách tài khoản',
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
               $template = ButtonControlWidget::widget(); 
                  $visible = false;
                  if(isset($template) && $template !=""){
                      $visible = true;
                  }
                  $buttons = [
                    'class'          => 'yii\grid\ActionColumn',
                    'header'         => 'Chức năng',
                    'visible'         => $visible,
                    'contentOptions' => ['width'=>'100','style' => 'width:100px;text-align:center'],
                    'headerOptions'  => ['width'=>'100','style' => 'color:green;'],
                    'template'       => $template,
                    'buttons'        => [
                              'view' => function ($url, $model) {
                                  return Html::a('<i class="icon icon-eye-open"></i>', $url, [
                                              'title' => Yii::t('app', 'Xem'),
                                              'class' => 'marginAction',
                                              'style' => 'margin-left:5px;',
                                  ]);
                              },

                              'update' => function ($url, $model) {
                                  return Html::a('<span class="icon icon-edit"></span>', $url, [
                                              'title' => Yii::t('app', 'Cập nhật'),
                                              'class' => 'marginAction',
                                              'style' => 'margin-left:5px;',
                                  ]);
                              },
                              'delete' => function ($url, $model) {
                                  //$module       = Yii::$app->controller->module->id;
                                  //$url = $module.'/delete/id/'.$model->ACC_ID;
                                  return Html::a('<span class="icon icon-trash"></span>', $url, [
                                              'class' => 'marginAction',
                                              'style' => 'margin-left:5px;',
                                              'title' => Yii::t('app', 'Xóa'),
                                              'data-confirm'=>'Bạn có chắc chắn xóa?',
                                              'data-method'=>'post',
                                              'onclick' => 'function ( $event ) { alert("Button 5 clicked"); }',
                                  ]);
                              },


                            ],
                   
                    ];
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
                    'headerOptions' => ['width' => '100','style'=>'text-align:center'],
                    'contentOptions' => ['width' => '100','style'=>'text-align:center'],
                    'attribute'=>'CP_CODE',
                    'value' => function ($model){
                        return  $model->CP_CODE;
                    },
                  ],
                  [
                      'headerOptions' => ['width' => '200','style'=>'text-align:center'],
                      'contentOptions' => ['width' => '200','style'=>'text-align:center'],
                      'attribute'=>'PARENT_ID',
                      'value' => function ($model){
                          $data = Accounts::find()->select('USERNAME')->where('ACC_ID=:accId',['accId'=>$model->PARENT_ID])->one(); 
                          if(isset($data) && count($data)>0){
                            return $data['USERNAME'];
                          }else{
                            return 'Administrator';
                          }
                      }
                  ],
                  [
                    'headerOptions' => ['width' => '50','style'=>'text-align:center'],
                    'contentOptions' => ['width' => '50','style'=>'text-align:center'],
                    'attribute'=>'STATUS',
                    'value' => function ($model){
                    return  $model->STATUS == 1 ? 'Kích hoạt' : ( $model->STATUS == 0 ? 'Chờ kích hoạt':'Không kích hoạt');
                  },],
                  // 'OPTION_DATA',

                 $buttons,
              ],
          ]); ?>
          </div>
        </div>
      </div>
    </div>
</div>