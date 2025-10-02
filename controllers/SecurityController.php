<?php

namespace app\controllers;

use app\models\LoginForm;
use app\services\SecurityService;
use Yii;
use yii\web\Controller;
use app\models\RegisterForm;

class SecurityController extends Controller
{
    private $securityService;

    public function __construct($id, $module, SecurityService $securityService, $config = [])
    {
        $this->securityService = $securityService;
        parent::__construct($id, $module, $config);
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->login()) {
            return $this->goHome(); // Перенаправление на главную после входа
        }

        return $this->render('login', ['loginForm' => $loginForm]);
    }

    public function actionRegister()
    {
        $registerForm = new RegisterForm();

        $result = null;

        if ($registerForm->load(Yii::$app->request->post()) && $registerForm->validate()) {
            $result = $this->securityService->createUser($registerForm);
        }

        return $this->render('register', ['registerForm' => $registerForm, 'result' => $result]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}