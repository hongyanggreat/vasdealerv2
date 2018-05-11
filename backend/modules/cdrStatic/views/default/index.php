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
                      'model'     =>$model,
                      'dealerIds' =>$dealerIds,
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
                        <th>Dealer</th>
                        <th>Giao dịch</th>
                        <th>Tổng số Request</th>
                        <th>Tổng Tiền</th>
                        <th>Hoa hồng</th>
                      </tr>
                      </thead>
                      <?php 
                          if(isset($dataProviders) && count($dataProviders)>0){

                       ?>
                      <tbody>
                         <?php 
                            foreach ($dataProviders as $key => $dataProvider) {
                              $totalReq    = $dataProvider['TOTAL_REQUEST'];
                              $price       = $dataProvider['PRICE'];
                              $dealerId    = $dataProvider['DEALER_ID'];
                              $action      = $dataProvider['ACTION'];
                              $actionTitle = MyEnum::synActs($action);
                              $hoaHong = 0;
                              if($price){
                                $hoaHong = "?";
                              }
                          ?>
                          <tr>
                            <td><?= $dealerId  ?></td>
                            <td title="<?= $actionTitle  ?>"><?= $action  ?></td>
                            <td><?= $totalReq  ?></td>
                            <td><?= $price  ?></td>
                            <td><?= $hoaHong ?></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                      <?php } ?>
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

