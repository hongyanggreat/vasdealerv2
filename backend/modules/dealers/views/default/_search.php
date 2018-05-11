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
                          <?= $form->field($model, 'NAME', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Tên Dealer'])->label('Tên Dealer') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                          <?= $form->field($model, 'CODE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Mã Dealer'])->label('Mã Dealer') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                      
                          <?= $form->field($model, 'EMAIL', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'email'])->label('Email') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      
                  
                      <!-- /.col -->
                      <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                          
                          <?= $form->field($model, 'MSISDN', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Nhập số điện thoại'])->label('Số điện thoại') ?>
                          
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                     
                  </div>
                   <div class="row">
                      <div class="col-md-3">
                         <div class="form-group">
                           
                          <?= $form->field($model, 'DEALER_ID', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Nhập Dealer ID'])->label('Dealer ID') ?>
                          
                        </div>
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
                               <button type="button" class="btn btn-primary" id="linkFunction" data-target="<?= $baseUrl .$module.'/create' .$suffix ?>">Thêm mới</button>
                          
                        </div>
                  </div>
                  <?php ActiveForm::end(); ?>