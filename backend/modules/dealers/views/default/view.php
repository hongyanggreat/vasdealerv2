 <?php 
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
    $module    = Yii::$app->controller->module->id;
  ?>
 <section class="content">

      <div class="row">
        <div class="col-md-5">
          <div class="box box-warning">
            <div class="box-header with-border">
               <button type="button" class="btn btn-primary" id="linkFunction" data-target="<?= $baseUrl .$module .$suffix ?>">Danh sách</button>
            </div>
          </div>
          <!-- thong bao loi -->
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
                  <div class="alert alert-<?=$classAlert ?>">
                    <span type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</span>
                    <h4><i class="icon fa <?= $iconAlert ?>"></i><?= $messAlert ?></h4>
                  </div>
           <?php endif; ?>
          <!-- thong bao loi -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                 
                </div>
              <h3 class="box-title">Thông tin Dealer đăng ký</h3>
            </div>
            <!-- /.box-header -->
              <?php 

                  $id      = $model->ID;
                  $status      = $model->STATUS;
                     switch ($status) {
                                case '0':
                                     $classStatus = "has-warning";
                                     $iconStatus = "fa-bell-o";
                                     $textStatus = " Không hoạt động";
                                  break;
                                case '1':
                                    $classStatus = "has-success";
                                    $iconStatus = "fa-check";
                                    $textStatus = " Hoạt động";
                                 break;
                                case '2':
                                    $classStatus = "has-error";
                                    $iconStatus = "fa-times-circle-o";
                                    $textStatus = " Từ chối";
                                 break;
                                 case '3':
                                    $classStatus = "has-error";
                                    $iconStatus = "fa-times-circle-o";
                                    $textStatus = " Khóa";
                                 break;
                                 case '4':
                                    $classStatus = "has-error";
                                    $iconStatus = "fa-times-circle-o";
                                    $textStatus = " Xóa";
                                 break;
                                  case '4':
                                    $classStatus = "has-error";
                                    $iconStatus = "fa-times-circle-o";
                                    $textStatus = " Chờ đồng bộ";
                                 break;
                                default:
                                  $classStatus = "has-warning";
                                  $iconStatus = "fa-bell-o";
                                  $textStatus = ' Chờ đồng bộ';
                                  # code...
                                  break;
                              }
                      $status = ' <span class="form-group '.$classStatus.'">
                                    <label class="control-label trangthai" for="inputWarning" id="'.$id.'"><i class="fa '.$iconStatus.'"></i>'.$textStatus.'</label>
                                  </span>';

               ?>
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Dealer ID : <?= $model->DEALER_ID ?></strong>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Name : <?= $model->NAME ?> </strong>


              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Code : <?= $model->CODE ?> </strong>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> ID Tài khoản : <?= $model->ACCOUNT_ID ?> </strong>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Tài khoản : <?= ucfirst($model->USER_ACCOUNT) ?> </strong>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Trạng thái : <?= $status ?> </strong>
              <hr>
              <p><i class="fa fa-file-text-o margin-r-5"></i> chú ý : Vui lòng giữ thông tin cẩn thận</p>
            </div>
            <!-- /.box-body -->
          </div>
</div></div></section>