<?php
if (isset($_GET['title']) && isset($_GET['id']) && isset($_GET['hash'])) {
    include("php_includes/mysqli_connect.php");
    
    $title = preg_replace('#[^a-z0-9,\'.@:;/() ]#i', '', $_GET['title']);
    $job_id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    $hash =  $_GET['hash'];
    $compl = '';
    // Run a check on the variables and exit if not correct 
    $sql = "SELECT job_title, hash FROM jobslisting WHERE id=:id";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':id', $job_id, PDO::PARAM_STR);
    $stmt->execute();
    foreach($stmt->fetchAll() as $row) {
      $dbJobTitle = $row['job_title'];
      $dbHash = $row['hash'];
    }
    if($hash != $dbHash) {
        header("location: message.php?msg=Sorry, we cannot verify the token.");
        exit();
    }
    $compl .= '<div class="col-sm-10">';
    $compl .= '<div style="font-size:16px;">'.$dbJobTitle.'</div>';
    $compl .= '<br>';
    $compl .= '<form class="form-inline">';
    $compl .= '<div class="form-group">';
    $compl .= '<label class="sr-only" for="pwd">Your Email:</label>';
    $compl .= '<input type="email" class="form-control" id="mail" placeholder="Enter your email here..." required>';
    $compl .= '</div>';
    $compl .= '<div class="form-group">';
    $compl .= '<label class="sr-only" for="complaint">Complaint:</label>';
    $compl .= '<textarea type="text" class="form-control" row="8" id="complaint" placeholder="Enter your complaint here..." required></textarea>';
    $compl .= '</div>';
    $compl .= '<button type="button" id="'.$job_id.'" onclick=submitComplaint(this) class="btn btn-default">Submit</button>';
    $compl .= '</form>';
    $compl .= '<br>';
    $compl .= '<div id="compStatus"></div>';
    $compl .= '</div>';

} else {
    // Log this issue of missing initial $_GET variables
    header("location: message.php?msg=Sorry, we cannot verify the token.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Naija Jobs Arena</title>
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
<?php echo $compl; ?>
<script src="js/complaint.js"></script>
<link rel="stylesheet" href="style/style.css">
</body>
</html>
