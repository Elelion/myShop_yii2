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

        // NOTE: setting meta tags for our index
        $this->setMeta('E-SHOPPER__index');
        return $this->render('index', compact('hits'));
    }

    // NOTE: http://localhost/yii2/basic_shop/web/category/4
    public function actionView($id)
    {
        /*
         * NOTE:
         * getting the id from the url.
         * This line is optional, everything will work without it
         * */
        $id = Yii::$app->request->get('id');

        $products = Product::find()
            ->where(['category_id' => $id])
            ->all();

        $category = Category::findOne($id);

        // NOTE: setting meta tags for our View
        $this->setMeta(
            'E-SHOP__view | ' . $category->name,
            $category->keywords,
            $category->description
        );

        return $this->render('view', compact(
            'products',
            'category'
        ));
    }
}

/*
NOTE:
http://localhost/yii2/basic_shop/web/category/4
does not output keywords & description,
because they are not registered in the database under id 4

http://localhost/yii2/basic_shop/web/category/29
outputs keywords & description
*/