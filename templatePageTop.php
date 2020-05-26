<?php
include_once("php_includes/check_login_status.php");
include("php_includes/mysqli_connect.php");

$loginLink = '<ul class="nav navbar-nav navbar-right" id="myScrollspy">
<li class="active"><a id="Home" href="#home"><b>HOME</b></a></li>
<li><a id="aboutus" href="#about"><b>ABOUT US</b></a></li>
<li><a href="#" id="myBtn"><span class="glyphicon glyphicon-log-in"></span><b> LOGIN</b></a></li>
</ul>';
if($user_ok == true) {
    $loginLink = '<ul class="nav navbar-nav navbar-right">';
    $loginLink .=  '<li><a href="user.php?u='.$log_username.'"><i class="fas fa-home fa-2x navicon" id="homeid" alt="home" title="Home"></i></a></li>';
    $loginLink .= '<li><a href="profile.php?u='.$log_username.'"><i class="fas fa-cog fa-2x navicon" id="settingsid" alt="rss" title="Profile Setting"></i></a></li>';
    $loginLink .= '<li><a href="logout.php"><i class="fas fa-sign-out-alt fa-2x navicon" id="logoutid" alt="logout" title="Logout"></i></a></li>
    </ul>';
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top"  style="background-color:black;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-left" href="#"><img src="images/logo/logo.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <?php
            echo $loginLink;
       ?>
    </div>
  </div>
</nav>
