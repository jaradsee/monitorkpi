<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviwerisk */

$this->title = 'Update Reviwerisk: ' . ' ' . $model->reviwerisk_id;
$this->params['breadcrumbs'][] = ['label' => 'Reviwerisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reviwerisk_id, 'url' => ['view', 'id' => $model->reviwerisk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reviwerisk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
