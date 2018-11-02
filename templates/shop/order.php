<h1>Ваши заказы</h1>
<?= $login ?>
<?php if (count($orders) > 0) : ?>
    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">Номер заказа</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Статус</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <th scope="row" onclick="window.location.href='/shop/order.php?action=view&id=<?= $order['id'] ?>'" class='href'><?= $order['id'] ?></th>
                <td><?= $order['created_at'] ?></td>
                <td><?= $order['status'] ?></td>
                <?php if($order['status'] != 'Отправлен'): ?>
                <td class="status"><a href="#" class="order_status" data-id="<?= $order['id'] ?>">del</a></td>
                <?php else: ?>
                <td></td>
                <?php endif; ?> 
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="my-5">
        <em>Вы еще ничего не заказали? :(</em>
    </div>
<?php endif; ?>
<script src="/js/orderuser.js" defer></script>

