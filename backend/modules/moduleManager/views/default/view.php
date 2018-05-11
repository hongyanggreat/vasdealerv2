<?php 
    use yii\helpers\Html;
   use yii\widgets\DetailView;
   use backend\widgets\ButtonWidget;
    $module       = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
    $this->title = 'Module chi tiết : '.ucfirst( $model->NAME );

    $this->params['breadcrumbs'][] = ['label' => 'Quản lý module', 'url' => ['index']];
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
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$model->MODULE_ID,'TITLE'=>'Danh sách Quản lý Module']]) ?>
          </div>
          <div class="widget-content nopadding">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'MODULE_ID',
                    'RESOURCE',
                    'NAME',
                    'DESCRIPTION',
                    'CREATE_DATE',
                    'CREATE_BY',
                    'UPDATE_DATE',
                    'UPDATE_BY',
                    'TYPE',
                    'STATUS',
                ],
            ]) ?>
          </div>
        </div>
      </div>
     
    </div>
   
  </div>