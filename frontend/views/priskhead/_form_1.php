<?php

use yii\helpers\Html;

use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;

use frontend\models\Adddep;
use frontend\models\Clinictype;
use frontend\models\Level;
use frontend\models\Status;
use frontend\models\Simple;
use frontend\models\Headmaster;
use frontend\models\Prohead;
use frontend\models\Prodetail;
use frontend\models\Riskplace;
use frontend\models\Dep;
use yii\helpers\VarDumper;
use kartik\widgets\DepDrop;
use kartik\widgets\TypeaheadBasic;
use frontend\models\Complain;
use frontend\models\Result;
/* @var $this yii\web\View */
/* @var $model frontend\models\Priskhead */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="priskhead-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="panel panel-default">
      <div class="panel-body">
        <h3>บันทึกความเสี่ยง</h3>
        <div class="row">
    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>

        <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'risk_date')->widget(
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

        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'risk_time')->textInput(['maxlength' => true]) ?>

        </div>

  <div class="col-sm-6 col-md-6">

    <?=
    $form->field($model, 'date_report')->widget(
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

        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'time_report')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6 col-md-6">


            <?=
            $form->field($model, 'department')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Adddep::find()->all(), 'ADDDEP_ID', 'DEP_NAME'),
                'options' => ['placeholder' => 'เลือกแแผนก ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>


        <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'place_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Riskplace::find()->all(), 'PLACE_ID', 'PLACE_NAME'),
                'options' => ['placeholder' => 'เลือกสถานที่เกิดเหตุ ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>

        <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'clinictype')->dropdownList(
                    ArrayHelper::map(Clinictype::find()->all(), 'CLINICTYPE_ID', 'CLINIC_NAME'), [
                'id' => 'ddl-clinictype',
                'prompt' => 'เลือกประเภทความเสี่ยง'
            ]);
            ?>
        </div>
        <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'risk_level')->widget(DepDrop::classname(), [
                'options' => ['id' => 'ddl-level'],
                'data' => $level,
                'pluginOptions' => [
                    'depends' => ['ddl-clinictype'],
                    'placeholder' => 'เลือกหัวข้อความรุนแรง...',
                    'url' => Url::to(['/priskhead/get-level'])
                ]
            ]);
            ?>
        </div>





</div>

<?= $form->field($model, 'event_name')->textarea(['rows' => 3]) ?>

<?= $form->field($model, 'outcome_pt')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'outcome_guest')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'outcome_staff')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'outcome_price')->textInput() ?>

<?= $form->field($model, 'solve_begin')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'risk_sum_dep')->textInput() ?>




</div>

<div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'headmaster')->dropdownList(
            ArrayHelper::map(Headmaster::find()->all(), 'HEADMASTER_ID', 'HEADMASTER_NAME'), [
        'id' => 'ddl-headmaster',
        'prompt' => 'เลือกโปรแกรมความเสี่ยง'
    ]);
    ?>
</div>
<div class="col-sm-6 col-md-6">
    <?=
    $form->field($model,'prohead')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-prohead'],
    /* @var $prodetail type */
    'data' => $prohead,
        'pluginOptions' => [
            'depends' => ['ddl-headmaster'],
            'placeholder' => 'เลือกโปรแกรมย่อยความเสี่ยง...',
            'url' => Url::to(['/priskhead/get-prohead'])
        ]
    ]);
    ?>
     </div>
<div class="col-sm-6 col-md-6">
    <?=
    $form->field($model,'prodetail')->widget(DepDrop::classname(), [
        'options' => ['id' => 'ddl-prodetail'],
    /* @var $prodetail type */
    'data' => $prodetail,
        'pluginOptions' => [
            'depends' => ['ddl-prohead'],
            'placeholder' => 'เลือกหัวข้ออุบัติการณ์...',
            'url' => Url::to(['/priskhead/get-prodetail'])
        ]
    ]);
    ?>
     </div>
     <div class="col-sm-6 col-md-6">
         <?= $form->field($model, 'program_text')->textInput(['maxlength' => true]) ?>
     </div>

