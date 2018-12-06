<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Friskhead */

$this->title = 'Update Friskhead: ' . ' ' . $model->risk_id;
$this->params['breadcrumbs'][] = ['label' => 'Friskheads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->risk_id, 'url' => ['view', 'id' => $model->risk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="friskhead-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prodetail'=> $prodetail,
        'level'=>$level,
        'initialPreview'=>$initialPreview,
        'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
