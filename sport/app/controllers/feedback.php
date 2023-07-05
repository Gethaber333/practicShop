<?
include "C:/Ampps/www/sport/path.php";
include 'C:/Ampps/www/sport/app/database/database.php';
$db_search = selectall('products');
$ID_user = selectOne('user', ['login' => $_SESSION['login']]);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($_GET['ID_product_single']))) {
    $ID_prod = $_GET['ID_product_single'];
    $db_product_single = selectOne('products', ['ID_product' => $ID_prod]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_button'])) {

    $ID_product = $_POST['ID_product'];
    $ID_user = $_POST['ID_user'];
    $star = $_POST['star'];
    $text = $_POST['text'];
    $post = [

        'ID_product' => $ID_product,
        'ID_user' => $ID_user,
        'stars' => $star,
        'text' => $text
    ];
    insert_db('feedback', $post);
    header("Location:".BASE_URL."shop_single.php" . "?ID_product_single=" .$ID_product);
 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['basket_button'])) {
    
    $ID_prod = $_POST['ID_product_single_basket'];
    $db_product_single = selectOne('products', ['ID_product' => $ID_prod]);
    $product = $_POST['ID_product_single_basket'];
    $user = $ID_user['ID_user'];
    $post = [
        'ID_product' => $product,
        'ID_user' => $user
    ];
    insert_db('basket', $post);
    header("Location:".BASE_URL."shop_single.php" . "?ID_product_single=" .$ID_prod);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unbasket_button'])) {
    $ID_prod = $_POST['ID_product_single_unbasket'];
    $db_product_single = selectOne('products', ['ID_product' => $ID_prod]);
    $product = $_POST['ID_product_single_unbasket'];
    $user = $ID_user['ID_user'];
    $post = [
        'ID_product' => $product,
        'ID_user' => $user
    ];
    $id_delete_basket = selectOne('basket', $post);
    delete('basket', $id_delete_basket['ID_basket']);
    header("Location:".BASE_URL."shop_single.php" . "?ID_product_single=" .$ID_prod);
}