<?php
$token = "905684105:AAEGtV8_rp-wjzpub40LucuaUJS4FLaQ_Uw";
$chat_id = "@jobsarena";
$messageType = "";
$sendMessage_url = "https://api.telegram.org/bot$token/sendMessage";
$sendPhoto_url = "https://api.telegram.org/bot$token/sendPhoto";
$sendPoll_url = "https://api.telegram.org/bot$token/sendPoll";
$sendVideo_url = "https://api.telegram.org/bot$token/sendVideo";
$sendAudio_url = "https://api.telegram.org/bot$token/sendAudio";

// Get message type from the database


// Fetch messages from database
if($messageType == "text") {
    $sql = "SELECT jobTitle, description, requirement, location, salary, companyName, datePosted FROM jobs WHERE messageType = :messageType";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':messageType', $messageType, PDO::PARAM_STR);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $jobTitle = $row['jobTitle'];
        $description = $row['description'];
        $requirement = $row['requirement'];
        $location = $row['location'];
        $salary = $row['salary'];
        $companyName = $row['companyName'];
        $datePosted = $row['datePosted'];
        }
} else if($messageType == "photo") {
    
} else if($messageType == "poll") {
    
} else if($messageType == "video") {
    
} else if($messageType == "audio") {
    
}








include("php_includes/mysqli_connect.php");
include("functions/telegram_functions.php");
$update = json_decode(file_get_contents("php://input"), TRUE);
$chat_id = isset($update["message"]["chat"]["id"]) ? $update["message"]["chat"]["id"] : "";
$message = isset($update["message"]["text"]) ? $update["message"]["text"] : "";
$callback_query = isset($update["callback_query"]) ? $update["callback_query"] : "";
$callback_data = isset($callback_query["data"]) ? $callback_query["data"] : "";
$token = "959364317:AAEjHrvMc4bjFj3aZozblHJRoQoewh7RFRc";
$sendInvoice_url = "https://api.telegram.org/bot$token/sendInvoice";
$sendMessage_url = "https://api.telegram.org/bot$token/sendMessage"; 
$provider_token = "710555963:TEST:91101619cfdea103ae49699a6867b40c"; 
$width = 90;
$height = 50;
$currency = "NGN";
$need_name = "True";
$need_phone_number = "True";
$need_email = "True";
$need_shipping_address = "True";
$is_flexible = "True";

$keyboard = array("inline_keyboard" => array(array(array("text" => "Start Shopping","callback_data" => "startshopping"))));
$contact_keyboard = array("keyboard" => array(array(array("text" => "Share Contact", "request_contact" => true))),"one_time_keyboard" => true, "resize_keyboard" => true);

