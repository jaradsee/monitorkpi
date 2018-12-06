<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Riskplace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riskplace-form">

    <?php $form = ActiveForm::begin(); ?>
 <div class="panel panel-default">
    <div class="panel-body">
        <h3>PLACE</h3>
    

    <?= $form->field($model, 'PLACE_NAME')->textInput(['maxlength' => true]) ?>
     </div>
      </div>
     <div class="panel panel-default">
    <div class="panel-body">
        <h3>ADDDEP</h3>
   <?= $form->field($modelDep, 'ADDDEP_ID')->textInput(['maxlength' => true]) ?>
    <?= $form->field($modelDep, 'DEP_NAME')->textInput(['maxlength' => true]) ?>
   
  </div>
  </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
