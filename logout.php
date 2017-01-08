<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>Logout</title>    
  </head>
  <body>
  
<?php
  if(isset($_SESSION['homeownerid'])) {
    unset($_SESSION['homeownerid']);
    die("<h3>You are no longer logged in. Bye-bye.<br>Back to DIY Helpers <a href='index.php'>Login</a>.</h3>");
  }
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
    $params["domain"], $params["secure"], $params["httponly"]);
  }
  session_destroy();
?>

  </body>
</html>
  