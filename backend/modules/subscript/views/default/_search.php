			<?php 
				use yii\widgets\ActiveForm;
				use yii\helpers\Html;
        use backend\components\MyEnum;
				$baseUrl = Yii::$app->params['baseUrl'];
				$suffix  = Yii::$app->params['suffix'];
				$module  = Yii::$app->controller->module->id;
			 ?>
			<?php $form = ActiveForm::begin([
                      //'action' => '/login',
                      // 'method' => 'get',
                      'options' => [
                          'class' => 'formDealer'
                       ]
                  ]); ?>
                  <div class="row">
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                          <?= $form->field($model, 'REQUEST_ID', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'ID giao dịch'])->label('ID giao dịch') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                          <?= $form->field($model, 'DEALER_ID', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'ID của đại lý'])->label('ID của đại lý') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                      
                          <?= $form->field($model, 'SERVICE_ID', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'ID của gói cước'])->label('ID của gói cước') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      
                  
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                          
                          <?= $form->field($model, 'MSISDN', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Thuê bao khách'])->label('Thuê bao khách') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                     
                  </div>
                  <div class="row">
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                          <?= $form->field($model, 'DEALER_CODE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Mã đại lý'])->label('Mã đại lý') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                          <?= $form->field($model, 'USER_ACCOUNT', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Tài khoản của đại lý'])->label('Tài khoản của đại lý ') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                      
                          <?= $form->field($model, 'CP_CODE_ACCOUNT', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Mã tài khoản của đại lý'])->label('Mã tài khoản của đại lý') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $haveCommission = [
                                "0" =>'Không có hoa hồng',
                                "1"  =>'Có hoa hồng',
                              ];
                           ?>
                          <?= $form->field($model, 'HAVE_COMMISSION',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($haveCommission)->label('Loại tính hoa hồng')?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                  </div>
                   <div class="row">
                      
                      <div class="col-md-5">
                        <!-- /.form-group -->
                        <div class="form-group">
                          <?php

                              $actions = MyEnum::errorCode();
                              $actions["all"] = "Tất cả";
                              // array_unshift($actions);
                           ?>
                          <?= $form->field($model, 'ERROR_CODE',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $actions,
                                ['data-target'=> 'subscript-service_id',
                                 'checkAction' => '0','class'=>'form-control select2'])
                                 ->label('Mã lỗi ')?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $status = [
                                "" =>'Tất cả',
                                "1" => 'Hoạt động', 
                                "0" =>'Không hoạt động',
                                "2" =>'Từ chối',
                                "3" =>'Khóa',
                                "4" =>'Xóa',
                                "5" =>'Chờ đồng bộ',
                              ];
                           ?>
                          <?= $form->field($model, 'STATUS',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($status)->label('Trạng thái')?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $order = [
                               "ID"              =>"ID",
                               "USERNAME"        =>"USERNAME",
                               "PASSWORD"        =>"PASSWORD",
                               "MASTER_ID"       =>"MASTER_ID",
                               "CHECKSUM"        =>"CHECKSUM",
                               "REQUEST_ID"      =>"REQUEST_ID",
                               "DEALER_ID"       =>"DEALER_ID",
                               "SERVICE_ID"      =>"SERVICE_ID",
                               "MSISDN"          =>"MSISDN",
                               "DEALER_CODE"     =>"DEALER_CODE",
                               "USER_ACCOUNT"    =>"USER_ACCOUNT",
                               "CP_CODE_ACCOUNT" =>"CP_CODE_ACCOUNT",
                               "ERROR_CODE"      =>"ERROR_CODE",
                               "ERROR_DESC"      =>"ERROR_DESC",
                               "HAVE_COMMISSION" =>"HAVE_COMMISSION",
                               "TRANSACTION_ID"  =>"TRANSACTION_ID",
                               "TIME_START"      =>"TIME_START",
                               "TIME_END"        =>"TIME_END",
                               "STATUS"          =>"STATUS",
                               "CREATE_AT"       =>"CREATE_AT",

                              ];
                           ?>
                          <?= $form->field($model, 'ORDER',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($order)->label('Sắp xếp')?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $by = [
                                "SORT_ASC"  =>'Tăng dần',
                                "SORT_DESC" =>'Giảm dần',
                              ];
                           ?>
                          <?= $form->field($model, 'BY',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($by)->label('Chiều')?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>

                       
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                          <div class="form-group">
                              <?= Html::submitButton('Tìm kiếm', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <div class="col-md-1">
                               <button type="button" class="btn btn-primary" id="linkSynService" data-target="" checkAction="0" >Đồng bộ dữ liệu</button>
                        </div>
                  </div>
                  <?php ActiveForm::end(); ?>

                <script>
                  $(document).ready(function() {
                      $('body').on('click', '#linkSynService', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        var idClick = $('#linkSynService');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/create' . $suffix; ?>";
                        var   urlRedirect       = "<?php echo $baseUrl .$module . $suffix; ?>";
                        // console.log("dong bo");
                        $(this).attr('checkAction', '1');
                        if(checkAction == 0){
                            $.ajax({
                                    
                                    url: url,
                                    
                                    type: "post",
                                    
                                    dataType: "json",
                                    
                                    data: {_csrf :_csrf,getContent:"true"},

                                    beforeSend: function () {
                                       idClick.html('Đang xử lý ....');
                                    },

                                    success: function (res) {
                                        // console.log(res);
                                        // console.log("res.errorCode:" + res.errorCode);
                                        idClick.attr('checkAction', '0');
                                        if(res.errorCode == 1){
                                            idClick.removeClass('btn-primary btn-danger btn-success').addClass('btn-success').html('Đồng bộ thành công');
                                            setTimeout(function(){ 
                                                window.location = urlRedirect;
                                            }, 500);
                                        }else{
                                            idClick.removeClass('btn-primary btn-danger btn-success').addClass('btn-danger').html('Đồng bộ thất bại');
                                        }
                                        
                                        
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