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
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->ID,'TITLE'=>'Danh sách nhóm tài khoản chi tiết']]) ?>
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

            <?=  $form->field($model, 'GROUP_ID',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($dataGroupAccount,['options'=>[$model->GROUP_ID =>['Selected'=>true]],'class'=>'span11']); ?>

            <?php 
                $selectedOptions = [];
                if($model->ACC_ID !=""){
                    $arrayAccounts = explode('-', $model->ACC_ID);
                    foreach ($arrayAccounts as  $value) {
                        $selectedOptions[$value] = array('selected'=>'selected');
                    }
                }
             ?>
            <?= $form->field($model, 'ACC_ID[]',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])            
                   ->dropDownList($dataUser,
                   [
                    'multiple'=>'multiple',
                    'class'=>'chosen-select input-md required',
                    'options'=>$selectedOptions,              
                   ]             
                  )  ?>

             <?= $form->field($model, 'DESCRIPTION',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->textarea(['class' => "span11",'value'=>htmlspecialchars_decode(trim($model->DESCRIPTION)),'placeholder'=>'Nhập miêu tả chi tiết ']) ?>
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