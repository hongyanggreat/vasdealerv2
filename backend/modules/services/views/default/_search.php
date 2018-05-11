			<?php 
				use yii\widgets\ActiveForm;
				use yii\helpers\Html;
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
                          <?= $form->field($model, 'ID_PACKAGE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'ID gói cước'])->label('ID của gói cước') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                          <?= $form->field($model, 'SERVICE_CODE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Mã Dịch vụ'])->label('Mã Dịch vụ') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                      
                          <?= $form->field($model, 'PRODUCT_CODE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Mã Sản phẩm'])->label('Mã Sản phẩm') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      
                  
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                          
                          <?= $form->field($model, 'PRICE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Giá gói cước'])->label('Giá gói cước') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                     
                  </div>
                   <div class="row">
                      <div class="col-md-3">
                         <div class="form-group">
                           
                          <?= $form->field($model, 'TYPE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Loại dịch vụ'])->label('Loại dịch vụ') ?>
                          
                        </div>
                       </div>

                       <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $commissionType = [
                                "1"  =>'Theo số tiền trừ thực ',
                                "0" =>'Theo đơn giá',
                              ];
                           ?>
                          <?= $form->field($model, 'BY',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($commissionType)->label('Loại tính hoa hồng')?>
                          
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
                                "ID"     =>'ID',
                                "NAME"   =>'NAME',
                                "CODE"   =>'CODE',
                                "MSISDN" =>'PHONE',
                                "STATUS" =>'STATUS',
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
                               <!-- <button type="button" class="btn btn-primary" id="linkSynService" data-target="" checkAction="0" >Đồng bộ dữ liệu</button> -->
                          
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
                                        console.log(res);
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