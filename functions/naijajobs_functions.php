<?php
function postjob($sendMessage_url,$chat_id,$text,$keyboard) {
    $postfields = array(
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML'
);
if (!$curld = curl_init()) {
exit;
}

curl_setopt($curld, CURLOPT_POST, true);
curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
curl_setopt($curld, CURLOPT_URL,$sendMessage_url);
curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curld);
    
if(curl_errno($curld)){
    echo 'Request Error:' . curl_error($curld);
} else {
    echo 'success';
}

curl_close ($curld);
}


function welcomeMessage($sendPhoto_url,$chat_id,$text,$jobcat_keyboard) {
    $postfields = array(
        'chat_id' => $chat_id,
        'photo' => new CURLFile(realpath("https://www.callnect.com/images/welcome.jpeg")),
        'caption' => $text,
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode($jobcat_keyboard)      
        
);
if (!$curld = curl_init()) {
exit;
}
curl_setopt($curld, CURLOPT_HTTPHEADER, array(
    "Content-Type:multipart/form-data"
));
curl_setopt($curld, CURLOPT_POST, true);
curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
curl_setopt($curld, CURLOPT_URL,$sendPhoto_url);
curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curld);
    
curl_close ($curld);
}
?>