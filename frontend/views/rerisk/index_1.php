<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReriskSearh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rerisks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rerisk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rerisk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'risk_id',
            'rerisk_date',
            'reviwrisk',
            'ref',
            'date_recive',
            // 'time_recive',
            // 'input_complain',
            // 'risk_time',
            // 'safety',
            // 'sum_solve',
            // 'risk_level',
            // 'risk_status',
            // 'program_text',
            // 'login_name',
            // 'risk_sum_dep',
            // 'risk_simple',
            // 'date_input',
            // 'last_update',
            // 'staff',
            // 'last_staff',
            // 'dep_risk_head',
            // 'sentinel',
            // 'covenant',
            // 'docs',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
