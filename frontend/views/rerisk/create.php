<?php

use yii\helpers\Html;
use app\models\Rerisk;

/* @var $this yii\web\View */
/* @var $model app\models\Rerisk */

$this->title = 'Create Rerisk';
$this->params['breadcrumbs'][] = ['label' => 'Rerisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rerisk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
