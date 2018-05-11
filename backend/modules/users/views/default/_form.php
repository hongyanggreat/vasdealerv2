<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use backend\widgets\ButtonWidget;
    $module       = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
 ?>

 <style>
     .help-block, .help-inline{
        color: #d81b1b;
        display: inline-block;
     }
 </style>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span7 offset2">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5><?= $subject ?></h5>
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->ACC_ID,'TITLE'=>'Danh sách tài khoản']]) ?>
           
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

            <?= $form->field($model, 'USERNAME', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Điền tài khoản','disabled'=>$disabled]) ?>
            
            <?= $form->field($model, 'PASSWORD', ['template' => '{label} <div class="controls">{input}{error}{hint}<p>* Mật khẩu yêu cầu ít nhất 20 ký tự .</p><p>* Phải chứa ít nhất 1 ký tự { viết hoa,viết thường ,số và ký tự đặc biệt }. </p></div>','options' => ['class' => 'control-group']])->passwordInput(['class'=>'span11','placeholder'=>'Điền mật khẩu','value'=>'']) ?>

            <?= $form->field($model, 'FULL_NAME', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Họ tên đầy đủ']) ?>
            
             <?= $form->field($model, 'DESCRIPTION',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textarea(['class' => "span11",'value'=>htmlspecialchars_decode(trim($model->DESCRIPTION)),'placeholder'=>'Nhập miêu tả']) ?>
             <?= $form->field($model, 'ADDRESS',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textarea(['class' => "span11",'value'=>htmlspecialchars_decode(trim($model->DESCRIPTION)),'placeholder'=>'Nhập địa chỉ']) ?>
            <?= $form->field($model, 'PHONE', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Nhập số điện thoại']) ?>
            <?= $form->field($model, 'EMAIL', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Nhập email']) ?>
            
            <?php 
                $userType = [1 => 'Admin', 0 =>'Sub'];
             ?>
            <?= $form->field($model, 'USER_TYPE',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->radioList($userType)?>


            <?php 
                $status = [1 => 'Kích hoạt', 0 =>'Không kích hoạt'];
                if(isset($action) && $action =="update"){
                    if($model->STATUS == 0){
                        $status   = [ 0 =>'Không kích hoạt',1 => 'Kích hoạt',2=>'Hủy kích hoạt'];
                    }else{
                        $status   = [1 => 'Kích hoạt',2=>'Hủy kích hoạt'];
                    }
                }
                //$model->STATUS = 1;
             ?>
            <?= $form->field($model, 'STATUS',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->radioList($status)?>

            
             <?= $form->field($model, 'OPTION_DATA',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textarea(['class' => "span11",'value'=>htmlspecialchars_decode(trim($model->OPTION_DATA)),'placeholder'=>'Thêm options data']) ?>
            
             
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>