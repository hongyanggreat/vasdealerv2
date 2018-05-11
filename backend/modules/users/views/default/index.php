<?php 
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use backend\widgets\ButtonWidget;
    use backend\widgets\ButtonControlWidget;
    $baseUrl = Yii::$app->params['baseUrl'];
    
    $module    = Yii::$app->controller->module->id;
    $this->title = 'Danh sách tài khoản';
    $this->params['breadcrumbs'][] = $this->title;
    

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
                  <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th style="width:50px;text-align: center;">STT</th>
                  <th>ID</th>
                  <th>Tài khoản</th>
                  <th>Cp Code</th>
                  <th>Parent</th>
                  <th>Điện thoại</th>
                  <th>Email</th>
                  <th>Trạng thái</th>
                  <th>Tạo ngày</th>
                  <th>Chức năng</th>
                </tr>
                </thead>
                <tbody>

                <?php 

                
                  if(isset($dataProviders) && count($dataProviders)>0){

                    foreach ($dataProviders as $key => $dataProvider) {
                       
                        $id          =$dataProvider['ACC_ID'];
                        $user        =$dataProvider['USERNAME'];
                        $cpCode      =$dataProvider['CP_CODE'];
                        $status      =$dataProvider['STATUS'];
                        $phone      =$dataProvider['PHONE'];
                        $email      =$dataProvider['EMAIL'];
                        $create_date = $dataProvider['CREATE_DATE'];
                        $create_date = date('d-m-Y',$create_date);
                        $parent = '-';
                        $parent   = $dataProvider['parent'];
                        if(isset($parent) && !empty($parent)){
                           $parent =  $parent['USERNAME'];
                        }else{
                           $parent =  '---';
                        }

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
                    <td style="text-align: center;width: 50px;"><input type="checkbox" /></td>
                    <td style="text-align: center;width: 50px;"><?= $key +1  ?></td>
                    <td style="text-align: center;width: 50px;"><?= $id  ?></td>
                    <td style="text-align: center;"><?= $user  ?></td>
                    <td style="text-align: center;width: 100px;"><?= $cpCode  ?></td>
                    <td style="text-align: center;width: 100px;"><?= $parent  ?></td>
                    <td style="text-align: center;width: 100px;"><?= $phone  ?></td>
                    <td style="text-align: left;width: 100px;"><?= $email  ?></td>
                    <td style="text-align: center;width: 60px;"><?= $status  ?></td>
                    <td style="text-align: center;width: 100px;"><?= $create_date  ?></td>
                    <td style="text-align: center;width: 100px;"><?php 
                        echo  ButtonControlWidget::widget(['dataProvider'=>[
                                  'task'       =>'ButtonControl2',
                                  'ID'         =>$id,
                                  'URL_UPDATE' =>$baseUrl.$module.'/update?id='.$id,
                                  'URL_VIEW'   =>$baseUrl.$module.'/view?id='.$id,
                                  'URL_DELETE' =>$baseUrl.$module.'/delete?id='.$id,
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