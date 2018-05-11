<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use backend\widgets\ButtonWidget;
    $module       = Yii::$app->controller->module->id;
    $baseUrl    = Yii::$app->params['baseUrl'];
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
          <div class="widget-title"> 
            <span class="icon"><a class="" href="<?= $baseUrl.$module ?>" title="Danh sách tài khoản" style="padding:0 2px;"><i class="icon icon icon-home" style="color:#fff"></i></a></span>
            <span class="icon"><a style="padding:0 2px;">Nhập thông tin để tìm kiếm</a></span>
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
                //'method' => 'get',
                'options' => [
                    'class' => 'form-horizontal'
                 ]
            ]); ?>
           
            <?= $form->field($model, 'USERNAME', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Điền tài khoản','disabled'=>$disabled]) ?>
            <?= $form->field($model, 'CP_CODE', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Điền CP_Code','disabled'=>$disabled]) ?>
            <?= $form->field($model, 'PARENT_ID', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Điền tài khoản cha','disabled'=>$disabled]) ?>


             <?php 
                $startTime = date('d-m-Y');
                $startTime = '01-06-2017';
                $endTime   = date('d-m-Y');
              ?>
            <?php 
              // Mượn CREATE_DATE lam ngày bắt đầu
              echo  $form->field($model, 'CREATE_DATE', ['template' => '{label} <div class="controls"><div  data-date="'.$startTime.'" class="input-append date datepicker">{input}<span class="add-on"><i class="icon-th"></i></span>{error}{hint}</div></div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','data-date-format'=>'mm-dd-yyyy','placeholder'=>'Chọn ngày bắt đầu','value'=>$startTime])->label('Từ ngày') ?>
            
            <?php 
              // Mượn UPDATE_DATE lam ngày kết thuc
              echo  $form->field($model, 'UPDATE_DATE', ['template' => '{label} <div class="controls"><div  data-date="'.$endTime.'" class="input-append date datepicker">{input}<span class="add-on"><i class="icon-th"></i></span>{error}{hint}</div></div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','data-date-format'=>'mm-dd-yyyy','placeholder'=>'Chọn ngày kết thúc'])->label('Đến ngày') ?>
          
            <?php 
                $status   = [ 0 =>'Không kích hoạt',1 => 'Kích hoạt',2=>'Hủy kích hoạt'];
                $checkedList = ['0','1','3'];
                $model->STATUS = $checkedList;
             ?>
            <?= $form->field($model,'STATUS',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->checkboxList($status); ?>
            
            
            <?php

              // Mượn USER_TYPE làm sắp xếp theo trường 
               $orderBy= [
                'DESC' =>'Giảm dần',
                'ASC'  =>'Tăng dần',
              ]; 
              $orderByRecord =  $form->field($model, 'USER_TYPE',['template' => '{input}{error}','options' => ['class' => '']])->dropDownList($orderBy,['options'=>[$model->USER_TYPE =>['Selected'=>true]],'class'=>'span4'])->label('Sắp xếp'); ?>
             

            <?php 
              // Mượn AUTH_KEY để sắp xếp theo trường 

              $dataField= [
                  'ACC_ID'   =>'Theo ID tài khoản',
                  'USERNAME' =>'Theo tài khoản',
                  'CP_CODE'  =>'Theo mã CP code',
                  'EMAIL'    =>'Theo email',
                  'PHONE'    =>'Theo Điện thoại',
                  'STATUS'   =>'Theo trạng thái',
                  
              ];
              echo $limitRecode  = $form->field($model, 'AUTH_KEY',['template' => '{label} <div class="controls">{input}'.$orderByRecord.'{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($dataField,['options'=>[$model->AUTH_KEY =>['Selected'=>true]],'class'=>'span4'])->label('Sắp xếp'); ?>
            
            <?php $dataModule= [
                  '5'    =>'5 bản ghi',
                  '10'   =>'10 bản ghi',
                  '20'   =>'20 bản ghi',
                  '50'   =>'50 bản ghi',
                  '100'  =>'100 bản ghi',
                  '200'  =>'200 bản ghi',
                  '300'  =>'300 bản ghi',
                  '500'  =>'500 bản ghi',
                  '1000' =>'1000 bản ghi',
                  'all'  =>'Tất cả bản ghi',
              ]; ?>
            
            <?php  
              // Mượn OPTION_DATA làm ten gioi hạn bản ghi 
            $limitRecode  = $form->field($model, 'OPTION_DATA',['template' => '{label} <div class="controls">{input}<input type="text" style="margin-left:5px;width:160px;padding: 3px 5px;" name="Accounts[TEXT_LIMIT]" placeholder="Nhập số bản ghi">{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($dataModule,['options'=>[$model->OPTION_DATA =>['Selected'=>true]],'class'=>'span4'])->label('Giới hạn bản ghi'); ?>

            <?php 
                echo $limitRecode ;
             ?>
            <div class="control-group">

                <label class="control-label"></label>
                <div class="controls">
                  <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-info']) ?>
                </div>
            </div>
            
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>