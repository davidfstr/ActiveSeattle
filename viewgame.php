<?php

require 'db.php';

$game = db_get_object('game', $_GET['game_id']);

$time_start = date('g:i A', $game['datetime']);
$time_end = date('g:i A', $game['datetime'] + (60 * 60 * $game['duration']));
$num_people = count($game['members']);
$person_people = ($num_people == 1) ? 'person' : 'people';

?><!DOCTYPE html>
<html>
<head>
<title>View Game | Pickup Sports</title>
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?sensor=true">
</script>
</head>
<body onload="initialize()">

<b><?= $game['title'] ?></b><br/>
<?= $time_start ?> &ndash; <?= $time_end ?><br/>
<?= $num_people ?> <?= $person_people ?><br/>
<br/>
<div id="map_canvas" style="width:200px; height:200px"></div>
<br/>
<form method="post" action="joingame.php">
  <input type="hidden" name="game_id" value="<?= $game['id'] ?>"/>
  <input type="submit" value="Join Game"/> | <a href="listgames.php?sport_id=<?= $game['sport_id'] ?>">Back</a>
</form>

<script type="text/javascript">
  function initialize() {
    var location = new google.maps.LatLng(
      <?= $game['lat'] ?>,
      <?= $game['lng'] ?>);
    
    var map = new google.maps.Map(document.getElementById("map_canvas"), {
      center: location,
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: false
    });
    var marker = new google.maps.Marker({
      map: map,
      position: location,
      title: "<?= $game['title'] ?>",
      draggable: false,
      animation: google.maps.Animation.DROP
    });
  }
</script>
</body>
</html>