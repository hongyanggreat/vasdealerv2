<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\moduleManager\models\Modules */

$this->title = 'Cập nhật Dealer: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách Dealer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="modules-update">

    <?= $this->render('_form', [
        'model' => $model,
        'subject'=>'Cập nhật Dealer',
    ]) ?>

</div>
