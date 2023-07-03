<!-- Login Modal -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>Войти или зарегистрироваться</h4>
        <form class="aa-login-form" method="post" action="<?php echo  BASE_URL ?>index.php">
          <label for="">Логин<span>*</span></label>
          <input name="user_email_login" type="text" placeholder="Логин">
          <label for="">Пароль<span>*</span></label>
          <input name="user_pass_password" type="password" placeholder="Пароль">
          <button class="aa-browse-btn" name="button_log" type="submit">Войти</button>

          <div class="aa-register-now">
            У вас нет аккаунта?<a href="<?php echo  BASE_URL ?>account.php">Зарегистрироваться</a>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>