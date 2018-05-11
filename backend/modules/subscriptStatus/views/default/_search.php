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
                          <?= $form->field($model, 'MSISDN', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Nhập số điện thoại'])->label('Số điện thoại') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              // $status = [
                              //   ""  => 'Tất cả',
                              //   "1" => 'Đang sử dụng dịch vụ', 
                              //   "0" => 'Không sử dụng hoặc đã hủy',
                              //   "2" => 'Không tồn tại',
                              //   "3" => 'Không lấy được thông tin',
                              // ];
                            $status = Yii::$app->myEnum->subscribeStatus();
                            // use backend\components\MyEnum;
                            // $status = MyEnum::subscribeStatus();
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
                               <button type="button" class="btn btn-primary" id="linkFunction" ata-target="<?= $baseUrl .$module.'/create' .$suffix ?>" checkAction="0" >Kiểm tra tin nhắn</button>
                          
                        </div>
                  </div>
                  <?php ActiveForm::end(); ?>

             