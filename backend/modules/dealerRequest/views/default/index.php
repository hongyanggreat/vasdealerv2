<?php 
    use backend\wgAdminLte\ButtonFuncWidget;
    use backend\wgAdminLte\PaginationWidget;
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
    $module    = Yii::$app->controller->module->id;
    // HEAD 
    $this->title = 'Quản lý dealer';
 ?>
    <section class="content-header">
      <h1>
        Danh sách
        <small><?=  $this->title ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $baseUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= $baseUrl .$module .$suffix ?>">Dealers</a></li>
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
                        <th>Dearler ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Tài khoản</th>
                        <th>Error</th>
                        <th>Tạo ngày</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php 

                      
                        if(isset($dataProviders) && count($dataProviders)>0){

                          foreach ($dataProviders as $key => $dataProvider) {
                             // echo '<pre>';print_r($dataProvider);
                             // die;
                              $id           = $dataProvider->ID;
                              $dearlerID    = $dataProvider->DEALER_ID;
                              $name         = $dataProvider->NAME;
                              $code         = $dataProvider->CODE;
                              $email        = $dataProvider->EMAIL;
                              $phone        = $dataProvider->MSISDN;
                              $userAccount  = $dataProvider->USER_ACCOUNT;
                              $create_date  = $dataProvider->CREATE_AT;
                              $errordes  = $dataProvider->ERROR_DESC;

                       ?>
                      <tr>
                          <td><?= $key+ 1  ?></td>
                          <td><?= $id  ?></td>
                          <td><?= $dearlerID  ?></td>
                          <td><?= $name  ?></td>
                          <td><?= $code  ?></td>
                          <td><?= $phone  ?></td>
                          <td><?= $email  ?></td>
                          <td><?= $userAccount  ?></td>
                          <td><?= $errordes  ?></td>

                          <td><?= $create_date  ?></td>
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

    