<?php 
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use backend\widgets\ButtonWidget;
    use backend\widgets\ButtonControlWidget;
    $baseUrl = Yii::$app->params['baseUrl'];
    $suffix = Yii::$app->params['suffix'];
    $module    = Yii::$app->controller->module->id;
    $this->title = 'Quản lý module';

 ?>

<div class="container-fluid">
  <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-ok-sign"></i> </span>
            <h5>Danh sách User</h5>
            <?php echo ButtonWidget::widget(['data'=>[
                  'ID'=>null,
                  'TITLE'=>'Danh sách tài khoản',
                ]]) ?>
              
          </div>
          <div class="widget-content nopadding">
          <?php $form = ActiveForm::begin([
                'id' => 'formRecord',
                'action' => '',
                'options' => [
                    'class' => 'form-horizontal'
                 ]
            ]); ?>
           
            <table class="table table-bordered table-striped data-table">
              <thead>
                <tr>
                  <th style="width:50px;text-align: center;">STT</th>
                  <th>ID</th>
                  <th>Source</th>
                  <th>Tên</th>
                  <th>Miêu tả</th>
                  <th>Trạng thái</th>
                  <th>Tạo bởi</th>
                  <th>Tạo ngày</th>
                  <th>Chức năng</th>
                </tr>
                </thead>
                <tbody>

                <?php 

                
                  if(isset($dataProviders) && count($dataProviders)>0){

                    foreach ($dataProviders as $key => $dataProvider) {
                       
                        $id          =$dataProvider['MODULE_ID'];
                        $resource    =$dataProvider['RESOURCE'];
                        $name        =$dataProvider['NAME'];
                        $description =$dataProvider['DESCRIPTION'];
                        $create_by   =$dataProvider['CREATE_BY'];
                        $create_date =$dataProvider['CREATE_DATE'];
                        $create_date = date('d-m-Y',$create_date);

                        $status      = $dataProvider['STATUS'];
                        switch ($status) {
                          case '0':
                            $status = '<i class="icon icon-lock"></i>';
                            break;
                          case '1':
                            $status = '<i class="icon icon-ok-sign"></i>';
                           # code...
                           break;
                          case '2':
                            $status = '<i class="icon icon-minus-sign"></i>';
                           # code...
                           break;
                          
                          default:
                            $status = '<i class="icon icon-eye-open"></i>';
                            # code...
                            break;
                        }
                    
                 ?>
                <tr>
                    <td style="text-align: center;width: 50px;"><?= $key +1  ?></td>
                    <td style="text-align: center;width: 50px;"><?= $id  ?></td>
                    <td style="text-align: left;"><?= $resource  ?></td>
                    <td style="text-align: left;width: 200px;"><?= $name  ?></td>
                    <td style="text-align: left;width: 200px;"><?= $description  ?></td>
                    <td style="text-align: center;width: 60px;"><?= $status  ?></td>
                    <td style="text-align: center;width: 60px;"><?= $create_by  ?></td>
                    <td style="text-align: center;width: 100px;"><?= $create_date  ?></td>
                    <td style="text-align: center;width: 100px;"><?php 

                        echo  ButtonControlWidget::widget(['dataProvider'=>[
                                  'task'       =>'ButtonControl2',
                                  'ID'         =>$id,
                                  'URL_UPDATE' =>$baseUrl.$module.'/update'.$suffix.'?id='.$id,
                                  'URL_VIEW'   =>$baseUrl.$module.'/view'.$suffix.'?id='.$id,
                                  'URL_DELETE' =>$baseUrl.$module.'/delete'.$suffix.'?id='.$id,
                                ]]); 
                     ?></td>
                </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
            </table>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
        </div>
  </div>
</div>