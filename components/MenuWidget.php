<?php
namespace app\components;
use yii\base\Widget;

class MenuWidget extends Widget
{
  public $tpl;

  public function init()
  {
    // parent::init();

    // NOTE: if \app\components\MenuWidget::widget()
    if ($this->tpl === null) {
      $this->tpl = 'menu';
    }

    $this->tpl .= '.php';
  }

  public function run()
  {
    return $this->tpl;
  }
}