<?php 
    use yii\helpers\Html;
    use yii\grid\GridView;
    use backend\modules\Users\models\Accounts;
    use backend\modules\moduleManager\models\Modules;
    use backend\widgets\ButtonWidget; 
    use backend\widgets\ButtonControlWidget; 
    $this->title = 'Nhóm tài khoản';
    $this->params['breadcrumbs'][] = $this->title;
 ?>

<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Danh sách nhóm tài khoản</h5>
           <?php echo ButtonWidget::widget(['data'=>['ID'=>null,'TITLE'=>'Danh sách nhóm tài khoản chi tiết']]) ?>

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
            span.checkboxList{
              margin-right: 10px;
              text-align: center;
              color: green
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
                  ['class' => 'yii\grid\SerialColumn'],
                  [
                      'contentOptions' => ['width' => '200','style'=>'text-align:center'],
                      'headerOptions' => ['width' => '200'],
                      'attribute'=>'GROUP_ID',
                      'value' => function ($model){
                          return $model->GROUP_ID;
                      }
                  ],
                   [
                      'contentOptions' => ['width' => '300','style'=>'text-align:center'],
                      'headerOptions' => ['width' => '300'],
                      'attribute'=>'NAME',
                      'value' => function ($model){
                          return $model->NAME;
                      }
                  ],
                   [
                      'contentOptions' => ['width' => '300','style'=>'text-align:center'],
                      'attribute'=>'DESCRIPTION',
                      'value' => function ($model){
                          return $model->DESCRIPTION;
                      }
                  ],
                  [
                    'attribute'=>'STATUS',
                    'contentOptions' => ['width' => '100','style'=>'text-align:center'],
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