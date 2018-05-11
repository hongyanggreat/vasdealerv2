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
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                          <?= $form->field($model, 'REQUEST_ID', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'REQUEST_ID'])->label('Request ID') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                          <?php

                              $actions = MyEnum::synActs();
                              array_unshift($actions , 'Tất cả');
                           ?>
                          <?= $form->field($model, 'ACTION',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $actions,
                                ['data-target'=> 'subscript-service_id',
                                 'checkAction' => '0','class'=>'form-control'])
                                 ->label('Hành động ')?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <?= $form->field($model, 'START_DATE', ['template' => '{label}<div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                             {input}
                          </div>{error}{hint}','options' => ['class' => '','id'=>'']])->textInput(['class'=>'form-control pull-right datepicker','id'=>'','value'=>$model->START_DATE,'placeholder'=>'Chọn thời gian'])->label('Từ ngày') ?>
                          <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <?= $form->field($model, 'END_DATE', ['template' => '{label}<div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                             {input}
                          </div>{error}{hint}','options' => ['class' => '','id'=>'']])->textInput(['class'=>'form-control pull-right datepicker','id'=>'','value'=>$model->END_DATE,'placeholder'=>'Chọn thời gian'])->label('Đến ngày') ?>
                          <!-- /.input group -->
                        </div>
                    </div>
                       
                      <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                         <?php 
                              $order = [
                                "ID"             =>'ID',
                                "REQUEST_ID"     =>"REQUEST_ID",
                                "MASTER_ID"      =>"MASTER_ID",
                                "AGENT_ID"       =>"AGENT_ID",
                                "TRANSACTION_ID" =>"TRANSACTION_ID",
                                "TIMESTAMP"      =>"TIMESTAMP",
                                "ACTION"         =>"ACTION",
                                "ORGINAL_PRICE"  =>"ORGINAL_PRICE",
                                "PRICE"          =>"PRICE",
                                "PROMOTION"      =>"PROMOTION",
                                "CHARGE_COUNT"   =>"CHARGE_COUNT",
                                "RESULT_CODE"    =>"RESULT_CODE",
                                "ERROR_CODE"     =>"ERROR_CODE",
                                "ERROR_DESC"     =>"ERROR_DESC",
                                "STATUS"         =>"STATUS",

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
                    
                  </div>
                  <div class="row">
                    <div class="col-md-1">
                          <div class="form-group">
                              <?= Html::submitButton('Tìm kiếm', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>
                  </div>
                  <?php ActiveForm::end(); ?>

