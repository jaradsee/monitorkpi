<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rerisk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rerisk-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rerisk_date')->textInput() ?>

    <?= $form->field($model, 'reviwrisk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_recive')->textInput() ?>

    <?= $form->field($model, 'time_recive')->textInput() ?>

    <?= $form->field($model, 'input_complain')->textInput() ?>

    <?= $form->field($model, 'risk_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'safety')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum_solve')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'risk_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'risk_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'risk_sum_dep')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'risk_simple')->textInput() ?>

    <?= $form->field($model, 'date_input')->textInput() ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'staff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_staff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dep_risk_head')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sentinel')->textInput() ?>

    <?= $form->field($model, 'covenant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
