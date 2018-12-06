<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reviwerisk */

$this->title = $model->reviwerisk_id;
$this->params['breadcrumbs'][] = ['label' => 'Reviwerisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviwerisk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->reviwerisk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->reviwerisk_id], [
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
            'reviwerisk_id',
            'reviwerisk_date',
            'reviwe_detial',
            'ref',
            'date_recive',
            'time_recive',
            'risk_ref_no',
            'input_complain',
            'risk_time',
            'safety',
            'sum_solve',
            'risk_status',
            'program_text',
            'login_name',
            'risk_sum_dep',
            'risk_simple',
            'date_input',
            'last_update',
            'staff',
            'last_staff',
            'print_url:url',
            'dep_risk_head',
            'sentinel',
            'covenant',
            'docs',
        ],
    ]) ?>

</div>
