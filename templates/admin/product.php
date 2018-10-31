<h1><?= $do ?></h1>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="goodName">Название товара</label>
        <input id="goodName" class="form-control" type="text" name="goodName" value="<?= $goodName ?>">
    </div>
    <div class="form-group">
        <label for="goodQuantity">Количество</label>
        <input id="goodQuantity" class="form-control" type="number" name="goodQuantity" value="<?= $goodQuantity ?>">
    </div>
    <div class="form-group">
        <label for="goodDescription">Описание</label>
        <textarea id="goodDescription" class="form-control" rows="3"
                  name="goodDescription"><?= $goodDescription ?></textarea>
    </div>
    <div class="form-group">
        <label for="goodPrice">Цена</label>
        <input id="goodPrice" class="form-control" type="text" name="goodPrice" value="<?= $goodPrice ?>">
    </div>
    <div class="form-group">
        <label for="goodCategory">Категория товара</label>
        <input id="goodCategory" class="form-control" type="text" name="goodCategory" value="<?= $goodCategory ?>">
    </div>
    <div class="form-group">
        <label for="goodFile">Фото товара (.jpg, .png, .gif)</label>
        <input id="goodFile" class="form-control" type="file" name="goodFile" value="<?= $goodUrl ?>">
    </div>
        <button class="btn-outline-success btn-lg btn-block" <?= $buttonname ?> id="submit"><?= $button ?></button>
</form>