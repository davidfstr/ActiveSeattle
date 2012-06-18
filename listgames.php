<?php

require 'db.php';

$sport = db_get_sport($_GET['sport_id']);
$sport_name = strtolower($sport['name']);
$games = db_get_every_game_for_sport($_GET['sport_id']);

$games_by_time = array();
foreach ($games as $game) {
  $time = $game['datetime'];
  
  if (!array_key_exists($time, $games_by_time)) {
    $games_by_time[$time] = array();
  }
  array_push($games_by_time[$time], $game);
}

?><!DOCTYPE html>
<html>
<head>
<title>Choose a Game | Pickup Sports</title>
</head>
<body>

<p>There are <?= count($games) ?> <?= $sport_name ?> game<?= count($games)!=1 ? 's' : '' ?> today:</p>
<ul>
<?
foreach ($games_by_time as $time => $games) {
  $time_str = date('g:i A', $time);
  print "<li>$time_str";
  print "<ul>";
  foreach ($games as $game) {
    $num_people = count($game['members']);
    $person_people = ($num_people == 1) ? 'person' : 'people';
    print "<li><a href='viewgame.php?game_id={$game['id']}'>{$game['title']}, $num_people $person_people</a></li>";
  }
  print "</ul>";
  print "</li>";
}
?>
</ul>

None of these games interesting?<br/>
<a href="creategame.php?sport_id=<?= $_GET['sport_id'] ?>">Create a New Game</a>

</body>
</html>