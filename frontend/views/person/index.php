<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (!Yii::$app->user->isGuest) {
            echo Html::a('เพิ่ม Person', ['create'], ['class' => 'btn btn-success']) ;
            }
        ?>
    </p>
    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax','timeout'=>5000]) ?>
    <!-- เรียก view _search.php -->
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<br>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'template'=>'{create}',
                'contentOptions'=>[
                    'noWrap' => true,

                  ],
                  'buttons'=>[
                    //'class' => 'btn btn-primary btn-block',
                    'create' => function($url,$model,$key){
                        return Html::a('<button class = "btn btn-info">
                                        <i class="glyphicon glyphicon-import"></i>
                                        </button>',['bmitest/create',
                                            'cid' => $model->CID,
                                            'sex' => $model->SEX,
                                            'age' => $model->AGE,
                                            'fname'=> $model->NAME,
                                            'lname'=> $model->LNAME,
                                    ]);
                      },
                    ],
            ],
//ทดสอบเพิ่มปุ่ม

[
    'class' => 'yii\grid\ActionColumn',
    'header'=>'Regiter',
    'template'=>'{create}',
    'contentOptions'=>[
        'noWrap' => true,

      ],
      'buttons'=>[
        //'class' => 'btn btn-primary btn-block',
        'create' => function($url,$model,$key){
            return Html::a('<button class = "btn btn-success">
                            <i class="glyphicon glyphicon-import"></i>
                            </button>',['bmitest/create',
                                'cid' => $model->CID,
                                'sex' => $model->SEX,
                                'age' => $model->AGE,
                                'fname'=> $model->NAME,
                                'lname'=> $model->LNAME,
                        ]);
          },
        ],
],

            //'cid',
            'NAME:ntext',
			'LNAME:ntext',

            'SEX',
            //'birth',
            'AGE',
            // 'disses:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
