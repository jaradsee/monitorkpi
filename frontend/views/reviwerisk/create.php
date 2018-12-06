<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Reviwerisk */

$this->title = 'Create Reviwerisk';
$this->params['breadcrumbs'][] = ['label' => 'Reviwerisks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviwerisk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
