<?php 
     use yii\helpers\Html;
     use yii\widgets\ActiveForm;
     use backend\widgets\ButtonWidget;
     $action       = Yii::$app->controller->action->id;
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
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->GROUP_ID,'TITLE'=>'Danh sách Nhóm tài khoản']]) ?>
          </div>
          <div class="widget-content nopadding">

            <?php $form = ActiveForm::begin([
                //'action' => '/login',
                'options' => [
                    'class' => 'form-horizontal'
                 ]
            ]); ?>

            <?= $form->field($model, 'NAME', ['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textInput(['class'=>'span11','placeholder'=>'Tên nhóm tài khoản']) ?>
             <?php 
                $selectedOptions = [];
                if($model->MODULE_ID !=""){
                    if($model->MODULE_ID =="all_module"){
                        foreach ($dataModule as $key=> $value) {
                            $selectedOptions[$key] = array('selected'=>'selected');
                        }
                        //print_r($dataModule);
                    }else{
                        $arrayAccounts = explode('-', $model->MODULE_ID);
                        foreach ($arrayAccounts as  $value) {
                            $selectedOptions[$value] = array('selected'=>'selected');
                        }
                    }
                }
                //print_r($selectedOptions);
             ?>
            <?= $form->field($model, 'MODULE_ID[]',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])            
                   ->dropDownList($dataModule,
                   [
                    'multiple'=>'multiple',
                    'class'=>'chosen-select input-md required',
                    'options'=>$selectedOptions,              
                   ]             
                  )  ?>
            <?= $form->field($model, 'DESCRIPTION',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textarea(['class' => "span11",'value'=>htmlspecialchars_decode(trim($model->DESCRIPTION)),'placeholder'=>'Nhập miêu tả chi tiết về module']) ?>

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

            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            
            <?php ActiveForm::end(); ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>