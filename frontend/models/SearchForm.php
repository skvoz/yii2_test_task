<?php
namespace frontend\models;


use yii\base\Model;

class SearchForm extends Model
{
    public $keywords;
    public $grade;

    public function rules()
    {
        return [
            [['keywords', 'grade'], 'safe']
        ];
    }
}