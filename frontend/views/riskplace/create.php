<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Riskplace */

$this->title = 'Create Riskplace';
$this->params['breadcrumbs'][] = ['label' => 'Riskplaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riskplace-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelDep' =>$modelDep
    ]) ?>

</div>
