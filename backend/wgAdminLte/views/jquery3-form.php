<?php 
  $baseUrl = Yii::$app->params['baseUrl'];
 ?>
<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="<?= $baseUrl ?>adminVas/process/process.js?v=1.0.0"></script>
<!-- Select2 -->
<script src="<?= $baseUrl ?>adminVas/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= $baseUrl ?>adminVas/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= $baseUrl ?>adminVas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= $baseUrl ?>adminVas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?= $baseUrl ?>adminVas/bower_components/moment/min/moment.min.js"></script>
<script src="<?= $baseUrl ?>adminVas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= $baseUrl ?>adminVas/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?= $baseUrl ?>adminVas/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?= $baseUrl ?>adminVas/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="<?= $baseUrl ?>adminVas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?= $baseUrl ?>adminVas/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?= $baseUrl ?>adminVas/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= $baseUrl ?>adminVas/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $baseUrl ?>adminVas/dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
    var $datepicker = $('.datepicker');
    $datepicker.datepicker();
    // $datepicker.datepicker('setDate', new Date());
    // $("#myDatapicker").datepicker("setDate","14/12/2014");
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>
             
</body>
</html>
