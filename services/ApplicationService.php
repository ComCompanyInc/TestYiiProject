<?php

namespace app\services;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

const PRODUCTS_PER_PAGE = 21;
const CATEGORIES_PER_PAGE = 20;
class ApplicationService
{

    public function getCategories(): array
    {
        //Category::find()->all();
        $categories = Category::find();

        $pages = new Pagination([
            'totalCount' => $categories->count(), // сколько всего записей в бд
            'pageSize' => CATEGORIES_PER_PAGE  // кол-во записей на странице
        ]);

        $models = $categories
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return [
            'models' => $models,
            'pages' => $pages
        ];
    }

    public function getProducts(string $search, string $category): array {
        $products = Product::find();

        if(($search != null) || ($search != "")) {
            $products->andWhere(['like', 'name', $search]);
        }

        if(($category != null) || ($search != "")) {
            $products->joinWith('category')
                ->andWhere(['category.name' => $category]);
        }

        $pages = new Pagination([
            'totalCount' => $products->count(), // сколько всего записей в бд
            'pageSize' => PRODUCTS_PER_PAGE // кол-во записей на странице
        ]);

        $models = $products
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return [
            'models' => $models,
            'pages' => $pages
        ];
    }
}