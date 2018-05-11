<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\groupAccountDetail\models\GroupAccDetail */

$this->title = 'Thêm mới nhóm tài khoản chi tiết';
$this->params['breadcrumbs'][] = ['label' => 'Nhóm tài khoản chi tiết', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-acc-detail-create">

    <?= $this->render('_form', [
		'model'            => $model,
		'dataUser'         => $dataUser,
		'dataGroupAccount' => $dataGroupAccount,
		'subject'          => 'Thêm mới nhóm tài khoản',
    ]) ?>

</div>
