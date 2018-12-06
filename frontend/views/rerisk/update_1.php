<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rerisk */

$this->title = 'Update Rerisk: ' . ' ' . $model->risk_id;
$this->params['breadcrumbs'][] = ['label' => 'Rerisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->risk_id, 'url' => ['view', 'id' => $model->risk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rerisk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
