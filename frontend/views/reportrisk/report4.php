<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'หมวดรายงานเพื่อบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายงานแยกตามแผนกที่รายงานความเสี่ยง';


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
            'value' => function($model)use($date1,$date2) {
                $department = $model['department'];
                $departmentname = $model['departmentname'];
                return Html::a(Html::encode($departmentname), ['reportrisk/report7', 'department' => $department,
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