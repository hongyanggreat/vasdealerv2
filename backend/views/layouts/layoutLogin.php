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
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/colorpicker.css" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/datepicker.css" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/uniform.css" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/select2.css" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/maruti-style.css?v=1.2" />
  <link rel="stylesheet" href="<?= $baseUrl ?>admin/css/maruti-media.css" class="skin-color" />
    <?= Html::csrfMetaTags() ?>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="#">AriTime</a></h1>
</div>
<!--close-Header-part--> 

    <?= $content ?>

</div>
</div>

  <script src="<?= $baseUrl ?>admin/js/jquery.min.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/jquery.ui.custom.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/bootstrap.min.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/bootstrap-colorpicker.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/bootstrap-datepicker.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/jquery.uniform.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/select2.min.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/maruti.js"></script> 
  <script src="<?= $baseUrl ?>admin/js/maruti.form_common.js"></script>
  <script src="<?= $baseUrl ?>admin/js/myScript.js?v=1.1"></script>
</body>
</html>
