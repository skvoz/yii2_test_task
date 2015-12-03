<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BooksModel */

$this->title = 'Update Books Model: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="books-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
