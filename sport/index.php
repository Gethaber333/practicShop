
 
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
   <title>Кавказ Shop | Главная</title>

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
  <?php include 'app/include/header.php'?>
 
  <?php include 'app/include/menu.php'?>
   
  <?php include 'app/include/footer.php'?>
 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="<?php echo  BASE_URL ?>js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleGallery.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/jquery.simpleLens.js"></script>
   <script type="text/javascript" src="<?php echo  BASE_URL ?>js/slick.js"></script>
   <script src="<?php echo  BASE_URL ?>js/custom.js"></script>

  </body>
</html>