<?php

require 'settings.php';
require 'db.php';

// No profile for the current user? Create one before continuing.
if (!array_key_exists('profile_name', $_COOKIE)) {
  $next_raw = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
  $next = urlencode($next_raw);
  header("Location: createprofile.php?next=$next");
  return;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('HTTP/1.0 405 Method Not Allowed');
  return;
}

$game_id = $_POST['game_id'];
$game = db_get_object('game', $game_id);

$other_members = $game['members'];   // copy by value

// Add self as a member
$game['members'][] = $_COOKIE['profile_phone'];
db_set_object('game', $game_id, $game);

// Send out SMS messages to other members of the game
if ($twilio_enabled) {
  require 'Services/Twilio.php';
  
  $twilio = new Services_Twilio($twilio_account_sid, $twilio_auth_token);
  $message = 'A new person has joined the "' . $game['title']. '" game. There are now ' . count($game['members']) . ' players.';
  
  foreach ($other_members as $to_number) {
    // (If a whitelist is defined, only send an SMS if the
    //  member is in the whitelist.)
    if (($twilio_to_number_whitelist == NULL) || 
        in_array($to_number, $twilio_to_number_whitelist))
    {
      $sms = $twilio->account->sms_messages->create(
        $twilio_from_number,
        $to_number,
        $message
      );
    }
  }
}

?><!DOCTYPE html>
<html>
<head>
<title>Join Game | Pickup Sports</title>
</head>
<body>

<p>You have joined the game.</p>

<? if ($twilio_enabled): ?>
<p>A text message has been sent to the other players.</p>
<? endif; ?>

<a href="listgames.php?sport_id=<?= $game['sport_id'] ?>">OK</a>

</body>
</html>