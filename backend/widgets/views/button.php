<?php 
	use yii\helpers\Html;
	$baseUrl = Yii::$app->params['baseUrl'];

	$module     = Yii::$app->controller->module->id;
	$action     = Yii::$app->controller->action->id;
	$linkModule = $module;
	$arrActions = Yii::$app->acl->getRole();
	//echo '<pre>';print_r($arrActions);
	$linkHome = ['/'.$linkModule];
	if(isset($data['linkHome'])){
		$linkHome     = $data['linkHome'];
	}
	$linkSearch   = $baseUrl.$linkModule.'?search';
	$linkDownload = $baseUrl.$linkModule.'/download';
	$linkCreate   = ['create'];
	if(isset($data['linkCreate'])){
		$linkCreate = $data['linkCreate'];
	}
	$id = null;
	if(isset($data['ID']) && $data['ID'] != null){
		$id = $data['ID'];
	}
	$linkView   = ['view', 'id' => $id];
	if(isset($data['linkView'])){
		$linkView = $data['linkView'];
	}
	$linkUpdate = ['update', 'id' => $id];
	if(isset($data['linkUpdate'])){
		$linkUpdate = $data['linkUpdate'];
	}
    
 ?>
<?php 
	if(in_array('index', $arrActions)){

 ?>
		<span class="icon"><?= Html::a('Danh sách', $linkHome, ['title' => Yii::t('app', $data['TITLE']),'class' => '','style'=>'padding:0 2px;']) ?></span>
		
		<!-- <a href="#collapseOne" data-toggle="collapse" title="Tìm kiếm">
		          <span class="icon"><i class="icon icon icon-search"></i> Tìm kiếm</span>
		        </a>
		
		 <span class="icon"><a class="" href="<?= $linkSearch ?>" title="Tìm kiếm" style="padding:0 2px;"><i class=" icon-zoom-in" style="color:#fff"></i> Tìm kiếm</a></span> -->
	    
	 <?php } ?>
	<?php 
	    if((isset($action) && $action =="index" && in_array('download', $arrActions)) && 1!=1){

	 ?>
 		<span class="icon"><a class="" href="<?= $linkDownload ?>" title="Tải xuống nhanh" style="padding:0 2px;"><i class="icon icon-download-alt" style="color:#fff"></i> <!-- Xuất file CSV --></a></span>

 	<?php } ?>
 <?php 
    if(isset($action) && $action =="index" && in_array('create', $arrActions)){

 ?>
	<span class="icon"><?= Html::a('Thêm mới', $linkCreate, ['title' => Yii::t('app', 'Thêm mới'),'class' => '','style'=>'padding:0 2px;']) ?></span>
 <?php 
    }else if(isset($action) && $action =="update"){
 ?>
 	<?php 
		if(in_array('create', $arrActions)){

	 ?>
     	<span class="icon"><?= Html::a('Thêm mới', $linkUpdate, ['title' => Yii::t('app', 'Thêm mới'),'class' => '','style'=>'padding:0 2px;']) ?></span>
     <?php } ?>
	<?php 
		if(in_array('view', $arrActions)){

	 ?>
     	<span class="icon"><?= Html::a('Chi tiết', $linkView, ['title' => Yii::t('app', 'Xem chi tiết'),'class' => '','style'=>'padding:0 2px;']) ?></span>
   	<?php } ?>
<?php 
	}else if(isset($action) && $action =="view"){
?>
	<?php 
		if(in_array('create', $arrActions)){

	 ?>
	<span class="icon"><?= Html::a('Thêm mới', $linkCreate, ['title' => Yii::t('app', 'Thêm mới'),'class' => '','style'=>'padding:0 2px;']) ?></span>
	<?php } ?>
	<?php 
		if(in_array('update', $arrActions)){

	 ?>
     <span class="icon"><?= Html::a('Cập nhật', $linkUpdate, ['title' => Yii::t('app', 'Cập nhật'),'class' => '','style'=>'padding:0 2px;']) ?></span>
	<?php } ?>	
	
<?php 
	} 
?>