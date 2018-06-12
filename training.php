<?php require_once 'header.php';?>
<?php
  require_once 'controller/controller.php'; // подключаем скрипт
  require_once 'controller/mobile.php';
  $textLength = 300;
  $imageSize = 50;
  if(check_mobile_device()){
      $textLength = 150;
      $imageSize = 20;
  }
 
  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка " . mysqli_error($link));
   
  // выполняем операции с базой данных
  $query ="SELECT * FROM training";
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
  if($result)
  {
    $rows = mysqli_num_rows($result); // количество полученных строк
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);?>
        <div class='one-post'>
          <div class='training'>
            <a href='#'>
              <h4 class='name-tr'><?php echo $row[1]?></h4>
              <div class='level'>
                <p><?php echo $row[4]?></p>
              </div>
              <img class='img-thumbnail' src='<?php echo $row[3]?>' align='left' , width='<?php echo $imageSize.'%'?>' alt=''>
              <p class='preview-text'><?php echo substr($row[2], 0, $textLength)."..."?></p>
            </a>
          </div>
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
