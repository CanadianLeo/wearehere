$(document).ready(function () {
  // Сюда указываем id поля поиска.      
  $('#input-search').bind('input', function () {
    // В переменную помещаем поисковое значение которое ввел пользователь.               
    var input_search = $("#input-search").val();
    // Проверяем поисковое значение. 
    if (input_search.length >= 3 && input_search.length < 150) {
      // Делаем запрос в обработчик в котором будет происходить поиск.
      $.ajax({
        type: "POST",
        url: "/wearehere/controller/search.php", // Обработчик.
        data: "q=" + input_search,
        dataType: "html",
        cache: false,
        success: function (data) {

          $("#block-search-result").show(); // Показываем блок с результатом.
          $("#list-search-result").html(data); // Добавляем в список результат поиска.

        }
      });

    } else {
      // Если ничего не найдено, то скрываем выпадающий список.
      $("#block-search-result").hide();
    }

  })
});