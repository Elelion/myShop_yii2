<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

// NOTE: inheriting from our shared controller
class CategoryController extends AppController
{
    /*
     * NOTE:
     * default action for this controller
     * Look in: config/web.php -> 'defaultRoute' => 'category/index',
     * */
    public function actionIndex()
    {
        $hits = Product::find()
            ->where(['hit' => '1'])
            ->limit(6)
            ->all();

        return $this->render('index', compact('hits'));
    }
}