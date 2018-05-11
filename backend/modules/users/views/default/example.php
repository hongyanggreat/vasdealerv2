<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
 ?>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Personal-info</h5>
          </div>
          <div class="widget-content nopadding">
            <?php $form = ActiveForm::begin([
                //'action' => '/login',
                'options' => [
                    'class' => 'form-horizontal'
                 ]
            ]); ?>
               
            <?php 
                    $create_dat2 = [
                                    '2'=>'thu 2',
                                    '3'=>'thu 3',
                                    '4'=>'thu 4',
                                    '5'=>'thu 5',
                                    '6'=>'thu 6',
                                    '7'=>'thu 7',
                                    '8'=>'Chu nhat',
                                ]; ?>
          <?= $form->field($model, 'CREATE_DATE[]',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])            
                   ->dropDownList($create_dat2,
                   [
                    'multiple'=>'multiple',
                    'class'=>'chosen-select input-md required',              
                   ]             
                  )->label("Add Categories");  ?>
                  
            <?php 
                $gender =[1 => 'Male', 0 =>'Female',2=>'none'];

                $model->PHONE = 0;
             ?>
            <?= $form->field($model, 'PHONE',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->radioList($gender)?>

            <?php $status= ['0'=>'Vui long chon','1' => 'Du lieu mau 1','2' => 'Du lieu mau 2','3'=>'Du lieu mau 3' ]; ?>
           
            <?=  $form->field($model, 'PARENT_ID',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($status,['options'=>['0'=>['Selected'=>true]],'class'=>'span11']); ?>
            

            <?= $form->field($model, 'USERNAME', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Điền tài khoản']) ?>


            <?php 
                $list = [0 => 'All right', 1 => 'View Right', 2 => 'Add Right',3=>'Edit Right',4=>'Delete Right',5=>'Up Right',6=>'Down Right'];
                $checkedList = ['0','1','3'];
                $model->STATUS = $checkedList;
             ?>

            <?= $form->field($model,'STATUS',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->checkboxList($list); ?>
            
            <?= $form->field($model, 'USERNAME',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->fileInput(['maxlength' => true]) ?>


             <?= $form->field($model, 'DESCRIPTION',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textarea(['class' => "span11",'value'=>htmlspecialchars_decode(trim($model->DESCRIPTION))]) ?>
            
             <?= $form->field($model, 'AUTH_KEY', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'nnn','disabled' => true])?>
              <?php //echo $form->field($model, 'PN_CODE', ['template' => '{label} <div class="controls"><div class="input-append">{input}<span class="add-on"><i class="icon icon-eye-open" style="cursor:pointer"></i></span> </div>{error}{hint}</div></div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','maxlength' => true,'placeholder' => 'Điền mật khẩu','value'=>''])?>
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