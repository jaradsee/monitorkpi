<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\EasyUpload */

$this->title = 'Create Easy Upload';
$this->params['breadcrumbs'][] = ['label' => 'Easy Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="easy-upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
