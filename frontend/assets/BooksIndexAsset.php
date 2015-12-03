<?php


namespace frontend\assets;


use yii\web\AssetBundle;

/**assets for book/index
 * Class BooksIndexAsset
 * @package frontend\assets
 */
class BooksIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'js/booksIndex.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}