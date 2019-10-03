<?php
namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
  public static function tableName()
  {
    return 'product';
  }

  public function getCategory()
  {
    // NOTE: one product can have only one category
    return $this->hasOne(Category::className(), ['id' => 'category_id'])
  }
}