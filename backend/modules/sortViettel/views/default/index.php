<?php 
    $module    = Yii::$app->controller->module->id;
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
 ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sắp xếp gói cước
        <small>Mạng Viettel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $baseUrl ?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">gói cước</li>
      </ol>
    </section>
<!-- Main content -->
    <section class="content">
<form action="" method="post">
      <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
      <?php if (Yii::$app->session->hasFlash('showAlert')): ?>
        <?php 
            $showAlert = Yii::$app->session->getFlash('showAlert');
            // echo 'show showAlert ';
            // echo '<pre>';
            // print_r($showAlert);
            // die;
            $classAlert = $showAlert['classAlert'];
            $iconAlert  = $showAlert['iconAlert'];
            $messAlert  = $showAlert['messAlert'];
         ?>
      <div class="row">
          <div class="col-md-6">
             <div class="box box-solid box-<?=$classAlert ?>">
                  <div class="box-header with-border">
                     <span type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</span>
                            <h4><i class="icon fa <?= $iconAlert ?>"></i><?= $messAlert ?></h4>
                  </div>
              </div>
          </div>
      </div>
      <?php endif; ?>
      <div class="row">
        
        <div class="col-md-6">
          <div class="box box-solid box-success">
            <div class="box-header with-border">
              <h4 class="box-title">Danh sách các gói [ <?= $idCate ?> ]</h4>
            </div>


            <div class="box-body">
              <!-- the events -->

              <div class="form-group">
                <label>Chọn danh mục</label>
                <select class="form-control select2" style="width: 100%;" name="cate" id="cate">
                  <?php 
                      foreach ($cates as $key => $cate) {
                        $term_id = $cate->term_id;
                        $description = $cate->description;
                        $checked = "";
                        if($term_id == $idCate){
                            $checked = 'selected';
                        }
                   ?>
                      <option value="<?= $term_id ?>" <?= $checked ?> ><?= $description ?></option>
                  <?php } ?>
                </select>
              </div>
                
              
              <div id="external-events">
                <?php 
                  // $datas = [];
                  if(isset($dataSorteds) && $dataSorteds){
                    // echo $datas;
                    // die;
                    foreach ($dataSorteds as $key => $dataSorted) {
                        $id = $dataSorted['ID'];
                        $post_title = $dataSorted['post_title'];
                        $menu_order = $dataSorted['menu_order'];
                        if($menu_order == 0){
                            $colorBtn = "blue";
                        }else{
                            $colorBtn = "green";
                        }
                        // $datas[] = $id; 
                      
                 ?>
                      <!--  -->
                      <label for="drop-remove">
                        
                        <div class="external-event bg-<?= $colorBtn ?>"><input checked type="checkbox" class="minimal-red" name="<?= $id ?>" > <?= $menu_order  .' - '. $post_title ?></div>
                      </label>
                <?php } ?>
                <?php }
                    // $datasJson = json_encode($datas,true);
                ?>
                <br>
                
              </div>
              <button type="submit" class="btn btn-success">Cập nhật</button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          
        </div>
     
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</form>
    <!-- /.content -->

    <script>
      $( function() {
        $( "#sortable" ).sortable();
        $( "#external-events" ).sortable();
        $( "#sortable" ).disableSelection();
      } );


      $('body').on('change', '#cate', function(event) {
        event.preventDefault();
        /* Act on the event */
        var idCate = $(this).val();
        var _csrf = "<?=Yii::$app->request->getCsrfToken()?>";
        var   url = "<?php echo $baseUrl . $module.'/list-post-by-cate' . $suffix; ?>";
        // console.log('cate id = '+idCate);
       $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: {idCate: idCate,_csrf :_csrf},
                beforeSend: function () {
                    // $('#txtChat').val('');
                },
                success: function (res) {
                    // console.log(res);
                    if(res.status){
                        $('body').find('#external-events').html(res.info);
                    }else{
                        console.log(res.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
      });
  </script>