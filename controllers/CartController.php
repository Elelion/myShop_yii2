<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use Yii;

use app\models\OrderProduct;
use app\models\OrderItem;

/*
Array
(
	[1] => Array
	(
		[qty] => QTY
		[name] => NAME
		[price] => PRICE
		[img] => IMG
	)

	[10] => Array
	(
		[qty] => QTY
		[name] => NAME
		[price] => PRICE
		[img] => IMG
	)
)

	[qty] => QTY,
	[sum] => SUM
);
*/

class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;

        $this->layout = false;
        $product = Product::findOne($id);

        if (empty($product)) {
            return false;
        }

        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);

        if (!Yii::$app->request->isAjax) {
            // NOTE: return to the page that the user came from
            //return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('cart-model', compact('session'));
    }

    public function actionClear()
    {
        $this->layout = false;

        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        return $this->render('cart-model', compact('session'));
    }

    public function actionDel()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Basket');
        $order = new OrderProduct();

        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);

                Yii::$app->session->setFlash(
                    'success',
                    'Ваш заказ принят, менеджер скоро с вами свяжется');

                /*
                 * NOTE:
                 * passing our shopping cart:
                 * Yii::$app->mailer->compose('order', compact('session'))
                 *
                 * ->setFrom - which e-mail is used to get this mail.
                 * There must be something that is in the mail settings
                 * in the web.php!!!
                 *
                 * ->setFrom(['test@mail.ru' => 'yii2.loc'])
                 * yii2.loc - this is what the user will see in the From field
                 *
                 * ->setTo - address where we send the email
                 * ->setTo(Yii::$app->params['adminEmail']) - send mail for admin
                 * look address in config/params.php
                 *
                 * ->setSubject - topic
                 *
                 * ->setTextBody('text') - send a text message
                 *
                 * ->setHtmlBody('<b>text</b>') - send in html format
                 *
                 * ->send() - send mail
                 * */

                Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom(['test@mail.ru' => 'yii2.loc'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();

                // NOTE: clear basket
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                // NOTE: reload page
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash(
                    'error',
                    'Ощибка оформления заказа');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            /*
             * NOTE:
             * we create our own object for each record,
             * so we write it in foreach
             * */

            // NOTE: saves an order with a unique id
            $order_items = new OrderItem;
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];

            $order_items->save();
        }
    }
}
