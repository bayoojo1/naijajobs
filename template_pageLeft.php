<?php
include("php_includes/check_login_status.php");
// Initialize any variables that the page might echo

// Make sure the _GET username is set, and sanitize it
if(isset($_GET["u"]) && ($_GET["u"] == $log_username)){
    $u = preg_replace('#[^a-z0-9.@_]#i', '', $_GET["u"]);
} else {
    header("location: http://localhost:8080/naijajobs/logout.php");
    exit();
}
include_once("functions/page_functions.php");
?>
