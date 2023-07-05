<?php
include "C:/Ampps/www/sport/app/database/database.php";



function userAuto($user)
{
    $_SESSION['login'] = $user['login'];
    $_SESSION['email_user'] = $user['email_user'];
    $_SESSION['admin_status'] = $user['admin_status'];
    if ($_SESSION['admin_status']) {
        header('location: ' . BASE_URL .'index.php' );
    } else {
        header('location: ' . BASE_URL .'index.php');
    }
}


$errMsg = [];
$regStatus = '';
//Код для входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_reg'])) {


    $admin_status = 0;
    $name = trim($_POST['user_name']);
    $email = trim($_POST['user_mail']);
    $login = trim($_POST['user_login']);
    $number = trim($_POST['user_num']);
    $passf = trim($_POST['user_pass']);

   
    //$pass= password_hash($_POST['user_second_password'],PASSWORD_DEFAULT);
    if ($name === '' || $email === '' || $login === '' || $passf === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif ((mb_strlen($name, 'UTF8') < 2) || (mb_strlen($login, 'UTF8') < 2)) {
        array_push($errMsg, "Имя и Логин должны быть более 1 символа");
    } else {
        $existence = selectOne('user', ['email_user' => $email]);
        if ($existence) {
            if ($existence['email_user'] === $email) {
                array_push($errMsg, "Пользователь с данной почтой уже зарегистрирован.");
            }
            if ($existence['login'] === $login) {
                array_push($errMsg, "Пользователь с таким логином уже зарегистрирован.");
            }
        } else {

            $pass = password_hash($passf, PASSWORD_DEFAULT);
            $post = [
                'status_user' => $admin_status,
                'name_user' => $name,
                'email_user' => $email,
                'login' => $login,
                'password' => $pass,
                'number_user'=>$number

            ];
            insert_db('user', $post);
            // $user = selectOne('users',['usersid'=>$id]);
            // $user2 = selectOne('login_password',['usersid'=>$id2]);
            userAuto($post);
            // $regStatus = "Пользователь $login успешно зарегистрирован.";
        }
    }
} else {
    $name = '';
    $email = '';
    $login = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_log'])) {
    $login = trim($_POST['user_email_login']);
    $pass = trim($_POST['user_pass_password']);
    if ($login === '' || $pass === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } else {
        $existence3 = selectOne('user', ['login' => $login]);
        if ($existence3) {

            if (password_verify($pass, $existence3['password'])) {
                userAuto($existence3);

            } else {

                array_push($errMsg, "Неверная почта или пароль.");
            }
        }
    }
} else {
    $login = '';
}