if($message == "/start") {
    $text = "<b><u>Welcome To CallNect Market Place.</u></b> \n I would like to know you better in other to serve you well. Therefore, I would like to have your contact. \n Please press the <b>Share Contact</b> button bellow and that would be done. \n Thanks and welcome once again.";
    
    shareContact($sendMessage_url,$chat_id,$text,$contact_keyboard);
} else if($callback_data == "startshopping") {
    $chat_id = $callback_query["message"]["chat"]["id"];
    $text = "Select a category below:";
    
    // Fetch categories from the database and send to user 
    $sql = "SELECT category FROM categories";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $category[] = $row['category'];
    }
        $cat_keyboard = array("inline_keyboard" =>
        array(array(array("text" => isset($category[0]) ? $category[0] : "","callback_data" => isset($category[0]) ? $category[0] : "")),
        array(array("text" => isset($category[1]) ? $category[1] : "","callback_data" => isset($category[1]) ? $category[1] : "")),
        array(array("text" => isset($category[2]) ? $category[2] : "","callback_data" => isset($category[2]) ? $category[2] : "")),
        array(array("text" => isset($category[3]) ? $category[3] : "","callback_data" => isset($category[3]) ? $category[3] : "")),
        array(array("text" => isset($category[4]) ? $category[4] : "","callback_data" => isset($category[4]) ? $category[4] : "")),
        array(array("text" => isset($category[5]) ? $category[5] : "","callback_data" => isset($category[5]) ? $category[5] : "")),
        array(array("text" => isset($category[6]) ? $category[6] : "","callback_data" => isset($category[6]) ? $category[6] : "")),
        array(array("text" => isset($category[7]) ? $category[7] : "","callback_data" => isset($category[7]) ? $category[7] : "")),
        array(array("text" => isset($category[8]) ? $category[8] : "","callback_data" => isset($category[8]) ? $category[8] : "")),
        array(array("text" => isset($category[9]) ? $category[9] : "","callback_data" => isset($category[9]) ? $category[9] : "")),
        array(array("text" => isset($category[10]) ? $category[10] : "","callback_data" => isset($category[10]) ? $category[10] : "")),
        array(array("text" => isset($category[11]) ? $category[11] : "","callback_data" => isset($category[11]) ? $category[11] : "")),
        array(array("text" => isset($category[12]) ? $category[12] : "","callback_data" => isset($category[12]) ? $category[12] : "")),
        array(array("text" => isset($category[13]) ? $category[13] : "","callback_data" => isset($category[13]) ? $category[13] : "")),
        array(array("text" => isset($category[14]) ? $category[14] : "","callback_data" => isset($category[14]) ? $category[14] : "")),
        array(array("text" => isset($category[15]) ? $category[15] : "","callback_data" => isset($category[15]) ? $category[15] : "")),
        array(array("text" => isset($category[16]) ? $category[16] : "","callback_data" => isset($category[16]) ? $category[16] : "")),
        array(array("text" => isset($category[17]) ? $category[17] : "","callback_data" => isset($category[17]) ? $category[17] : "")),
        array(array("text" => isset($category[18]) ? $category[18] : "","callback_data" => isset($category[18]) ? $category[18] : "")),
        array(array("text" => isset($category[19]) ? $category[19] : "","callback_data" => isset($category[19]) ? $category[19] : "")),
        array(array("text" => isset($category[20]) ? $category[20] : "","callback_data" => isset($category[20]) ? $category[20] : "")),
        array(array("text" => isset($category[21]) ? $category[21] : "","callback_data" => isset($category[21]) ? $category[21] : "")),
        array(array("text" => isset($category[22]) ? $category[22] : "","callback_data" => isset($category[22]) ? $category[22] : ""))
        )); 
    
    
        showItems($sendMessage_url,$chat_id,$text,$cat_keyboard);

} else if(!empty($callback_data) && $callback_data != "startshopping") {
    $chat_id = $callback_query["message"]["chat"]["id"];
    $text = "I don't have any product listed under " .$callback_data. " category at the moment. You can introduce me to anyone selling this product or service. Share my link https://t.me/callnect_bot";
    // Find this category in the db and return the products
    $sql = "SELECT title, description, payload, start_parameter, price, imageUrl, website FROM listing WHERE category=:category";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':category', $callback_data, PDO::PARAM_STR);
    $stmt->execute();
    $numrows = $stmt->rowCount();
    if($numrows < 1) {
        // Send message to user and exit
        noproduct($sendMessage_url,$chat_id,$text);
        exit();
    } else {        
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $title = $row['title'];
            $description = $row['description'];
            $payload = $row['payload'];
            $start_parameter = $row['start_parameter'];
            $price = $row['price'];
            $photoUrl = $row['imageUrl'];
            $website = $row['website'];
            $LabeledPrice = array(array('label' => $title, 'amount' => str_replace(',', '', $price).'00'));
            $product_keyboard = array("inline_keyboard" => array(array(array("pay" => True,"text" => "Purchase"),array("text" => "Merchant Website","url" => $website))));
            sendInvoice($sendInvoice_url,$chat_id,$title,$description,$payload,$provider_token,$start_parameter,$currency,$LabeledPrice,$photoUrl,$product_keyboard,$height,$width,$need_name,$need_phone_number,$need_email,$need_shipping_address,$is_flexible);
        }
    }
    
} else if(!empty($chat_id)) {
    $text = "Press the button below to start shopping.";
    $notification = "I already have your contact!";
    // Check if the user detail is already in DB
    $sql = "SELECT id FROM buyer WHERE chat_id=:chat_id LIMIT 1";
    $stmt = $db_connect->prepare($sql);
    $stmt->bindParam(':chat_id', $chat_id, PDO::PARAM_STR);
    $stmt->execute();
    $numrows = $stmt->rowCount();
    if($numrows > 0) {
        // Send message to user and exit
        chatidExit($sendMessage_url,$chat_id,$notification);
        startShopping($sendMessage_url,$chat_id,$text,$keyboard);
        exit();
    }
    $user_phone = $update["message"]["contact"]["phone_number"];
    // Store phone and chat_id in the database
    $stmt = $db_connect->prepare( "INSERT INTO buyer (chat_id, phone_number, dateJoined) VALUES(:chat_id, :phone_number, now())");
    $stmt->execute(array(':chat_id' => $chat_id, ':phone_number' => $user_phone));
    // Send message to the user to start shopping
    startShopping($sendMessage_url,$chat_id,$text,$keyboard);
} 
?>
