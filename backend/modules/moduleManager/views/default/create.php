<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\moduleManager\models\Modules */

$this->title = 'Thêm mới Modules';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách module', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-create">
    <?= $this->render('_form', [
        'model' => $model,
        'subject' => 'Thêm module',
    ]) ?>

</div>
