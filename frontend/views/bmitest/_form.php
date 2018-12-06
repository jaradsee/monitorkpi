<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use yii\helpers\Url;

use frontend\models\grouptest;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bmitest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bmitest-form">

  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

  <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>

  <div class="col-sm-12 col-md-12">

      <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
      <div>
          <?=
          FileInput::widget([
              'name' => 'upload_ajax[]',
              'options' => ['multiple' => true, 'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
              'pluginOptions' => [
                  'overwriteInitial' => false,
                  'initialPreviewShowDelete' => true,
                  'initialPreview' => $initialPreview,
                  'initialPreviewConfig' => $initialPreviewConfig,
                  'uploadUrl' => Url::to(['/bmitest/upload-ajax']),
                  'uploadExtraData' => [
                      'ref' => $model->ref,
                  ],
                  'maxFileCount' => 100
              ]
          ]);
          ?>
      </div>

    <?php echo "<label class='control-label'>วันที่ให้บริการ</label>";


            //echo "<div class='col col-sm-9'>";
            echo DatePicker::widget([
                'model' => $model,
                //'language' => 'th',
                //'dateFormat' => 'dd-MM-yyyy',
                'attribute' => 'dateserv',
                'options' => ['placeholder' => 'เลือก วันที่ ...'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-m-d',
                    'todayHighlight'=> true,
                  ]
            ]);
          //echo "</div><br>";
          echo "<br>";
?>

<?=
$form->field($model, 'groupid')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(grouptest::find()->all(), 'GROUP_ID', 'GROUP_NAME'),
    'options' => ['placeholder' => 'เลือกกลุ่มทดสอบ ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

    <?= $form->field($model, 'cid')->textInput(['readonly' => true, 'value' => $_GET['cid'] ]) ?>

    <?= $form->field($model, 'fname')->textInput(['readonly' => true, 'value' => $_GET['fname'] ]) ?>

    <?= $form->field($model, 'lname')->textInput(['readonly' => true, 'value' => $_GET['lname'] ]) ?>

    <?= $form->field($model, 'age')->textInput(['readonly' => true, 'value' => $_GET['age'] ]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>



    

    <?= $form->field($model, 'waistline')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['readonly' => true, 'value' => $_GET['sex'] ]) ?>

    <?= $form->field($model, 'bpsys')->textInput() ?>

    <?= $form->field($model, 'bpdi')->textInput() ?>

    <?= $form->field($model, 'heartrate')->textInput() ?>


    <?= $form->field($model, 'pushup')->textInput() ?>

    <?= $form->field($model, 'situp')->textInput() ?>

    <?= $form->field($model, 'flexibility')->textInput() ?>

    <?= $form->field($model, 'gripst')->textInput() ?>

    <?= $form->field($model, 'legpress')->textInput() ?>

    <?= $form->field($model, 'run2400')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
