<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BooksModel */

$this->title = 'Create Books Model';
$this->params['breadcrumbs'][] = ['label' => 'Books Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
