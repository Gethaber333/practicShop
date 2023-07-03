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
    <?php include '../../app/include/header.php' ?>

    <?php include '../../app/include/menu.php' ?>
    <div class="container mt-5">
        <div class="row">

            <!-- Account Sidebar-->
            <?php include '../../app/include/user_sidebar.php' ?>
            <!-- Profile Settings-->


            <div class="col-lg-8 pb-5">
                <form action="user_index.php" method="post" class="aa-login-form">
                    <div class="mb-3 err">
                        <?php include("../../app/helps/errorinfo.php"); ?>
                    </div>
                    <div class="col">

                        <input name="ID_user" value="<?= $info['ID_user']; ?>" type="hidden">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Имя</label>
                            <input name="user_name" type="text" value=<?= $info['name_user'] ?> placeholder="Имя">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Почта</label>
                            <input name="user_mail" type="text" value=<?= $info['email_user'] ?> placeholder="Ваша почта">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                            <label>Номер<span></span></label>
                            <input name="user_num" type="text" value=<?= $info['number_user'] ?> placeholder="Номер для связи - не обязательно">
                        </div>
                    </div>



                    <button type="submit" name="update_profile" class="aa-browse-btn">Обновить профиль</button>

                </form>

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