<?php

include "path.php";
include 'app/controllers/users.php';

include 'app/include/login.php';

?>

<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Кавказ Shop | Аккаунт</title>

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
  <?php include 'app/include/header.php' ?>

  <?php include 'app/include/menu.php' ?>

  <!-- Cart view section -->
  <section id="aa-myaccount">
    <div class="container">


      <div class="row">

        <div class="col-md-12">
          <div class="aa-myaccount-area">
            <div class="row">
              <div class="err">
                <?php include("app/helps/errorinfo.php") ?>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                  <h4>Войти</h4>

                  <form action="account.php" method="post" class="aa-login-form">
                    <label for="">Логин<span>*</span></label>
                    <input name="user_email_login" type="text" placeholder="Логин">
                    <label for="">Пароль<span>*</span></label>
                    <input name="user_pass_password" type="password" placeholder="Пароль">
                    <button type="submit" name="button_log" class="aa-browse-btn">Войти</button>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">
                  <h4>Регистрация</h4>

                  <form action="account.php" method="post" class="aa-login-form">

                    <label>Имя<span>*</span></label>
                    <input name="user_name" type="text" placeholder="Имя">
                    <label>Почта<span>*</span></label>
                    <input name="user_mail" type="text" placeholder="Ваша почта">
                    <label>Номер<span></span></label>
                    <input name="user_num" type="text" placeholder="Номер для связи - не обязательно">
                    <label>Логин<span>*</span></label>
                    <input name="user_login" type="text" placeholder="Логин">
                    <label>Пароль<span>*</span></label>
                    <input name="user_pass" type="password" placeholder="Пароль">
                    <button type="submit" name="button_reg" class="aa-browse-btn">Зарегистрироваться</button>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->


  <?php include 'app/include/footer.php' ?>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="<?php echo  BASE_URL ?>js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleGallery.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleLens.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/slick.js"></script>
   <script src="<?php echo  BASE_URL ?>js/custom.js"></script>


</body>

</html>