<?php
include("php_includes/mysqli_naijajobs_connect.php");
include("functions/telegramBotsFunctions.php");
include("functions/recordCategoryClicks.php");
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
$sendPhoto_url = "https://api.telegram.org/bot$token/sendPhoto";
$jobcat_keyboard = array("inline_keyboard" => array(array(array("text" => "Job Categories","callback_data" => "jobcategories"))));  
        

if($message == "/start") {
    $text = "I'm a bot that helps in providing you with job vacancies. With me, you don't need to search for vacancies anymore, as I always place them on your palm. \n To start, click on the #Job#Categories button below to see the list of categories, select any category you'll like to receive vacancy alerts from me - You can select as many as you like. Every click on any category returns #10 most recent vacancies posted within the last 1 week in that #category. You can #repeatedly click on #same category in other to see more list of that category. \n I also send #frequent vacancy's alerts on your selected categories so that you don't miss any #job opportunity";
    
    // Check if user chat id is in the db, if not store it
    $sql = "SELECT COUNT(id) FROM telegram_users WHERE chat_id = :chat_id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':chat_id', $chat_id, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->fetchColumn() < 1) {
        // Store it in the db
        $stmt = $db_connect->prepare( "INSERT INTO telegram_users (chat_id, Firstname, Lastname, Username, dateJoined) VALUES(:chat_id, :Firstname, :Lastname, :Username, now())");
        $stmt->execute(array(':chat_id' => $chat_id, ':Firstname' => $firstname, ':Lastname' => $lastname, ':Username' => $telegramUsername));
    }
     
    welcomeMessage($sendPhoto_url,$chat_id,$text,$jobcat_keyboard);
} else if($callback_data == "Frequently Asked Question(FAQ)") {
    //Write the code here...
    faq($sendMessage_url,$chat_id,$text,$jobcat_keyboard);
} else if($callback_data == "jobcategories") {
    $chat_id = $callback_query["message"]["chat"]["id"];
    $text = "Select a category below:";
    $cat_array = array("Agriculture, Food and Natural Resources", "Architecture and Construction", "Arts, Audio/Video Technology and Communications", "Business Management and Administration", "Education and Training", "Banking, Finance", "Health Science", "Hospitality and Tourism", "Human Services", "Information Technology", "Law, Public Safety, Corrections and Security", "Manufacturing", "Marketing, Sales and Service", "Science, Technology, Engineering", "Transportation, Distribution and Logistics", "Others", "Frequently Asked Question(FAQ)");
    
    
    // Fetch categories from the database and send to user 
    $sql = "SELECT category, dbCategory FROM job_categories";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $category[] = $row['category'];
        $dbcategory[] = $row['dbCategory'];
        }
        // Get the count of category id 3 
        $sql = "SELECT COUNT(id) FROM jobslisting WHERE dbCategory = :category AND (datePosted > NOW() -INTERVAL 1 WEEK)";
        $stmt = $db_connect->prepare($sql);
        for ($x = 0; $x <= 15; $x++) {
        $stmt->bindParam(':category', $cat_array[$x], PDO::PARAM_STR);
        $stmt->execute();
        foreach($stmt->fetchAll() as $row) {
          $count[] = $row['0'];
            }
          }
        $cat_keyboard = array("inline_keyboard" =>
        array(array(array("text" => isset($category[0]) ? $category[0]. ' ' .$count[0] : "","callback_data" => isset($category[0]) ? $category[0] : "")),
        array(array("text" => isset($category[1]) ? $category[1]. ' ' .$count[1] : "","callback_data" => isset($category[1]) ? $category[1] : "")),
        array(array("text" => isset($category[2]) ? $category[2]. ' ' .$count[2] : "","callback_data" => isset($category[2]) ? $category[2] : "")),
        array(array("text" => isset($category[3]) ? $category[3]. ' ' .$count[3] : "","callback_data" => isset($category[3]) ? $category[3] : "")),
        array(array("text" => isset($category[4]) ? $category[4]. ' ' .$count[4] : "","callback_data" => isset($category[4]) ? $category[4] : "")),
        array(array("text" => isset($category[5]) ? $category[5]. ' ' .$count[5] : "","callback_data" => isset($category[5]) ? $category[5] : "")),
        array(array("text" => isset($category[6]) ? $category[6]. ' ' .$count[6] : "","callback_data" => isset($category[6]) ? $category[6] : "")),
        array(array("text" => isset($category[7]) ? $category[7]. ' ' .$count[7] : "","callback_data" => isset($category[7]) ? $category[7] : "")),
        array(array("text" => isset($category[8]) ? $category[8]. ' ' .$count[8] : "","callback_data" => isset($category[8]) ? $category[8] : "")),
        array(array("text" => isset($category[9]) ? $category[9]. ' ' .$count[9] : "","callback_data" => isset($category[9]) ? $category[9] : "")),
        array(array("text" => isset($category[10]) ? $category[10]. ' ' .$count[10] : "","callback_data" => isset($category[10]) ? $category[10] : "")),
        array(array("text" => isset($category[11]) ? $category[11]. ' ' .$count[11] : "","callback_data" => isset($category[11]) ? $category[11] : "")),
        array(array("text" => isset($category[12]) ? $category[12]. ' ' .$count[12] : "","callback_data" => isset($category[12]) ? $category[12] : "")),
        array(array("text" => isset($category[13]) ? $category[13]. ' ' .$count[13] : "","callback_data" => isset($category[13]) ? $category[13] : "")),
        array(array("text" => isset($category[14]) ? $category[14]. ' ' .$count[14] : "","callback_data" => isset($category[14]) ? $category[14] : "")),
        array(array("text" => isset($category[15]) ? $category[15]. ' ' .$count[15] : "","callback_data" => isset($category[15]) ? $category[15] : "")),
        array(array("text" => isset($category[16]) ? $category[16] : "","callback_data" => isset($category[16]) ? $category[16] : ""))
        )); 
  
    
    
        showCategories($sendMessage_url,$chat_id,$text,$cat_keyboard);

} else if(isset($callback_data) && !empty($callback_data) && $callback_data != "jobcategories") {
    $chat_id = $callback_query["message"]["chat"]["id"];
    //Call a function that records the number of click on this particular category 
    recordCategoryClicks($callback_data,$chat_id);
    
    // Check if user has any category in notification 
    $sql = "SELECT id FROM notification WHERE category = :category AND chat_id = :chat_id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':category', $callback_data, PDO::PARAM_STR);
    $stmt->bindParam(':chat_id', $chat_id, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
    
    $sql = "SELECT jobslisting.id, job_title, company_desc, job_responsibility, qualification_skill, education_requirement, benefit, location, jobslisting.hash, howtoapply, salary, datePosted, users.company, users.about FROM jobslisting INNER JOIN users ON users.username = jobslisting.username WHERE (jobslisting.dbCategory = :category AND jobslisting.approval = :approval AND jobslisting.datePosted > NOW() -INTERVAL 1 WEEK) ORDER BY RAND() LIMIT 5";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':category', $callback_data, PDO::PARAM_STR);
    $stmt->bindValue(':approval', 'Yes', PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
     //$text = "";
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
        $text .= "<b>#Job #Title:</b>";
        $text .= "\n";
        $text .=  $jobTitle;
        $text .= "\n";
    if(isset($comp_description) && !empty($comp_description)){
    $text .= '<b>#About #Us:</b>';
    $text .= "\n";
    $text .=  $comp_description;
    } else {
        $text .= '<b>#About #Us:</b>';
        $text .= "\n";
        $text .=  $about;
    }
    $text .= "\n";
    if(isset($job_desc) && !empty($job_desc)) {
    $text .= '<b>#Job #Description:</b>';
    $text .= "\n";
    $text .=  $job_desc;
    $text .= "\n";
    }
    if(isset($skill_reqmt) && !empty($skill_reqmt)) {
    $text .= '<b>#Other #Skills:</b>';
    $text .= "\n";
    $text .=  $skill_reqmt;
    $text .= "\n";
    }
    if(isset($edu_reqmt) && !empty($edu_reqmt)) {
    $text .= '<b>#Educational #Requirement:</b>';
    $text .= "\n";
    $text .=  $edu_reqmt;
    $text .= "\n";
    }
    $text .= '<b>#Job #Location:</b>';
    $text .= "\n";
    $text .=  $location;
    $text .= "\n";
    if(isset($benefit) && !empty($benefit)) {
    $text .= '<b>#Other #Benefits:</b>';
    $text .= "\n";
    $text .=  $benefit;
    $text .= "\n";
    }
    if(isset($salary) && !empty($salary)) {
    $text .= '<b>#Renumeration:</b>';
    $text .= "\n";
    $text .=  $salary;
    $text .= "\n";
    }
    $text .= '<b>#To #Apply:</b>';
    $text .= "\n";
    if(filter_var('http://'.$howtoapply, FILTER_VALIDATE_URL)) {
    $text .= ' Visit our website: ' .$howtoapply;
    $text .= "\n";
    } else {
    $text .= $howtoapply;
    $text .= "\n"; 
    }
    $text .= '<b>#Date #Posted:</b>';
    $text .= "\n";
    $text .=  $datePosted;
    $text .= "\n";
    $text .= "\n";
    $text .= "##########################";
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

