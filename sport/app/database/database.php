<?php


session_start();
require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
 
}
function  dbCheckError($query)
{
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}
//Все данные с таблицы
function selectall($table, $params = [])
{
    global $pdo;
    $sql = "select * from $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value ";
            } else {
                $sql = $sql . " AND $key = $value ";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function searchContent($text)
{
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT p.ID_product, p.name_product, p.description_product, p.price_product, p.availability, s.name_subcategory, c.name_category
    FROM products p
    JOIN subcategory s ON p.ID_subcategory = s.ID_subcategory
    JOIN category c ON p.ID_category = c.ID_category
    WHERE p.name_product LIKE '%$text%' OR s.name_subcategory LIKE '%$text%' OR c.name_category LIKE '%$text%';
    ";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//Данные одной строки
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "select * from $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value ";
            } else {
                $sql = $sql . " AND $key = $value ";
            }
            $i++;
        }
    }
    //$sql = $sql . " LIMIT 1";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $result = $query->fetch();
    return $result;
}

//Запись в таблицу БД
function insert_db($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
//Изменение строки в таблице
function update($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . "$value" . "'";
        } else {
            $str = $str . ", " . $key . " = '" . "$value" . "'";
        }
        $i++;
    }
   
    $sql = "UPDATE $table SET $str WHERE " ." ID_" .  "$table " .  " = $id";
  

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
//Удаление
function delete($table, $id)
{
    global $pdo;
    $sql = "DELETE FROM " . " $table " . " WHERE " ."ID_". "$table" . " = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
function clearBasket($table, $id)
{
    global $pdo;
    $sql = "DELETE FROM " . " $table " . " WHERE " ."ID_". "user" . " = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
function selectBasket( $idus, $idprod)
{
    global $pdo;
    $sql = "SELECT *
    FROM basket
    WHERE ID_user = $idus AND ID_product = $idprod;";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $result = $query->fetch();
    return $result;
}
function countBasket( $idus)
{
    global $pdo;
    $sql = "SELECT count(*) count
    FROM basket
    WHERE ID_user = $idus;";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $result = $query->fetch();
    return $result;
}


