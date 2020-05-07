<?php


namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product, $qty = 1)
    {
        // NOTE: if the product already exists in the session, then add it to it
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty'   => $qty,
                'name'  => $product->name,
                'price' => $product->price,
                'img'   => $product->img,
            ];
        }

        // DTO

        /*
         * NOTE:
         * if we already have one $_SESSION['cart.qty'] then we add a
         * quantity to it, if it doesn't exist, then we add this quantity
         * */
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty'])
            ? $_SESSION['cart.qty'] + $qty
            : $qty;

        $_SESSION['cart.qty'] = isset($_SESSION['cart.sum'])
            ? $_SESSION['cart.sum'] + $qty * $product->price
            : $qty * $product->price;
    }
}