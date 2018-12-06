<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReviweriskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviwerisks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviwerisk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reviwerisk', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reviwerisk_id',
            'reviwerisk_date',
            'reviwe_detial',
            'ref',
            'date_recive',
            // 'time_recive',
            // 'risk_ref_no',
            // 'input_complain',
            // 'risk_time',
            // 'safety',
            // 'sum_solve',
            // 'risk_status',
            // 'program_text',
            // 'login_name',
            // 'risk_sum_dep',
            // 'risk_simple',
            // 'date_input',
            // 'last_update',
            // 'staff',
            // 'last_staff',
            // 'print_url:url',
            // 'dep_risk_head',
            // 'sentinel',
            // 'covenant',
            // 'docs',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
