<?php
namespace app\components;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $template;

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
        return $this->template;
    }
}