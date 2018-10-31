<h1>Управление продуктами</h1>
<table class="table table-striped mt-5">
    <thead>
    <tr>
        <th scope="col">Номер</th>
        <th scope="col">Название</th>
        <th scope="col">Цена</th>
        <th scope="col">Количество</th>
        <th scope="col">Категория</th>
        <th scope="col"></th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <th scope="row"><?= $product['id'] ?></th>
            <td><a href="/shop/product.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['category_id'] ?></td>
            <td><a href="?action=products&delete=<?= $product['id'] ?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="text-center mt-5">
    <a class="btn btn-info" href="admin.php?action=products&add">Добавить товар</a>
    <!--    <input type="submit" id="submit" class="btn btn-danger" name="logout" value="Выход"/>-->
</div>
