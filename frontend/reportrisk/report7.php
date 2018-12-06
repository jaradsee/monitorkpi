<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายงานแยกตามแผนกที่รายงานความเสี่ยง';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'แผนกที่รายงานความเสี่ยงตั้งแต่ วันที่ 1 ตุลาคม 2559-ปัจุบัน',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
]);
?>
<div id="chart" style="padding-bottom: 10px"></div>
    
    

