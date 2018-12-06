<?php

use yii\helpers\Html;
use frontend\models\Priskhead;

/* @var $this yii\web\View */
/* @var $model frontend\models\Priskhead */


$this->title = 'เพิ่มรายการความเสี่ยง';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกความเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priskhead-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prohead' => $prohead,
        'prodetail'=> $prodetail,
        'level'=> $risk_level,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
