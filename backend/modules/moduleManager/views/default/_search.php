<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\moduleManager\models\ModulesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modules-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MODULE_ID') ?>

    <?= $form->field($model, 'RESOURCE') ?>

    <?= $form->field($model, 'NAME') ?>

    <?= $form->field($model, 'DESCRIPTION') ?>

    <?= $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_DATE') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'TYPE') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
