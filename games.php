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
<?php
  require_once 'controller/controller.php'; // подключаем скрипт
 
  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка " . mysqli_error($link));
   
  // выполняем операции с базой данных
  $query ="SELECT * FROM games
      LEFT JOIN type_of_games ON type_of_games.id = games.id_type_of_game
      LEFT JOIN locations ON locations.id = games.name";
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
  if($result)
  {
    echo '<div class="grid">';
    $rows = mysqli_num_rows($result); // количество полученных строк
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);?>
          <div class='one-post'>
            <h4><?php echo $row[9]?></h4>
            <p><?php echo $row[7]?></p>
            <p>Количество человек: <?php echo $row[3]?></p>
            <p>Время начала: <?php echo $row[4]?></p>
            <p>Создатель лобби: <?php echo $row[5]?></p>
          </div>
        <?php
    }
    echo '</div>';
     
    // очищаем результат
    mysqli_free_result($result);
  }
?>
<?php require_once 'footer.php';?>

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <form method="POST">
      <div class="modal-content">
        <!-- Заголовок модального окна -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Добавление игры</h4>
        </div>
        <!-- Основное содержимое модального окна -->
        <div class="modal-body">

          <input type='text' name='creater' placeholder='Ваше имя:' required><br />

          <select class='type-game' name="type_of_game" required>
            <option disabled selected >Игра:</option>
            <option value="Футбол">Футбол</option>
            <option value="Баскетбол">Баксетбол</option>
            <option value="Хоккей">Хоккей</option>
            <option value="Волейбол">Волейбол</option>
          </select><br />

          <input type='text' name="location" id="input-search" placeholder='Площадка:' required>
            <div id="block-search-result">
              <ul id="list-search-result"></ul>
            </div><br /><br />

          <input type='number' name='count' placeholder='Кол-во человек:' required>

        <!--  <div class="g-recaptcha" data-sitekey="6LdH1F4UAAAAAB3WtIsLSyJrW9nSHbTkxb381eZv"></div> -->
        </div>
        <!-- Футер модального окна -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          <input type="submit" class="btn btn-primary" value="Добавить" />
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="js/textAdd.js"></script>
<script type="text/javascript" src="js/TextChange.js"></script>
 
<?php 
  if (isset($_POST['location']) && isset($_POST['creater']) && isset($_POST['count']) && isset($_POST['type_of_game'])){
    $err = array();

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
  
    $location = mysqli_real_escape_string($link, $_POST['location']);
    
    $query = "SELECT * FROM locations WHERE name='$location'";
    $place;
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
      $rows = mysqli_num_rows($result);
      if ($rows != 1) {
        $err[] = 'Нет такой площадки';
      } else {
        $row = mysqli_fetch_row($result);
        $place = $row[0];
      }
    }

    $type = mysqli_real_escape_string($link, $_POST['type_of_game']);
    $query = "SELECT * FROM type_of_games WHERE name='$type'";
    
    $type0;
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
      $row = mysqli_fetch_row($result);
      $type0 = $row[0];
    }
    $count = mysqli_real_escape_string($link, $_POST['count']);
    $name = mysqli_real_escape_string($link, $_POST['creater']);
    $timeS = date( 'H:i' );

    if (count($err) == 0) {
      $query = "INSERT INTO `games` (`id`, `name`, `id_type_of_game`, `countOfPeople`, `timeToStart`, `creater`) VALUES (NULL, '$place', '$type0', '$count', '$timeS' , '$name')";
      $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    }
  } else {

  }
?>