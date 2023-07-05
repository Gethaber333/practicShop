<style>
.timer {
  font-family: 'Lato', sans-serif;
  font-size: 18px;
  padding: 10px 15px;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  animation: colorAnimation 5s ease-in-out infinite;
}

@keyframes colorAnimation {
  0% { background-color: #f5f5f5; color: #333; }
  50% { background-color: #d5d5f5; color: #666; }
  100% { background-color: #f5d5d5; color: #999; }
}

.timer:before {
  content: "\f017";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  margin-right: 5px;
}

.timer.not-authorized {
  background-color: #ff5c5c;
  color: #fff;
  animation: none;
}

.timer.not-authorized:before {
  content: "\f071";
}
</style>
<!-- footer -->  
<footer id="aa-footer">
  <!-- footer bottom -->
  <div class="aa-footer-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-footer-top-area">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="aa-footer-widget">
                  <span id="timer" class="timer"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer> 




<script>
// Функция для отображения времени на странице
function displayTimer() {
  var timerElement = document.getElementById("timer");
  var seconds = 0;
  var minutes = 0;
  
  // Функция для обновления таймера каждую секунду
  function updateTimer() {
    seconds++;
    if (seconds >= 60) {
      seconds = 0;
      minutes++;
    }

    timerElement.textContent = "Вы на сайте уже " + minutes + " минут " + seconds + " секунд";
  }

  // Проверяем, есть ли сессия пользователя
  var sessionActive = '<?php echo isset($_SESSION["login"]) ? "true" : "false"; ?>';

  // Применяем стиль "not-authorized", если сессия не активна
  if (sessionActive !== "true") {
    timerElement.classList.add("not-authorized");
    timerElement.textContent = "Вы не авторизованы";
    return;
  }

  // Обновляем таймер каждую секунду
  setInterval(updateTimer, 1000);
}

// Запускаем функцию отображения таймера при загрузке страницы
window.onload = displayTimer;
</script>
