<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PriskheadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายงานความเสี่ยง 10 รายการล่าสุด';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priskhead-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มรายการความเสี่ยง', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'risk_id',
            'risk_date',
            'event_name',
            'department',
            'headmaster',
            'date_report',
            'clinictype',
            'risk_level',
            'risk_status',
            'result',
            // 'risk_ref_no',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
