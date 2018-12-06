<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายงานแยกตามแผนกที่รายงานความเสี่ยง';


?>
<div id="chart" style="padding-bottom: 10px"></div>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงานความเสี่ยงจำแนกตามแผนกที่รายงานความเสี่ยง ตั้งแต่วันที่ 1 ต.ค.2559-ปัจจุบัน',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'department',
            'header' => 'รหัสแผนก',
        ],
        [
            'attribute' => 'departmentname',
            'header' => 'ชื่อแผนก',
            'format' => 'raw',
            'value' => function($model) {
                $department = $model['department'];
                $departmentname = $model['departmentname'];
                return Html::a(Html::encode($departmentname), ['reportrisk/report7', 'department' => $department]);
            }
                ],
                [
                    'attribute' => 'total',
                    'header' => 'ความเสี่ยงทั้งหมด(ครั้ง)'
                ],
                
                
            ]
        ]);
        ?>