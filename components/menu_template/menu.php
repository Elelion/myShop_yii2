<?php
use yii\helpers\Url;
?>

<li>
  <!-- <a href="/yii2/basic_shop/web/category/view?id=5"> ... </a> -->
    <a href=<?= Url::to(['category/view', 'id' => $category['id']]); ?>>
        <?= $category['name']; ?>
        <?php if (isset($category['childs'])): ?>
            <span class="badge pull-right">
                <i class="fa fa-plus"></i>
            </span>
        <?php endif; ?>

    </a>
    <?php if (isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif; ?>
</li>

<!-- NOTE: <a href=""> - writing is not recommended -->

<!--
NOTE:
What would our link didn't look like one:
/yii2/basic_shop/web/category/view?id=5

it looked like this:
/yii2/basic_shop/web/category/7

We need to write a rule
config -> web.php -> urlManager -> rules ->
'category/<id:\d+>' => 'category/view',
-->