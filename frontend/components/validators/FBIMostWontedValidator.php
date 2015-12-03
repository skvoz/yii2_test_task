<?php


namespace frontend\components\validators;


use frontend\components\parsers\FbiParser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use yii\bootstrap\Html;
use yii\validators\Validator;

class FBIMostWontedValidator extends Validator
{
    /**
     * @var string
     */
//    public $fbiUrl = 'https://www.fbi.gov/wanted/cyber';

    public function validateAttribute($model, $attribute)
    {
        try {
            $responseParser = (new FbiParser())->run();
        } catch (BadResponseException $e) {
            $this->addError($model, 'some trouble with validator');
            \Yii::info('error scrap info from fbi site', 'fbi_validator');
            \Yii::info($e->getMessage(), 'fbi_validator');
            return ;
        }

        if (array_key_exists(2, $responseParser)) {
            foreach ($responseParser[2] as $key => $name) {
                $fullNameStr = strtolower($name);

                $search = strstr($fullNameStr, $model->$attribute);
                if ($search) {
                    $model->addError($attribute, 'o no, you are pirate >:| '.
                        '<a target="_blank" ' . $responseParser[1][$key] . '>' . $name . ' wanted</a>'
                    );
                }
            }

        }
    }

//    public function clientValidateAttribute($model, $attribute, $view)
//    {
//        $url = Url::toRoute(['serviceman/validate-remote-link']);
//
//        $id = $model->soldier_id;
//        return <<<JS
//        deferred.push($.get("$url", {link: value, id: "$id"}).done(function(data) {
//            if (jQuery.isEmptyObject(data) == false) {
//                messages.push(data.cwgc_references[0]);
//            }
//        }));
//JS;
//    }
}