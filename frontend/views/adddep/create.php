<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Adddep */

$this->title = 'Create Adddep';
$this->params['breadcrumbs'][] = ['label' => 'Adddeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adddep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
