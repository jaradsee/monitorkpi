<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Riskplace */

$this->title = $model->PLACE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Riskplaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riskplace-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PLACE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PLACE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PLACE_ID',
            'PLACE_NAME',
        ],
    ]) ?>

</div>
