<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    // NOTE: http://localhost/yii2/basic_shop/web/
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
        $id = Yii::$app->request->get('id');

        /**/

        // NOTE: our query that returns all records
        $query = Product::find()
            ->where(['category_id' => $id]);

        /*
         * NOTE:
         * calculates the total number of entries, for further pagination
         *
         * 'pageSize' => 3 - outputs 3 entries per page
         * if this parameter is omitted, 20 is output by default
         *
         * 'forcePageParam' => false + 'pageSizeParam' => false - for clear url
         * /web/category/4?per-page=3 -> .../4?per-page=3 - it is trash
         *
         * rules - look at web.php -> urlManager -> rules
         * */
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        /*
         * NOTE:
         * $query->offset($pages->offset) - we say which entry to start with
         * ->limit($pages->limit) - number of entries per page
         * ->all(); - select from all entries
         * */
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        /**/

        $category = Category::findOne($id);

        $this->setMeta(
            'E-SHOP__view | ' . $category->name,
            $category->keywords,
            $category->description
        );

        return $this->render('view', compact(
            'products',
            'pages',
            'category'
        ));
    }
}

/*
NOTE:
an example of pagination is given here:
https://www.yiiframework.com/doc/guide/2.0/ru/output-pagination
*/