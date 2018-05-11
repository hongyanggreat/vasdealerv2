<?php 
    use backend\wgAdminLte\ButtonFuncWidget;
    use backend\wgAdminLte\PaginationWidget;
    use backend\components\MyEnum;
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
    $module    = Yii::$app->controller->module->id;
    // HEAD 
    $this->title = 'Lịch sử đồng bộ cước';
 ?>
    <section class="content-header">
      <h1>
        Danh sách
        <small><?=  $this->title ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $baseUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= $baseUrl .$module .$suffix ?>">Đồng bộ cước</a></li>
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
          <?php 
                $collapsedBox = "collapsed-box";
                // $collapsedBox = "";
                if($collapse){
                  $collapsedBox = "";
                }
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
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <!-- /.box-header -->
            <div class="box-body">
               
                  <table id="listTable" class="table table-bordered table-hover">

                      <thead>
                      <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Request đồng bộ</th>
                        <th>Số điện thoại</th>
                        <th>Đại lý</th>
                        <th>ID của Agent</th>
                        <th>ID của giao dịch</th>
                        <!-- <th>Thời gian phát sinh sự kiện</th>
                        <th>Mô tả sự kiện</th>
                        <th>Giá cước hệ thống</th>
                        <th>Khuyến mại</th>
                        <th>Số lần đã trừ cước</th>
                        <th>Lý do đăng ký không thành công</th> -->
                        <th>Gói cước</th>
                        <th>Mức cước gốc</th>
                        <th>Hành động</th>
                        <!-- <th>Mã lỗi</th>
                        <th>Mô tả lỗi</th> -->
                        <th>Chi tiết</th>
                        <th>Thời gian</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php 

                      
                        if(isset($dataProviders) && count($dataProviders)>0){

                          foreach ($dataProviders as $key => $dataProvider) {
                          
                              // $id            = $dataProvider->ID;
                              // $redId         = $dataProvider->REQUEST_ID;
                              // $masterId      = $dataProvider->MASTER_ID;
                              // $agentId       = $dataProvider->AGENT_ID;
                              // $transactionId = $dataProvider->TRANSACTION_ID;
                              // $timeEvent     = $dataProvider->TIMESTAMP;
                              // $action        = $dataProvider->ACTION;
                              // $orginalPrice  = $dataProvider->ORGINAL_PRICE;
                              // $price         = $dataProvider->PRICE;
                              // $promotion     = $dataProvider->PROMOTION;
                              // $chargeCount   = $dataProvider->CHARGE_COUNT;
                              // $resultCode    = $dataProvider->RESULT_CODE;
                              // $errorCode     = $dataProvider->ERROR_CODE;
                              // $errorDes      = $dataProvider->ERROR_DESC;

                              $id            = $dataProvider['ID'];
                              $redId         = $dataProvider['REQUEST_ID'];
                              $dealerCode    = $dataProvider['DEALER_CODE'];
                              $agentId       = $dataProvider['AGENT_ID'];
                              $transactionId = $dataProvider['TRANSACTION_ID'];
                              $phone         = $dataProvider['PHONE'];
                              $productCode         = $dataProvider['PRODUCT_CODE'];
                              // $timeEvent    = $dataProvider['TIMESTAMP'];
                              // $action       = $dataProvider['ACTION'];
                              $orginalPrice = $dataProvider['ORGINAL_PRICE'];
                              // $price        = $dataProvider['PRICE'];
                              // $promotion    = $dataProvider['PROMOTION'];
                              // $chargeCount  = $dataProvider['CHARGE_COUNT'];
                              // $resultCode   = $dataProvider['RESULT_CODE'];
                              $action          = $dataProvider['ACTION'];
                              $actionTitle          = MyEnum::synActs($action);
                              // $errorCode       = $dataProvider['ERROR_CODE'];
                              // $errorDes        = $dataProvider['ERROR_DESC'];
                              $createAt        = $dataProvider['CREATE_AT'];

                              $dataJson = json_encode($dataProvider);
                              
                              
                       ?>
                      <tr>
                          <td><?= $key+1  ?></button>
                          <td><?= $id  ?></button>
                          </td>
                          <td><?= $redId  ?></td>
                          <td><?= $phone  ?></td>
                          <td><?= $dealerCode  ?></td>
                          <td><?= $agentId  ?></td>
                          <td><?= $transactionId  ?></td>
                          <!-- <td><?php // $timeEvent  ?></td>
                          <td><?php // $action  ?></td>
                          <td><?php // $price  ?></td>
                          <td><?php // $promotion  ?></td>
                          <td><?php // $chargeCount  ?></td>
                          <td><?php // $resultCode  ?></td> -->
                          <td><?= $productCode  ?></td>
                          <td><?= $orginalPrice  ?></td>
                          <td title="<?= $actionTitle  ?>"><?= $action  ?></td>
                          
                          <td><?= $createAt  ?></td>
                          <td><button type="button"  class="btn btn-default showInfo" data-toggle="modal" data-target="#modal-default" data-json='<?= $dataJson ?>'>Xem chi tiết</button>
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

<?= $this->render('_infoModal') ?>