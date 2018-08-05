<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'controller.php';

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

    $search = mysqli_real_escape_string($link, $_POST['q']); // Принимаем поисковое значение которое нам отправил Ajax и сразу отчищаем его от вредоностного кода который может ввести пользователь.
    $query = "SELECT * FROM locations WHERE name LIKE '%$search%' LIMIT 5";
    // Поиск совпадений по поисковому значению. LIKE '%$search%' - Поиск совпадений. LIMIT 5 - Выводить Пять совпадений.
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    if ($result) {

        // Проверяем нашлось что или нет.
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            $row = mysqli_fetch_array($result);

            // Указываем цикл с помощью которого будем выводить все совпадения поиска.
            do {
                // Выводим найденые совпадения, которые появятся в выпадающем списке.
                echo '
                <li>
                    <div class="block-title-price">
                        <a href="#" onclick="changeText(\'' . $row["name"] . '\'); return false;">' . $row["name"] . '</a>
                    </div>
                </li>';
            } while ($row = mysqli_fetch_array($result)); // Цикл закончился.

            // Проверяем если совпадений больше Пяти, то показываем ссылку <strong>Посмотреть все результаты</strong>
            if ($rows > 5) {
                echo '
            <center>
            <a id="search-more" href="">Посмотреть все результаты →</a>
            </center>
            ';
            }
        } else {

            // Если ничего не найдено, то выводим надпись.
            echo '<center>
                <a id="search-noresult">Ничего не найдено! :\'(</a>
                </center>';
        }
    }
}
