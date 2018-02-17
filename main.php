<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="index.js"></script>
    <style>
        #map {
            width:70%;
            margin: 0 auto;
            text-align:center;
            height: 400px;
            background-color: grey;
        }
    </style>
</head>
<body>




<div id="map"></div>
<?php
$servername = "localhost";
$username = "kingcolb";
$password = "euo9vSff";
$dbname = "schema2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,name,lat,lng,description FROM bars ";
$result = $conn->query($sql);
$new = array();
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($new,array($row["name"],$row["description"],$row["lat"],$row["lng"]));


    }

} else {
    echo "0 results";
}
$conn->close();

?>

<script>
    //simple for loop to iterate over array, index 0 name, index 1 desc index 2 lat, index 3 long
    var resultArray = <?php echo json_encode($new); ?>;

    function initMap() {
        var uluru = {lat: 60.169480, lng: 24.937352};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: uluru
        });

    var markers = [];

        for(i=0;i<resultArray.length; i++) {
            var marker = markers[i];
            marker = new google.maps.Marker({
                position: {lat: parseFloat(resultArray[i][2]), lng: parseFloat(resultArray[i][3])},
                animation: google.maps.Animation.DROP,
                map: map,
                content: '<div id="content">' +
                '<h1 id="firstHeading" class="firstHeading">' + resultArray[i][0] + '</h1>'+
                '<div id="bodyContent">'+
                '<p><b>' + resultArray[i][1] + '</b></p>'+
                '<a href="https://www.whyjoin.fi">'+
                'Webpage</a> '+
                '</div>'+
                '</div>'

            });



            var infowindow = new google.maps.InfoWindow({
                content: "holding..."
            });




            google.maps.event.addListener(marker,'click', function(){

                    infowindow.setContent(this.content);
                    infowindow.open(map,this);

            });

        }






    }













</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe3IVm8Zs0cqyaJ4MzuB5t1iK77beIxXo&callback=initMap">
</script>


















<?php
require 'simple_html_dom.php';
$url = 'http://en.ilmatieteenlaitos.fi/local-weather?forecast=daily';
$html = file_get_html($url);
$wholeThing = $html->find('ul[class=local-weather-forecast-day-menu]');
$title = $wholeThing[0]->find('div[class=local-weather-forecast-day-menu-time-stamp]');

$data = $wholeThing[0]->find('div[class=temperature positive]');
$data2 = $wholeThing[0]->find('div[class=temperature negative]');


$dataTable = array();
$daysTable = array();


foreach($title as $element1) {

    $ready =  $element1->find('strong') ;
    array_push($dataTable,$ready[0]);

}

foreach($data as $element2) {

    $ready =  $element2->find('text') ;
    array_push($daysTable,$ready[0]);

}

foreach($data2 as $element2) {

    $ready =  $element2->find('text') ;
    array_push($daysTable,$ready[0]);

}



?>

<div class = "topText">
    <p>A Simple PHP Scraper</p>
</div>
<div class="Weatherbox">
    <p>Wondering about the weather in Helsinki? </p>
    <form>
    <input type="button" id="revealWeather" onClick = "showWeather(this)" value = "Yes!" >
    </form>




<ul id = "wholeDataUL" style = "visibility:hidden">

   <?php
    $index = 0 ;
   foreach($dataTable as $temp) {
       echo "<li class ='oneDay'><ul id ='indvDataUL'><li>" . $temp . "</li><li>" . $daysTable[$index] ."</li></ul></li>" ;
       $index = $index + 1 ;
   }
   ?>
</ul>

</div>





<div class="copyright">
    <h1>Information received from the Finnish Meteorological Institute</h1>

</div>


</body>
</html>
