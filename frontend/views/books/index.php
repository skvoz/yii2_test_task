<?php

use frontend\models\AuthorModel;
use frontend\models\BookSearchModel;
use newerton\fancybox\FancyBox;
use yii\grid\GridView;
use yii\helpers\Html;
\frontend\assets\BooksIndexAsset::register($this);
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="search" style="display: none">
        <h2>Search</h2>
    <?=$this->render('search', [
        'model' => new BookSearchModel()
    ]);?>
    </div>
    <p>
        <?= Html::a('Create Books Model', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('search', null, ['class' => 'btn btn-info search']) ?>
    </p>

    <h2>List</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'label' => 'book name',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->name;
                },
            ],
            [
                'attribute' => 'preview',
                'label' => 'preview',
                'format' => 'raw',
                'value' => function ($model) {
                    echo FancyBox::widget([
                        'target' => 'a[id="fancy_'.$model->id.'"]',
                        'helpers' => true,
                    ]);
                    return Html::a(Html::img('/image/' . $model->preview, [
                        'width' => '100px',
                        'height' => 'auto',
                    ]), '/image/' . $model->preview, ['id' => 'fancy_'.$model->id]);
                },
            ],
            [
                'attribute' => 'author',
                'label' => 'author',
                'format' => 'raw',
                'value' => function ($model) {
                    /** @var AuthorModel $author */
                    $author = $model->author;
                    return $author->lastname . ' ' . $author->firstname;
                },
            ],

            [
                'attribute' => 'date',
                'label' => 'date release',
                'format' => 'raw',
                'value' => function ($model) {
                    return \Yii::$app->formatter->asDate($model->date, 'long');
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{prev}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('edit', null, [
                            'class' => 'edit-btn',
                            'data-target' => '/books/ajax-update?id=' . $model->id
                        ]);
//                        return Html::a('edit', $url);
                    },
                    'prev' => function ($url, $model) {

                        return Html::a(' | prev', $url);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(' | delete', $url);
                    },
                ],
            ]
        ],
    ]); ?>

</div>
<!--modal-->
<?php
yii\bootstrap\Modal::begin([
    'header' => 'Edit book',
    'id' => 'modal',
    'size' => 'modal-md',
]);
?>
<div id='modal-content'>download...</div>
<?php yii\bootstrap\Modal::end(); ?>



