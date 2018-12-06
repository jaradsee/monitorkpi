<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายความเสี่ยง';
?>

<div id="chart" style="padding-bottom: 10px"></div>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงานความเสี่ยงจำแนกตามประเภทความเสี่ยง ตั้งแต่วันที่ 1 ต.ค.2559-ปัจจุบัน',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'clinictype',
            'header' => 'ประเภทความเสี่ยง',
        ],
        [
            'attribute' => 'clinicname',
            'header' => 'ประเภทความเสี่ยง',
            'format' => 'raw',
            'value' => function($model) {
                $clinictype = $model['clinictype'];
                $clinicname = $model['clinicname'];
                return Html::a(Html::encode($clinicname), ['reportrisk/report3', 'clinictype' => $clinictype]);
            }
                ],
                [
                    'attribute' => 'total',
                    'header' => 'ความเสี่ยงทั้งหมด(ครั้ง)'
                ],
                
                
            ]
        ]);
        ?>

        