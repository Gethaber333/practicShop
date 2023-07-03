<?php
$name = $_SESSION['login'];

$date = selectOne('user', ['login' => $name]);


?>
<div class="col-lg-4 pb-5">
    <div class="author-card pb-3">

        <div class="author-card-profile">
            <div class="author-card-avatar"><img src="<?php echo  BASE_URL ?>assets/img/cap/cap-5.jpg" alt="Daniel Adams">
            </div>
            <div class="author-card-details">
                <h5 class="author-card-name text-lg"><? echo $name ?></h5><span class="author-card-position">Вы с нами с <?= $date['date_reg_user'] ?></span>
            </div>
        </div>
    </div>
    <div class="wizard">
        <nav class="list-group list-group-flush">

            </a><a class="list-group-item" href="<?php echo  BASE_URL ?>user/profile/user_index.php"><i class="fe-icon-user text-muted"></i>Настройки профиля</a>
            <a class="list-group-item" href="<?php echo  BASE_URL ?>user/profile/user_orders.php">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class="fe-icon-heart mr-1 text-muted"></i>
                        <div class="d-inline-block font-weight-medium text-uppercase">Мои заказы</div>
                    </div>
                </div>
            </a>
            <a class="list-group-item" href="<?php echo  BASE_URL ?>user/profile/user_basket.php">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class="fe-icon-tag mr-1 text-muted"></i>
                        <div class="d-inline-block font-weight-medium text-uppercase">Корзина</div>
                    </div>
                </div>
            </a>
        </nav>
    </div>

</div>