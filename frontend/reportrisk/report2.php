<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานนับถือศาสนา';
?>

<div id="chart" style="padding-bottom: 10px"></div>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงาน xxxx',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'clinictype',
            'header' => 'รหัสสถานบริการ',
        ],
        [
            'attribute' => 'CLINIC_NAME',
            'format' => 'raw',
            'value' => function($model) {
                $hoscode = $model['clinictype'];
                $hosname = $model['CLINICNAME'];
                return Html::a(Html::encode($hosname), ['report/report3', 'clinictype' => $clinictype]);
            }
                ],
                [
                    'attribute' => 'total',
                    'header' => 'ประชากรทั้งหมด(คน)'
                ],
                
                [
                    'attribute' => 'other',
                    'header' => 'อื่นๆ (คน)'
                ],
            ]
        ]);
        ?>

        