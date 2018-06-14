<!doctype html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Заголовок</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>
  <img src="image/note-head.png" class="note-head" />
  <div class="wrapper">
    <div class="note-body">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="games.php">We Are Here</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php $menu = array_reverse(explode('/', $_SERVER["REQUEST_URI"]))[0];?>
              <li<?php if($menu == 'games.php') echo ' class="active"'?>>
                <a href="games.php">Игры</a>
              </li>
              <li<?php if($menu == 'training.php') echo ' class="active"'?>>
                <a href="training.php">Развитие</a>
              </li>
              <li<?php if($menu == 'locations.php') echo ' class="active"'?>>
                <a href="locations.php">Площадки</a>
              </li>
              <li<?php if($menu == 'about.php') echo ' class="active"'?>>
                <a href="about.php">О нас</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class='posts'>
        <hr width='90%' size='1'>