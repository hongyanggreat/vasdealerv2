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
                        <div class="form-group">
                          <?= $form->field($model, 'TIME', ['template' => '{label}<div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                             {input}
                          </div>{error}{hint}','options' => ['class' => '','id'=>'']])->textInput(['class'=>'form-control pull-right','id'=>'reservationtime','placeholder'=>'Thời gian'])->label('Thời gian') ?>
                          <!-- /.input group -->
                        </div>
                      </div>
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $order = [
                                "ID"              => "ID",
                                "USERNAME"        => "USERNAME",
                                "PASSWORD"        => "PASSWORD",
                                "MASTER_ID"       => "MASTER_ID",
                                "CHECKSUM"        => "CHECKSUM",
                                "REQUEST_ID"      => "REQUEST_ID",
                                "NAME"            => "NAME",
                                "CODE"            => "CODE",
                                "EMAIL"           => "EMAIL",
                                "MSISDN"          => "MSISDN",
                                "ERROR_CODE"      => "ERROR_CODE",
                                "ERROR_DESC"      => "ERROR_DESC",
                                "DEALER_ID"       => "DEALER_ID",
                                "TYPE_ACTION"     => "TYPE_ACTION",
                                "USER_ACTION"     => "USER_ACTION",
                                "CREATE_AT"       => "CREATE_AT",
                                "USER_ACCOUNT"    => "USER_ACCOUNT",
                                "CP_CODE_ACCOUNT" => "CP_CODE_ACCOUNT",

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
                  </div>
                  <?php ActiveForm::end(); ?>