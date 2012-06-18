<?php

require 'db.php';

?><!DOCTYPE html>
<html>
<head>
<title>Choose a Sport | Pickup Sports</title>
</head>
<body>

<p>What would you like to play?</p>
<ul>
<?
foreach (db_get_every_sport() as $sport) {
  print "<li><a href='listgames.php?sport_id={$sport['id']}'>{$sport['name']}</a></li>";
}
?>
</ul>

</body>
</html>