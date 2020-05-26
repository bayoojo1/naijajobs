<?php
include("php_includes/check_login_status.php");
include("php_includes/mysqli_connect.php");
$url = 'https://t.me/naijajobsarena/65';
// If user is already logged in, header that weenis away
if($user_ok == true){
    header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?><?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["e"])){
    // CONNECT TO THE DATABASE
    // GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
    $e = $_POST['e'];
    $p = ($_POST['p']);
    $r = ($_POST['r']);
    // GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
    // FORM DATA ERROR HANDLING
    if($e == "" || $p == ""){
        echo "login_failed";
        exit();
    } else {
    // END FORM DATA ERROR HANDLING
    include("php_includes/mysqli_connect.php");
    $sql = "SELECT id, username, password, email FROM users WHERE email=:email AND activated=:activated LIMIT 1";
            $stmt = $db_connect->prepare($sql);
            $stmt->bindParam(':email', $e, PDO::PARAM_STR);
            $stmt->bindValue(':activated', '1', PDO::PARAM_STR);
            $stmt->execute();

            foreach($stmt->fetchAll() as $row) {
                 $db_id = $row['0'];
                 $db_username = $row['1'];
                 $db_pass_str = $row['2'];
                 $db_email = $row['3'];

            }

        if(!password_verify($p, $db_pass_str)){
            echo "invalid";
            exit();
        } else {
            // CREATE THEIR SESSIONS AND COOKIES
            $_SESSION['userid'] = $db_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['email'] = $db_email;
            $_SESSION['password'] = $db_pass_str;
            if($r == 'true') {
            setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
            setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
            setcookie("mail", $db_email, strtotime( '+30 days' ), "/", "", "", TRUE);
            setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE);
          } else if($r == 'false') {
            setcookie("id", '', strtotime( '-5 days' ), '/');
            setcookie("user", '', strtotime( '-5 days' ), '/');
            setcookie("mail", '', strtotime( '-5 days' ), '/');
            setcookie("pass", '', strtotime( '-5 days' ), '/');
          }
            // UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
            //include("php_includes/mysqli_connect.php");
            $sql = "UPDATE users SET ip=:ip, lastlogin=now() WHERE email=:email LIMIT 1";
            $stmt = $db_connect->prepare($sql);
            $stmt->bindParam(':email', $db_email, PDO::PARAM_STR);
            $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
            $stmt->execute();
            // Get the last visit and update date_visit table
            $sql = "SELECT latest_visit FROM date_visit WHERE username=:username LIMIT 1";
            $stmt = $db_connect->prepare($sql);
            $stmt->bindParam(':username', $db_username, PDO::PARAM_STR);
            $stmt->execute();
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
              $last_visit = $row['latest_visit'];
            }
            // Update the info in date_visit table
            $sql = "UPDATE date_visit SET last_visited='$last_visit', latest_visit=now() WHERE username=:username LIMIT 1";
            $stmt = $db_connect->prepare($sql);
            $stmt->bindParam(':username', $db_username, PDO::PARAM_STR);
            $stmt->execute();

            echo $db_username;
            exit();
        }
    }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
  <link rel="icon" sizes="16x16" href="images/favicon_io/favicon.ico">
  <link rel="manifest" href="images/favicon_io/site.webmanifest">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script
  src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">

<?php include_once('templatePageTop.php'); ?>

<!-- Modal for login-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Email</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input id="checkbx" type="checkbox">Remember me for 30 days</label>
            </div>
              <button type="submit" id="logbtn" onclick="login()" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
              <p id="loginstatus" style="text-align:center;"></p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Want to post a job? <a id="regBtn" href="#">Sign Up</a></p>
          <p>Forgot <a id="forgotpassword" href="#">Password?</a></p>
        </div>
      </div>

    </div>
  </div>
<!-- Ends here -->

<!-- Modal for signup -->
<div class="modal fade" id="regModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding:35px 50px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span> Sign Up</h4>
      </div>
      <div class="modal-body" style="padding:40px 50px;">
        <form role="form">
          <div class="form-group">
            <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Email</label>
            <input type="text" class="form-control" id="signupusrname" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
            <input type="password" class="form-control" id="signuppsw" placeholder="Enter password">
          </div>
          <div class="form-group">
            <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Repeat Password</label>
            <input type="password" class="form-control" id="signuppsw1" placeholder="Enter password">
          </div>
          <div class="checkbox">
            <label><input id="checkbox_id" type="checkbox" value="">Terms & Conditions</label>
          </div>
            <button type="submit" id="signupbtn" onclick="signup()" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Register</button>
            <p id="regstatus" style="text-align:center;"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
      </div>
    </div>

  </div>
</div>
<!-- Ends Here -->
<!-- Modal for forgot Password -->
<div class="modal fade" id="forgotModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding:35px 50px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span> Forgot Password</h4>
      </div>
      <div class="modal-body" style="padding:40px 50px;">
        <form role="form">
          <div class="form-group">
            <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Email</label>
            <input type="text" class="form-control" id="forgotmail" placeholder="Enter email">
          </div>
            <button type="submit" id="forgotbtn" onclick="forgotpwd()" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Send</button>
            <p id="forgotstatus" style="text-align:center;"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- Ends Here -->

<div id="home" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active" style="height=400px; width=1200px;">
        <img src="images/banners/newlogo/banner_new.png" alt="Image" height="400" width="1200">
      </div>
    </div>
</div>
<br>
<br>
<div id="about" class="container-fluid bg-3 text-center" style="min-height:500px;">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="jumbotron" id="jombo" style="color:white;">
        <p>Naija Jobs Arena is a platform that connects job providers with job seekers.</p>
        <p>If you are job provider, you only need to sign up here and start posting your vacancies.</p>
        <button type="button" id="provReg" style="color:white; font-weight:bold;" class="btn btn-danger btn-lg">Register</button>
        <br>
        <h1>How we connect providers and seekers</h1>
        <p>Once a job is posted by registered providers, Naija Jobs Arena takes over the remaining aspect of the process. We utilize the Telegram App to alert job seekers who already subscribed to our <a href="https://t.me/naijajobsarena_bot" style="color:#FF4500; font-weight:bold;">Telegram bot.</a> job alerts.</p>
        <p>Note that we have an approval process before any posted job is broadcast to our Telegram subscribers. This is to ensure we don't broadcast scam vacancies to our subscribers.</p>
        <p>As job seekers, Subscribe to our Telegram bot below to start recieving our daily job alerts.</p>
        <button type="button" class="btn btn-danger btn-lg"><a href="https://t.me/naijajobsarena_bot" style="color:white; font-weight:bold;">Subscribe Now</a></button>
    </div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<br>
<br>
<footer style="background-color:black; color:white;" class="container-fluid text-center">
  <p>Copyright &copy<?php echo date("Y"); ?> - Naija Jobs Arena</p>
  <p><i class="far fa-envelope"></i><span> info@naijajobsarena.com</span></p>
<a href="https://www.facebook.com/naijajobsarena"><i class="fab fa-facebook-square fa-2x social"></i></a>
<?php echo '<a href="http://www.facebook.com/sharer/sharer.php?u=' . urlencode($url) . '">Share on facebook</a>'; ?>
</footer>
<link rel="stylesheet" href="style/style.css">
<script src="js/functions.js"></script>
</body>
</html>
