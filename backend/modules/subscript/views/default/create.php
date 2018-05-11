<?php 
    use backend\wgAdminLte\ButtonFuncWidget;
    use backend\wgAdminLte\PaginationWidget;
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
    $module    = Yii::$app->controller->module->id;
    // HEAD 
    $this->title = 'Gửi lời mời sử dụng dịch vụ';
 ?>
    <section class="content-header">
      <h1>
        Yêu cầu : 
        <small><?=  $this->title ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= $baseUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= $baseUrl .$module .$suffix ?>">Subscript Status</a></li>
        <li class="active">Yêu cầu</li>
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
              <h3 class="box-title">Gửi lời mời</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  
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
                      <div class="col-md-3" id="msisdn">
                        <!-- /.form-group -->
                        <div class="form-group">
                          
                          <?= $form->field($modelSubscript, 'MSISDN', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Thuê bao khách'])->label('Thuê bao khách') ?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                     <div class="col-md-2 " id="dealerId">
                        <!-- /.form-group -->
                        <div class="form-group">
                           
                        
                          <?= $form->field($modelSubscript, 'DEALER_ID',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $dealerIds,
                                ['data-target'=> 'subscript-service_id',
                                 'checkAction' => '0'])
                                 ->label('Dealer')?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2" id="serviceCode">
                        <!-- /.form-group -->
                        <div class="form-group">
                         
                          <?= $form->field($modelSubscript, 'SERVICE_CODE',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $serviceCodes,
                                [
                                  'data-target'=> 'subscript-service_code',
                                  'checkAction' => '0',
                                  'class'=>'form-control select2',
                                  'id' => 'selectServiceCode',
                                ])
                                 ->label('Dịch vụ')?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2" id="serviceId">
                        <!-- /.form-group -->
                        <div class="form-group">
                         
                          <?= $form->field($modelSubscript, 'SERVICE_ID',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $serviceProductIds,
                                ['data-target'=> 'subscript-service_id',
                                 'checkAction' => '0',
                                 'class'=>'form-control select2',
                                 'id'=>'selectServiceProductIds'])
                                 ->label('Gói cước')?>
                        </div>
                        <!-- /.form-group -->
                      </div>
                        <!-- /.col -->
                      
                  </div>
                 
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            
                            <?= Html::submitButton("Gửi lời mời", ['class' => $modelSubscript->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                          </div>
                      </div>
                  </div>
             
                  <?php ActiveForm::end(); ?>

                 
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
  //==========================================
        $('body').on('change', '#selectServiceCode', function(event) {
          event.preventDefault();
          var idClick = $('#changeServiceCode');
          var idChange = $('#selectServiceCode');
          var serviceProductIds = $('#selectServiceProductIds');
          var checkAction = $(this).attr('checkAction');
          var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
          var   url       = "<?php echo $baseUrl .$module.'/change_service' . $suffix; ?>";
          $(this).attr('checkAction', '1');
         
          if(checkAction == 0){
              // var dataTarget = $(this).attr('data-target');
              var serviceCode = $(this).val();
              // console.log(serviceCode);
              $.ajax({
                      
                      url: url,
                      
                      type: "post",
                      
                      dataType: "json",
                      
                      data: {_csrf :_csrf,getContent:"true",serviceCode:serviceCode},

                      beforeSend: function () {
                         idClick.html('Đang xử lý ....');
                      },

                      success: function (res) {
                          // console.log(res);
                          serviceProductIds.html(res.selectOption).trigger('change');
                          // console.log("res.errorCode:" + res.errorCode);
                          idClick.attr('checkAction', '0');
                          idChange.attr('checkAction', '0');
                          idClick.html(res.message);
                      },
                      error: function (jqXHR, textStatus, errorThrown) {
                          console.log(textStatus, errorThrown);
                      }
              });
            }else{
                console.log("Dang xu ly");
            }
        });
</script>