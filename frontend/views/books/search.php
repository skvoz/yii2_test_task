<?php

use frontend\models\AuthorModel;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BookSearchModel */
/* @var $form ActiveForm */


    $items = [];
    foreach (AuthorModel::find()->all() as $author) {
        $items[$author->id] = $author->lastname . ' ' . $author->firstname;
    }
?>
<div class="site-search">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'author')->dropDownList(
            $items,
//            ArrayHelper::map(AuthorModel::find()->all(), 'id', 'lastname'),
            ['prompt'=>' - check author - ']
        ) ?>

        <?= $form->field($model, 'from')->widget(DatePicker::className(),
            [
                'name' => 'dp_2',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                ]
            ]

        ) ?>

        <?= $form->field($model, 'to')->widget(DatePicker::className(),
            [
                'name' => 'dp_2',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                ]
            ]

        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Clear', ['books/clear'],['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-search -->
