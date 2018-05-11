<?php 
    use yii\helpers\Html;
   use yii\widgets\DetailView;
    use backend\widgets\ButtonWidget;
    $module       = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
    $this->title = 'Chi tiết nhóm tài khoản : '.ucfirst( $model->NAME );

    $this->params['breadcrumbs'][] = ['label' => 'Nhóm tài khoản', 'url' => ['index']];
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
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->GROUP_ID,'TITLE'=>'Danh sách Nhóm tài khoản']]) ?>
            
          <div class="widget-content nopadding">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'GROUP_ID',
                    'NAME',
                    'DESCRIPTION',
                    'CREATE_DATE',
                    'CREATE_BY',
                    'UPDATE_DATE',
                    'UPDATE_BY',
                    'STATUS',
                ],
            ]) ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>

