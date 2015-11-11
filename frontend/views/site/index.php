<?php

/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>

<?php
Modal::begin([
    'header' => '<h2>Prose</h2>',
    'toggleButton' => [
        'label' => 'submit a writing sample',
        'class' => 'btn btn-primary'
    ],
]);
?>
<div class="search-form-form">

    <?php $form = ActiveForm::begin([
        'id' => 'test2',
        'action' => ['site/index'],
        'method' => 'post'
    ]);
    $modelForm = new \frontend\models\SearchForm();
    ?>

    <?= $form->field($modelForm, 'keywords')->textInput(['maxlength' => true]) ?>

    <?=$form->field($modelForm, 'grade')->dropDownList(
        ArrayHelper::map(\app\models\GradeLevelModel::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select a grade level')]);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
Modal::end();



Modal::begin([
    'header' => '<h2>Prose</h2>',
    'toggleButton' => [
        'label' => 'submit a writing sample',
        'class' => 'btn btn-info'
    ],
]);
?>
    <div class="prose-model-form">

        <?php $form = ActiveForm::begin([
            'id' => 'test1',
            'action' => ['prose/create'],
            'method' => 'post',
        ]); ?>

        <?=$form->field($model, 'text')->textarea(['rows' => 6]) ?>

        <?=$form->field($model, 'grade_level_id')->dropDownList(
            ArrayHelper::map(\app\models\GradeLevelModel::find()->all(), 'id', 'name'),
            ['prompt' => Yii::t('app', 'Select a grade level')]);

        ?>
        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
Modal::end();
echo Html::tag('br');
echo Html::tag('br');
echo Html::tag('br');
echo Html::tag('br');
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
             'label'=>'login',
             'format' => 'raw',
             'value'=>function ($data) {
                    if ($data->user) {
                        return $data->user->username;
                    }
                    return '-';
                  },
         ],
        [
            'label'=>'short text',
            'format' => 'raw',
            'value'=>function ($data) {
                return substr($data->text, 0, 20) . '...';
            },
        ],
        [
            'label'=>'grade level',
            'format' => 'raw',
            'value'=>function ($data) {
                return $data->gradeLevel->name;
            },
        ],
        'keywords',
        ['class' => 'yii\grid\ActionColumn',
            'template'=>'{view}{update}',
            'buttons'=>[
                'update' => function ($url, $model) {
                    return '   ' . Html::a('update', ['prose/update', 'id'=> $model->id], [
                        'title' => Yii::t('yii', 'Create'),
                    ]);

                },
                'view' => function ($url, $model) {
                    return '   ' . Html::a('view', ['prose/view', 'id'=> $model->id], [
                        'title' => Yii::t('yii', 'Create'),
                    ]);

                }
            ]
        ],

    ],
]); ?>


