<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BmitestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bmitests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bmitest-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bmitest', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('PDF', ['pdf'], ['class' => 'btn btn-danger']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'weight',
            'height',
            'bmi',
            'age',
            //'waistline',
            //'gradewaistline',
            //'sex',
            //'bpsys',
            //'bpdi',
            //'gradebpsys',
            //'gradebpdi',
            //'cid',
            //'age',
            //'dateserv',
            //'pushup',
            //'gradepushup',
            //'situp',
            //'heartrate',
            //'gripst',
            //'flexibility',
            //'legpress',
            //'run2400',

            [
              'class' => 'yii\grid\ActionColumn',
              'header'=>'Actions',
              'options'=>['style'=>'width:150px;'],
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{print} {view} {update} {delete} </div>',
              'buttons'=>[
                'print'=>function($url,$model){
                  return Html::a('<i class="glyphicon glyphicon-print"></i>',['pdf/url'],['class'=>'btn-pdfprint btn btn-default','data-pjax'=>'0']);
                }
              ]
            ],
        ],
    ]); ?>
</div>
