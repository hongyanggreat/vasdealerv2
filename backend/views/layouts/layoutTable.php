<?php 
	
	use yii\widgets\Breadcrumbs;
	use common\widgets\Alert;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\widgets\ActiveForm; 
	$baseUrl = Yii::$app->params['baseUrl'];
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?= Html::encode($this->title) ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/colorpicker.css" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/datepicker.css" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/uniform.css" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/select2.css" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/maruti-style.css" />
<link rel="stylesheet" href="<?= $baseUrl ?>admin/css/maruti-media.css" class="skin-color" />
<?= Html::csrfMetaTags() ?>
<script src="<?= $baseUrl ?>admin/js/jquery.min.js"></script> 
<script src="<?= $baseUrl ?>admin/js/select2.min.js"></script> 

</head>
<body>

<!-- // css help checkbox -->
<style>
  .checker{
    vertical-align: initial;
  }
</style>
<!--Header-part-->
<div id="header">
  <h1><a href="<?= $baseUrl ?>">QUIZ ONLINE</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<?php 
    use backend\widgets\TopMenuWidget;
    echo TopMenuWidget::widget(['view'=>'topMenu']);
?>
<!--close-top-Header-menu-->

 <?php 
    use backend\widgets\MainMenuWidget;
    echo MainMenuWidget::widget();
 ?>

<div id="content">
  <?php 
    //print_r($this->params['breadcrumbs']);
  	$baseUrl = Yii::$app->params['baseUrl'];
    $module       = Yii::$app->controller->module->id;
    $controller   =  Yii::$app->controller->id;
    $action       =  Yii::$app->controller->action->id;

    $label = '';
    if(isset($this->params['breadcrumbs'][0]['label'])){
      $linkModule = $baseUrl.$module;
      $label = '<a href="'.$linkModule.'">'.$this->params['breadcrumbs'][0]['label'].'</a>';
    }
    $action = '';
    if(isset($this->params['breadcrumbs'][0]) && !is_array($this->params['breadcrumbs'][0]) ){
      $action = '<a class="current">'.$this->params['breadcrumbs'][0].'</a>';
    }
    if(isset($this->params['breadcrumbs'][1]) && !is_array($this->params['breadcrumbs'][1]) ){
      $action = '<a class="current">'.$this->params['breadcrumbs'][1].'</a>';
    }
    if(isset($this->params['breadcrumbs'][2]) && !is_array($this->params['breadcrumbs'][2]) ){
       $action = '<a  class="current">'.$this->params['breadcrumbs'][2].'</a>';
    }
    ?>
  <div id="content-header">
    <div id="breadcrumb">
        <a href="<?= $baseUrl.'quantri' ?>" title="" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a>
        <?=  $label ?>
        <?=  $action ?>
      </div>
  </div>
    <?= $content ?>
  
</div>
<?php 
    use backend\widgets\FooterWidget;
    echo FooterWidget::widget();
 ?>
 <?php
     ActiveForm::begin(['id' => 'formLogout','action'=>$baseUrl.'site/logout'.Yii::$app->params['suffix']]); 
     ActiveForm::end();
?>
  <script src ="<?= $baseUrl ?>admin/js/jquery.ui.custom.js"></script> 
  <script src ="<?= $baseUrl ?>admin/js/bootstrap.min.js"></script> 
  <script src ="<?= $baseUrl ?>admin/js/bootstrap-colorpicker.js"></script> 
  <script src ="<?= $baseUrl ?>admin/js/bootstrap-datepicker.js"></script> 
  <script src ="<?= $baseUrl ?>admin/js/jquery.uniform.js"></script> 
  <script src ="<?= $baseUrl ?>admin/js/maruti.js"></script> 
  <script src ="<?= $baseUrl ?>admin/js/maruti.tables.js"></script>
  <script src ="<?= $baseUrl ?>admin/js/maruti.form_common.js"></script>
  <script src ="<?= $baseUrl ?>admin/js/jquery.dataTables.min.js"></script> 

  <script src ="<?= $baseUrl ?>admin/fck3/ckeditor/ckeditor.js"></script>
  <script src ="<?= $baseUrl ?>admin/fck3/ckfinder/ckfinder.js"></script>
  <script src ="<?= $baseUrl ?>admin/fck3/func_ckfinder.js?v=1.0"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="<?= $baseUrl ?>admin/js/myScript.js?v=1.0.0"></script>
  
</body>
</html>
