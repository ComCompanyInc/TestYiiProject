<?php

namespace app\controllers;

use yii\web\Controller;

class ApplicationController extends Controller
{
    public function actionMain() {
        return $this->render('main');
    }
}