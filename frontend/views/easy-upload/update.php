<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EasyUpload */

$this->title = 'Update Easy Upload: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Easy Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="easy-upload-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
