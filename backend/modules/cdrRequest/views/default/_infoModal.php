    <!-- /.modal -->
  <div class="modal modal-default fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Thông tin chi tiết</h4>
        </div>
        <div class="modal-body">
          <div class="row">
             <div class="col-md-12">
              <!-- Profile Image -->
             <div class="box box-success">
                <?php 
                  $classLabelName = "label text-green";
                  $classTextName = "text-red";
                 ?>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">ID</span>  : <span id="cdr-id" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Request đồng bộ</span>  : <span id="cdr-reqId" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">ID tổng đại lý</span>  : <span id="cdr-masterId" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">ID của Agent</span>  : <span id="cdr-agentId" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">ID của giao dịch</span>  : <span id="cdr-transactionId" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Thời gian phát sinh sự kiện</span>  : <span id="cdr-timeEvent" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Mô tả sự kiện</span>  : <span id="cdr-action" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Mức cước gốc</span>  : <span id="cdr-orginalPrice" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Giá cước hệ thống</span>  : <span id="cdr-price" class="<?= $classTextName ?>"> .......... </span>
                    
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Khuyến mại</span>  : <span id="cdr-promotion" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Số lần đã trừ cước</span>  : <span id="cdr-chargeCount" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Lý do đăng ký không thành công</span>  : <span id="cdr-resultCode" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Mã lỗi</span>  : <span id="cdr-errorCode" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="<?= $classLabelName ?>">Mô tả lỗi</span>  : <span id="cdr-errorDes" class="<?= $classTextName ?>"> .......... </span>
                  </h3>
                </div> 
              </div>
              <!-- /.box -->
        </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <script>
    
    $(document).ready(function() {
        $('body').on('click', '.showInfo', function(event) {
          var dataJsonId = $(this).attr('data-json');
          var id            = " .......... ";
          var reqId         = " .......... ";
          var masterId      = " .......... ";
          var agentId       = " .......... ";
          var transactionId = " .......... ";
          var timeEvent     = " .......... ";
          var action        = " .......... ";
          var orginalPrice  = " .......... ";
          var price         = " .......... ";
          var promotion     = " .......... ";
          var chargeCount   = " .......... ";
          var resultCode    = " .......... ";
          var errorCode     = " .......... ";
          var errorDes      = " .......... ";
          console.log(dataJsonId);
          if(dataJsonId){
              
              var dataJson = jQuery.parseJSON( dataJsonId );
              console.log(dataJson);

              id            = dataJson.ID;
              reqId         = dataJson.REQUEST_ID;
              masterId      = dataJson.MASTER_ID;
              agentId       = dataJson.AGENT_ID;
              transactionId = dataJson.TRANSACTION_ID;
              timeEvent     = dataJson.TIMESTAMP;
              action        = dataJson.ACTION;
              orginalPrice  = dataJson.ORGINAL_PRICE;
              price         = dataJson.PRICE;
              promotion     = dataJson.PROMOTION;
              chargeCount   = dataJson.CHARGE_COUNT;
              resultCode    = dataJson.RESULT_CODE;
              errorCode     = dataJson.ERROR_CODE;
              errorDes      = dataJson.ERROR_DESC;
          }else{
            console.log("khong co thong tin");
          }

          $('body').find('#cdr-id').html(id);
          $('body').find('#cdr-reqId').html(reqId);
          $('body').find('#cdr-masterId').html(masterId);
          $('body').find('#cdr-agentId').html(agentId);
          $('body').find('#cdr-transactionId').html(transactionId);
          $('body').find('#cdr-timeEvent').html(timeEvent);
          $('body').find('#cdr-action').html(action);
          $('body').find('#cdr-orginalPrice').html(orginalPrice);
          $('body').find('#cdr-price').html(price);
          $('body').find('#cdr-promotion').html(promotion);
          $('body').find('#cdr-chargeCount').html(chargeCount);
          $('body').find('#cdr-resultCode').html(resultCode);
          $('body').find('#cdr-errorCode').html(errorCode);
          $('body').find('#cdr-errorDes').html(errorDes);

        });
    });
  </script>