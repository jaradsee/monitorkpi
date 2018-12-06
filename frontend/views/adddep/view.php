<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Adddep */

$this->title = $model->ADDDEP_ID;
$this->params['breadcrumbs'][] = ['label' => 'Adddeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adddep-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ADDDEP_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ADDDEP_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ADDDEP_ID',
            'DEP_NAME',
        ],
    ]) ?>

</div>
