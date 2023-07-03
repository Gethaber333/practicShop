<?php
include 'app/controllers/feedback.php';
include 'app/include/login.php';

//tt($forPr);

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


<body class="productPage">

    <div id="wpf-loader-two">
        <div class="wpf-loader-two-inner">
            <span>Чиллим</span>
        </div>
    </div>
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>

    <!-- / header section -->
    <?php include 'app/include/header.php' ?>

    <?php include 'app/include/menu.php' ?>


    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="assets/img/cap/cap-2.jpg" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">

                    <ol class="breadcrumb">
                        <li><a href="index.html">Дом</a></li>
                        <li class="active">Магазинчик</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container"><img src="assets/img/cap/cap-3.png" class="simpleLens-big-image"></div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <?php ?>
                                        <h3><?php echo $db_product_single['name_product'] ?></h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price"><?php echo $db_product_single['price_product'] ?></span>
                                            <p class="aa-product-avilability">Наличие:
                                                <?php if ($db_product_single['availability'] == 1) : ?>
                                                    <span>
                                                        Есть в наличии
                                                    </span>
                                                <?php else : ?>
                                                    <span>
                                                        Нет в наличии
                                                    </span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                        <p><?php echo $db_product_single['description_product'] ?></p>

                                        <div class="aa-prod-view-bottom">
                                            <?php $exist = selectBasket($ID_user['ID_user'], $db_product_single['ID_product']);

                                            if (isset($exist['ID_user'])) :
                                            ?>
                                                <form action="shop_single.php" method="post">
                                                    <input type="hidden" name="ID_product_single_unbasket" value="<?= $db_product_single['ID_product'] ?>">
                                                    <button type="submit" name="unbasket_button" class="aa-browse-btn">Убрать из корзины</button>

                                                </form>
                                            <?php else : ?>
                                                <form action="shop_single.php" method="post">
                                                    <input type="hidden" name="ID_product_single_basket" value="<?= $db_product_single['ID_product'] ?>">
                                                    <button type="submit" name="basket_button" class="aa-browse-btn">В корзину</button>
                                                </form>
                                            <?php endif; ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">

                                <li><a href="#review" data-toggle="tab">Отзывы</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade " id="review">
                                    <div class="aa-product-review-area">
                                        <h4>Отзывы</h4>
                                        <ul class="aa-review-nav">
                                            <?php
                                            $feedback = selectall('feedback', ['ID_product' => $ID_prod]);

                                            foreach ($feedback as $key => $value) :
                                            ?>
                                                <?php
                                                $feedback_user = selectOne('user', ['ID_user' => $value['ID_user']]);

                                                ?>
                                                <li>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#">
                                                                <img class="media-object" src="assets/img/cap/cap-4.png" alt="girl image">
                                                            </a>
                                                        </div>

                                                        <div class="media-body">
                                                            <h4 class="media-heading"><strong><?= $feedback_user['name_user'] ?></strong> - <span><?= $value['date_feedback'] ?></span></h4>
                                                            <div class="aa-product-rating">
                                                                <?php for ($i = 0; $i < $value['stars']; $i++) : ?>
                                                                    <span class="fa fa-star"></span>
                                                                <?php endfor; ?>
                                                                <?php for ($i = $value['stars']; $i < 5; $i++) : ?>
                                                                    <span class="fa fa-star-o"></span>
                                                                <?php endfor; ?>
                                                            </div>
                                                            <p><?= $value['text'] ?></p>
                                                        </div>

                                                    </div>

                                                </li>

                                            <?php endforeach;   ?>
                                        </ul>
                                        <h4>Оставить отзыв</h4>

                                        <!-- review form -->
                                        <form method="post" action="app/controllers/feedback.php" class="aa-review-form">
                                            <input type="hidden" name="ID_product" value="<?= $db_product_single['ID_product'] ?>">
                                            <input type="hidden" name="ID_user" value="<?= $ID_user['ID_user'] ?>">
                                            <div class="aa-your-rating">
                                                <p>Рейтинг</p>
                                                <a class="star" data-value="1"><span class="fa fa-star-o"></span></a>
                                                <a class="star" data-value="2"><span class="fa fa-star-o"></span></a>
                                                <a class="star" data-value="3"><span class="fa fa-star-o"></span></a>
                                                <a class="star" data-value="4"><span class="fa fa-star-o"></span></a>
                                                <a class="star" data-value="5"><span class="fa fa-star-o"></span></a>
                                                <input type="hidden" name="star" id="star-input">
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Ваш отзыв</label>
                                                <textarea name="text" class="form-control" rows="3" id="message"></textarea>
                                            </div>

                                            <button name="feedback_button" type="submit" class="btn btn-default aa-review-submit">Отправить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->


    <?php include 'app/include/footer.php' ?>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="<?php echo  BASE_URL ?>js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleGallery.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleLens.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/slick.js"></script>
   <script src="<?php echo  BASE_URL ?>js/custom.js"></script>

</body>

</html>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination li {
        display: inline-block;
        margin: 0 5px;
    }

    .pagination li a {
        padding: 5px 10px;
        border: 1px solid #ccc;
    }

    .pagination li a.active {
        background-color: #ccc;
    }
</style>
<script>
    function changePerPage(selectElement) {
        var perPage = selectElement.value;
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.set('per_page', perPage);
        window.location.href = '?' + urlParams.toString();
    }
</script>
<script>
    function changeSorting(selectElement) {
        var sorting = selectElement.value;
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sort', sorting);
        window.location.href = '?' + urlParams.toString();
    }
</script>
<script>
    // Очистка параметра ID_product_single_basket или ID_product_single_unbasket из URL
    function clearBasketParams() {
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('ID_product_single_basket');
        urlParams.delete('ID_product_single_unbasket');
        var newUrl = window.location.pathname + '?' + urlParams.toString();
        history.replaceState(null, null, newUrl);
    }
</script>
<script>
    // JavaScript код для обработки выбранной звезды и обновления значения в поле формы
    const stars = document.querySelectorAll('.star');
    const starInput = document.getElementById('star-input');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            starInput.value = value;

            // Обновление состояния звезд
            stars.forEach(s => {
                const starValue = s.getAttribute('data-value');
                if (starValue <= value) {
                    s.innerHTML = `<span class="fa fa-star"></span>`;
                } else {
                    s.innerHTML = `<span class="fa fa-star-o"></span>`;
                }
            });
        });
    });
</script>