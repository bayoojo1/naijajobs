<?php
if (isset($_GET['id']) && isset($_GET['hash'])) {
    include("php_includes/mysqli_connect.php");
    
    $chat_id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    $hash =  $_GET['hash'];
    $message = '';
    $greeting = 'We take your feedback very seriously.';
    
    $message .= '<div class="col-sm-10">';
    $message .= '<div style="font-size:16px;">'.$greeting.'</div>';
    $message .= '<br>';
    $message .= '<form class="form-inline">';
    $message .= '<div class="form-group">';
    $message .= '<label class="sr-only" for="name">Your Name:</label>';
    $message .= '<input type="name" class="form-control" id="name" placeholder="Optionally enter your name here...">';
    $message .= '</div>';
    $message .= '<div class="form-group">';
    $message .= '<label class="sr-only" for="complaint">Message:</label>';
    $message .= '<textarea type="text" class="form-control" row="8" id="message" placeholder="Enter your message here..." required></textarea>';
    $message .= '</div>';
    $message .= '<button type="button" id="'.$chat_id.'" onclick=submitMessage(this) class="btn btn-default">Submit</button>';
    $message .= '</form>';
    $message .= '<br>';
    $message .= '<div id="messageStatus"></div>';
    $message .= '</div>';

} else {
    // Log this issue of missing initial $_GET variables
    header("location: message.php?msg=Sorry, we cannot verify the token.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Naija Jobs Arena - Contact Us</title>
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
   <nav class="navbar navbar-inverse navbar-fixed-top"  style="background-color:black;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <ul class="nav navbar-nav navbar-right" id="myScrollspy">
            <li class="active"><a id="Home" href="#home"><b>HOME</b></a></li>
            <li><a id="aboutus" href="#about"><b>ABOUT US</b></a></li>
            <li><a href="#" id="myBtn"><span class="glyphicon glyphicon-log-in"></span><b> LOGIN</b></a></li>
        </ul>
        
        <a class="navbar-left" href="#"><img src="images/logo/logo.png"></a>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<?php echo $message; ?>
<script src="js/message.js"></script>
<link rel="stylesheet" href="style/style.css">
</body>
</html>
