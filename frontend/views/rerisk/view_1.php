<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rerisk */

$this->title = $model->risk_id;
$this->params['breadcrumbs'][] = ['label' => 'Rerisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rerisk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->risk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->risk_id], [
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
            'risk_id',
            'rerisk_date',
            'reviwrisk',
            'ref',
            'date_recive',
            'time_recive',
            'input_complain',
            'risk_time',
            'safety',
            'sum_solve',
            'risk_level',
            'risk_status',
            'program_text',
            'login_name',
            'risk_sum_dep',
            'risk_simple',
            'date_input',
            'last_update',
            'staff',
            'last_staff',
            'dep_risk_head',
            'sentinel',
            'covenant',
            'docs',
        ],
    ]) ?>

</div>
