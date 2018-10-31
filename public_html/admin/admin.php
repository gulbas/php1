<?php

// поключаем конфигурации приложения
require '../../engine/core.php';

    if (!isAdmin()) {
        header("Location: /");
    }


// выводим список (БД)
function routeIndex()
{
    if (!isAdmin()) {
        header("Location: /");
    } else {
        echo render('admin/panel');
    }
}

function routeOrderview()
{
    if (!isAdmin()) {
        header("Location: /");
    } elseif (isset($_GET['change'])) {
        $id = (int)$_GET['change'];
        $getStatus = getItem("select status from `order` where id = {$id}");
        $getStatus ['status'] == 0 ? $status = 1 : $status = 0;
        $sql = "UPDATE `order` SET `status` = '$status' where id = {$id}";
        execute($sql);
        header("Location: /admin/admin.php?action=orderview");
    } else {

    $orders = getItemArray("select * from `order`");
    $users = getItemArray("select * from `users`");

    $orderEnd = [];

    foreach ($orders as $order) {
        if ($order['status'] == 0) {
            $order['status'] = "Новый";
        } else {
            $order['status'] = "Проведен";
        }
        foreach ($users as $user) {
            if ($order['user_id'] == $user['id']) {
                $order['user_id'] = $user['name'];
            }
        }
        array_push($orderEnd, $order);
    }

    echo render('admin/order', [
        'orders' => $orderEnd
    ]);
    }
}


function routeProducts()
{
    if (!isAdmin()) {
        header("Location: /");
    } elseif (isset($_GET['add'])) {
        routeAddproduct();
    } elseif (isset($_GET['edit'])){
        routeEditproduct();
    } elseif (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $id = (int)$id;
        $getGood = getItem("SELECT * FROM `product` WHERE  `id` = {$id}");
        execute("DELETE FROM `product` WHERE `id` = '{$id}'");
        unlink("../img/goods/big/{$getGood['image']}");
        unlink("../img/goods/small/{$getGood['image']}");
        header("Location: /admin/admin.php?action=products");
    } else {

    $getProduct = getItemArray("select * from `product`");
    $categories = getItemArray("select * from `category`");

    $products = [];

    foreach ($getProduct as $product) {
        foreach ($categories as $category) {
            $product['category_id'] == $category['id'] ? $product['category_id'] = $category['name'] : 0;
        }
        array_push($products, $product);
    }

    echo render('admin/products', [
        'products' => $products
    ]);
}
}

function routeEditproduct(){
    if (!isAdmin()) {
        header("Location: /");
    } elseif (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $id = (int)$id;
        $buttonname = "name='change'";
        $getGood = getItem("SELECT * FROM `product` WHERE  `id` = {$id}");
        $goodId = $getGood['id'];
        $goodName = $getGood['name'];
        $goodPrice = $getGood['price'];
        $goodQuantity = $getGood['quantity'];
        $goodDescription = $getGood['description'];
        $goodCategory = $getGood['category_id'];
        $goodUrl = $getGood['image'];
        $do = "Редактировать товар";
        $button = "Редактировать";
            if (isset($_POST["change"])) {
                $types = array('image/gif', 'image/png', 'image/jpeg');
                if ($_FILES['goodFile']['size'] > 0 && !in_array($_FILES['goodFile']['type'], $types)) {
                    die("Запрещённый тип файла. <a href='/admin/admin.php?action=products&edit={$goodId}'>Попробовать другой файл?</a>");
                }

                $goodName = stripcslashes(strip_tags($_POST['goodName']));
                $goodQuantity = stripcslashes(strip_tags($_POST['goodQuantity']));
                $goodQuantity = (int)$goodQuantity;
                $goodDescription = stripcslashes(strip_tags($_POST['goodDescription']));
                $goodPrice = stripcslashes(strip_tags($_POST['goodPrice']));
                $goodPrice = (int)$goodPrice;
                $goodCategory = stripcslashes(strip_tags($_POST['goodCategory']));

                if ($_FILES['goodFile']['size'] > 0) {
                    unlink("../img/goods/big/{$goodUrl}");
                    unlink("../img/goods/small/{$goodUrl}");
                    $goodUrl = $_FILES['goodFile']['name'];
                    move_uploaded_file($_FILES['goodFile']['tmp_name'], "../img/goods/big/{$goodUrl}");
                    copy("../img/goods/big/{$goodUrl}", "../img/goods/small/{$goodUrl}");
                }
        $result = execute("UPDATE product SET `name` = '{$goodName}', `price` = '{$goodPrice}', `quantity` = '{$goodQuantity}', `description` = '{$goodDescription}', `image` = '{$goodUrl}', `category_id` = '{$goodCategory}' WHERE `id` = {$id}");
        header("Location: /shop/product.php?id={$id}");
    }

    echo render('admin/product',[
        'do' => $do,
        'button' => $button,
        'goodName' => $goodName,
        'goodPrice' => $goodPrice,
        'goodQuantity' => $goodQuantity,
        'goodDescription' => $goodDescription,
        'goodCategory' => $goodCategory,
        'goodUrl' => $goodUrl, 
        'buttonname' => $buttonname
    ]);
    }
}

function routeAddproduct() {
    $do = "Добавить товар";
    $button = "Отправить";
    if (!isAdmin()) {
        header("Location: /");
    }  elseif (!empty($_POST)) {
        $types = array('image/gif', 'image/png', 'image/jpeg');
// Проверяем тип файла
        if (!in_array($_FILES['goodFile']['type'], $types))
            die('Запрещённый тип файла. <a href="?action=products&add">Попробовать другой файл?</a>');
        $goodName = stripcslashes(strip_tags($_POST['goodName']));
        $goodQuantity = stripcslashes(strip_tags($_POST['goodQuantity']));
        $goodQuantity = (int)$goodQuantity;
        $goodDescription = stripcslashes(strip_tags($_POST['goodDescription']));
        $goodPrice = stripcslashes(strip_tags($_POST['goodPrice']));
        $goodPrice = (int)$goodPrice;
        $goodCategory = stripcslashes(strip_tags($_POST['goodCategory']));
        $goodLink = $_FILES['goodFile']['name'];
        // echo "<img src='../img/goods/big/{$goodLink}'>";
        $goodPut = execute("INSERT INTO `product` (`name`, `price`, `quantity`, `description`, `image`, `category_id`) 
                                VALUES ('{$goodName}','{$goodPrice}','{$goodQuantity}','{$goodDescription}','{$goodLink}','{$goodCategory}');
                                ");
        move_uploaded_file($_FILES['goodFile']['tmp_name'], "../img/goods/big/{$goodLink}");
        copy("../img/goods/big/{$goodLink}", "../img/goods/small/{$goodLink}");
        header("Location: /admin/admin.php?action=products");
    }

    echo render('admin/product',[
        'do' => $do,
        'button' => $button
    ]);
}


// запуск маршрутизации
route();
