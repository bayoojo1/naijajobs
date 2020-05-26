<?php
include("php_includes/mysqli_naijabots_connect.php");
include("functions/telegramBotsFunctions.php");
$update = json_decode(file_get_contents("php://input"), TRUE);
$chat_id = isset($update["message"]["chat"]["id"]) ? $update["message"]["chat"]["id"] : "";
$firstname = isset($update["message"]["chat"]["first_name"]) ? $update["message"]["chat"]["first_name"] : "";
$lastname = isset($update["message"]["chat"]["last_name"]) ? $update["message"]["chat"]["last_name"] : "";
$telegramUsername = isset($update["message"]["chat"]["username"]) ? $update["message"]["chat"]["username"] : "";
$message = isset($update["message"]["text"]) ? $update["message"]["text"] : "";
$callback_query = isset($update["callback_query"]) ? $update["callback_query"] : "";
$callback_data = isset($callback_query["data"]) ? $callback_query["data"] : "";
$token = "1180159193:AAGmdFUATIfLWwy2jUiFWi5Anu-2aKRjz2w";
$sendMessage_url = "https://api.telegram.org/bot$token/sendMessage"; 
$jobcat_keyboard = array("keyboard" => array(array(array("text" => "Job Categories","callback_data" => "jobcategories" ))),"one_time_keyboard" => false, "resize_keyboard" => true);  
        


