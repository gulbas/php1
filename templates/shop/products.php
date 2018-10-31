<h1>Товары в категории</h1>

<div class="card-columns">
    <?php foreach ($prods as $product): ?>
        <div class="card">
            <a class="divLink" href='/shop/product.php?id=<?= $product['id'] ?>'>
                <img class='card-img-top' src='../img/goods/small/<?= $product['image'] ?>' alt='Card image cap'>
                <div class="card-body">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class='card-text'>Цена: <?= $product['price'] ?> руб.</p>
                    <p class='card-text'>Количество в наличии: <?= $product['quantity'] ?></p>
                </div>
            </a>
            <div class="card-footer text-muted">
                <a href="category.php">Назад</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>