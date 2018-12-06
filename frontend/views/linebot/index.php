<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\Models\LineBotsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Line Bots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="line-bot-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Line Bot', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'last_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
