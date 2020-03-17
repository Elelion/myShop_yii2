<?php
namespace app\components;
use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget
{
    public $template;
    public $data;
    public $tree;
    public $menuHtml;

    // NOTE: default auto initialized method
    public function init()
    {
        // parent::init();

        // NOTE: if \app\components\MenuWidget::widget()
        if ($this->template === null) {
            $this->template = 'menu';
        }

        $this->template .= '.php';
    }

    // NOTE: default auto-run method
    public function run()
    {
        // NOTE: ->indexBy('id) - to index an array, where 'id' key for index
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        //debug($this->data);
        return $this->menuHtml;
    }

    // NOTE: to build a tree from an array
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

    // NOTE: passes the tree parameter
    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }

        return $str;
    }

    /*
     * NOTE:
     * whatever the result is displayed on the screen we buffer it
     * in the same way, we replace the classic render -> views
     * .../components/views/...
     * */
    protected function catToTemplate($category)
    {
        ob_start();
        include __DIR__ . '/menu_template/' . $this->template;
        return ob_get_clean();
    }
}

/*
NOTE:
Плагины качаем тут:
https://plugins.jquery.com/cookie/ - jQuery Cookie
https://github.com/Shakhlin/new_yii2/tree/master/web/js - all plugins
*/