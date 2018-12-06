<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\frontend\modeles\Priskhead;

/* @var $this yii\web\View */
/* @var $model app\models\Priskhead */

$this->title = $model->event_name;
$this->params['breadcrumbs'][] = ['label' => 'Priskheads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priskhead-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->risk_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->risk_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Genraet PDF', ['gen-pdf', 'id' => $model->risk_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'risk_id',
            'risk_date',
            'risk_time',
            'event_name',
            'riskplaceName',
            'clinictypeName',
            'levelName',
            'risk_again',

            'date_report',
            'headmasterName',
            'proheadName',
            'prodetailName',
            'adddepName',
            'complainName',
            'depName',
            'safety',
            'outcome_pt',
            'outcome_guest',
            'outcome_staff',
            'outcome_price',
            'solve_begin',
            'resultName',

            'statusName',
            'CreatedBy',
            'created_at',
            'updated_at',
            'UpdatedBy',
            'program_text',
            'risk_sum_dep',
            'simpleName',
            ['attribute'=>'covenant','value'=>$model->listDownloadFiles('covenant'),'format'=>'html'],
            ['attribute'=>'docs','value'=>$model->listDownloadFiles('docs'),'format'=>'html'],


        ],
    ]) ?>
<div class="panel panel-default">
  <div class="panel-body">
     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->event_name)]);?>
  </div>
</div>
</div>
