<?php

require '../../engine/core.php';

/**
 * Выводим список категорий
 */
function routeIndex()
{
    $sql = "select * from users where login = '{$_SESSION['auth']['login']}'";
    $user = getItem($sql);

    $orders = getItemArray(
        "select * from `order` where user_id = '{$user['id']}'"
    );

    $orderEnd = [];

    foreach ($orders as $order) {
        if ($order['status'] == 0) {
            $order['status'] = "Обрабатывается";
        } else {
            $order['status'] = "Отправлен";
        }
        array_push($orderEnd, $order);
    }


    echo render('shop/order', [
        'orders' => $orderEnd,
    ]);
}

function routeView()
{
    $id = $_GET['id'];
    if (isset($_GET['id'])) {
        $order = getItemArray(
            "select * from `order_item` where `order_id` = '{$id}'"
        );

        $products = getItemArray(
            "select * from `product`"
        );

        $orderEnd = [];

        foreach ($order as $item) {
            foreach ($products as $product) {
                if ($item['product_id'] == $product['id']) {
                    $item['product_id'] = $product['name'];
                }
            }
            array_push($orderEnd, $item);
        }
    }


    echo render('shop/orderviwe', [
        'order' => $orderEnd,
        'orderid' => $id
    ]);
}

route();