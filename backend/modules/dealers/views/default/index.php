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
                        <th>Tạo ngày</th>
                        <!-- <th>Hiệu lực</th> -->
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
                              $id           = $dataProvider->ID;
                              $dearlerID    = $dataProvider->DEALER_ID;
                              $name         = $dataProvider->NAME;
                              $code         = $dataProvider->CODE;
                              $email        = $dataProvider->EMAIL;
                              $phone        = $dataProvider->MSISDN;
                              $userAccount  = $dataProvider->USER_ACCOUNT;
                              $status       = $dataProvider->STATUS;
                              $create_date  = $dataProvider->CREATE_AT;
                              
                              $effTimeStart = $dataProvider->EFFECTIVE_TIME_START;
                              $effTimeEnd   = $dataProvider->EFFECTIVE_TIME_END;
                              // $create_date  = date('d-m-Y',$create_date);

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
                                  case '5':
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
                          <td><?= $dearlerID  ?></td>
                          <td><?= $name  ?></td>
                          <td><?= $code  ?></td>
                          <td><?= $phone  ?></td>
                          <td><?= $email  ?></td>
                          <td><?= $userAccount  ?></td>
                          <td><?= $create_date  ?></td>
                          <!-- <td><?php // $effTimeStart  ?> => <?php // $effTimeStart  ?></td> -->
                          <td><?= $status  ?></td>


                          <td ><?php 

                              echo  ButtonFuncWidget::widget(['dataProvider'=>[
                                        'task'       =>'ButtonControl2',
                                        'ID'         =>$id,
                                        'URL_UPDATE' =>$baseUrl.$module.'/update'.$suffix.'?id='.$id,
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

    <script>
      $(document).ready(function() {
          $('body').on('click', '.trangthai', function(event) {
            event.preventDefault();
            /* Act on the event */
              var id = $(this).attr('id');
              var idClick = $('.trangthai#'+id);
              var checkAction = $(this).attr('checkAction');
              var _csrf = "<?=Yii::$app->request->getCsrfToken()?>";
              var   url = "<?php echo $baseUrl . $module.'/status' . $suffix; ?>";
              // console.log('id = '+id);
              var message = "Thất bại";
              var iconStatus = "fa-times-circle-o";
              var hasClass = "has-error";
              $(this).attr('checkAction', '1');
              if(checkAction == 0){

                $.ajax({
                        
                        url: url,
                        
                        type: "post",
                        
                        dataType: "json",
                        
                        data: {id: id,_csrf :_csrf},

                        beforeSend: function () {
                           idClick.html('processing ....');
                           idClick.parent().removeClass().addClass('form-group '+hasClass);
                        },

                        success: function (res) {
                            // console.log(res);
                            idClick.attr('checkAction', '0');
                            switch(res.status) {
                             case 0:
                             //============ 0: Không hoạt động
                                hasClass = "has-warning";
                                message = "Không hoạt động";
                              break;
                              case 1:
                             //============ 1: Hoạt động
                                
                                iconStatus = "fa-check";
                                message = "Hoạt động";
                                hasClass = "has-success";
                              break;

                             case 2:
                             //============ 2: Từ chối
                             message = "Từ chối";
                                hasClass = "has-warning";
                              break;
                             
                             case 3:
                             //============ 3: Khóa
                             message = "Khóa";
                                hasClass = "has-error";
                              break;
                             
                             case 4:
                             //============ 4: Xóa
                             message = "Xóa";
                                hasClass = "has-error";
                              break;
                             
                             case 5:
                             //============ 5: Chờ đồng bộ
                                hasClass = "has-warning";
                                message = "Chờ đồng bộ";
                              break;
                             
                             default:
                             //============ null: Chờ đồng bộ
                                message = "Chờ đồng bộ";
                                hasClass = "has-warning";
                             // code to be executed if n is different from case 1 and 2
                            }  
                            idClick.parent().removeClass().addClass('form-group '+hasClass);
                            idClick.html('<i class="fa '+iconStatus+'"></i> '+message);
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
              }else{
                  console.log("Dang xu ly");
              }
          });
      });
    </script>