<?php
include("../php_includes/mysqli_connect.php");
$token = "1180159193:AAGmdFUATIfLWwy2jUiFWi5Anu-2aKRjz2w";
$sendPhoto_Url = "https://api.telegram.org/bot$token/sendPhoto";
$jobcat_keyboard = array("inline_keyboard" => array(array(array("text" => "Job Categories","callback_data" => "jobcategories")))); 
//Get parameter sent by Ajax
if(isset($_POST['filepath'])){
    $filepath = preg_replace('#[^-a-z0-9:.\/]#i', '', $_POST['filepath']);
    $chatid = preg_replace('#[^0-9,]#i', '', $_POST['chatid']);
    $caption = $_POST['caption'];
}
if(isset($chatid) && !empty($chatid)) {
    $array = explode(',', $chatid); // split chat id into array at comma
    //Initiate curl 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));  
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL,$sendPhoto_Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    foreach($array as $ct) {
      $post = array(
          'chat_id' => $ct,
          'photo' => new CURLFile(realpath("$filepath")),
          'caption' => $caption,
          'parse_mode' => 'HTML',
          'reply_markup' => json_encode($jobcat_keyboard)
      );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

      $result = curl_exec($ch);     

  if(curl_errno($ch)){
    echo 'Request Error:' . curl_error($ch);
} else {
    echo 'success';
  }
}
curl_close($ch);   
} else {
    //Get chat id from database
    $sql = "SELECT chat_id FROM telegram_users";
    $stmt = $db_connect->prepare($sql);
    $stmt->execute();
    foreach($stmt->fetchAll() as $row) {
    $chat_id = $row['0'];
        //Initiate curl 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL,$sendPhoto_Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $post = array(
          'chat_id' => $chat_id,
          'photo' => new CURLFile(realpath("$filepath")),
          'caption' => $caption,
          'parse_mode' => 'HTML',
          'reply_markup' => json_encode($jobcat_keyboard)
      );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

      $result = curl_exec($ch);     

  if(curl_errno($ch)){
    echo 'Request Error:' . curl_error($ch);
} else {
    echo 'success';
  }
}
curl_close($ch);   
}
?>