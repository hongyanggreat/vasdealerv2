<?php 
    $baseUrl = Yii::$app->params['baseUrl'];
    use backend\wgAdminLte\HeadTableWidget;
    echo HeadTableWidget::widget();
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
    <!-- Content Header (Page header) -->
    <?= $content ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- footer-->
   <?php 
      use backend\wgAdminLte\FooterWidget;
      echo FooterWidget::widget();
   ?>
   <!-- footer -->
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
<!-- jQuery 3 -->
 <?php 
    use backend\wgAdminLte\Jquery3TableWidget;
    echo Jquery3TableWidget::widget();
 ?>