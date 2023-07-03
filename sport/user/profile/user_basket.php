<?php

include '../../app/controllers/user_profile.php';

include '../../app/include/login.php';

$name = $_SESSION['login'];

$info = selectOne('user', ['login' => $name]);

?>



<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Кавказ Shop | Магазинчик</title>

   <!-- Bootstrap -->
   <link href="<?php echo  BASE_URL ?>assets/css/bootstrap.css" rel="stylesheet">
   <!-- Main style sheet -->
   <link href="<?php echo  BASE_URL ?>assets/css/style.css" rel="stylesheet">
   <!-- Theme color -->
   <link href="<?php echo  BASE_URL ?>assets/css/theme.css" rel="stylesheet">
   <!-- Google Font -->
   <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

 </head>


<body>

    <!-- wpf loader Two -->
    <div id="wpf-loader-two">
        <div class="wpf-loader-two-inner">
            <span>Чиллим</span>
        </div>
    </div>
    <!-- / wpf loader Two -->
    <!-- SCROLL TOP BUTTON -->

    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TOP BUTTON -->

    <!-- / header section -->
    <?php include '../../app/include/header.php' ?>

    <?php include '../../app/include/menu.php' ?>

    <div class="container mt-5">
        <div class="row">

            <!-- Account Sidebar-->
            <?php include '../../app/include/user_sidebar.php' ?>
            <!-- Profile Settings-->

            <div class="col-lg-8">
                <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <!-- Wishlist Table-->
                <div class="table-responsive wishlist-table margin-bottom-none">
                    <form method="post" action="<?php echo  BASE_URL ?>app/controllers/user_profile.php">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Имя продукта</th>
                                    <th class="text-center"><button type="submit" name="button_clear_all" class="btn btn-sm btn-outline-danger">Очистить корзину</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $my_basket = selectall('basket', ['ID_user' => $id['ID_user']]);
                                $sum = 0;

                                foreach ($my_basket as $key1 => $value1) :
                                ?>
                                    <tr>
                                        <?php

                                        $my_basket_product = selectall('products', ['ID_product' => $value1['ID_product']]);
                                        foreach ($my_basket_product as $key2 => $value2) :
                                        ?>
                                            <td>
                                                <div class="product-item">
                                                    <a class="product-thumb" href="<?= BASE_URL ?>shop_single.php?ID_product_single=<?= $value2['ID_product'] ?>"><img src="<?php echo  BASE_URL ?>assets/img/cap/cap-6.jpg" alt="Product"></a>
                                                    <div class="product-info">
                                                        <h4 class="product-title"><a href="<?= BASE_URL ?>shop_single.php?ID_product_single=<?= $value2['ID_product'] ?>"><?= $value2['name_product'] ?></a></h4>
                                                        <div class="text-lg text-medium text-muted"><?php
                                                                                                    echo  $value2['price_product'];
                                                                                                    $sum = $sum + $value2['price_product'];
                                                                                                    ?></div>

                                                    </div>
                                                </div>

                                            </td>
                                            <td class="text-center">
                                                <form method="post">
                               
                                                    <input type="hidden" name="ID_item_clear" value="<?=$value1['ID_product'] ?>"></input>
                                                    <button type="submit" name="button_clear_item" class="remove-from-cart">Убрать из корзины</button>
                                                </form>

                                            </td>

                                    </tr>
                                <?php endforeach;  ?>

                            <?php endforeach;   ?>
                            </tbody>
                        </table>


                        <span class="text-lg text-medium text-muted">
                            Всего <?= $sum; ?>
                        </span>

                        <button type="submit" name="button_order" class="aa-browse-btn">Заказать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php include '../../app/include/footer.php' ?>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="<?php echo  BASE_URL ?>js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleGallery.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleLens.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/slick.js"></script>
   <script src="<?php echo  BASE_URL ?>js/custom.js"></script>


</body>

</html>