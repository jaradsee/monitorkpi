<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Adddep */

$this->title = 'Update Adddep: ' . $model->ADDDEP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Adddeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ADDDEP_ID, 'url' => ['view', 'id' => $model->ADDDEP_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adddep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
