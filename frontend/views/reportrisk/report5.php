<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายความเสี่ยง';
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

<div id="chart" style="padding-bottom: 10px"></div>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงานความเสี่ยงจำแนกตามความรุนแรงของความเสี่ยง ตั้งแต่วันที่'.$date1  .$date2 ,
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'risk_level',
            'header' => 'ประเภทความเสี่ยง',
        ],
        [
            'attribute' => 'levelname',
            'header' => 'ประเภทความเสี่ยง',
            'format' => 'raw',
            'value' => function($model)use($date1,$date2) {
                $risk_level = $model['risk_level'];
                $levelname = $model['levelname'];
                return Html::a(Html::encode($levelname), ['reportrisk/report12', 'risk_level' => $risk_level,
                    'date1' => $date1,
                            'date2' => $date2]);
            }
                ],
                [
                    'attribute' => 'total',
                    'header' => 'ความเสี่ยงทั้งหมด(ครั้ง)'
                ],
                
                
            ]
        ]);
        ?>

        