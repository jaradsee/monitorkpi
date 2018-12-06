<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Riskplace */

$this->title = 'Update Riskplace: ' . $model->PLACE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Riskplaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PLACE_ID, 'url' => ['view', 'id' => $model->PLACE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="riskplace-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelDep'=>$modelDep
    ]) ?>

</div>
