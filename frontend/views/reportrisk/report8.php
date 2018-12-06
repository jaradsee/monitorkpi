<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายงานแยกตามแผนกที่รายงานความเสี่ยงวันนี้';


?>
<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            'themes/grid',
            'modules/solid-gauge'
        //'modules/exporting',
        ]
    ]);
    ?>
</div>

        <?php
        $depart = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $categ[] = $rawData[$i]['depart'];
            //array_push($categ,'vvvv');
        }

        $depart = array_column($rawData, 'depart');
        $js_categories = implode("','", $depart);

        $total = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $total[] = $rawData[$i]['total'];
            //array_push($categ,'vvvv');
        }

        $total = array_column($rawData, 'total');
        $js_data = implode(",", $total);
        ?>
<div id="chart" style="padding-bottom: 10px"></div>
<?php
        $this->registerJs("

    $('#chart').highcharts({
         colors: ['#ED921C', '#1F7CDB'],
        chart: {
            type: 'column'
        },
        title: {
            text: 'รายงานแผนกที่พบความเสี่ยงและรายงานในระบบ FAKTHARM'
        },
        subtitle: {
            text: 'ปีงบประมาณ 2560'
        },
        xAxis: {
            categories: ['$js_categories'],
            //crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'ครั้ง'
            }
        },
       
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'แผนก',
            data: [$js_data]

        }]
    });



");
// จบ chart
        ?>


<!-- ส่วนแสดง Grid View -->
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนความเสี่ยงที่แต่ละแผนกรายงาน</h3>
    </div>
    <div class="panel-body">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'แผนกที่รายงาน',
                    'attribute' => 'depart'
                ],
                
                [
                    'label' => 'จำนวนความเสี่ยง',
                    'attribute' => 'total'
                ],
            ]
        ]);
        ?>
    </div>
</div>
