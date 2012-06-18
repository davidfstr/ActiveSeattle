<?php

require 'db.php';

// No profile for the current user? Create one before continuing.
if (!array_key_exists('profile_name', $_COOKIE)) {
  $next_raw = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
  $next = urlencode($next_raw);
  header("Location: createprofile.php?next=$next");
  return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $game = array(
    'title' => $_POST['title'],
    'members' => array($_COOKIE['profile_phone']),
    'lat' => floatval($_POST['lat']),
    'lng' => floatval($_POST['lng']),
    // TODO: include address
    'datetime' => strtotime($_POST['time']),
    'duration' => intval($_POST['num_hours']),
    'sport_id' => $_POST['sport_id'],
  );
  
  db_add_object('game', $game);
  
  header("Location: createsuccess.php?sport_id={$_POST['sport_id']}");
  return;
}

?><!DOCTYPE html>
<html>
<head>
<title>New Game | Pickup Sports</title>
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?sensor=true">
</script>
</head>
<body onload="initialize()">

<form method="post" action="">
<input type="hidden" name="sport_id" value="<?= $_GET['sport_id'] ?>"/>
<input type="hidden" name="lat" id="lat" value=""/> <!-- FIXME: populate -->
<input type="hidden" name="lng" id="lng" value=""/>

When?<br/>
<input type="text" name="time" placeholder="12:00 PM"/><br/>

Where?<br/>
<div id="map_canvas" style="width:200px; height:200px"></div><br/>

For how long?<br/>
<input type="text" name="num_hours" value="1"/> hour(s)<br/>

With name:<br/>
<input type="text" name="title" placeholder="optional"/><br/>

<input type="submit" value="Create Game"/>
</form>

<script type="text/javascript">
  function initialize() {
    var userLocation = new google.maps.LatLng(47.606625, -122.331218);
    
    var map = new google.maps.Map(document.getElementById("map_canvas"), {
      center: userLocation,
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: false
    });
    var marker = new google.maps.Marker({
      map: map,
      position: userLocation,
      title: "Game Location",
      draggable: true,
      animation: google.maps.Animation.DROP
    });
    
    google.maps.event.addListener(marker, 'position_changed', function() {
      var latInput = document.getElementById("lat");
      var lngInput = document.getElementById("lng");
      
      var latlng = marker.getPosition();
      latInput.value = latlng.lat();
      lngInput.value = latlng.lng();
    });
  }
</script>
</body>
</html>