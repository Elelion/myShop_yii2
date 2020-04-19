<?php


namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{
    // NOTE: http://localhost/yii2/basic_shop/web/
    public function actionIndex()
    {
        $hits = Product::find()
            ->where(['hit' => '1'])
            ->limit(6)
            ->all();

        $this->setMeta('E-SHOPPER__index');
        return $this->render('index', compact('hits'));
    }

    // NOTE: http://localhost/yii2/basic_shop/web/category/4
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);

        // NOTE: .../web/category/300
        if (empty($category)) {
            throw new HttpException(
                404,
                'There is no such category'
            );
        }

        /**/

        $query = Product::find()
            ->where(['category_id' => $id]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        /**/

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

    // NOTE: ../web/ -> search field -> enter
    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));

        // NOTE: we place meta tags here for both the empty query and the found one
        $this->setMeta('E-SHOP__view | Search: ' . $q);

        if (!$q) {
            return $this->render('search');
        }

        $query = Product::find()
            ->where(['like', 'name', $q]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('search', compact(
            'products',
            'pages',
            'q'
        ));
    }
}
