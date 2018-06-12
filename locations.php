<?php require_once 'header.php';?>
<div id='map'></div>
<script>
  function initMap() {

var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 11,
  center: {lat: 57.635297, lng: 39.865561}
});

// Add some markers to the map.
// Note: The code uses the JavaScript Array.prototype.map() method to
// create an array of markers based on a given "locations" array.
// The map() method here has nothing to do with the Google Maps API.
var markers = locations.map(function(location, i) {
  return new google.maps.Marker({
    position: location,
    label: labels[i]
  });
});

// Add a marker clusterer to manage the markers.
var markerCluster = new MarkerClusterer(map, markers,
    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}


var locations = [
<?php 
  $labels = array();
  require_once 'controller/controller.php';
  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $password, $database) 
      or die("Ошибка " . mysqli_error($link));
   
  // выполняем операции с базой данных
  $query ="SELECT * FROM locations";

  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
  if($result)
  {
    $rows = mysqli_num_rows($result); // количество полученных строк
    for ($i = 0 ; $i < $rows ; ++$i)
    {
      $row = mysqli_fetch_row($result);
      echo "{lat:" . $row[2] . ", lng: " . $row[3] . "}";
      $labels[] = $row[1];
      if ($i != $rows-1) {
        echo ",";
      }
    }
  echo "];";
  }
  ?>
  var labels = [
  <?php
  for ($i = 0; $i < count($labels); ++$i){
    echo "'".$labels[$i]."'";
    if ($i != count($labels)-1){
      echo ",";
    }
  }
  ?>
];
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDByrG3OXiHpE5Cj0ZgfCRFEWWWVTsorNM&callback=initMap">
    </script>
<?php require_once 'footer.php';?>