<div class="col-sm-6 col-md-6">
  <?= $form->field($model, 'miss')->inline()->radioList(frontend\models\Priskhead::itemAlias('miss')) ?>
    </div>

    <div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'sentinel')->widget(Select2::classname(), [
    'language' => 'de',
    'data' => ArrayHelper::map(\frontend\models\Sentinel::find()->all(), 'ID_SEN', 'SENTI_NAME'),
    'options' => [ 'placeholder' => 'เลือกหัวข้อ sentinel ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
    ]);
    ?>

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
<div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'input_complain')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\frontend\models\Complain::find()->all(), 'COMPLAIN_ID', 'COMPLAIN_NAME'),
        'options' => ['placeholder' => 'เลือกช่องทางรับเรื่องร้องเรียน ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
</div>
    <div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'dep_risk_head')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => ArrayHelper::map(Dep::find()->all(), 'DEP_ID', 'FULLNAME'),
        'options' => [ 'placeholder' => 'เลือกทีมนำที่เกี่ยวข้อง ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
</div>

<div class="col-sm-6 col-md-6">

            <?=
            $form->field($model, 'dep_risk')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Adddep::find()->all(), 'ADDDEP_ID', 'DEP_NAME'),
                'options' => ['placeholder' => 'เลือกหน่วยงานที่เกี่ยวข้อง ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>


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
                'uploadUrl' => Url::to(['/priskhead/upload-ajax']),
                'uploadExtraData' => [
                    'ref' => $model->ref,
                ],
                'maxFileCount' => 100
            ]
        ]);
        ?>
    </div>

   </div>
<div class="panel-body">


        <h3>แก้ไขความเสี่ยง ผู้จัดการความเสี่ยง</h3>
        <div class="row">

            <div class="col-sm-6 col-md-6">
            <?=
            $form->field($model, 'receive_date')->widget(
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

        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'receive_time')->textInput(['maxlength' => true]) ?>

        </div>

  <div class="col-sm-6 col-md-6">

    <?=
    $form->field($model, 'reviwe_date')->widget(
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

        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'reviwe_time')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="col-sm-12 col-md-12">

             <?= $form->field($model, 'reviwe_detailed')->textarea(['rows' => 3]) ?>

        </div>





    <div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'risk_status')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => ArrayHelper::map(Status::find()->all(), 'STATUS_ID', 'STATUS_NAME'),
        'options' => [ 'placeholder' => 'เลือกสถานะการจัดการความเสี่ยง ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


</div>



        <div class="col-sm-6 col-md-6">
    <?=
    $form->field($model, 'result')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => ArrayHelper::map(Result::find()->all(), 'RESULT_ID', 'RESULT_NAME'),
        'options' => [ 'placeholder' => 'เลือกผลการดำเนินงานจัดการความเสี่ยง ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


</div>

     <div class="col-sm-12 col-md-12">


            <?php // $form->field($model, 'covenant')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'covenant')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'=>$model->initialPreview($model->covenant,'covenant','file'),
        'initialPreviewConfig'=>$model->initialPreview($model->covenant,'covenant','config'),
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
    ]); ?>
           </div>

 <div class="col-sm-12 col-md-12>
    <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
    'options' => [
        //'accept' => 'image/*',
        'multiple' => true
    ],
    'pluginOptions' => [
        'initialPreview'=>$model->initialPreview($model->docs,'docs','file'),
        'initialPreviewConfig'=>$model->initialPreview($model->docs,'docs','config'),
        'allowedFileExtensions'=>['pdf','doc','docx','xls','xlsx'],
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
        'overwriteInitial'=>false
     ]
    ]); ?>
    </div>
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-info' : 'btn btn-info') . ' btn-lg btn-block']) ?>

<?php ActiveForm::end(); ?>
