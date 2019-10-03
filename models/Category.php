<?php
namespace app\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
  // NOTE: if the class name does not match the table name in mySQL
  public static function tableName()
  {
    return 'category';
  }

  // NOTE: describe the relationship with the product table
  public function getProducts()
  {
    /**
     * NOTE:
     * first parameter:
     * recommend that you use XYZ::className() to get a string with
     * the class name. Where XYZ:: is the name of the table
     *
     * second parameter:
     * establish communication FROM ['category_id] field
     * TO ['id'] field in the current table
     *
     * what have we done:
     * that is: table Product - field category_id.
     * Binds to the category table - id field
     */
    return $this->hasMany(Product::className(), ['category_id' => 'id'])
  }
}

/**
 * NOTE:
 * ActiveRecord - provides an object-oriented interface for accessing and
 * manipulating data stored in databases. The Active Record class corresponds
 * to a table in the database, the ActiveRecord object corresponds to a row in
 * that table, and the Active Record object attribute is the value of a single
 * column in the row.
 *
 * hasMany() / hasOne() - relationship multiplicity: specified by calling the
 * has Many() method or the has One () method. In the example above, you can
 * easily see in link ads that a customer can have many orders while only one
 * customer can place an order.
 *
 * 
 */