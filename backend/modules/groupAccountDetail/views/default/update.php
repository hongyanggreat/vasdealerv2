<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\groupAccountDetail\models\GroupAccDetail */

$this->title = 'Cập nhật nhóm tài khoản chi tiết: ' . $model->ACC_ID;
$this->params['breadcrumbs'][] = ['label' => 'Nhóm tài khoản chi tiết', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ACC_ID, 'url' => ['view', 'ACC_ID' => $model->ACC_ID, 'GROUP_ID' => $model->GROUP_ID]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="group-acc-detail-update">

    <?= $this->render('_form', [
        'model'            => $model,
		'dataUser'         => $dataUser,
		'dataGroupAccount' => $dataGroupAccount,
		'subject'          => 'Cập nhật nhóm tài khoản',
    ]) ?>

</div>
