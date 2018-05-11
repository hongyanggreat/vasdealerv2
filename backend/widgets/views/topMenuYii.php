<?php 
  use yii\helpers\Html;
 ?>
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=" dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Hộp thư</span> <span class="label label-important">5</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#">Tin nhắn mới</a></li>
        <li><a class="sInbox" title="" href="#">Tin nhắn</a></li>
        <li><a class="sOutbox" title="" href="#">Thư gửi</a></li>
        <li><a class="sTrash" title="" href="#">Thùng rác</a></li>
      </ul>
    </li>
     <?php 
        $userID = '';
        if (!Yii::$app->user->isGuest) {
            $userID     =  Yii::$app->user->identity->USERNAME;
        }
     ?>
    <li class=""><a title="" href="#"><i class="icon icon-user"></i> <span class="text"><?= $userID ?></span></a></li>
    <li class=""><?= Html::a('Đăng xuất', ['/site/logout'], ['data' => ['confirm' => 'Bạn có chắc muốn thoát?','method' => 'post']]) ?></li>
  </ul>
</div>