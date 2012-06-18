<?php

/*
 * Contains functions for accessing the database.
 */

function db_load_table($table_name) {
  $filename = 'db_' . $table_name . '.kvdb';
  if (!file_exists($filename)) {
    return array();
  }
  $file = fopen($filename, 'rb');
  flock($file, LOCK_SH);
  
  $table = array();
  while ($line = fgets($file)) {
    $line = substr($line, 0, strlen($line) - 1);  // remove newline
    $kv = explode(':', $line, 2);
    $k = $kv[0];
    $v = $kv[1];
    
    $table[$k] = json_decode($v, /*assoc=*/true);
  }
  
  flock($file, LOCK_UN);
  fclose($file);
  return $table;
}

function db_save_table($table_name, $table) {
  $filename = 'db_' . $table_name . '.kvdb';
  $file = fopen($filename, 'wb');
  flock($file, LOCK_EX);
  
  foreach ($table as $k => $v) {
    fwrite($file, $k . ':' . json_encode($v) . "\n");
  }
  
  flock($file, LOCK_UN);
  fclose($file);
  return $table;
}

function db_get_object($table_name, $key) {
  $table = db_load_table($table_name);
  return $table[$key];
}

function db_set_object($table_name, $key, $obj) {
  $table = db_load_table($table_name);
  $table[$key] = $obj;
  db_save_table($table_name, $table);
}

function db_add_object($table_name, $obj) {
  $table = db_load_table($table_name);
  
  $key = (count($table) == 0) ? 1 : max(array_keys($table)) + 1;
  $obj['id'] = $key;
  
  $table[$key] = $obj;
  db_save_table($table_name, $table);
  
  return $key;
}

// =====

/**
 * Returns the list of sports, sorted by name.
 */
function db_get_every_sport() {
  $sports = db_load_table('sport');
  
  // Sort by name
  usort($sports, function($s1, $s2) {
    return ($s1['name'] < $s2['name']) ? -1 : 1;
  });
  
  return $sports;
}

/**
 * Returns the list of games for the given sport, sorted by time.
 */
function db_get_every_game_for_sport($sport_id) {
  $games = db_load_table('game');
  
  // Filter sports
  $games_for_sport = array_filter($games, function($game) use ($sport_id) {
    return $game['sport_id'] == $sport_id;
  });
  
  // Sort by time
  usort($games_for_sport, function($g1, $g2) {
    return ($g1['datetime'] < $g2['datetime']) ? -1 : 1;
  });
  
  return $games_for_sport;
}

/**
 * Returns the specified sport, or NULL if no such sport exists.
 */
function db_get_sport($sport_id) {
  foreach (db_get_every_sport() as $sport) {
    if ($sport_id == $sport['id']) {
      return $sport;
    }
  }
  return NULL;
}

