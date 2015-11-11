<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProseModel */

$this->title = 'Update Prose Model: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prose Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prose-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
