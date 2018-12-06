<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model frontend\models\Bmitest */



?>
<div class="bmitest-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel panel-default">
      
      <div class="panel-body">
         <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->fname)]);?>
      </div>
</div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'groupid',
            'fname',
            'lname',
            'weight',
            'height',
            'bmi',
            'gradebmi',
            'waistline',
            'gradewaistline',
            'sex',
            'bpsys',
            'bpdi',
            'gradebpsys',
            'gradebpdi',
            'cid',
            'age',
            'dateserv',
            'pushup',
            'gradepushup',
            'gradesitup',
            'situp',
            'heartrate',
            'gripst',
            'flexibility',
            'legperweight',
            'legpress',
            'gradeleg',
            'run2400',
            'graderun',
            'gradeheart',
            'griperweight',
            'gradegrip',
            'gradeflex',
        ],
    ]) ?>

</div>
