<?php 
	 	$baseUrl = Yii::$app->params['baseUrl'];
	 	$suffix = Yii::$app->params['suffix'];
        $permissions = Yii::$app->acl->getPermissionMenu();

        // $permissions = [
        // 	'users',
        // 	'userPermission',
        // 	'userPermissionAdvanced',

        // 	'groupAccount',
        // 	'groupAccountDetail',
        // 	'groupPermission',
        // 	'groupPermissionAdvanced',

        // 	'moduleManager',

        // 	'providers',
        // 	'service',
        // 	'userService',
        // 	'userServiceRegister',
        // ];

 ?>
 <?php 
 	// Lien ket nhom Quản lý Tài khoản
 	$managerUserGroup  = ''; 
 	$numberLinkManagerUserGroup  = 0; 
	if($permissions && in_array('users', $permissions)){
		$managerUserGroup .= '<li><a href="'.$baseUrl.'users'.$suffix.'">Tài khoản</a></li>';	
		$numberLinkManagerUserGroup += 1;	
	}
	
	if($permissions && in_array('userPermissionAdvanced', $permissions)){
		$managerUserGroup .= '<li><a href="'.$baseUrl.'userPermissionAdvanced'.$suffix.'">Phân quyền tài khoản dạng list</a></li>';		
		$numberLinkManagerUserGroup += 1;	
	}
	
 	// Lien ket nhom Quản lý group
 	$managerGroup  = ''; 
 	$numberLinkManagerGroup  = 0; 
 	if($permissions && in_array('groupAccount', $permissions)){
		$managerGroup .= '<li><a href="'.$baseUrl.'groupAccount'.$suffix.'">Nhóm tài khoản</a></li>';		
		$numberLinkManagerGroup += 1;	
	}
	if($permissions && in_array('groupAccountDetail', $permissions)){
		$managerGroup .= '<li><a href="'.$baseUrl.'groupAccountDetail'.$suffix.'">Nhóm tài khoản chi tiết</a></li>';		
		$numberLinkManagerGroup += 1;	
	}
	/*if($permissions && in_array('groupPermission', $permissions)){
		$managerGroup .= '<li><a href="'.$baseUrl.'groupPermission">Phân quyền nhóm tài khoản</a></li>';		
		$numberLinkManagerGroup += 1;	
	}*/
	if($permissions && in_array('groupPermissionAdvanced', $permissions)){
		$managerGroup .= '<li><a href="'.$baseUrl.'groupPermissionAdvanced'.$suffix.'">Phân quyền nhóm tài khoản Dạng list</a></li>';		
		$numberLinkManagerGroup += 1;	
	}
 	// Lien ket Quản lý Module
 	$moduleManager = '';
	$numberLinkModuleManager = 0;	

 	if($permissions && in_array('moduleManager', $permissions)){
		$moduleManager .= '<li><a href="'.$baseUrl.'moduleManager'.$suffix.'"><i class="icon icon-th-list"></i> <span>Quản lý Module</span> </a></li>';		
		$numberLinkModuleManager += 1;	
	}
	
 ?>



<div id="sidebar"><a href="#" class="visible-phone">Danh mục</a>
	<ul>
	    <li class="active"><a href="<?= $baseUrl ?>"><i class="icon icon-home"></i> <span>Trang người dùng</span></a> </li>
	    <?php 
	    	if($managerUserGroup){

	     ?>
	    <li class="submenu"> 
			<a href="#"><i class="icon icon-th-list"></i> <span>Quản lý Tài khoản</span> <span class="label label-important"><?= $numberLinkManagerUserGroup ?></span></a>
		    <ul>
		        <?= $managerUserGroup ?>
		    </ul>
	    </li>
	    <?php } ?>

	    <?php 
	    	if($managerGroup){

	     ?>
	    <li class="submenu"> 
			<a href="#"><i class="icon icon-th-list"></i> <span>Quản lý group</span> <span class="label label-important"><?= $numberLinkManagerGroup ?></span></a>
		    <ul>
		    	<?= $managerGroup ?>
		    </ul>
	    </li>
	    <?php } ?>

	    <?php 
	    	if($moduleManager){
	    		echo $moduleManager;
	    	}

	     ?>
		

  </ul>
</div>