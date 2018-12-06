<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
use app\models\Adddep;
use app\models\Dep;
use app\models\Status;
use app\models\Simple;
use yii\helpers\VarDumper;
use kartik\widgets\DepDrop;
use kartik\widgets\TypeaheadBasic;
use app\models\Complain;
use app\models\Result;
use app\models\Sentinel;

/* @var $this yii\web\View */
/* @var $model app\models\Priskhead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rerisk-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


<?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
    <div class="row">

<div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'rerisk_date')->widget(
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

        <div class="col-xs-4 col-sm-2 col-md-2">
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

        <div class="col-xs-4 col-sm-2 col-md-2">
            <?= $form->field($model, 'time_recive')->textInput(['maxlength' => true]) ?>

        </div>
        
      

</div>

<?= $form->field($model, 'reviwrisk')->textarea(['rows' => 3]) ?>





<?= $form->field($model, 'risk_sum_dep')->textInput() ?>



</div>


</div>

<div class="col-sm-6 col-md-6 col-md-6">
    <?= $form->field($model, 'program_text')->textInput(['maxlength' => true]) ?>
</div>

<div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'risk_simple')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Simple::find()->all(), 'SIMPLE_ID', 'SIMPLE_NAME'),
        'options' => ['placeholder' => 'เลือกหัวข้อตาม simple ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>   



</div>



<div class="col-sm-6 col-md-6 col-md-6">
    <?=
    $form->field($model, 'input_complain')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Complain::find()->all(), 'COMPLAIN_ID', 'COMPLAIN_NAME'),
        'options' => ['placeholder' => 'เลือกช่องทางรับเรื่องร้องเรียน ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>   
</div>
<div>
    <?=
    $form->field($model, 'dep_risk_head')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => ArrayHelper::map(Dep::find()->all(), 'DEP_ID', 'FULLNAME'),
        'options' => [ 'placeholder' => 'เลือกหน่วยงาน/ทีมนำที่เกี่ยวข้อง ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


</div> 



  

<div class="form-group field-upload_files">
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
                'uploadUrl' => Url::to(['/rerisk/upload-ajax']),
                'uploadExtraData' => [
                    'ref' => $model->ref,
                ],
                'maxFileCount' => 100
            ]
        ]);
        ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' btn-lg btn-block']) ?>
</div>

<?php ActiveForm::end(); ?>