<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProseModel */

$this->title = 'Create Prose Model';
$this->params['breadcrumbs'][] = ['label' => 'Prose Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prose-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
