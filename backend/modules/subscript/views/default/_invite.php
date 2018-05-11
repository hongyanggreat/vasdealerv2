			<?php 
				use yii\widgets\ActiveForm;
				use yii\helpers\Html;
        use yii\helpers\ArrayHelper;

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
                      <?php 
                        $hide = true; // ẩn cac lưa chon cần thiết
                        $hide = false; // Hiển thị các lưa chon ra man hinh
                        $accept = true;
                        $accept = false;
                      ?>
                    
                      <!-- /.col -->
                     <div class="col-md-2 " id="dealerId">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <?= $form->field($modelSubscript, 'DEALER_ID',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $dealerIds, [
                              'data-target'=> 'subscript-service_id', 
                              'checkAction' => '0',
                              'class'=>'form-control select2',
                              'id' => 'selectDealerId',
                              ]) ->label('ID của đại lý')?>
                          <button type="button" class="btn btn-primary" id="acceptDealerId" data-target="subscript-dealer_id" checkAction="0" >Xác nhận</button>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-2 <?=  ($hide)?"hide":"" ?>" id="serviceCode">
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
                          <button type="button" class="btn btn-primary" id="changeServiceCode" data-target="subscript-service_id" checkAction="0" >Xác nhận</button>
                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-2 <?=  ($hide)?"hide":"" ?>" id="serviceId">
                        <!-- /.form-group -->
                        <div class="form-group">
                         
                          <?= $form->field($modelSubscript, 'SERVICE_ID',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList( $serviceProductIds,
                                ['data-target'=> 'subscript-service_id',
                                 'checkAction' => '0',
                                 'class'=>'form-control select2',
                                 'id'=>'selectServiceProductIds'])
                                 ->label('Gói cước')?>
                          <button type="button" class="btn btn-primary" id="acceptServiceProductIds" data-target="subscript-service_id" checkAction="0" >Xác nhận</button>
                        </div>
                        <!-- /.form-group -->
                      </div>

                        <!-- /.col -->
                      <div class="col-md-3 <?=  ($hide)?"hide":"" ?>" id="msisdn">
                        <!-- /.form-group -->
                        <div class="form-group">
                          
                          <?= $form->field($modelSubscript, 'MSISDN', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Thuê bao khách'])->label('Thuê bao khách') ?>
                          <button type="button" class="btn btn-primary" id="acceptMsisdn" data-target="subscript-msisdn" checkAction="0" >Xác nhận</button>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-1 <?=  ($hide)?"hide":"" ?> hide" id="btnSent">
                        <div class="form-group">
                          <label class="control-label" for="subscript-inVite"> </label>
                            <div class="controls">
                              
                             <button type="button" class="btn btn-primary" id="inVite" data-target="subscript-inVite" checkAction="0" >Gửi lời mời</button>
                            </div>
                        </div>
                      </div>
                  </div>
             
                  <?php ActiveForm::end(); ?>

                <script>
                  $(document).ready(function() {
                      
                      var accept = "<?= $accept ?>";
                          // hide = false;
                      //==========================================

                      //================= DEALER ID =========================
                       //==========================================
                      $('body').on('change', '#selectDealerId', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        if(accept){
                          $('#dealerId').addClass('hide');
                        }
                        $('#serviceId').removeClass('hide');
                        var idChange = $('#selectDealerId');
                        var idClick = $('#acceptDealerId');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/dealerid' . $suffix; ?>";
                        $(this).attr('checkAction', '1');
                       

                        if(checkAction == 0){

                            // var dataTarget = $(this).attr('data-target');
                            var dealerId = $(this).val();
                            // console.log("dataTarget:"+dataTarget);
                            // console.log("dealerId:"+dealerId);
                            $.ajax({
                                    
                                    url: url,
                                    
                                    type: "post",
                                    
                                    dataType: "json",
                                    
                                    data: {_csrf :_csrf,getContent:"true",dealerId:dealerId},

                                    beforeSend: function () {
                                       idClick.html('Đang xử lý ....');
                                    },

                                    success: function (res) {
                                        // console.log(res);
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

                      //==========================================
                      $('body').on('click', '#acceptDealerId', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        if(accept){
                          $('#dealerId').addClass('hide');
                        }
                        $('#serviceId').removeClass('hide');
                        var idClick = $('#acceptDealerId');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/dealerid' . $suffix; ?>";
                        $(this).attr('checkAction', '1');

                        if(checkAction == 0){

                            var dataTarget = $(this).attr('data-target');
                            var dealerId = $("#selectDealerId").val();
                            // console.log("dataTarget:"+dataTarget);
                            // console.log("dealerId:"+dealerId);
                            $.ajax({
                                    
                                    url: url,
                                    
                                    type: "post",
                                    
                                    dataType: "json",
                                    
                                    data: {_csrf :_csrf,getContent:"true",dealerId:dealerId},

                                    beforeSend: function () {
                                       idClick.html('Đang xử lý ....');
                                    },

                                    success: function (res) {
                                        // console.log(res);
                                        // console.log("res.errorCode:" + res.errorCode);
                                        idClick.attr('checkAction', '0');
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
                      //==========================================
                     
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

                      //==========================================
                      //==========================================
                      $('body').on('click', '#acceptServiceProductIds', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        if(accept){
                          $('#serviceId').addClass('hide');
                        }
                        $('#msisdn').removeClass('hide');

                        var idClick = $('#acceptServiceProductIds');
                        var serviceProductIds = $('#selectServiceProductIds');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/serviceid' . $suffix; ?>";
                        $(this).attr('checkAction', '1');

                        if(checkAction == 0){

                            var dataTarget = $(this).attr('data-target');
                            var serviceProductIds = serviceProductIds.val();
                            // console.log("dataTarget:"+dataTarget);
                            // console.log("serviceId:"+serviceId);
                            $.ajax({
                                    
                                    url: url,
                                    
                                    type: "post",
                                    
                                    dataType: "json",
                                    
                                    data: {_csrf :_csrf,getContent:"true",serviceId:serviceProductIds},

                                    beforeSend: function () {
                                       idClick.html('Đang xử lý ....');
                                    },

                                    success: function (res) {
                                        // console.log(res);
                                        // console.log("res.errorCode:" + res.errorCode);
                                        idClick.attr('checkAction', '0');
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
                       //==========================================
                      //==========================================
                      $('body').on('change', '#selectServiceProductIds', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        if(accept){
                          $('#dealerId').addClass('hide');
                        }
                        $('#serviceId').removeClass('hide');
                        var idChange = $('#selectServiceProductIds');
                        var idClick = $('#acceptServiceProductIds');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/serviceid' . $suffix; ?>";
                        $(this).attr('checkAction', '1');
                       

                        if(checkAction == 0){

                            // var dataTarget = $(this).attr('data-target');
                            var serviceId = $(this).val();
                            // console.log("dataTarget:"+dataTarget);
                            // console.log("serviceId:"+serviceId);
                            $.ajax({
                                    
                                    url: url,
                                    
                                    type: "post",
                                    
                                    dataType: "json",
                                    
                                    data: {_csrf :_csrf,getContent:"true",serviceId:serviceId},

                                    beforeSend: function () {
                                       idClick.html('Đang xử lý ....');
                                    },

                                    success: function (res) {
                                        // console.log(res);
                                        // console.log("res.errorCode:" + res.errorCode);
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
                      //==========================================
                      //==========================================
                      $('body').on('click', '#acceptMsisdn', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        

                        var idClick = $('#acceptMsisdn');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/msisdn' . $suffix; ?>";
                        $(this).attr('checkAction', '1');

                        if(checkAction == 0){

                            var dataTarget = $(this).attr('data-target');
                            var msisdn = $("#"+dataTarget).val();
                            // console.log("dataTarget:"+dataTarget);
                            // console.log("msisdn:"+msisdn);
                            // console.log("msisdn.length:"+msisdn.length);
                            if(msisdn.length > 0){
                              if(accept){
                                $('#msisdn').addClass('hide');
                              }
                              
                              $.ajax({
                                    
                                    url: url,
                                    
                                    type: "post",
                                    
                                    dataType: "json",
                                    
                                    data: {_csrf :_csrf,getContent:"true",msisdn:msisdn},

                                    beforeSend: function () {
                                       idClick.html('Đang xử lý ....');
                                    },

                                    success: function (res) {
                                        // console.log(res);
                                        // console.log("res.errorCode:" + res.errorCode);
                                        idClick.attr('checkAction', '0');
                                        idClick.html(res.message);
                                        if(res.status){
                                            $('#btnSent').removeClass('hide');
                                        }else{
                                            $('#btnSent').addClass('hide');
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                            }else{
                                idClick.attr('checkAction', '0');
                                idClick.html('Vui lòng nhập số điện thoại');
                            }
                            
                          }else{
                              console.log("Dang xu ly");
                          }
                      });
                      //==========================================
                      //==========================================
                      $('body').on('click', '#inVite', function(event) {
                        event.preventDefault();
                        /* Act on the event */
                        var idClick = $('#inVite');
                        var checkAction = $(this).attr('checkAction');
                        var _csrf       = "<?=Yii::$app->request->getCsrfToken()?>";
                        var   url       = "<?php echo $baseUrl .$module.'/sendone' . $suffix; ?>";
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
                                    // idClick.html('Gửi tin nhắn thành công');
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
                      //==========================================
                      //==========================================
                  });
                </script>