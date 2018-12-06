<?php

use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงานความเสี่ยงจำแนกตามประเภทความเสี่ยง', 'url' => ['reportrisk/index']];
$this->params['breadcrumbs'][] = 'รายความเสี่ยง';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงานความเสี่ยงที่เกิดขึ้นทั้งหมด',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
    ],
]);
?>
