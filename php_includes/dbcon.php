<?php 
// Create connection
$dbc = new mysqli(localhost, root, wifi1234, naijajobs);

// Check connection
if ($dbc->connect_error) {
    die("Connection failed: " . $dbc->connect_error);
}
?>