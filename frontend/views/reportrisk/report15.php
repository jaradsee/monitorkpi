<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JsExpression;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายงานความเสี่ยงแยกตามโปรแกรมความเสี่ยง';



?>


<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            'themes/grid',
            //'modules/exporting',
            'modules/solid-gauge',
        ]
    ]);
    ?>
</div>
<div class='well'>

    <form method="POST">
        ระหว่าง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
        ]);
        ?>
        ถึง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'>ประมวลผล</button>
    </form>
</div>
<a href="#" id="btn_sql">ชุดคำสั่ง</a>
<div id="sql" style="display: none"><?= $sql ?></div>


        <?php
        $riskprogram = [];
        for ($i = 0; $i < count($rawData); $i++) {
            $categ[] = $rawData[$i]['riskprogram'];
            //array_push($categ,'vvvv');
        }

        $riskprogram = array_column($rawData, 'riskprogram');
        $js_categories = implode("','", $riskprogram);

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
            text: 'รายงานความเสี่ยงแยกตามโปรแกรมความเสี่ยงในระบบ FAKTHARM'
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
            line: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'โปรแกรมความเสี่ยง',
            data: [$js_data]

        }]
    });



");
// จบ chart
        ?>


<!-- ส่วนแสดง Grid View -->
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนความเสี่ยงแยกตามโปรแกรมคามโปรแกรมความเสี่ยง</h3>
    </div>
    <div class="panel-body">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
            'attribute' => 'programno',
            'label' => 'รหัสโปรแกรม'],
        [
            'attribute' => 'riskprogram',
            'label' => 'โปรแกรมความเสี่ยง',
            'format' => 'raw',
            'value' => function($model) use($date1,$date2) {$programno = $model['programno'];

                $programno = $model['programno'];
                $riskprogram = $model['riskprogram'];
                return Html::a(Html::encode($riskprogram), ['reportrisk/report16', 'programno' => $programno,
                    'date1' => $date1,
                            'date2' => $date2
                ]);
            }// end value
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
<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});

$('#btn_sql').on('click', function(e) {

   $('#sql').toggle();
});
JS;
$this->registerJs($script);
?>
