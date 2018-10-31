<?php if ($id <= 0 || $item['id'] == Null): ?>
    <h1>Goods not found!</h1>
<?php else: ?>
<div class="card">
    <div class="card-header">
        <h1 class="card-title"><?= $item['name'] ?></h1>
    </div>
    <div class="card-body">
        <div style="text-align: center; margin: 20px;">
            <img src="../img/goods/big/<?= $item['image'] ?>" style="max-width: 600px"/>
        </div>
        <p><b>Описание: </b> <?= $item['description'] ?></p>
        <p><b>Количество в наличии: </b> <?= $item['quantity'] ?></p>
        <p><b>Цена: </b> <?= $item['price'] ?> руб.</p>
        <button class="btn btn-primary" id="add-product" data-id="<?= $item['id'] ?>">
            Добавить в корзину
        </button>
    </div>
    <?php if (isAdmin()) : ?>
        <div class="card-body">
            <a href="/admin/admin.php?action=products&edit=<?= $item['id'] ?>" class="card-link">Редактировать</a>
            <a href="/admin/admin.php?action=products&delete=<?= $item['id'] ?>" class="card-link del">Удалить</a>
        </div>
    <?php endif; ?>
    <div class="card-footer text-muted">
        <a href="category.php?action=view&id=<?= $item['category_id'] ?>">Назад</a>
    </div>
</div>
<?php endif; ?>

<script src="/js/product.js" defer></script>