<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProseModel */
/* @var $form ActiveForm */
?>
<div class="site-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'text') ?>
        <?= $form->field($model, 'grade_level_id') ?>
        <?= $form->field($model, 'keywords') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-form -->
