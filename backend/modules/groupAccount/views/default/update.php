<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\groupAccount\models\GroupAccount */

$this->title = 'Cập nhật nhóm tài khoản: ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Nhóm tài khoản', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->GROUP_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-account-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataModule' => $dataModule,
        'subject' => 'Cập nhật nhóm tài khoản',
    ]) ?>

</div>
