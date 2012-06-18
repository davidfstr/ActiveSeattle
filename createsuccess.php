<?php

require 'settings.php';
require 'db.php';

?><!DOCTYPE html>
<html>
<head>
<title>Success | Pickup Sports</title>
</head>
<body>

<p>Your game has been created.</p>

<? if ($twilio_enabled): ?>
<p>You will receive a text message whenever someone joins your game.</p>
<? endif; ?>

<a href="listgames.php?sport_id=<?= $_GET['sport_id'] ?>">OK</a>

</body>
</html>