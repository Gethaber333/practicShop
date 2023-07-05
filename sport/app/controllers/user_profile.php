<?php
include "C:/Ampps/www/sport/app/database/database.php";
include "../../path.php";
$errMsg = [];

//EDIT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $usersid = trim($_POST['ID_user']);
    $user_name = trim($_POST['user_name']);
    $user_mail = trim($_POST['user_mail']);
    $user_num = trim($_POST['user_num']);
    $prof2 = selectOne('user', ['email_user' => $user_mail]);

    if (!isset($prof2['email_user'])) {
        $user_mail = trim($_POST['user_mail']);

        if ($user_mail === '') {
            array_push($errMsg, "Отсутствует почта.");
        } elseif ((mb_strlen($user_name, 'UTF8') < 2)) {
            array_push($errMsg, "Имя и Логин должны быть более 1 символа");
        } else {
            $existence = selectOne('user', ['email_user' => $user_mail]);


            $post = [
                'name_user' => $user_name,
                'email_user' => $user_mail,

                'number_user' => $user_num,

            ];
            update('user', $usersid, $post);
        }
    } elseif ($_SESSION['email_user'] === $prof2['email_user']) {
        $user_mail = trim($_POST['user_mail']);

        if ($user_mail === '') {
            array_push($errMsg, "Отсутствует почта.");
        } elseif ((mb_strlen($user_name, 'UTF8') < 2)) {
            array_push($errMsg, "Имя и Логин должны быть более 1 символа");
        } else {
            $existence = selectOne('user', ['email_user' => $user_mail]);


            $post = [
                'name_user' => $user_name,
                'email_user' => $user_mail,

                'number_user' => $user_num,

            ];
            update('user', $usersid, $post);
        }
    } else {


        array_push($errMsg, "Данная почта уже занята");
    }
}
//Корзина
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_clear_all'])) {
    $name = $_SESSION['login'];
    $info = selectOne('user', ['login' => $name]);
    clearBasket('basket',$info['ID_user']);
    header("Location:" . BASE_URL . "user/profile/user_basket.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_clear_item'])) {

    $ID_prod=$_POST['ID_item_clear'];
    $name = $_SESSION['login'];
    $info = selectOne('user', ['login' => $name]);
 
    $post = [
        'ID_product' => $ID_prod,
        'ID_user' => $info['ID_user']
    ];
 
    $id_delete = selectOne('basket', $post);
    delete('basket', $id_delete['ID_basket']);
    header("Location:" . BASE_URL . "user/profile/user_basket.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_order'])) {
    tt($_POST);




    exit;
    header("Location:" . BASE_URL . "user/profile/user_orders.php");
}
