<?php

namespace app\controllers;

use app\services\ApplicationService;
use app\services\RoleService;
use Yii;
use yii\web\Controller;

class ApplicationController extends Controller
{
    private $applicationService;

    public function __construct($id, $module, ApplicationService $applicationService, $config = [])
    {
        $this->applicationService = $applicationService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function() {
                            // Проверяем что пользователь авторизован И имеет нужную роль
                            return Yii::$app->user->identity !== null &&
                                Yii::$app->user->identity->roleName === RoleService::DEFAULT_ROLE;
                        }
                    ],
                ],
            ],
        ];
    }
    public function actionMain(string $category = "", string $search = "") {
        $sidebar = $this->applicationService->getCategories();

        $products = $this->applicationService->getProducts($search, $category);
        return $this->render('main', [
            'sidebar' => $sidebar['models'],
            'sidebarPages' => $sidebar['pages'],
            'products' => $products['models'],
            'productsPages' => $products['pages'],
        ]);
    }
}