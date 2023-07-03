 <?php
  include "path.php";
  include 'app/database/database.php';
  include 'app/include/login.php';

  $db_search = selectall('products');
  if (isset($_SESSION['login'])){
    $ID_user = selectOne('user', ['login' => $_SESSION['login']]);
  }

  //tt($forPr);
  // Проверяем, была ли отправлена форма с параметрами сортировки
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shop_button_search'])) {
    $db_search = searchContent($_POST['search_input']);
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shop_button_search'])) {
    $db_search = searchContent($_POST['search_input']);
  }
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['side_category'])) {

    $db_search = searchContent($_GET['side_category']);
  }


  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_product_basket'])) {
    $product = $_GET['ID_product_basket'];
    $user = $ID_user['ID_user'];
    $post = [
      'ID_product' => $product,
      'ID_user' => $user
    ];
    insert_db('basket', $post);
  }
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID_product_unbasket'])) {
    $product = $_GET['ID_product_unbasket'];
    $user = $ID_user['ID_user'];
    $post = [
      'ID_product' => $product,
      'ID_user' => $user
    ];
    $id_delete_basket = selectOne('basket', $post);
    delete('basket', $id_delete_basket['ID_basket']);
  }


  $totalProducts = count($db_search);
  $productsPerPage = isset($_GET['per_page']) ? $_GET['per_page'] : 12;
  $totalPages = ceil($totalProducts / $productsPerPage);
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($currentPage - 1) * $productsPerPage;

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['shop_button_search'])) {
    $db_search = searchContent($_POST['search_input']);
    $totalProducts = count($db_search);
    $totalPages = ceil($totalProducts / $productsPerPage);
    $currentPage = 1;
    $offset = 0;
  }

  $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';

  if ($sort == 'name-asc') {
    usort($db_search, function ($a, $b) {
      return strcmp($a['name_product'], $b['name_product']);
    });
  } elseif ($sort == 'name-desc') {
    usort($db_search, function ($a, $b) {
      return strcmp($b['name_product'], $a['name_product']);
    });
  } elseif ($sort == 'price-asc') {
    usort($db_search, function ($a, $b) {
      return $a['price_product'] - $b['price_product'];
    });
  } elseif ($sort == 'price-desc') {
    usort($db_search, function ($a, $b) {
      return $b['price_product'] - $a['price_product'];
    });
  }



  $db_search = array_slice($db_search, $offset, $productsPerPage);
  ?>

 <html lang="en">

 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Кавказ Shop | Магазинчик</title>

   <!-- Bootstrap -->
   <link href="assets/css/bootstrap.css" rel="stylesheet">
   <!-- Main style sheet -->
   <link href="assets/css/style.css" rel="stylesheet">
   <!-- Theme color -->
   <link href="assets/css/theme.css" rel="stylesheet">
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
   <?php include 'app/include/header.php' ?>

   <?php include 'app/include/menu.php' ?>
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
   <section id="aa-product-category">
     <div class="container">
       <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
           <div class="aa-product-catg-content">
             <div class="aa-product-catg-head">
               <div class="aa-product-catg-head-left">
                 <form action="shop.php" method="GET" class="aa-sort-form">
                   <label for="sort">Сортировать по</label>
                   <select name="sort" onchange="changeSorting(this)">
                     <option value="default" <?php echo ($sort == "default") ? 'selected' : ''; ?>>Без сортировки</option>
                     <option value="name-asc" <?php echo ($sort == "name-asc") ? 'selected' : ''; ?>>Название (От А до Я)</option>
                     <option value="name-desc" <?php echo ($sort == "name-desc") ? 'selected' : ''; ?>>Название (От Я до А)</option>
                     <option value="price-asc" <?php echo ($sort == "price-asc") ? 'selected' : ''; ?>>Цена (по возрастанию)</option>
                     <option value="price-desc" <?php echo ($sort == "price-desc") ? 'selected' : ''; ?>>Цена (от большего)</option>
                   </select>
                 </form>

                 <form action="shop.php" method="GET" class="aa-show-form">
                   <label for="per_page">Показывать по:</label>
                   <select name="per_page" id="per_page" onchange="changePerPage(this)">
                     <option value="6" <?php echo ($productsPerPage == 6) ? 'selected' : ''; ?>>6</option>
                     <option value="12" <?php echo ($productsPerPage == 12) ? 'selected' : ''; ?>>12</option>
                     <option value="24" <?php echo ($productsPerPage == 24) ? 'selected' : ''; ?>>24</option>
                   </select>
                 </form>
               </div>
               <div class="aa-product-catg-head-right">
                 <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                 <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
               </div>
             </div>
             <div class="aa-product-catg-body">
               <ul class="aa-product-catg">

                 <!-- start single product item -->
                 <?php foreach ($db_search as $key => $value) :   ?>
                   <li>
                     <figure>
                       <a class="aa-product-img" href="shop_single.php?ID_product_single=<?= $value['ID_product'] ?>"><img src="assets/img/cap/cap-1.png" alt="polo shirt img"></a>
                       <?php   if (isset($_SESSION['login'])){
                        $exist = selectBasket($ID_user['ID_user'], $value['ID_product'])
                        ;
                       }
                        if (isset($exist['ID_user'])) :
                        ?>
                         <form action="shop.php" method="post">
                           <a name="button_basket" class="aa-add-card-btn" href="shop.php?ID_product_unbasket=<?= $value['ID_product'] ?>"><span class="fa fa-shopping-cart"></span>Убрать из корзины</a>

                         </form>
                       <?php else : ?>
                         <form action="shop.php" method="post">
                           <a name="button_basket" class="aa-add-card-btn" href="shop.php?ID_product_basket=<?= $value['ID_product'] ?>"><span class="fa fa-shopping-cart"></span>В корзину</a>
                         </form>
                       <?php endif; ?>

                       <figcaption>
                         <h4 class="aa-product-title"><a href="?ID_product=<?= $value['ID_product'] ?>"><?= $value['name_product'] ?></a></h4>
                         <span class="aa-product-price"><?= $value['price_product'] ?></span>
                         <p class="aa-product-descrip"><?= $value['description_product'] ?></p>
                       </figcaption>
                     </figure>

                   </li>
                 <?php endforeach;   ?>
                 <!-- start single product item -->
               </ul>
               <!-- quick view modal -->
               <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-body">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <div class="row">
                         <!-- Modal view slider -->
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <div class="aa-product-view-slider">
                             <div class="simpleLens-gallery-container" id="demo-1">
                               <div class="simpleLens-container">
                                 <div class="simpleLens-big-image-container">
                                   <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                     <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                   </a>
                                 </div>
                               </div>
                               <div class="simpleLens-thumbnails-container">
                                 <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="img/view-slider/large/polo-shirt-1.png" data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                   <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                 </a>
                                 <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="img/view-slider/large/polo-shirt-3.png" data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                   <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                 </a>

                                 <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="img/view-slider/large/polo-shirt-4.png" data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                   <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                 </a>
                               </div>
                             </div>
                           </div>
                         </div>
                         <!-- Modal view content -->
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <div class="aa-product-view-content">
                             <h3>T-Shirt</h3>
                             <div class="aa-price-block">
                               <span class="aa-product-view-price">$34.99</span>
                               <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                             </div>
                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                             <h4>Size</h4>
                             <div class="aa-prod-view-size">
                               <a href="#">S</a>
                               <a href="#">M</a>
                               <a href="#">L</a>
                               <a href="#">XL</a>
                             </div>
                             <div class="aa-prod-quantity">
                               <form action="">
                                 <select name="" id="">
                                   <option value="0" selected="1">1</option>
                                   <option value="1">2</option>
                                   <option value="2">3</option>
                                   <option value="3">4</option>
                                   <option value="4">5</option>
                                   <option value="5">6</option>
                                 </select>
                               </form>
                               <p class="aa-prod-category">
                                 Category: <a href="#">Polo T-Shirt</a>
                               </p>
                             </div>
                             <div class="aa-prod-view-bottom">
                               <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                               <a href="#" class="aa-add-to-cart-btn">View Details</a>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div><!-- /.modal-content -->
                 </div><!-- /.modal-dialog -->
               </div>
               <!-- / quick view modal -->
             </div>
             <div class="aa-product-catg-pagination">
               <nav>
                 <ul class="pagination">
                   <?php if ($currentPage > 1) : ?>
                     <li>
                       <a href="?page=<?php echo $currentPage - 1; ?>&per_page=<?php echo $productsPerPage; ?>" aria-label="Previous">
                         <span aria-hidden="true">&laquo;</span>
                       </a>
                     </li>
                   <?php endif; ?>

                   <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                     <li>
                       <a class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>" href="?page=<?php echo $i; ?>&per_page=<?php echo $productsPerPage; ?>">
                         <?php echo $i; ?>
                       </a>
                     </li>
                   <?php endfor; ?>

                   <?php if ($currentPage < $totalPages) : ?>
                     <li>
                       <a href="?page=<?php echo $currentPage + 1; ?>&per_page=<?php echo $productsPerPage; ?>" aria-label="Next">
                         <span aria-hidden="true">&raquo;</span>
                       </a>
                     </li>
                   <?php endif; ?>
                 </ul>
               </nav>
             </div>


           </div>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
           <aside class="aa-sidebar">
             <!-- single sidebar -->
             <div class="aa-sidebar-widget">
               <h3>Категории</h3>
               <ul class="aa-catg-nav">
                 <?php foreach ($category as $key => $value) :   ?>


                   <li><a name="side_category" href="shop.php?side_category=<?= $value['name_category'] ?>"><?= $value['name_category'] ?></a></li>
                 <?php endforeach;   ?>

               </ul>
             </div>
           </aside>
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