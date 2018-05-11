<?php 
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use backend\modules\userPermission\models\UserPermission;
    use backend\widgets\ButtonWidget;
    $module     = Yii::$app->controller->module->id;
    $linkModule ='/'.$module;
 ?>
<div class="container-fluid">
  <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-ok-sign"></i> </span>
            <h5>Danh sách phân quyền : <?= $dataGroupAccount->NAME ?></h5>
            <?php echo ButtonWidget::widget(['data'=>['ID'=>$dataGroupAccount->GROUP_ID,'TITLE'=>'Danh sách phân quyền : '.$dataGroupAccount->NAME]]) ?>
          </div>
          <div class="widget-content">
          <?php $form = ActiveForm::begin([
                //'action' => '/login',
                'options' => [
                    'class' => 'form-horizontal'
                 ]
            ]); ?>
            <?php 
                $idUser = $dataGroupAccount->GROUP_ID;
             ?>
            <input type="hidden" name="idGroupAccount" value="<?= $idUser ?>">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Tên module</th>
                  <th colspan="2">Trạng thái</th>
                  <th colspan="8">Quyền</th>
                  
                  <th>Thực hiện</th>
                </tr>
                <tr>
                  <th></th>
                  <th>Module</th>
                  <th ><input type="checkbox" class="checkAllModule permission" id="permission" name="radios" /><br>User Permission</th>
                  <th ><span><input type="checkbox" class="checkAllModule all" id="all" name="radios" /><br>All</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule list" id="list"  name="radios" /><br>List</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule view" id="view" name="radios" /><br>Xem</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule add" id="add" name="radios" /><br>Thêm</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule edit" id="edit" name="radios" /><br>Sửa</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule delelete" id="delete" name="radios" /><br>Xóa</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule upload" id="upload" name="radios" /><br>Upload</span></th>
                  <th ><span><input type="checkbox" class="checkAllModule download" id="download" name="radios" /><br>Download</span></th>
                  
                  <th><?= Html::submitButton('Cập nhật all', ['class' => 'btn btn-success','name'=>'updateAll','value'=>'updateAll','style'=>'    margin-top: -20px;']) ?></th>
                </tr>
                </thead>
                <tbody>

                <?php 
                  if(isset($dataProviders) && count($dataProviders)>0){
                    $numberRows = count($dataProviders);
                    echo '<input type="hidden" name="numberRow" value="'.$numberRows.'">';
                    $checkAllRight = false;
                    foreach ($dataProviders as $key => $dataProvider) {
                      $idModule     = $dataProvider['MODULE_ID'];
                      $nameModule   = $dataProvider['NAME'];
                      $statusModule = $dataProvider['STATUS'];
                      
                      if($statusModule == 0){
                        $titleStatusModule = 'Chưa kích hoạt';
                        $iconStatusModule = '<i class="icon-icon-lock"></i>';
                      }elseif($statusModule == 1){
                        $titleStatusModule = 'Kích hoạt';
                        $iconStatusModule = '<i class="icon-ok-sign"></i>';
                      }elseif($statusModule == 2){
                        $titleStatusModule = 'Hủy kích hoạt';
                        $iconStatusModule = '<i class="icon-ban-circle"></i>';
                      }else{
                        $titleStatusModule = '---';
                        $iconStatusModule = '<i class="icon-ok-sign"></i>';
                      }
                      $statusGroupPermission  = (int)($dataProvider['statusGroupPermission']);
                      if($statusGroupPermission){$statusGroupPermission = "checked";}else{$statusGroupPermission="";}

                      $statusRightAll  = (int)($dataProvider['ALL_RIGHT']);
                      if($statusRightAll){$statusRightAll = "checked";}else{$statusRightAll="";}
                      
                      $statusRightList = (int)($dataProvider['LIST_RIGHT']);
                      if($statusRightList){$statusRightList = "checked";}else{$statusRightList="";}
                      
                      $statusRightView = (int)($dataProvider['VIEW_RIGHT']);
                      if($statusRightView){$statusRightView = "checked";}else{$statusRightView="";}
                      
                      $statusRightAdd  = (int)($dataProvider['ADD_RIGHT']);
                      if($statusRightAdd){$statusRightAdd = "checked";}else{$statusRightAdd="";}
                      
                      $statusRightEdit = (int)($dataProvider['EDIT_RIGHT']);
                      if($statusRightEdit){$statusRightEdit = "checked";}else{$statusRightEdit="";}
                      
                      $statusRightDel  = (int)($dataProvider['DEL_RIGHT']);
                      if($statusRightDel){$statusRightDel = "checked";}else{$statusRightDel="";}
                      
                      $statusRightUp   = (int)($dataProvider['UP_RIGHT']);
                      if($statusRightUp){$statusRightUp = "checked";}else{$statusRightUp="";}
                      
                      $statusRightDown = (int)($dataProvider['DOWN_RIGHT']);
                      if($statusRightDown){$statusRightDown = "checked";}else{$statusRightDown="";}

                    
                 ?>
<tr>
<?php echo '<input type="hidden" name="idModule[]" value="'.$idModule.'">'; ?>
<td style="width:300px;text-align: left;"><?= $nameModule ?></td>
<td style="width:80px;text-align: center;"><span class="" title="<?= $titleStatusModule ?>"><?= $iconStatusModule ?></span></td>

<td style="width:80px;text-align: center;"><span> <input type="checkbox" <?php echo $statusGroupPermission ?> class="checkboxpermission" name="status<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightAll ?> class="checkboxall" title="All Right" name="allRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightList ?> class="checkboxlist" title="List Right" name="listRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightView ?> class="checkboxview" title="View Right" name="viewRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightAdd ?> class="checkboxadd" title="Add Right" name="addRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightEdit ?> class="checkboxedit" title="Edit Right" name="editRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightDel ?> class="checkboxdelete" title="Delete Right" name="deleteRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightUp ?> class="checkboxupload" title="Upload Right" name="upRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input type="checkbox" <?php echo $statusRightDown ?> class="checkboxdownload" title="Download Right" name="downRight<?= $idModule  ?>" /></span></td>


<td style="width:120px;text-align: center;">
    <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-success','name'=>'updateone','value'=>$idModule]) ?>
</td>
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

