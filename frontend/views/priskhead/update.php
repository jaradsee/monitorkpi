<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Priskhead */

$this->title = 'Update Priskhead: ' . ' ' . $model->risk_id;
$this->params['breadcrumbs'][] = ['label' => 'รายงานความเสี่ยง 10 อันดับล่าสุด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->risk_id, 'url' => ['view', 'id' => $model->risk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="priskhead-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,
        'prohead' => $prohead,
        'prodetail'=> $prodetail,
        'level'=> $risk_level,
         'initialPreview'=>$initialPreview,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
