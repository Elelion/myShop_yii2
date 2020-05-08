<?php
use yii\helpers\Html;
?>

<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item): ?>
                    <tr>
                        <?= Html::img(
                            "@web/images/products/{$item['img']}",
                            [
                                'alt' => $item['name'],
                                'height' => 50
                            ])?>
                        <td><?= $item['img']; ?></td>
                        <td><?= $item['name']; ?></td>
                        <td><?= $item['qty']; ?></td>
                        <td><?= $item['price']; ?></td>
                        <th><span data-id="<?= $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></th>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="4">Итого</td>
                    <td><?= $session['cart.qty']; ?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму</td>
                    <td><?= $session['cart.sum']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>

<!-- TODO: 16.00 -->