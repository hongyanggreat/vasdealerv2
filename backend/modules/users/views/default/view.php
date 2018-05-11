<?php 
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use backend\widgets\ButtonWidget;
    $module       = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
    $this->title = 'Chi tiết tài khoản : '.ucfirst( $model->USERNAME );

    $this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
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
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->ACC_ID,'TITLE'=>'Danh sách tài khoản']]) ?>
          </div>
          <div class="widget-content nopadding">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ACC_ID',
                    'PARENT_ID',
                    'USERNAME',
                    //'PASSWORD',
                    //'PASSWORD_RESET_TOKEN',
                    //'AUTH_KEY',
                    'CP_CODE',
                    'FULL_NAME',
                    'DESCRIPTION',
                    'ADDRESS',
                    'PHONE',
                    'EMAIL:email',
                    'CREATE_DATE',
                    'CREATE_BY',
                    'UPDATE_DATE',
                    'UPDATE_BY',
                    'USER_TYPE',
                    'STATUS',
                    'OPTION_DATA',
                ],
            ]) ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>