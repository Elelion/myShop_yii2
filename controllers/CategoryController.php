<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()
            ->where(['hit' => '1'])
            ->limit(6)
            ->all();

        return $this->render('index', compact('hits'));
    }

    // NOTE: http://localhost/yii2/basic_shop/web/category/4
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $products = Product::find()
            ->where(['category_id' => $id])
            ->all();

        return $this->render('view', compact('products'));
    }
}