<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
    div.box { background: #EEE; height: 100%; width: 100%; }
    div.div1{background: #999; float: left; height: 200%; width: 300px; }
    div.div2{ background: #666; height: 150%; }
    div.clear { clear: both; height: 1px; overflow: hidden; font-size:0pt; margin-top: -1px; }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 200%;
      }
      form {
        margin: 0px;

      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

    </style>
    <title>Task 1</title>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>


<?php
$conn = new mysqli("localhost","root","root","SunScore");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//if(isset($_POST['firstC1']) && isset($_POST['firstC2']) && isset($_POST['secondC1']) && isset($_POST['secondC2']) && isset($_POST['answer'])){
        $latHouse=$_POST["firstC1"];
        $lngHouse=$_POST["firstC2"];
        $latObs=$_POST["secondC1"];
        $lngObs=$_POST["secondC2"];
        $ans=$_POST["answer"];
         $temp_address=$_POST["address"];
         //echo  ;
         $ids=$_POST["id"];

$sql = "INSERT INTO TestData (Id,Address, Lat_of_house, Long_of_house, Lat_of_obs, Long_of_obs, ans ) VALUES ($ids, '$temp_address', $latHouse, $lngHouse,$latObs,$lngObs, $ans)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>






<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ecodigs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$sql = "(select * from listings WHERE address NOT LIKE 'None' order by id limit 200)";

$sql = "select * from (select * from listings WHERE address NOT LIKE 'None' order by id limit 50) as rows  order by rand() limit 10 ";
//orders first 300 in ascnding order and then pics the random 10 from this.

$result = $conn->query($sql);



$id_array = array();
$address_array = array();
$i=0;
if ($result->num_rows > 0) {
    //echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "<tr><td>".$row["id"]."</td><td>".$row["address"]." </td></tr>";
        $b =  $row['address'] . ", Pittsburgh, PA";
        $id_array[$i] = $row['id'];
        $address_array[$i] = $b;
        $i++;
    }
   // echo "</table>";
   // echo "$id_array"
} else {
    echo "0 results";
}

//print_r($id_array);
//print_r($address_array);

$conn->close();
?>


  <!--  <input id="pac-input" class="controls" type="text" placeholder="Search Box">-->

    <div class="box">
       <div class="div1" id="form">
       <form method="post" action="#" margin-left:25px>
           <br><br>
           <br><br>Where is the marked-house located?<br>
           <input type="radio" name="house_setting" >Urban setting<br>
           <input type="radio" name="house_setting" >Rural/Suburban setting<br><br>


             <b>Task 1: </b>Finding the distance of the obstruction from the house.<br>
             <br>
             <b>Instructions:</b><br>
             <b>Step 1:</b> Zoom in to the maximum possible by clicking on the plus, on the bottom-right corner of the map. Do not rotate the default imagery.<br><br>

             <b>Step 2:</b>Drag the marker to any of the marked-building's window which has an obstruction in front of it. In case the windows arent visible, drag the marker to the edge of the wall, such that it is in front of the obstruction. Obstruction can be trees or buildings. If there are no obstructions adjacent to the house, jump to step 6.<br>Else <b>click</b> on the marker and the coordinates of the place would be autofilled.<br>

             House Coordinates(Lat):<br>
             <input type="hidden" name ="address" id="address">
             <input type="hidden" name ="id" id="id">

             <input type="text" name="firstC1" required id="firstC1">
             <br>
             House Coordinates(Long):<br>
            <input type="text" name="firstC2" required id="firstC2">
            <br>
            <br>
            <b>Step 3:</b>Considering the building center as the center of the compass, which is the direction where you placed the marker in step 2? Note that the North is facing the top. East is on the right of the map<br>
            <input type="radio" name="direction" >N
            <input type="radio" name="direction" >E
            <input type="radio" name="direction" >W
            <input type="radio" name="direction" >S
            <input type="radio" name="direction" >NE
            <input type="radio" name="direction" >SE
            <input type="radio" name="direction" >SW
            <input type="radio" name="direction" >NW

            <br><br>
            <b>Step 4:</b>What was the obstruction you considered in step 2 ?<br>
            <input type="radio" name="obstruction" >Tree
            <input type="radio" name="obstruction" >Building/Apartment <br><br>


            <b>Step 5:</b>Drag the marker on the obstructing object you considered in step 2. Place it on the point closest to the window. Click on the marker. The coordinates of the obstruction should be autofilled.<br>
            Obstruction Coordinates(Lat):<br>
            <input type="text" name="secondC1" required id="secondC1">
            <br>

            Obstruction Coordinates(Long):<br>
            <input type="text" name="secondC2"  required id="secondC2">
            <br><br>
            <button type="button" id='Calculate'>Calculate</button>
            Answer
            <input  type="text" value="Press Calculate" name= "answer" required id="answer">
            <br><br>How dense (in terms of obstructions) is the area on the North side adjacent to the house?<br>
            <input type="radio" name="north_dense" >Sparse/None
            <input type="radio" name="north_dense" >Middle
            <input type="radio" name="north_dense" >Dense
            Estimated distance from these obstructions to building?<br><br>
            <input  type="text" value="Enter only value in meters" name= "e1" id="e1">
            <br><br>How dense (in terms of obstructions) is the area on the South side adjacent to the house?<br>
            <input type="radio" name="south_dense" >Sparse/None
            <input type="radio" name="south_dense" >Middle
            <input type="radio" name="south_dense" >Dense
            Estimated distance from these obstructions to building?<br><br>
            <input  type="text" value="Enter only value in meters" name= "e2" id="e2">


            <br><br>How dense (in terms of obstructions) is the area on the East side adjacent to the house?<br>
            <input type="radio" name="east_dense" >Sparse/None
            <input type="radio" name="east_dense" >Middle
            <input type="radio" name="east_dense" >Dense
            Estimated distance from these obstructions to building?<br><br>
            <input  type="text" value="Enter only value in meters" name= "e3" id="e3">

            <br><br>How dense (in terms of obstructions) is the area on the West side adjacent to the house?<br>
            <input type="radio" name="west_dense" >Sparse/None
            <input type="radio" name="west_dense" >Middle
            <input type="radio" name="west_dense" >Dense
            Estimated distance from these obstructions to building?<br><br>
            <input  type="text" value="Enter only value in meters" name= "e4" id="e4">


            <br><br>


            <b>Step 6:</b>Are there any obstructions around the house?<br>
            <input type="radio" name="obs_mcq" >No
            <input type="radio" name="obs_mcq" >Yes

              <br><br>
	<button id="submitBtn">Submit</button>
     </form>

       </div>
       <div class="div2" id="map"></div>
       <div class="clear">

    </div>






    <script type="text/javascript">
  	var address = <?php echo json_encode($address_array); ?>;
  	var ids = <?php echo json_encode($id_array); ?>;

	if(!window.localStorage['count']){
		window.localStorage.setItem('count', 0);
             //window.localStorage['count']=0
         }
    document.getElementById("Calculate").onclick = function() {updateanswer()};



      function updateanswer() {
        console.log('updateanswer');
        var lat1 = document.getElementById('firstC1').value;
        var lon1 = document.getElementById('firstC2').value;
        var lat2 = document.getElementById('secondC1').value;
        var lon2 = document.getElementById('secondC2').value;

        var R = 6371000; // metres
        var φ1 = toRad(lat1);
        var φ2 = toRad(lat2);
        var Δφ = toRad(lat2-lat1);
        var Δλ = toRad(lon2-lon1);

        var a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ/2) * Math.sin(Δλ/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

        var d = R * c;
        console.log('updateanswer' + d);
        document.getElementById('answer').value = d;
        //document.getElementById('address').innerHTML = str;
      }
      function toRad(Value) {
    /** Converts numeric degrees to radians */
    return Value * Math.PI / 180;
}


// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.


function initAutocomplete() {

  var i=0;
  //var j=0;
  var marker;
  var geocoder = new google.maps.Geocoder();
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 22,
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });


 if(window.localStorage.getItem('count')<100){
  //**update address here**//
  //var address = ["1104 Kenzie Drive, Pittsburgh, PA","120 Cobblestone Drive, Pittsburgh, PA","806 College St, Pittsburgh, PA 15232, USA"];
      var index = window.localStorage.getItem('count')
      //console.log(index);
      console.log(address[index]);

       document.getElementById("address").value= address[index];
       document.getElementById("id").value= ids[index];
      geocoder.geocode( { 'address': address[index++]}, function(results, status) {
      	window.localStorage.setItem('count', index);

        if (status == google.maps.GeocoderStatus.OK) {
        //address.splice(y,1);
          map.setCenter(results[0].geometry.location);
          marker = new google.maps.Marker({
              map: map,
              draggable: true,
              position: results[0].geometry.location

          });

  marker.addListener('click', function() {

  //console.log('ready');
  //var latlong_value = results[0].geometry.location;
  if(i==0){
  //document.getElementById('address_field').value = address;
  document.getElementById('firstC1').value = marker.getPosition().lat();
  document.getElementById('firstC2').value = marker.getPosition().lng();
  i++;
  console.log(i);
  //document.cookie = "index= "+x;
  }


  google.maps.event.addListener(marker, 'dragend', function() {
    //updateMarkerStatus('Drag ended');



    console.log('dragend');
    document.getElementById('secondC1').value = marker.getPosition().lat();
    document.getElementById('secondC2').value = marker.getPosition().lng();
    //updateMarkerAddress(marker.getPosition());
    ///geocodePosition(marker.getPosition());
  });
 });
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }

      });

      }
      else{

      	alert("task done");

      }


}






//google.maps.event.addDomListener(window, 'load', initAutocomplete);

function displayLocationElevation(location, elevator, infowindow) {
  // Initiate the location request
  elevator.getElevationForLocations({
    'locations': [location]
  }, function(results, status) {
    infowindow.setPosition(location);
    if (status === google.maps.ElevationStatus.OK) {
      // Retrieve the first result
      if (results[0]) {
        // Open the infowindow indicating the elevation at the clicked position.
        infowindow.setContent('The elevation at this point <br>is ' +
            results[0].elevation + ' meters.');
      } else {
        infowindow.setContent('No results found');
      }
    } else {
      infowindow.setContent('Elevation service failed due to: ' + status);
    }
  });
}

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ015OnrjZ5Zrd9NSssSUBXzoE3c1MpLw&libraries=places&callback=initAutocomplete"
         async defer></script>


</script>>

</script>

  </body>
</html>
