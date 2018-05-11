<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\moduleManager\models\Modules */

$this->title = 'Thêm mới Dealer';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách Dealer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-create">
    <?= $this->render('_form', [
        'model' => $model,
        'subject' => 'Thêm Dealer',
    ]) ?>

</div>
