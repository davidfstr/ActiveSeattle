<?php

/*
 * Destroys the database and reinitializes it with default data.
 */

require 'db.php';

$use_sample_games = array_key_exists('games', $_GET) && ($_GET['games'] == '1');

function generate_phones($num_people) {
  $profile_phones = array(
    // fictious numbers that are non-routable
    '2065550100',
    '2065550101',
    '2065550102',
    '2065550103',
    '2065550104',
    '2065550105',
  );

  return array_slice($profile_phones, 0, $num_people);
}

$sports = array(
  1 => array(
    'id' => 1,
    'name' => 'Badminton',
  ),
  2 => array(
    'id' => 2,
    'name' => 'Basketball',
  ),
  3 => array(
    'id' => 3,
    'name' => 'Tennis',
  ),
);

$games = (!$use_sample_games) ? array() : array(
  1 => array(
    'id' => 1,
    'title' => 'Cal Anderson Park',
    'members' => generate_phones(1),
    'lat' => 47.616965,
    'lng' => -122.319298,
    'datetime' => strtotime('Wed May 30 16:00:00 2012'),
    'duration' => 1,
    'sport_id' => 1,
  ),
  2 => array(
    'id' => 2,
    'title' => 'Froula Playground',
    'members' => generate_phones(2),
    'lat' => 47.681916,
    'lng' => -122.316284,
    'datetime' => strtotime('Wed May 30 17:00:00 2012'),
    'duration' => 1,
    'sport_id' => 1,
  ),
  3 => array(
    'id' => 3,
    'title' => 'Ravenna Park',
    'members' => generate_phones(1),
    'lat' => 47.669606,
    'lng' => -122.308988,
    'datetime' => strtotime('Wed May 30 17:00:00 2012'),
    'duration' => 1,
    'sport_id' => 1,
  ),
);

db_save_table('sport', $sports);
db_save_table('game', $games);

?><!DOCTYPE html>
<html>
<head>
<title>Database Reset | Pickup Sports</title>
</head>
<body>

The database has been reset.

</body>
</html>