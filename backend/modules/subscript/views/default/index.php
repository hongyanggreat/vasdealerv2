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
              <h3 class="box-title">Gửi lời mời sử dụng dịch vụ</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  
                 <?= $this->render('_invite', [
                      'modelSubscript' =>$modelSubscript,
                      'dealerIds'      =>$dealerIds,
                      'serviceCodes'   =>$serviceCodes,
                      'serviceProductIds'     =>$serviceProductIds,
                  ]) ?>
                    
                 
                <!-- /.box-body -->
            </div>
            <!-- /.box-body -->
          </div>
          
          <!-- /.box -->
        </div>
        <div class="col-xs-12">
          <?php 
              $collapsedBox = "collapsed-box";
              $collapsedBox = "";
           ?>
          <div class="box box-success <?= $collapsedBox ?>">
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
                    
                 
                <!-- /.box-body -->
            </div>
            <!-- /.box-body -->
          </div>
          
          <!-- /.box -->
        </div>

        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="box-body">

                 <table id="listTable" class="table table-bordered table-hover">

                      <thead>
                      <tr>
                        <th style="width:50px;text-align: center;">STT</th>
                        <th>ID</th>
                        <th>Request ID</th>
                        
                        <th>Dealer ID</th>
                        <th>Mã dealer</th>
                        
                        <th>Service ID</th>
                        <th>Số điện thoại</th>


                        <th>Tài khoản</th>
                        <th>Mã tài khoản</th>
                        
                        <th>Mã lỗi</th>
                        <th>Miêu tả lỗi</th>
                        
                        <th>Hoa hồng</th>
                        
                        <th>Mã giao dịch</th>
                        <th>Trạng thái</th>
                        
                        <th>Ngày mời</th>
                        
                      </tr>
                      </thead>
                      <tbody>

                      <?php 

                      
                        if(isset($dataProviders) && count($dataProviders)>0){

                          foreach ($dataProviders as $key => $dataProvider) {
                             // echo '<pre>';print_r($dataProvider);
                             // die;
                              $id             = $dataProvider->ID;
                              $requestId      = $dataProvider->REQUEST_ID;
                              $dealerId       = $dataProvider->DEALER_ID;
                              $serviceId      = $dataProvider->SERVICE_ID;
                              $msisdn         = $dataProvider->MSISDN;
                              
                              $dealerCode     = $dataProvider->DEALER_CODE;
                              
                              $userAcc        = $dataProvider->USER_ACCOUNT;
                              $cpCodeAcc      = $dataProvider->CP_CODE_ACCOUNT;
                              
                              $errorCode      = $dataProvider->ERROR_CODE;
                              $des            = $dataProvider->ERROR_DESC;
                              
                              $haveCommission = $dataProvider->HAVE_COMMISSION;
                              
                              $transactionId  = $dataProvider->TRANSACTION_ID;
                              $status         = $dataProvider['STATUS'];
                              
                              $create_date    = $dataProvider->CREATE_AT;


                              
                              switch ($status) {
                                case 0:
                                     $classStatus = "has-warning";
                                     $iconStatus = "fa-bell-o";
                                     $textStatus = " Thất bại";
                                  break;
                                case 1:
                                    $classStatus = "has-success";
                                    $iconStatus = "fa-check";
                                    $textStatus = " Thành công";
                                 break;
                              
                                default:
                                  $classStatus = "has-warning";
                                  $iconStatus = "fa-bell-o";
                                  $textStatus = ' Chờ đồng bộ';
                                  # code...
                                  break;
                              }
                              $status = '<div class="form-group '.$classStatus.'" >
                                            <label class="control-label trangthai" id="'. $id .'" style="cursor:pointer" checkAction="0"><i class="fa '.$iconStatus.'"></i> '.$textStatus.'</label>
                                          </div>';
                       ?>
                      <tr>
                          <td><?= $key + 1  ?></td> 
                          <td><?= $id  ?></td> 
                          <td><?= $requestId  ?></td>
                          
                          <td><?= $dealerId  ?></td>
                          <td><?= $dealerCode  ?></td>
                          
                          <td><?= $serviceId  ?></td>
                          <td><?= $msisdn  ?></td>

                          

                          <td><?= $userAcc  ?></td>
                          <td><?= $cpCodeAcc  ?></td>
                          
                          <td><?= $errorCode  ?></td>
                          <td><?= $des  ?></td>
                          
                          <td><?= $haveCommission  ?></td>
                          
                          <td><?= $transactionId  ?></td>
                          <td><?= $status  ?></td>
                          
                          <td><?= $create_date  ?></td>

                         
                      </tr>
                        <?php } ?>
                        <?php } ?>
                      </tbody>
                  </table>
                  <!-- ===== PHAN trang===== -->
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
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

