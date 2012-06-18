<?php

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // NOTE: Inputs are not validated in this prototype
  
  // Strip everything except digits from the phone number
  $phone = preg_replace('[^0-9]', '', $_POST['phone']);
  
  // Save the profile information in client-side cookies
  setcookie('profile_name', $_POST['name']);
  setcookie('profile_phone', $phone);
  
  // Redirect to next action
  $next = $_POST['next'];
  header("Location: $next");
  return;
}

?><!DOCTYPE html>
<html>
<head>
<title>Create Profile | Pickup Sports</title>
</head>
<body onload="initialize()">

<p>To create or join a game, you must create a profile.</p>

<form method="post" action="">
<input type="hidden" name="next" value="<?= $_GET['next'] ?>"/>

Name<br/>
<input type="text" name="name" placeholder="required"/><br/>
<i>This will be displayed to other users.</i><br/>
<br/>
Phone<br/>
<input type="text" name="phone" placeholder="123-456-7890"/><br/>
<i>You will receive a text message at this number when other users join your games.</i><br/>
<br/>
<input type="submit" value="Continue"/>
</form>

</body>
</html>