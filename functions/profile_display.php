<?php
include("./php_includes/mysqli_connect.php");
// Get all the variables to be echoed 
$sql = "SELECT * FROM users WHERE username = :logusername";
$stmt = $db_connect->prepare($sql);
$stmt->bindParam(':logusername', $log_username, PDO::PARAM_STR);
$stmt->execute();
?><?php
echo '<table class="table table-hover" style="background-color:lightgray;">';
if($isSuperadmin) {
  echo '<tr>';
    echo '<td><b>Profile Status:</b></td>';
    echo '<td>Super Admin</td>';
    echo '<td></td>';
  echo '</tr>';
} else if($isUser) {
    echo '<tr>';
      echo '<td><b>Profile Status:</b></td>';
      echo '<td>Business Owner</td>';
    echo '<td></td>';
  echo '</tr>';
} else if($isAdmin) {
  echo '<tr>';
    echo '<td><b>Profile Status:</b></td>';
    echo '<td>Administrator</td>';
    echo '<td></td>';
  echo '</tr>';
} else if($isBilling) {
  echo '<tr>';
    echo '<td><b>Profile Status:</b></td>';
    echo '<td>Billing</td>';
    echo '<td></td>';
  echo '</tr>';
} else if($isSupport) {
  echo '<tr>';
    echo '<td><b>Profile Status:</b></td>';
    echo '<td>Support Personnel</td>';
    echo '<td></td>';
  echo '</tr>';
}
  echo '<tr>';
    echo '<td><b>Username:</b></td>';
    echo '<td>'.$username.'</td>';
    echo '<td></td>';
  echo '</tr>';
  echo '<tr>';
    echo '<td><b>Email:</b></td>';
    echo '<td>'.$email.'</td>';
    echo '<td></td>';
  echo '</tr>';
  if($isUser) {
    echo '<tr>';
      echo '<td><b>Organization Name:</b></td>';
      echo '<td id="bizname_'.$profile_id.'">'.$row['company'].'</td>';
      echo '<td><button type="button" class="btn btn-info btn-sm" onclick="edit(this);"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>';
      echo '<td><button type="button" class="btn btn-success btn-sm" style="visibility:hidden" onclick="save(this);"><span class="glyphicon glyphicon-floppy-save"></span> Save</button></td>';
    echo '</tr>'; 
    //if(isset($row['website'])) {
      echo '<tr>';
        echo '<td><b>Website:</b></td>';
        echo '<td id="website_'.$profile_id.'">'.$row['website'].'</td>';
        echo '<td><button type="button" class="btn btn-info btn-sm" onclick="edit(this)"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>';
        echo '<td><button type="button" class="btn btn-success btn-sm" style="visibility:hidden" onclick="save(this)"><span class="glyphicon glyphicon-floppy-save"></span> Save</button></td>';
      echo '</tr>';
   // }
    echo '<tr>';
      echo '<td><b>About Us:</b></td>';
      echo '<td id="bizdescription_'.$profile_id.'">'.$row['about'].'</td>';
      echo '<td><button type="button" class="btn btn-info btn-sm" onclick="editdesc(this)"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>';
      echo '<td><button type="button" class="btn btn-success btn-sm" style="visibility:hidden" onclick="savedesc(this)"><span class="glyphicon glyphicon-floppy-save"></span> Save</button></td>';
    echo '</tr>';
}
  echo '<tr>';
    echo '<td><b>Change Profile Picture:</b></td>';
    echo '<td>';
    echo '<form enctype="multipart/form-data" method="post" action="php_parsers/photo_system.php">';
    echo '<div class="form-group">';
      echo '<input type="file" class="form-control-file border" name="avatar" required>';
      echo '</div>';
    echo '</td>';
    echo '<td>';
      echo '<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-upload"></span> Upload</button>';
  echo '</form>';
    echo '</td>';
  echo '</tr>';
echo '</table>';
?>
