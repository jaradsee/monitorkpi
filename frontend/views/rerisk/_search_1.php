<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReriskSearh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rerisk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'risk_id') ?>

    <?= $form->field($model, 'rerisk_date') ?>

    <?= $form->field($model, 'reviwrisk') ?>

    <?= $form->field($model, 'ref') ?>

    <?= $form->field($model, 'date_recive') ?>

    <?php // echo $form->field($model, 'time_recive') ?>

    <?php // echo $form->field($model, 'input_complain') ?>

    <?php // echo $form->field($model, 'risk_time') ?>

    <?php // echo $form->field($model, 'safety') ?>

    <?php // echo $form->field($model, 'sum_solve') ?>

    <?php // echo $form->field($model, 'risk_level') ?>

    <?php // echo $form->field($model, 'risk_status') ?>

    <?php // echo $form->field($model, 'program_text') ?>

    <?php // echo $form->field($model, 'login_name') ?>

    <?php // echo $form->field($model, 'risk_sum_dep') ?>

    <?php // echo $form->field($model, 'risk_simple') ?>

    <?php // echo $form->field($model, 'date_input') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'staff') ?>

    <?php // echo $form->field($model, 'last_staff') ?>

    <?php // echo $form->field($model, 'dep_risk_head') ?>

    <?php // echo $form->field($model, 'sentinel') ?>

    <?php // echo $form->field($model, 'covenant') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
