<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BmitestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bmitest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'weight') ?>

    <?= $form->field($model, 'height') ?>

    <?= $form->field($model, 'bmi') ?>

    <?= $form->field($model, 'gradebmi') ?>

    <?php // echo $form->field($model, 'waistline') ?>

    <?php // echo $form->field($model, 'gradewaistline') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'bpsys') ?>

    <?php // echo $form->field($model, 'bpdi') ?>

    <?php // echo $form->field($model, 'gradebpsys') ?>

    <?php // echo $form->field($model, 'gradebpdi') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'dateserv') ?>

    <?php // echo $form->field($model, 'pushup') ?>

    <?php // echo $form->field($model, 'gradepushup') ?>

    <?php // echo $form->field($model, 'situp') ?>

    <?php // echo $form->field($model, 'heartrate') ?>

    <?php // echo $form->field($model, 'gripst') ?>

    <?php // echo $form->field($model, 'flexibility') ?>

    <?php // echo $form->field($model, 'legpress') ?>

    <?php // echo $form->field($model, 'run2400') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
