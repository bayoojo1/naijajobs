<?php
require("./php_includes/mysqli_connect.php");
?><?php
// Find date a week back
//$aWeekago = date('Y-m-d H:i:s', strtotime('-1 week'));

$sql = "SELECT users.id, users.username, users.avatar, website, company, email, avatar, about, signup, lastlogin, useroptions.usertype FROM users INNER JOIN useroptions ON users.username=useroptions.username WHERE users.username=:username AND activated='1' LIMIT 1";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':username', $u, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();
if($count < 1) {
    echo "That user does not exist or is not yet activated, press back";
    exit();
}

// Fetch the user row from the query above
foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $profile_id = $row["id"];
    $username = $row["username"];
    $company = $row['company'];
    $email = $row["email"];
    $avatar = $row["avatar"];
    $about = $row['about'];
    $usertype = $row['usertype'];
    $website = $row['website'];
    $signup = $row["signup"];
    $lastlogin = $row["lastlogin"];
    $joindate = strftime("%b %d, %Y", strtotime($signup));
    $lastsession = strftime("%b %d, %Y", strtotime($lastlogin));
}
?><?php
// Get the different user types
$isUser = false;
$isAdmin = false;
$isBilling = false;
$isSupport = false;
$isSuperadmin = false;
if($user_ok == true && $u == $log_username && $usertype == 'user') {
  $isUser = true;
} else if($user_ok == true && $u == $log_username && $usertype == 'admin') {
  $isAdmin = true;
} else if($user_ok == true && $u == $log_username && $usertype == 'billing') {
  $isBilling = true;
} else if($user_ok == true && $u == $log_username && $usertype == 'support') {
  $isSupport = true;
} else if($user_ok == true && $u == $log_username && $usertype == 'superadmin') {
  $isSuperadmin = true;
}
?><?php
$pageleft = '';
$pageleft = '<div class="container text-center col-sm-offset-2">';
  $pageleft .= '<div class="row">';
    $pageleft .= '<div class="col-sm-2 well">';
      $pageleft .= '<div class="panel panel-default optionals">';
        $pageleft .= '<img src="user/'.$u.'/'.$avatar.'" class="img-circle" height="85" width="85">';
        if($isUser) {
            $pageleft .= '</div>';
            $pageleft .= '<div class="panel panel-default optionals">';
            $pageleft .= '<div class="panel-heading opt-heading">About Us</div>';
            $pageleft .= '<div class="panel-body">'.$about.'</div>';
            $pageleft .= '</div>';
        
            if(isset($website) || isset($company)) {
                $pageleft .= '<p><span style="color:#337ab7;" class="glyphicon glyphicon-globe"></span><a style="color:#337ab7;" href="http://'.$website.'"> '.$website.'</a></p>';
                $pageleft .= '<p style="color:#337ab7;"><i class="fas fa-briefcase"></i> ' .$company.'</p>';
            }
            $pageleft .= '<button type="button" class="btn btn-success btn-lg" id="userReg">Post a Job</button>';
        } else if($isAdmin) {
            $pageleft .= '</div>';
            $pageleft .= '<div class="panel panel-default optionals">';
            $pageleft .= '<div class="panel-heading opt-heading">About Me</div>';
            $pageleft .= '<div class="panel-body">'.$about.'</div>';
            $pageleft .= '</div>';
            $pageleft .= '<div id="sadminWidget" class="list-group">';
            $pageleft .= '<a id="manageuser" href="poll.php?u='.$log_username.'" class="list-group-item">Create Poll</a>';
            $pageleft .= '<a id="statistics" href="stats.php?u='.$log_username.'" class="list-group-item">Site Statistics</a>';
            $pageleft .= '<a id="managebilling" href="sendphoto.php?u='.$log_username.'" class="list-group-item">Post Photo</a>';
            $pageleft .= '<a id="registerbots" href="registerBots.php?u='.$log_username.'" class="list-group-item">Register Bot for first</a>';
            $pageleft .= '<div><button type="button" >Post</button></div>';
            $pageleft .= '<div><button type="button" >Post</button></div>';
            $pageleft .= '</div>';
            $pageleft .= '<button type="button" class="btn btn-success btn-lg" id="admUserReg">Post a Job</button>';
            
      } else if($isSuperadmin) {
            $pageleft .= '<div id="sadminWidget" class="list-group">';
            $pageleft .= '<a id="manageuser" href="manageuser.php?u='.$log_username.'" class="list-group-item">Manage User</a>';
            $pageleft .= '<a id="managebilling" href="managebilling.php?u='.$log_username.'" class="list-group-item">Manage Billing</a>';
            $pageleft .= '</div>';
      } else if($isSupport) {
            $pageleft .= '</div>';
            $pageleft .= '<div class="panel panel-default optionals">';
            $pageleft .= '<div class="panel-heading opt-heading">About Me</div>';
            $pageleft .= '<div class="panel-body">'.$about.'</div>';
            $pageleft .= '</div>';
            $pageleft .= '<button type="button" class="btn btn-success btn-lg" id="sptUserReg">Post a Job</button>';
        }
    $pageleft .= '</div>';
?>
