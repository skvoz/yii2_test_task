<?php

use frontend\models\AuthorModel;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BooksModel */
/* @var $form yii\widgets\ActiveForm */

//create preview
$image = [];
if ($model->preview) {
    $image = [
        Html::img('/image/' . $model->preview, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'']),
    ];
}
//time transform for widget
if ($model->date) {
    $objDate = DateTime::createFromFormat ('Y-m-d h:i:s', $model->date);
    $model->date = $objDate->format('m/d/Y');
}
?>

<div class="books-model-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'books-model',
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->widget(
        FileInput::classname(), [
            'pluginOptions' =>
                [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                    'initialPreview'=> $image
                ],
            'options' => [
                ['accept' => 'image/*'],
            ]
        ]
    ) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(),
        [
            'name' => 'dp_2',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'pluginOptions' => [
                'autoclose'=>true,
            ]
        ]

    ) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map(AuthorModel::find()->all(), 'id', 'lastname'),
        ['prompt'=>' - check author - ']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
