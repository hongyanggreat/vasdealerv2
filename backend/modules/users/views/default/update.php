<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\Users\models\Accounts */

$this->title = 'Cập nhật tài khoản ' . $model->USERNAME;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->USERNAME, 'url' => ['view', 'id' => $model->ACC_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accounts-update">

    <?= $this->render('_form', [
        'model' => $model,
        'subject' => $this->title ,
    ]) ?>

</div>
