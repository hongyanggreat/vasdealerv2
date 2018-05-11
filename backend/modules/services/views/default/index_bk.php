<?php 
    use backend\wgAdminLte\ButtonFuncWidget;
    use backend\wgAdminLte\PaginationWidget;
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
    $module    = Yii::$app->controller->module->id;
    // HEAD 
    $this->title = 'Quản lý Dịch vụ';
 ?>
    <section class="content-header">
      <h1>
        Danh sách
        <small><?=  $this->title ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $baseUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= $baseUrl .$module .$suffix ?>">Dich Vụ</a></li>
        <li class="active">Danh sách</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

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
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Tìm kiếm</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  
                 <?= $this->render('_search', [
                      'model'=>$model,
                  ]) ?>
                    
                  <table id="listTable" class="table table-bordered table-hover">

                      <thead>
                      <tr>
                        <th style="width:50px;text-align: center;">STT</th>
                        <th>ID</th>
                        <th>ID Package</th>
                        <th>Mã dịch vụ</th>
                        <th>Mã gói cước</th>
                        <th>Giá gói cước</th>
                        <th>Chu kỳ tính cước</th>
                        <th>Loại dịch vụ</th>
                        <th>Loại tính hoa hồng</th>
                        <th>Ngày đồng bộ</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php 

                      
                        if(isset($dataProviders) && count($dataProviders)>0){

                          foreach ($dataProviders as $key => $dataProvider) {
                             // echo '<pre>';print_r($dataProvider);
                             // die;
                              $id          = $dataProvider->ID;
                              $idPackage   = $dataProvider->ID_PACKAGE;
                              $serviceCode = $dataProvider->SERVICE_CODE;
                              $productCOde = $dataProvider->PRODUCT_CODE;
                              $price       = $dataProvider->PRICE;
                              $cycles      = $dataProvider->CYCLES;
                              // $des      = $dataProvider->DESCRIPTION;
                              $type        = $dataProvider->TYPE;
                              $status      = $dataProvider->STATUS;
                              $comType     = $dataProvider->CONMISSION_TYPE;
                              $create_date = $dataProvider->CREATE_AT;


                              $status      = $dataProvider['STATUS'];
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
                              $status = '<div class="form-group '.$classStatus.'" >
                                            <label class="control-label trangthai" id="'. $id .'" for="inputWarning" title="Click để cập nhật trạng thái"  style="cursor:pointer" checkAction="0"><i class="fa '.$iconStatus.'"></i> '.$textStatus.'</label>
                                          </div>';
                       ?>
                      <tr>
                          <td><?= $key+ 1  ?></td>
                          <td><?= $id  ?></td>
                          <td><?= $idPackage  ?></td>
                          <td><?= $serviceCode  ?></td>
                          <td><?= $productCOde  ?></td>
                          <td><?= $price  ?></td>
                          <td><?= $cycles  ?></td>
                          <td><?= $comType  ?></td>
                          <td><?= $type  ?></td>
                          <td><?= $create_date  ?></td>
                          <td><?= $status  ?></td>


                          <td ><?php 

                              echo  ButtonFuncWidget::widget(['dataProvider'=>[
                                        'task'       =>'ButtonControl2',
                                        'ID'         =>$id,
                                        'URL_UPDATE' =>false,
                                        'URL_VIEW'   =>$baseUrl.$module.'/view'.$suffix.'?id='.$id,
                                        'URL_DELETE' =>$baseUrl.$module.'/delete'.$suffix.'?id='.$id,
                                      ]]); 
                           ?></td>
                      </tr>
                        <?php } ?>
                        <?php } ?>
                      </tbody>
                  </table>
                  <!-- ===== PHAN trang===== -->
                    <div class="pagination alternate myPagination">
                              <ul>
                                 
                              </ul>
                          </div>
                     
                      
                       <?php 
                        if(isset($myPagination) && $myPagination['totalPage'] > 1){
                       ?>
                          
                    <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        <ul class="pagination">
                          <?= PaginationWidget::widget(['paginator'=>$myPagination]); ?>
                        </ul>
                      </div>
                    </div>
                    <?php } ?>
                  <!-- ===== PHAN trang===== -->
                <!-- /.box-body -->
            </div>
            <!-- /.box-body -->
          </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

