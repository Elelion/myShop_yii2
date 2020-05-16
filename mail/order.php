<?php
use yii\helpers\Html;
?>

<!--
NOTE:
view, for sending by mail
passes this view in the message body
-->

<div class="table-responsive">
    <table class="table table-hover table-striped" style="border-collapse:collapse; width: 100%;">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($session['cart'] as $id => $item): ?>
            <tr>
                <td style="border: 1px solid black;"><?= $item['name']; ?></td>
                <td style="border: 1px solid black;"><?= $item['qty']; ?></td>
                <td style="border: 1px solid black;"><?= $item['price']; ?></td>
                <td style="border: 1px solid black;"><?= $item['qty'] * $item['price']; ?></td>
                <br>
            </tr>

        <?php endforeach; ?>

        <tr>
            <td colspan="3">Итого</td>
            <td><?= $session['cart.qty']; ?></td>
        </tr>
        <tr>
            <td colspan="3">На сумму</td>
            <td><?= $session['cart.sum']; ?></td>
        </tr>
        </tbody>
    </table>
</div>

<?php
/*
 * NOTE:
 * <?= \yii\helpers\Url::to(['product/view', 'id' => $id, true]) ?>
 * absoluting link with domain name
 * */
?>