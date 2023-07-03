 <!-- menu -->
 <?php

  $category = selectall('category');

  ?>
 <section id="menu">
   <div class="container">
     <div class="menu-area">
       <!-- Navbar -->
       <div class="navbar navbar-default" role="navigation">

         <div class="navbar-collapse collapse">
           <!-- Left nav -->
           <ul class="nav navbar-nav">
             <li><a href="<?php echo  BASE_URL ?>index.php">Домой</a></li>
             <li><a href="<?php echo  BASE_URL ?>shop.php">Магазинчик <span class="caret"></span></a>
               <ul class="dropdown-menu">
                 <?php foreach ($category as $key => $value) :   ?>
                   <li><a href="<?php echo  BASE_URL ?>shop.php?side_category=<?= $value['name_category'] ?> "><?= $value['name_category'] ?> <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                       <?php
                        $subcategory = selectall('subcategory', ['ID_category' => $value['ID_category']]);
                        foreach ($subcategory as $key2 => $value2) :
                        ?>
                         <li><a href="<?php echo  BASE_URL ?>shop.php?side_category=<?= $value2['name_subcategory'] ?>"><?= $value2['name_subcategory'] ?></a></li>
                       <?php endforeach;   ?>
                     </ul>
                   </li>
                 <?php endforeach;   ?>


               </ul>
             </li>
           </ul>
         </div><!--/.nav-collapse -->
       </div>
     </div>
   </div>
 </section>
 <!-- / menu -->