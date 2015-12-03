<?php


namespace frontend\components\parsers;

/**
 * Class FbiParser
 * @package frontend\components\parsers
 */
class FbiParser extends AbstractParser
{
    public $url = 'https://www.fbi.gov/wanted/cyber';

    public $expression = "/<p class=\"person-title\">\W<a (.*)>(.*?)<\/a>\W<\/p>/";
}