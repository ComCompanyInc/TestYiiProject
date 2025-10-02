<?php

namespace app\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/pages/login.css'
    ];

    public $js = [
        //'js/login.js',
    ];

    // Подгружаются только если зарегистрирован этот бандл
    public $depends = [
        'app\assets\AppAsset', // Зависит от основного AppAsset
    ];
}