<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use frontend\models\Sex;
/* @var $this yii\web\View */
/* @var $model frontend\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">


    <?php $form = ActiveForm::begin(); ?>
    </div>
<div class="col-sm-6 col-md-6">


    <?= $form->field($model, 'CID')->textInput(['maxlength' => true,'type' => 'number']) ?>
    </div>
<div class="col-sm-6 col-md-6">
    <?= $form->field($model, 'NAME')->textarea(['rows' => 1]) ?>
    </div>
<div class="col-sm-6 col-md-6">
    <?= $form->field($model, 'LNAME')->textarea(['rows' => 1]) ?>
</div>
    <div class="col-sm-6 col-md-6">

<p><label for="SEX">SEX:</label><input id="SEX" title="We ask for your age only for statistical purposes."></p>
        <?=

        
        $form->field($model, 'SEX')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Sex::find()->all(), 'ID_SEX', 'SEX'),
            'options' => ['placeholder' => 'เลือกเผศ ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
        
    </div>
<div class="col-sm-6 col-md-6">
    <?php echo "<label class='control-label'>วันเกิด</label>";
            //echo "<div class='col col-sm-9'>";
            echo DatePicker::widget([
                'model' => $model,
                //'language' => 'th',
                //'dateFormat' => 'dd-MM-yyyy',
                'attribute' => 'BIRTH',
                'options' => ['placeholder' => 'เลือก วันเกิด ...'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-m-d',
                    'todayHighlight'=> true,
                  ]
            ]);
          //echo "</div><br>";
          echo "<br>";
      ?>
      </div>
<div class="col-sm-6 col-md-6">
    <?= $form->field($model, 'DISSES')->textarea(['rows' => 1]) ?>
</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Tooltip - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( document ).tooltip();
  } );
  </script>
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>
</head>
<body>
 
<p><a href="#" title="That&apos;s what this widget is">Tooltips</a> can be attached to any element. When you hover
the element with your mouse, the title attribute is displayed in a little box next to the element, just like a native tooltip.</p>
<p>But as it's not a native tooltip, it can be styled. Any themes built with
<a href="http://jqueryui.com/themeroller/" title="อธิบายได้ ยาวๆ ว่า ไงๆ งี้้">ThemeRoller</a>
will also style tooltips accordingly.</p>
<p>Tooltips are also useful for form elements, to show some additional information in the context of each field.</p>
<p><label for="age">Your age:</label><input id="age" title="We ask for your age only for statistical purposes."></p>
<p>Hover the field to see the tooltip.</p>
 
 
</body>
</html>