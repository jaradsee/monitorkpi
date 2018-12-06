<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bmitest */


$this->title = 'Update Bmitest: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bmitests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'cid' => $model->cid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bmitest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
        'initialPreview'=>$initialPreview,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
