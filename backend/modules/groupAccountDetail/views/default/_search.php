<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\groupAccountDetail\models\GroupAccDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-acc-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACC_ID') ?>

    <?= $form->field($model, 'GROUP_ID') ?>

    <?= $form->field($model, 'CREATE_BY') ?>

    <?= $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_DATE') ?>

    <?php // echo $form->field($model, 'DESCRIPTION') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
