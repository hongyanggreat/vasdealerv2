<?php 
    use yii\helpers\Html;
    use yii\grid\GridView;
    use backend\modules\users\models\Accounts;
    use backend\modules\groupAccount\models\GroupAccount;
    use backend\widgets\ButtonWidget; 
     use backend\widgets\ButtonControlWidget; 
    $this->title = 'Quản lý nhóm tài khoản chi tiết';
    $this->params['breadcrumbs'][] = $this->title;
 ?>

<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách</h5>
           <?php echo ButtonWidget::widget(['data'=>['TITLE'=>'Danh sách nhóm tài khoản chi tiết']]) ?>

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
            .table.with-check tr th:first-child, .table.with-check tr td:first-child{
                width: 500px;
            }
        </style>
          <div class="widget-content nopadding" style="width:100%;overflow-x: scroll;">
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
                    'contentOptions' => ['width'=>'100','style' => 'text-align:center'],
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
                    'attribute'      =>'GROUP_ID',
                    'headerOptions'  => ['width'=>'200','style' => 'text-align:center;'],
                    'contentOptions' => ['width'=>'200','style' => 'text-align:left;'],
                    'value'          => function ($model){
                       $data = GroupAccount::find()->select('NAME')->where('GROUP_ID=:groupId',['groupId'=>$model->GROUP_ID])->one(); 
                          return $data['NAME'];
                    },
                  ],
                  [
                    'format'         =>'raw',
                    'attribute'      =>'ACC_ID',
                    'headerOptions'  => ['style' => 'text-align:center;'],
                    'contentOptions' => ['style' => 'text-align:left;'],
                    'value'          => function ($model){
                        $arrId = [];
                        if($model->ACC_ID !=""){
                            $arrId = explode('-', $model->ACC_ID);
                            $users = Accounts::find()->where(['in','ACC_ID',$arrId])->all();
                            if(isset($users) && count($users) > 0){
                              $datauser = '';
                              foreach ($users as  $user) {
                                  $datauser .= '<input type="button" name="" value="'.$user['USERNAME'].'" placeholder="" class="btn btn-small btn-success" style="margin-bottom:5px;"> ';
                              }
                              return $datauser;
                            }
                        }
                       return '<input type="button" name="" value="Chưa có tài khoản nào trong nhóm này" placeholder="" class="btn">'; 
                       //$data = Accounts::find()->select('USERNAME')->where('ACC_ID=:accId',['accId'=>$model->ACC_ID])->one(); 
                       //   return $data['USERNAME'];
                    },
                  ],
                  
                  [
                    'contentOptions' => ['width'=>'100','style' => 'text-align:center;'],
                    'contentOptions' => ['width'=>'100','style' => 'text-align:center;'],
                    'attribute'      =>'STATUS',
                    'value'          => function ($model){
                    return  $model->STATUS == 1 ? 'Kích hoạt' : ( $model->STATUS == 0 ? 'Chờ kích hoạt':'Không kích hoạt');
                  },],

                 $buttons,
              ],
          ]); ?>
          </div>
        </div>
      </div>
    </div>
</div>