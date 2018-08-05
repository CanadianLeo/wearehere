<?php require_once 'header.php';?>
        <div class='row'>
          <a href='#myModal'  data-toggle="modal">
            <div class='col-md-2'>
              <div class='button-game'>
                <p class='ready'>
                  &#10003;
                </p>
              </div>
            </div>
            <div class='col-md-10'>
              <p class='add-game'> Я здесь! </p>
            </div>
          </a>
        </div>
        <hr width='90%' size='1'>
        <h2>Главные новости</h2>
        <hr width='90%' size='1'>
<?php
require_once 'controller/controller.php'; // подключаем скрипт

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$query = "SELECT * FROM news";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if ($result) {
    $rows = mysqli_num_rows($result); // количество полученных строк

    for ($i = 0; $i < $rows; ++$i) {
        $row = mysqli_fetch_row($result);?>
        <div class='one-post'>
          <img class='img-thumbnail' src='<?php echo $row[2] ?>' alt=''>
          <p class='preview-text'><?php echo $row[1] ?></p>
          <hr width='90%' size='1'>
        </div>
        <?php
}

    // очищаем результат
    mysqli_free_result($result);
}

// закрываем подключение
mysqli_close($link);
?>
<?php require_once 'footer.php';?>


<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Заголовок модального окна</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body">
        Содержимое модального окна...
      </div>
      <!-- Футер модального окна -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить изменения</button>
      </div>
    </div>
  </div>
</div>

<script>
    navigator.geolocation.getCurrentPosition(function(position) {
        // Текущие координаты.
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        console.log(lat);

    }, function (error){
      console.log(error);
    });


</script>