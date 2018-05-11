  <?php 
      use backend\wgAdminLte\ButtonFuncWidget;
      use yii\widgets\ActiveForm;
      use yii\helpers\Html;
      $baseUrl = Yii::$app->params['baseUrl'];
      $suffix = Yii::$app->params['suffix'];
      $module    = Yii::$app->controller->module->id;
      // HEAD 
      $this->title = 'Thêm mới dealer';
   ?>

    
      <section class="content-header">
        <h1>
          <?=  $this->title ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= $baseUrl ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?= $baseUrl .$module .$suffix ?>">Dealers</a></li>
          <li class="active">Danh sách</li>
        </ol>

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
        <br>
        <div class="row">
            <div class="col-md-6">
               <div class="box box-solid box-<?=$classAlert ?>">
                    <div class="box-header with-border">
                       <span type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</span>
                              <h4><i class="icon fa <?= $iconAlert ?>"></i> <b><?= $messAlert ?></b></h4>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
      </section>
      

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <button type="button" class="btn btn-primary" id="linkFunction" data-target="<?= $baseUrl .$module .$suffix ?>">Danh sách</button>
          
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        
        <?php $form = ActiveForm::begin([
                //'action' => '/login',
                'options' => [
                    'class' => 'formDealer'
                 ]
            ]); ?>

        <!-- /.box-header -->
        <div class="box-body">
          
          <div class="row">
            <div class="col-md-6">
              <!-- /.form-group -->
              <div class="form-group">
                <?= $form->field($model, 'NAME', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Tên Dealer'])->label('Tên Dealer') ?>
                 
                <?= $form->field($model, 'CODE', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Mã Dealer'])->label('Mã Dealer') ?>
               <?php 
                    $status = [1 => 'Kích hoạt', 0 =>'Không kích hoạt'];
                    if(isset($action) && $action =="update"){
                        if($model->STATUS == 0){
                            $status   = [ 0 =>'Không kích hoạt',1 => 'Kích hoạt',2=>'Hủy kích hoạt'];
                        }else{
                            $status   = [1 => 'Kích hoạt',2=>'Hủy kích hoạt'];
                        }
                    }else{

                        $model->STATUS = 1;
                    }
                 ?>
                <?php //$form->field($model, 'STATUS',['template' => '{label} <div class="controls">{input}{error}{hint}</div>','options' => ['class' => 'control-group']])->dropDownList($status)->label('Trạng thái')?>
                
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <!-- /.form-group -->
              <div class="form-group">
            
                <?= $form->field($model, 'EMAIL', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'email'])->label('Email') ?>
                
                <?= $form->field($model, 'MSISDN', ['template' => '{label} {input}{error}{hint}','options' => ['class' => '']])->textInput(['class'=>'form-control','placeholder'=>'Nhập số điện thoại'])->label('Số điện thoại') ?>
                

                <?php 
                    // echo  $form->field($model, 'STATUS')
                    //     ->radioList(
                    //         $status,
                    //         [
                    //             'item' => function($index, $label, $name, $checked, $value) {

                    //                 $return = '<label class="modal-radio">';
                    //                 $return .= '<input type="radio" class="flat-red" name="' . $name . '" value="' . $value . '" tabindex="3">';
                    //                 $return .= '<i></i>';
                    //                 $return .= '<span> ' . ucwords($label) . '</span>';
                    //                 $return .= '</label>';

                    //                 return $return;
                    //             }
                    //         ]
                    //     )
                    // ->label(false);
                ?>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
          </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.box-body -->
        <div class="box-footer">
          Hỗ trợ support  - duongnh - 0964.933.669
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->