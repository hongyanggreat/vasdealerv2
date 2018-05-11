<?php 
    $baseUrl = Yii::$app->params['baseUrl'];
 ?>
<script src="<?= $baseUrl ?>adminVas/process/process.js?v=1.0.0"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?= $baseUrl ?>adminVas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= $baseUrl ?>adminVas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= $baseUrl ?>adminVas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= $baseUrl ?>adminVas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= $baseUrl ?>adminVas/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= $baseUrl ?>adminVas/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $baseUrl ?>adminVas/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#listTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
