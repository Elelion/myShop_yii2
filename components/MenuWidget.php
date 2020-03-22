<?php
namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget
{
    public $template;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        // parent::init();

        // NOTE: if \app\components\MenuWidget::widget()
        if ($this->template === null) {
            $this->template = 'menu';
        }

        $this->template .= '.php';
    }

    public function run()
    {
        // NOTE: getting data from the cache
        $menu = Yii::$app->cache->get('menu');
        if ($menu) {
            return $menu;
        }

        /**/

        // NOTE: creating menu
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        // NOTE: getting data from the cache
        Yii::$app->cache->set('menu', $this->menuHtml, 60);
        return $this->menuHtml;
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $this->data[ $node['parent_id']] ['childs'] [$node['id']] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }

        return $str;
    }

    protected function catToTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_template/' . $this->template;
        return ob_get_clean();
    }
}


/*
NOTE: cache
get - get the cache, and set-write the cache.

set:
• first parameter: key - the name of the cache that we will use to access it
• second parameter - the data we want to record
• third parameter: duration - life time in ms

Creating a cached menu, because it rarely changes, and in order not to load
the database with queries, we cache it

cached data is stored here:
runtime -> cache
our files is here -> /me/...
*/