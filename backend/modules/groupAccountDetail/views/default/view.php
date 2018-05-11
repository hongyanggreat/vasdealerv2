<?php 
     use yii\helpers\Html;
     use yii\widgets\DetailView;
     use backend\widgets\ButtonWidget;
     use backend\modules\Users\models\Accounts;
     use backend\modules\groupAccount\models\GroupAccount;     
    $module       = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
    $this->title = 'Nhóm tài khoản chi tiết : '.ucfirst( $model->ACC_ID );

    $this->params['breadcrumbs'][] = ['label' => 'Nhóm tài khoản chi tiết', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
 ?>
 <style>
     .help-block, .help-inline{
        color: #d81b1b;
     }
 </style>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span7 offset2">
        <div class="widget-box">
          <div class="widget-title"> 
            
            <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5><?= $this->title ?></h5>
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->ID,'TITLE'=>'Danh sách nhóm tài khoản chi tiết']]) ?>
            <?php 
                $action       =  Yii::$app->controller->action->id;
                $disabled = false;
                if(isset($action) && $action =="update"){
                     $disabled = 'disabled';

             ?>
                <p style="float: right;margin: 7px 5px">
                    <?= Html::a('<i class="icon icon icon-pencil" style="color:#fff"></i>', ['create'], [
                                'title' => Yii::t('app', 'Thêm mới'),
                                'class' => 'btn btn-info',
                                'style'=>'padding:0 2px;'
                            ]) ?>
                </p>
            <?php } ?>
          </div>
          <div class="widget-content nopadding">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                   
                  [
                    'attribute'      =>'GROUP_ID',
                    'contentOptions' => ['style' => 'text-align:center;'],
                    'value'          => function ($model){
                       $data = GroupAccount::find()->select('NAME')->where('GROUP_ID=:groupId',['groupId'=>$model->GROUP_ID])->one(); 
                          return $data['NAME'];
                    },
                  ], 
                  [
                    'format'      =>'raw',
                    'attribute'      =>'ACC_ID',
                    'contentOptions' => ['style' => 'text-align:center;'],
                    'contentOptions' => ['style' => 'text-align:center;'],
                    'value'          => function ($model){
                        $arrId = [];
                        if($model->ACC_ID !=""){
                            $arrId = explode('-', $model->ACC_ID);
                            $users = Accounts::find()->where(['in','ACC_ID',$arrId])->all();
                            if(isset($users) && count($users) > 0){
                              $datauser = '';
                              foreach ($users as  $user) {
                                  $datauser .= '<input type="button" name="" value="'.$user['USERNAME'].'" placeholder="" class="btn btn-small btn-primary" style="margin-bottom:5px;"> ';
                              }
                              return $datauser;
                            }
                        }
                       return '<input type="button" name="" value="Chưa có tài khoản nào trong nhóm này" placeholder="" class="btn btn-warning">'; 
                       //$data = Accounts::find()->select('USERNAME')->where('ACC_ID=:accId',['accId'=>$model->ACC_ID])->one(); 
                       //   return $data['USERNAME'];
                    },
                  ],
                    'CREATE_BY',
                    'CREATE_DATE',
                    'UPDATE_BY',
                    'UPDATE_DATE',
                    'DESCRIPTION',
                    'STATUS',
                ],
            ]) ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>
