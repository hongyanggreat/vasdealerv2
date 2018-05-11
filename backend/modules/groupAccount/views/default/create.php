<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\groupAccount\models\GroupAccount */

$this->title = 'Tạo nhóm tài khoản';
$this->params['breadcrumbs'][] = ['label' => 'Nhóm tài khoản', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-account-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataModule' => $dataModule,
        'subject' => 'Thêm danh sách nhóm tài khoản',
    ]) ?>

</div>
