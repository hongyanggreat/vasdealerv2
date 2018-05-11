<?php 
    $baseUrl   = Yii::$app->params['baseUrl'];
    $suffix    = Yii::$app->params['suffix'];

    // $accLogin = Yii::$app->user->identity;
    // print_r($accLogin);
    $lvUserLogin =  Yii::$app->user->identity->LEVEL;
    $userLogin =  ucfirst(Yii::$app->user->identity->USERNAME);
 ?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= $baseUrl ?>adminVas/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $userLogin ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Thanh điều hướng</li>

        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lý Dealers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $baseUrl.'dealers'.$suffix ?>"><i class="fa fa-circle-o"></i> Dealer</a></li>
            <li><a href="<?= $baseUrl.'dealerRequest'.$suffix ?>"><i class="fa fa-circle-o"></i> Lịch sử</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lý Dịch vụ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $baseUrl.'services'.$suffix ?>"><i class="fa fa-circle-o"></i> Dịch vụ</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Quản lý subscript</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $baseUrl.'subscript/create'.$suffix ?>"><i class="fa fa-circle-o"></i> Gửi lời mời </a></li>
            <li><a href="<?= $baseUrl.'subscript'.$suffix ?>"><i class="fa fa-circle-o"></i> Lịch sử mời</a></li>
            <li><a href="<?= $baseUrl.'subscriptStatus/create'.$suffix ?>"><i class="fa fa-circle-o"></i> Trạng thái gói cước thuê bao</a></li>
            <li><a href="<?= $baseUrl.'subscriptStatus'.$suffix ?>"><i class="fa fa-circle-o"></i> Lịch sử yêu cầu trạng thái thuê bao</a></li>
          </ul>
        </li>
        <li>
          <a href="<?= $baseUrl.'cdrRequest'.$suffix ?>">
            <i class="fa fa-th"></i> <span>Lịch sử đồng bộ cước</span>
          </a>
        </li>
        <li>
          <a href="<?= $baseUrl.'cdrStatic'.$suffix ?>">
            <i class="fa fa-th"></i> <span>Thống kê cước đại lý</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Quản lý tài khoản</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $baseUrl.'users'.$suffix ?>"><i class="fa fa-circle-o"></i> Tài khoản</a></li>
            <li><a href="<?= $baseUrl.'userPermissionAdvanced'.$suffix ?>"><i class="fa fa-circle-o"></i> Phân quyền tài khoản</a></li>
          </ul>
        </li>
        <li>
          <a href="<?= $baseUrl.'moduleManager'.$suffix ?>">
            <i class="fa fa-th"></i> <span>Quản lý module</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Quản lý Nhóm tài khoản</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $baseUrl.'groupAccount'.$suffix ?>"><i class="fa fa-circle-o"></i> Nhóm tài khoản</a></li>
            <li><a href="<?= $baseUrl.'groupAccountDetail'.$suffix ?>"><i class="fa fa-circle-o"></i> Nhóm tài khoản chi tiết</a></li>
            <li><a href="<?= $baseUrl.'userPermissionAdvanced'.$suffix ?>"><i class="fa fa-circle-o"></i> Phân quyền nhóm tài khoản</a></li>
          </ul>
        </li>

        <?php 
            if(1===2){
         ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Sắp xếp gói cước</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $baseUrl.'sortViettel'.$suffix ?>"><i class="fa fa-circle-o"></i> Viettel</a></li>
            <li><a href="<?= $baseUrl.'sortVinaphone'.$suffix ?>"><i class="fa fa-circle-o"></i> Vinaphone</a></li>
            <li><a href="<?= $baseUrl.'sortMobifone'.$suffix ?>"><i class="fa fa-circle-o"></i> Mobifone</a></li>
          </ul>
        </li>  
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>