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
  <title>Send Photo</title>
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
<br />
<br />
<br />
<br />
<?php echo $pageleft; ?>
<div class="col-sm-6">
  <br>
  <br>
  <br>
  <br>
<div style="font-size:26px;">Send Photo</div>
  <br>
  <br>
    <form>
  <div class="form-group">
    <label for="filepath">Photo File Path:</label>
    <input type="text" class="form-control" id="filepath" placeholder="Full path of the image location. E.g. /var/www/html/filename" required>
  </div>
  <div class="form-group">
    <label for="userid">Recepient Chat ID:</label>
    <input type="text" class="form-control" id="chatid" placeholder="Optionally enter recepient chat id separated by comma. If empty, we'll use DB chat id.">
  </div>
  <div class="form-group">
    <label for="caption">Photo Description(Optional):</label>
      <textarea type="text" class="form-control" id="caption" placeholder="Enter the photo description..." ></textarea>
  </div>
  <button type="button" id="sendPhotoBtn" class="btn btn-success" onclick="sendPhoto()">Submit</button>
<br><br>
<div id="poststatus"></div>
</form>      
</div>
<link rel="stylesheet" href="style/style.css">
<script src="js/functions.js"></script>
</body>
</html>
