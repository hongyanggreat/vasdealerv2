<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\userPermission\models\UserPermissionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-permission-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACC_ID') ?>

    <?= $form->field($model, 'MODULE_ID') ?>

    <?= $form->field($model, 'ALL_RIGHT')->checkbox() ?>

    <?= $form->field($model, 'VIEW_RIGHT')->checkbox() ?>

    <?php // echo $form->field($model, 'ADD_RIGHT')->checkbox() ?>

    <?php // echo $form->field($model, 'EDIT_RIGHT')->checkbox() ?>

    <?php // echo $form->field($model, 'DEL_RIGHT')->checkbox() ?>

    <?php // echo $form->field($model, 'UP_RIGHT')->checkbox() ?>

    <?php // echo $form->field($model, 'DOWN_RIGHT')->checkbox() ?>

    <?php // echo $form->field($model, 'DESCRIPTION') ?>

    <?php // echo $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_DATE') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'LIST_PERMISSTION') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
