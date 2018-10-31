<?php

// поключаем конфигурации приложения
require '../engine/core.php';

function routeIndex()
{
    // перехват стандартного действия
    routeLogin();
}

// страница с формой входа
function routeLogin()
{
    // редирект если уже авторизован
    if (isLoggedUser()) {
        header("Location: /user.php?action=home");
    }

    $error = false;

    // проверка данных из формы
    if (isset($_POST['login_user'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = getItem("select * from users where login='{$login}'");

        if ($user != false) {
            if (password_verify($password, $user['password'])) {
                if (isset($_POST['remember'])) {
                    loginUser($login, true);
                } else {
                    loginUser($login);
                }

                header("Location: /user.php?action=home");
            }
        } else {
            $error = "Пользватель не найден или пароль и логин не верные";
        }
    }

    echo render('user/login', [
        'error' => $error
    ]);
}

function routeLogout()
{
    logoutUser();
}

function routeHome()
{
    if (isset($_POST['logout'])) {
        routeLogout();
    }

    $login = $_SESSION['auth']['login'];
    $sql = "select * from users where login = '{$login}'";
    $user = getItem($sql);

    if (isset($_POST['edit'])) {
        $error = false;

        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $sql = "UPDATE users SET `email` = '{$email}', `name` = '{$name}' WHERE `login` = '{$login}'";

        if (!empty($name) && !empty($email) && execute($sql)) {
            header("Location: /user.php?action=home");
        } else {
            $error = "Ошибка в заполненных данных";
        }
    }

    echo render('user/home', [
        'login' => $user['login'],
        'name' => $user['name'],
        'date' => $user['datetime'],
        'email' => $user['email'],
        'error' => $error
    ]);
}


function routeRegister()
{
    $error = false;

    // грузим из POST
    if (isset($_POST['reg_user'])) {
        $email = htmlspecialchars($_POST['email']);
        $name = htmlspecialchars($_POST['name']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        // хешируем пароль
        $password = password_hash($password, PASSWORD_DEFAULT);

        // готовим запрос SQL
        $sql = "insert into users (`email`, `name`, `password`, `login`) value ('{$email}', '{$name}', '{$password}', '{$login}')";

        if (!empty($name) && !empty($email) && !empty($password) && !empty($login) && execute($sql)) {
            // авторизуем
            loginUser($login, true);
            header("Location: /user.php?action=home");
        } else {
            $error = "Something went wrong";
        }
    }

    echo render('user/register', [
        'error' => $error
    ]);
}

route();