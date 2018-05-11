<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    $module       = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
 ?>

 <style>
     .help-block, .help-inline{
        color: #d81b1b;
        display: inline-block;
     }
     .widget-title h5{
        width: 100%;
        text-align: center;
        color: green
     }
 </style>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span6 offset3">
        <div class="widget-box">
          <div class="widget-title" >
            <?php 
                $subject = "Lấy lại mật khẩu";
             ?>
            <h5><?= $subject ?></h5>
           
            <?php 
                $action       =  Yii::$app->controller->action->id;
                $disabled = false;
                if(isset($action) && $action =="update"){
                     $disabled = 'disabled';
                } 
            ?>
          </div>
          <div class="widget-content nopadding">

            <?php $form = ActiveForm::begin([
                //'action' => '/login',
                'options' => [
                    'class' => 'form-horizontal'
                 ]
            ]); ?>

            <?= $form->field($model, 'email', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Nhập Email của bạn','disabled'=>$disabled]) ?>
            
            <?= $form->field($model, 'password', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->passwordInput(['class'=>'span11','placeholder'=>'Điền mật khẩu','value'=>'']) ?>

           
             <?= $form->field($model,'rememberMe',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->checkbox(); ?>

            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                  <?= Html::a('Quên Mật khẩu', '/site/forget', [
                                            'data' => [
                                              //'confirm' => 'Bạn có chắc muốn thoát?',
                                              'method' => 'post',
                                            ],
                                            //'href'=>"javascript:void(0);",
                                            //'onclick'=>'logout()',
                                         ]) 
                  ?>
                </div>
            </div>
            
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>