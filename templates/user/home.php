<h1>Hello, <?= $name ?></h1>
<p>Дата и время регистрации: <?= $date ?></p>
<p>Логин: <?= $login ?></p>
<?php if ($error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>
<form method="post">
    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
    </div>
    <div class="text-center mt-2">
        <input type="submit" id="submit" class="btn btn-info" name="edit" value="Редактировать"/>
        <input type="submit" id="submit" class="btn btn-danger" name="logout" value="Выход"/>
    </div>
</form>
<?= $orders ?>