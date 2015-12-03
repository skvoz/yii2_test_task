<?php


namespace frontend\components\parsers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;


/**
 * Class AbstractParser
 * @package frontend\components\parsers
 */
class AbstractParser
{
    /**
     * @var
     */
    public $url;
    /**
     * @var
     */
    public $expression;

    public function run()
    {
        $client = new Client();
        $res = $client->request('GET', $this->url);

        if ($res->getStatusCode() !== 200) {
            throw new BadResponseException();
        }
        $html = $res->getBody()->__toString();
        preg_match_all($this->expression, $html, $matches);

        return $matches;
    }
}