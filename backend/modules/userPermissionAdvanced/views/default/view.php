<?php 
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use backend\modules\userPermission\models\UserPermission;
    $module         = Yii::$app->controller->module->id;
    $linkModule     ='/'.$module;
    $idUser         = $dataUser->ACC_ID;
    $username       = $dataUser->USERNAME;
    $linkModuleEdit =$linkModule.'/update?id='.$idUser;
 ?>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
      <div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-ok-sign"></i> </span>
            <h5>Danh sách quyền tài khoản : <?= $username ?></h5>
            <span class="icon"><?= Html::a('<i class="icon icon icon-home" style="color:#fff"></i>', [$linkModule], ['title' => Yii::t('app', 'Danh sách dịch vụ đã đăng ký'),'class' => '','style'=>'padding:0 2px;']) ?></span>
            <?php 
                $arrActions = Yii::$app->acl->role();
                if(in_array('update', $arrActions)){
             ?>
           <span class="icon"><?= Html::a('<i class="icon icon icon-edit" style="color:#fff"></i>', [$linkModuleEdit], ['title' => Yii::t('app', 'Danh sách dịch vụ đã đăng ký'),'class' => '','style'=>'padding:0 2px;']) ?></span>
           <?php } ?>
          </div>
          </div>
          <div class="widget-content">
        
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Tên module</th>
                  <th colspan="2">Trạng thái</th>
                  <th colspan="8">Quyền</th>
                </tr>
                <tr>
                  <th></th>
                  <th>Module</th>
                  <th>User Permission</th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule all" name="radios" /><br>All</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule list" name="radios" /><br>List</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule view" name="radios" /><br>Xem</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule add" name="radios" /><br>Thêm</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule edit" name="radios" /><br>Sửa</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule del" name="radios" /><br>Xóa</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule up" name="radios" /><br>Upload</span></th>
                  <th ><span><input type="checkbox" disabled="" class="checkAllModule down" name="radios" /><br>Download</span></th>
                </tr>
                </thead>
                <tbody>

                <?php 
                  if(isset($dataProviders) && count($dataProviders)>0){
                    $numberRows = count($dataProviders);
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
                      $statusUserPermission  = (int)($dataProvider['statusUserPermission']);
                      if($statusUserPermission){$statusUserPermission = "checked";}else{$statusUserPermission="";}

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
<td style="width:300px;text-align: left;"><?= $nameModule ?></td>

<td style="width:80px;text-align: center;"><span class="" title="<?= $titleStatusModule ?>"><?= $iconStatusModule ?></span></td>


<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusUserPermission ?> class="checkbox" name="status<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightAll ?> class="checkbox" title="All Right" name="allRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightList ?> class="checkbox" title="List Right" name="listRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightView ?> class="checkbox" title="View Right" name="viewRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightAdd ?> class="checkbox" title="Add Right" name="addRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightEdit ?> class="checkbox" title="Edit Right" name="editRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightDel ?> class="checkbox" title="Delete Right" name="deleteRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightUp ?> class="checkbox" title="Upload Right" name="upRight<?= $idModule  ?>" /></span></td>
<td style="width:40px;text-align: center;"><span> <input disabled type="checkbox" <?php echo $statusRightDown ?> class="checkbox" title="Download Right" name="downRight<?= $idModule  ?>" /></span></td>

</tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
        </div>
    </div>
</div>