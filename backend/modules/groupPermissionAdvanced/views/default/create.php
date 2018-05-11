<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\Users\models\Accounts */

$this->title = 'Thêm mới quyền cho nhóm tài khoản';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách quyền nhóm tài khoản', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
        'dataGroupAccount' => $dataGroupAccount,
        'dataProviders' => $dataProviders,
    ]) ?>
