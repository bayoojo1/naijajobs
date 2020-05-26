<?php
include_once("php_includes/check_login_status.php");
// If the page requestor is not logged in, usher them away
if($user_ok != true || $log_username == ""){
    header("location: http://localhost:8080/naijajobs/index.php");
    exit();
}
if(isset($_GET['u'])){
    $u = preg_replace('#[^a-z0-9.@_]#i', '', $_GET['u']);
}else{
    exit();
}
include_once("functions/page_functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register Bot</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
  <link rel="icon" sizes="16x16" href="images/favicon_io/favicon.ico">
  <link rel="manifest" href="images/favicon_io/site.webmanifest">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include_once('templatePageTop.php'); ?>
<br>
<br>
<br>
    <?php echo $pageleft; ?>
<div class="container text-center">
  <div class="col-sm-7">
    <h1>Register a Bot</h1>
      <form action="https://api.telegram.org/bot959364317:AAEjHrvMc4bjFj3aZozblHJRoQoewh7RFRc/setwebhook" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="token">Enter your Token:</label>
          <input type="text" class="form-control" id="token" name="token" placeholder="Enter your bot token here..." required>
        </div>
        <div class="form-group">
          <label for="url">Enter your Host URL:</label>
          <input type="text" class="form-control" id="url" name="url" placeholder="Your host url, e.g. https://www.example.com/file.php" required>
        </div>
        <div class="form-group">
          <label for="port">Enter your Port:</label>
          <input type="text" class="form-control" id="port" name="port" placeholder="Enter your preferred port, e.g. 80, 443, etc..." required>
        </div>
        <div class="form-group">
          <label for="conn">Maximum Connection:</label>
          <input type="text" class="form-control" id="conn" name="conn" placeholder="Maximum connection to your bots, e.g. 100" required>
        </div>
          <button type="button" id="submitBotReg" class="btn btn-success" >Register</button>
        <div id="status"></div>
      </form>
  </div>
</div>
<link rel="stylesheet" href="style/style.css">
<script src="js/registerbot.js"></script>
</body>
</html>
