<h1>Подтверждение заказа</h1>

<table class="table table-striped mt-5">
    <thead>
    <tr>
        <th scope="col">Номер заказа</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Кто создал</th>
        <th scope="col">Статус</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <th scope="row"><?= $order['id'] ?></th>
            <td><?= $order['created_at'] ?></td>
            <td><?= $order['user_id'] ?></td>
            <td><a class="status" data-id="<?= $order['id'] ?>" href="#"><?= $order['status'] ?></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script src="/js/orders.js" defer></script>