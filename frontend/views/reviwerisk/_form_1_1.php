<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use frontend\models\Simple;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reviwerisk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviwerisk-form">

     <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
        <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'reviwerisk_date')->widget(
                    DatePicker::className(), [
                'language' => 'th',
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
   
 <div class="col-sm-6-6 col-md-6">
            <?= $form->field($model, 'risk_time')->textInput(['maxlength' => true]) ?>

        </div>
    <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'date_recive')->widget(
                    DatePicker::className(), [
                'language' => 'th',
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
    
    <div class="col-md-6 col-md-6">
            <?= $form->field($model, 'time_recive')->textInput(['maxlength' => true]) ?>

        </div>
    
  <div class="col-md-6 col-md-6"> 
    <?= $form->field($model, 'reviwe_detial')->textarea(['rows' => 3]) ?>

   
   </div>
    
 <div class="col-sm-6 col-md-6">


            <?=
            $form->field($model, 'risk_simple')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\frontend\models\Simple::find()->all(), 'SIMPLE_ID', 'SIMPLE_NAME'),
                'options' => ['placeholder' => 'เลือกแแผนก ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>   


   

   
    

    <?= $form->field($model, 'safety')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum_solve')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'risk_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'program_text')->textInput(['maxlength' => true]) ?>

  

    <?= $form->field($model, 'risk_sum_dep')->textInput(['maxlength' => true]) ?>

   

    

    <?= $form->field($model, 'dep_risk_head')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sentinel')->textInput() ?>

    <?= $form->field($model, 'covenant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docs')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
