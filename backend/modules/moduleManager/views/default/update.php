<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\moduleManager\models\Modules */

$this->title = 'Cập nhật Module: ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách Module', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->MODULE_ID]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="modules-update">

    <?= $this->render('_form', [
        'model' => $model,
        'subject'=>'Cập nhật Module',
    ]) ?>

</div>
