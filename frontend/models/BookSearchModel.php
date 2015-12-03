<?php


namespace frontend\models;


use app\models\BooksModel;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Cookie;

/**
 * Class BookSearchModel
 * @package frontend\models
 */
class BookSearchModel extends BooksModel
{
    /**author id
     * @var
     */
    public $author;
    /**date from
     * @var
     */
    public $from;
    /**date to
     * @var
     */
    public $to;

    public function rules()
    {
        return [
            [['author', 'name', 'from', 'to'], 'string'],
            [['author'], 'safe']
        ];

    }

    public function search()
    {
        $params = $this->getData();

        $query = BooksModel::find();

        $query->joinWith(['author']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        $dataProvider->sort->attributes['author'] = [
            'asc' => ['author.firstname' => SORT_ASC],
            'desc' => ['author.firstname' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'books.name', $this->name]);

        $fromTime = $this->from ? strtotime($this->from) : null;
        $toTime = $this->to ? strtotime($this->to) : null;
        $from = $fromTime ? date('Y-m-d h:i:s', $fromTime) : null;
        $to = $toTime ? date('Y-m-d h:i:s', $toTime) : null;

        $query->andFilterWhere(['between', 'books.date', $from,$to]);
        $query->andFilterWhere(['author.id'=> $this->author]);

        return $dataProvider;
    }

    /**
     * @return array|mixed
     */
    private function getData()
    {
        $post = \Yii::$app->request->post();
        //save get
        if ($sort = \Yii::$app->request->getQueryParam('sort')) {
            $cookie = new Cookie([
                'name' => 'sort',
                'value' => $sort,
                'expire' => time() + 86400 * 365,
            ]);
            \Yii::$app->response->cookies->add($cookie);

        }

        //save get
        if ($page = \Yii::$app->request->getQueryParam('page')) {
            $cookie = new Cookie([
                'name' => 'page',
                'value' => $page,
                'expire' => time() + 86400 * 365,
            ]);
            \Yii::$app->response->cookies->add($cookie);

        }

        //save search
        if ($this->load($post) && $this->validate()) {
            $cookie = new Cookie([
                'name' => 'search',
                'value' => Json::encode($post),
                'expire' => time() + 86400 * 365,
            ]);
            \Yii::$app->response->cookies->add($cookie);

            return $post;
        } elseif ($cookie = \Yii::$app->getRequest()->getCookies()->getValue('search')) {
            return Json::decode($cookie);
        }

        return [];
    }

    /**
     * clear search
     */
    public static function clearSearch()
    {
        \Yii::$app->response->cookies->remove('search');

        return true;
    }
}