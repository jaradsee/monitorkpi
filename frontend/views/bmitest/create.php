<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Bmitest */

$this->title = 'Create Bmitest';
$this->params['breadcrumbs'][] = ['label' => 'Bmitests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmitest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
