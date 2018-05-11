<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\Users\models\Accounts */

$this->title = 'Tạo tài khoản';
$this->params['breadcrumbs'][] = ['label' => 'Tài khoản', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-create">
    <?= $this->render('_form', [
        'model' => $model,
        'subject' => 'Tạo mới tài khoản',
    ]) ?>

</div>
