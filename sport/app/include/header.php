  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  
    

                  <?php  if (isset($_SESSION['login'])) : ?>
             
                    <li><a href="<?php echo  BASE_URL ?>user/profile/user_index.php">Мой аккаунт</a></li>
                  <?php else : ?>
                    <li><a href="<?php echo  BASE_URL ?>account.php">Мой аккаунт</a></li>
                    <?php endif; ?>


                  <?php if (isset($_SESSION['login'])) : ?>
                    <li><a> <?php
                            echo $_SESSION['login'];
                            ?></a></li>
                    <li><a href="<?php echo BASE_URL. 'logout.php' ?>">Выход</a></li>
                  <?php else : ?>

                    <li><a href="" data-toggle="modal" data-target="#login-modal">Войти</a></li>
                    <ul>
                    <?php endif; ?>



                    </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="<?php echo  BASE_URL ?>index.php">
                  <span class="fa fa-shopping-cart"></span>
                  <p>Кавказ<strong>Shop</strong> <span>Ваш дикий Look</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
              <!-- корзина -->
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">Корзина</span>
                  <?php if (isset($_SESSION['login'])) :
                   $id=selectOne('user',['login'=>$_SESSION['login']]);
                  $count=countBasket($id['ID_user'])
                  
                  
                  
                  ; 
                   ?>
              
                  <span class="aa-cart-notify"><?=$count['count']?></span>
                  <?php else:?>
                
                    <?php endif;?>
                </a>
                <?php if(isset($_SESSION['login'])) :   ?>
                <div class="aa-cartbox-summary">
                  <ul>               
                  <?php  
                           $my_basket=selectall('basket',['ID_user'=>$id['ID_user']]);
                           $sum=0;
                  foreach ($my_basket as $key => $value) :  
                   ?>
                    <li>
                    <?php   
                           $my_basket_product=selectall('products',['ID_product'=>$value['ID_product']]);
                  foreach ($my_basket_product as $key2 => $value2) :  
                   ?>
                      <a class="aa-cartbox-img" href="#"><img src="<?php echo  BASE_URL ?>img/woman-small-2.jpg" alt="img"></a>
                      <div class="aa-cartbox-info">
                        <h4><a href="#"><?=$value2['name_product']?></a></h4>
                        <p><?php 
                        echo $value2['price_product'];
                        $sum= $sum + $value2['price_product'];
                        ?></p>

                      </div>
                      <a class="aa-remove-product" href="shop.php?ID_product_unbasket=<?=$value['ID_product']?>"><span class="fa fa-times"></span></a>
                    </li>
                    <?php endforeach;   ?>

                    <?php endforeach;   ?>
                    <li>
                      <span class="aa-cartbox-total-title">
                        Всего
                      </span>
                      <span class="aa-cartbox-total-price">
                        <?=$sum;?>
                      </span>
                    </li>
                  </ul>
                
                  <a class="aa-cartbox-checkout aa-primary-btn" href="user/profile/user_basket.php">Моя корзина</a>
                </div>
                <?php else :   ?>

                  
                  <?php endif;   ?>


              </div>
              <!-- /корзина -->
              <!-- search box -->
              <div class="aa-search-box">
                <form method="post" action="<?php echo  BASE_URL ?>shop.php">
                  <input type="text" name="search_input" id="" placeholder="Поиск">
                  <button name="shop_button_search" type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>