if($message == "/start") {
    $text = "<b><u>Welcome To Naija Jobs Arena.</u></b> \n I'm a bot that helps provides job vacancies. With me, you don't need to search for vacancies anymore, as I always place them on your palm. \n To start, click on the <b>Job Categories</b> button below to see the list of categories, select any category you'll like to receive vacancy alerts from me - You can select as many as you want. Every click on any category returns 20 most recent vacancies posted within the last 1 week. \n I also send frequent vacancy's alerts on your selected categories, so you don't miss any opportunity";
    
    // Check if user chat id is in the db, if not store it
    $sql = "SELECT COUNT(id) FROM telegram_users WHERE chat_id = :chat_id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':chat_id', $chat_id, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() < 1) {
        // Store it in the db
        $stmt = $db_connect->prepare( "INSERT INTO telegram_users (chat_id, Firstname, Lastname, Username, dateJoined) VALUES(:chat_id, :Firstname, :Lastname, :Username, now())");
        $stmt->execute(array(':chat_id' => $chat_id, ':Firstname' => $firstname, ':Lastname' => $lastname, ':Username' => $telegramUsername));
    }
     
    welcomeMessage($sendMessage_url,$chat_id,$text,$jobcat_keyboard);
} else if($callback_data == "jobcategories") {
    $chat_id = $callback_query["message"]["chat"]["id"];
    //$text = "Select a category below:";
    
    // Fetch categories from the database and send to user 
    $sql = "SELECT category FROM job_categories";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $category = $row['category'];
   
        // Get the count of category id 
        $sql = "SELECT COUNT(id) FROM jobslisting WHERE category = :category";
        $stmt = $db_connect->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        foreach($stmt->fetchAll() as $row) {
          $count = $row['0'];
        }
        //Define the keyboard buttons 
        $cat_keyboard = array("inline_keyboard" =>
        array(array(array("text" => isset($category) ? $category. '' .$count : "","callback_data" => isset($category) ? $category : "")))); 
    }
        $text = "Select a category below:";
        showCategories($sendMessage_url,$chat_id,$text,$cat_keyboard);
        

} else if(isset($callback_data) && !empty($callback_data) && $callback_data != "jobcategories") {
    $chat_id = $callback_query["message"]["chat"]["id"];
    
    // Check if user has any category in notification 
    $sql = "SELECT id FROM notification WHERE category = :category AND chat_id = :chat_id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':category', $callback_data, PDO::PARAM_STR);
    $stmt->bindParam(':chat_id', $chat_id, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
    
    
    $sql = "SELECT jobslisting.id, job_title, company_desc, job_responsibility, qualification_skill, education_requirement, benefit, location, jobslisting.hash, howtoapply, salary, datePosted, users.company, users.about FROM jobslisting INNER JOIN users ON users.username = jobslisting.username WHERE (jobslisting.category = :category AND jobslisting.approval = :approval AND jobslisting.datePosted > NOW() -INTERVAL 1 WEEK) ORDER BY RAND() LIMIT 20";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':category', $callback_data, PDO::PARAM_STR);
    $stmt->bindValue(':approval', 'Yes', PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
    
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $job_id = $row['id'];
        $jobTitle = $row['job_title'];
        $comp_description = $row['company_desc'];
        $job_desc = $row['job_responsibility'];
        $skill_reqmt = $row['qualification_skill'];
        $edu_reqmt = $row['education_requirement'];
        $benefit = $row['benefit'];
        $location = $row['location'];
        $hash = $row['hash'];
        $howtoapply = $row['howtoapply'];
        $salary = $row['salary'];
        $companyName = $row['company'];
        $about = $row['about'];
        $datePosted = $row['datePosted'];
        //}
        
        $keyboard = array("inline_keyboard" => array(array(array("text" => "Report this job","url" => "www.naijajobsarena.com/reportjob/$jobTitle/$job_id/$hash"),array("text" => "Job Categories","callback_data" => "jobcategories" ))));
    // Form the text for Telegram
        $text = "";
        $text .= "<b><u>Job Title:</u></b>";
        $text .= "\n";
        $text .=  $jobTitle;
        $text .= "\n";
    if(isset($comp_description) && !empty($comp_description)){
    $text .= '<b><u>About Us:</u></b>';
    $text .= "\n";
    $text .=  $comp_description;
    } else {
        $text .= '<b><u>About Us:</u></b>';
        $text .= "\n";
        $text .=  $about;
    }
    $text .= "\n";
    if(isset($job_desc) && !empty($job_desc)) {
    $text .= '<b><u>Job Description:</u></b>';
    $text .= "\n";
    $text .=  $job_desc;
    $text .= "\n";
    }
    if(isset($skill_reqmt) && !empty($skill_reqmt)) {
    $text .= '<b><u>Other Skills:</u></b>';
    $text .= "\n";
    $text .=  $skill_reqmt;
    $text .= "\n";
    }
    if(isset($edu_reqmt) && !empty($edu_reqmt)) {
    $text .= '<b><u>Educational Requirement:</u></b>';
    $text .= "\n";
    $text .=  $edu_reqmt;
    $text .= "\n";
    }
    $text .= '<b><u>Job Location:</u></b>';
    $text .= "\n";
    $text .=  $location;
    $text .= "\n";
    if(isset($benefit) && !empty($benefit)) {
    $text .= '<b><u>Other Benefits:</u></b>';
    $text .= "\n";
    $text .=  $benefit;
    $text .= "\n";
    }
    if(isset($salary) && !empty($salary)) {
    $text .= '<b><u>Renumeration:</u></b>';
    $text .= "\n";
    $text .=  $salary;
    $text .= "\n";
    }
    $text .= '<b><u>To Apply:</u></b>';
    $text .= "\n";
    if(filter_var('http://'.$howtoapply, FILTER_VALIDATE_URL)) {
    $text .= ' Visit our website: ' .$howtoapply;
    $text .= "\n";
    } else {
    $text .= $howtoapply;
    $text .= "\n"; 
    }
    $text .= '<b><u>Date Posted:</u></b>';
    $text .= "\n";
    $text .=  $datePosted;
    $text .= "\n";
    $text .= "\n";
    $text .= "##################################";
    $text .= "\n";
    $text .= "\n";
      // Initiate Telegram sendMessage 
    requestjob($sendMessage_url,$chat_id,$text,$keyboard);  
    }
       
    } else {
            $text = "I don't have any recent vacancy in " .$callback_data. " category for now. You'll be notified once I have a vacancy in " .$callback_data. " category";
            novacancy($sendMessage_url,$chat_id,$text); 
        }
    } else {
        // Update notification table with this user chat id and category
        $stmt = $db_connect->prepare("INSERT INTO notification (chat_id, category, notify) VALUES(:chat_id, :category, :notify)");
        $stmt->execute(array(':chat_id' => $chat_id, ':category' => $callback_data, ':notify' => 'Yes', ));
        // Save the chat id in notification table to start getting update on this category 
        $text = "You've subscribed to " .$callback_data. " vacancy alerts. You'll start getting update on any vacancy posted in this category, also you can click the category again to see if I have any vacancy. You are welcome!";
        subscribed($sendMessage_url,$chat_id,$text);
        
    }
} 
?>
