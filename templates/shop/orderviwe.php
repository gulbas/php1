<h1>Ваши заказ #<?= $orderid ?></h1>
<?php foreach ($order as $item): ?>
    <li class="list-group-item">
        <?= $item['product_id'] ?> (количество: <?= $item['quantity'] ?>)
    </li>
<?php endforeach; ?>