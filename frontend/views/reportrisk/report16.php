<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายงานแยกตามโปรแกรมความเสี่ยง';

echo GridView::widget([
    'dataProvider' => $dataProvider,

    'panel' => [
        'before' => 'แผนกรายงานความเสี่ยงตั้งแต่'.$date1
         .$date2,
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
]);
?>
<div id="chart" style="padding-bottom: 10px"></div>
