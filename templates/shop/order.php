<h1>Ваши заказы</h1>
<?= $login ?>
<?php if (count($orders) > 0) : ?>
<table class="table table-striped mt-5">
    <thead>
    <tr>
        <th scope="col">Номер заказа</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Статус</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr onclick="window.location.href='/shop/order.php?action=view&id=<?= $order['id'] ?>'" class='href'>
            <th scope="row"><?= $order['id'] ?></th>
            <td><?= $order['created_at'] ?></td>
            <td><?= $order['status'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <div class="my-5">
        <em>Вы еще ничего не заказали? :(</em>
    </div>
<?php endif; ?>


