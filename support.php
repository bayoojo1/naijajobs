<?php
//include('php_includes/mysqli_connect.php');
// Start the process of updating the user home feed
//$adminfeed = '<div class="col-sm-12">';
echo '<div class="col-sm-12">';
$paginationCtrls = '<span>';
  // Get some variables to be used
  $sql_trans = "SELECT jobslisting.id, job_title, company_desc, job_responsibility, qualification_skill, education_requirement, benefit, location, howtoapply, salary, approval, datePosted, users.company, users.about FROM jobslisting INNER JOIN users ON users.username = jobslisting.username ORDER BY jobslisting.id DESC";
  $stmt = $db_connect->prepare($sql_trans);
  $stmt->execute();
  $job_count = $stmt->rowCount();
  // Specify how many result per page
  $rpp = '10';
  // This tells us the page number of the last page
  $last = ceil($job_count/$rpp);
  // This makes sure $last cannot be less than 1
  if($last < 1){
      $last = 1;
  }
  // Define pagination control
  //$paginationCtrls = "";
  // Define page number
  $pn = "1";

  // Get pagenum from URL vars if it is present, else it is = 1
  if(isset($_GET['pn'])){
      $pn = preg_replace('#[^0-9]#', '', $_GET['pn']);
  //$searchquery = $_POST['searchquery'];
  }

  // Make the script run only if there is a page number posted to this script

  // This makes sure the page number isn't below 1, or more than our $last page
  if ($pn < 1) {
      $pn = 1;
  } else if ($pn > $last) {
  $pn = $last;
  }

  // This sets the range of rows to query for the chosen $pn
  $limit = 'LIMIT ' .($pn - 1) * $rpp .',' .$rpp;
  // This is the query again, it is for grabbing just one page worth of rows by applying $limit
  $sql = "$sql_trans"." $limit";
  $stmt = $db_connect->prepare($sql);
  $stmt->execute();
  if($job_count > 0){
    //$paginationCtrls .= '<div class="col-sm-9">';
    $paginationCtrls .= '<ul class="pagination">';
    if($last != 1){
        /* First we check if we are on page one. If we are then we don't need a link to
           the previous page or the first page so we do nothing. If we aren't then we
           generate links to the first page, and to the previous page. */
        if ($pn > 1) {
            $previous = $pn - 1;
            $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?u='.$log_username.'&pn='.$previous.'">Previous</a></li> &nbsp; &nbsp;';
            // Render clickable number links that should appear on the left of the target page number
            for($i = $pn-4; $i < $pn; $i++){
                if($i > 0){
                    $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?u='.$log_username.'&pn='.$i.'">'.$i.'</a></li> &nbsp;';
                }
            }
        }
        // Render the target page number, but without it being a link
        $paginationCtrls .= '<li class="active"><a href="#">'.$pn.'</a></li> &nbsp; ';
        // Render clickable number links that should appear on the right of the target page number
        for($i = $pn+1; $i <= $last; $i++){
            $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?u='.$log_username.'&pn='.$i.'">'.$i.'</a></li> &nbsp;';
            if($i >= $pn+4){
                break;
            }
        }
        // This does the same as above, only checking if we are on the last page, and then generating the "Next"
        if ($pn != $last) {
            $next = $pn + 1;
            $paginationCtrls .= ' &nbsp; &nbsp; <li><a href="'.$_SERVER['PHP_SELF'].'?u='.$log_username.'&pn='.$next.'">Next</a></li>';
        }
    }
    $paginationCtrls .= '</ul>';
    $paginationCtrls .= '</span>';
    echo $paginationCtrls;
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $profile_id = $row["id"];
        $job_title = $row["job_title"];
        $company_desc = $row['company_desc'];
        $jobResponsibility = $row["job_responsibility"];
        $qualification = $row["qualification_skill"];
        $educationRequirement = $row["education_requirement"];
        $benefit = $row["benefit"];
        $location = $row["location"];
        $howtoapply = $row['howtoapply'];
        $salary = $row["salary"];
        $approval = $row["approval"];
        $datePosted = $row["datePosted"];
        $company = $row["company"];
        $about = $row["about"];
        $b = date_create($datePosted);
        $readabledate = date_format($b, 'jS F, Y');
    // Update the user timeline
    echo '<div class="row" id="'.$profile_id.'">';
      echo '<div class="col-sm-12">';
        echo '<div class="panel panel-primary optionals">';
        if($approval == "Yes") {
            echo '<div class="panel-heading opt-heading"><b>'.$job_title . '</b><i style="color:white; margin-left:10px;" class="fas fa-check-circle"></i></div>';
        } else {
            echo '<div class="panel-heading opt-heading"><b>'.$job_title.'</b></div>';
        }
        if(isset($company_desc)) {
        echo '<div class="panel-body" style="margin-top:-15px; margin-bottom:-30px;">'.$company_desc.'</div>';
        echo '<hr>';
        } else {
            echo '<div class="panel-body" style="margin-top:-15px; margin-bottom:-30px;">'.$about.'</div>';
        echo '<hr>';
        }
        if(isset($jobResponsibility) && !empty($jobResponsibility)) {
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>Responsibilities:</u></b><br>' .nl2br($jobResponsibility).' </div>';
        echo '<hr>';
        }
        if(isset($qualification) && !empty($qualification)) {
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>Skill Requirement:</u></b><br>' .nl2br($qualification).' </div>';
        echo '<hr>';
        }
        if(isset($educationRequirement) && !empty($educationRequirement)) {
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>Educational Requirement:</u></b><br>' .nl2br($educationRequirement).' </div>';
        echo '<hr>';
        }
        if(isset($salary) && !empty($salary)) {
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>Renumeration:</u></b><br>' .$salary.' </div>';
        echo '<hr>';
        }
        if(isset($benefit) && !empty($benefit)) {
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>Other benefits:</u></b><br>' .nl2br($benefit).' </div>';
        echo '<hr>';
        }
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>Job Location:</u></b><br>' .nl2br($location).' </div>';
        echo '<hr>';
        if(filter_var('http://'.$howtoapply, FILTER_VALIDATE_URL)) {
        echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>How to apply:</u></b><br>Visit our website: <a href="'.$howtoapply.'">'.$howtoapply.'</a> </div>';
        echo '<hr>';        
        } else {
           echo '<div class="panel-body" style="margin-top:-25px; margin-bottom:-30px;"><b><u>How to apply:</u></b><br>' .$howtoapply.'</div>';
        echo '<hr>'; 
        }
        echo '<div class="panel-body" style="margin-top:-25px;"><b><u>Date Posted:</u></b><br>' .$readabledate.' </div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
  }
?>
