<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\users\models\AccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ACC_ID') ?>

    <?= $form->field($model, 'PARENT_ID') ?>

    <?= $form->field($model, 'USERNAME') ?>

    <?= $form->field($model, 'PASSWORD') ?>

    <?= $form->field($model, 'PASSWORD_RESET_TOKEN') ?>

    <?php // echo $form->field($model, 'AUTH_KEY') ?>

    <?php // echo $form->field($model, 'PN_CODE') ?>

    <?php // echo $form->field($model, 'FULL_NAME') ?>

    <?php // echo $form->field($model, 'DESCRIPTION') ?>

    <?php // echo $form->field($model, 'ADDRESS') ?>

    <?php // echo $form->field($model, 'PHONE') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_DATE') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'USER_TYPE') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'OPTION_DATA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
