<?php

namespace frontend\controllers;

use frontend\models\BookSearchModel;
use Yii;
use app\models\BooksModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BooksController implements the CRUD actions for BooksModel model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all BooksModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        //get sort from cookies
        $sort = !\Yii::$app->request->getQueryParam('sort') && \Yii::$app->request->cookies->getValue('sort');
        $page = !\Yii::$app->request->getQueryParam('page') && \Yii::$app->request->cookies->getValue('page');
        if ($sort || $page) {
            $this->redirect([
                'books/index',
                'sort' => \Yii::$app->request->cookies->getValue('sort'),
                'page' => \Yii::$app->request->cookies->getValue('page')]);
        }
        $model = new BookSearchModel();
        //get search from post/cookies
        $dataProvider = $model->search();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionClear()
    {
        BookSearchModel::clearSearch();

        return $this->redirect(['books/index']);
    }

    /**
     * Displays a single BooksModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BooksModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BooksModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BooksModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BooksModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BooksModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BooksModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BooksModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $id - model id
     * @return mixed
     */
    public function actionAjaxUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/books/index');
        }

        return $this->renderAjax('_form', ['model' => $model]);
    }
}
