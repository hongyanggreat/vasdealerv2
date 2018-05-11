<?php 
    $baseUrl = Yii::$app->params['baseUrl'];
    use backend\wgAdminLte\HeadFormWidget;
    echo HeadFormWidget::widget();
 ?>
 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php 
    use backend\wgAdminLte\HeaderWidget;
    echo HeaderWidget::widget();
    // <!-- Left side column. contains the logo and sidebar -->
    use backend\wgAdminLte\MainSidebarWidget;
    echo MainSidebarWidget::widget();
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?= $content ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
      use backend\wgAdminLte\FooterWidget;
      echo FooterWidget::widget();
   ?>

  <!-- Control Sidebar -->
  <?php 
      use backend\wgAdminLte\ControlSidebarWidget;
      echo ControlSidebarWidget::widget();
   ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
      use backend\wgAdminLte\Jquery3FormWidget;
      echo Jquery3FormWidget::widget();
   ?>