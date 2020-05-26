<?php
$token = "905684105:AAEGtV8_rp-wjzpub40LucuaUJS4FLaQ_Uw";
$sendMessage_url = "https://api.telegram.org/bot$token/sendMessage";
$chat_id = "@naijajobsarena";


$text = "";
$text .= "<b><u>MAKING NAIJA JOBS ARENA BETTER!</u></b> \n";
$text .= "\n";
$text .= "Hello everyone, \n"; 
$text .= "In our effort to provide flexible and effective job update platform for our subscribers, we are moving this platform to a more robust Telegram bot to handle the the vacancies alert in a more efficient way. \n
The new platform still bears the same name, Naija Jobs Arena, but with a slightly different link: https://t.me/naijajobsarena_bot \n
Please <a href='https://t.me/naijajobsarena_bot'>SUBSCRIBE HERE</a> to the new bot if you still want to continue receiving vacancy alerts from Naija Jobs Arena, as we are stopping vacancy alerts on this current channel henceforth. \n
Thanks for your understanding. \n
#BetterService #EfficientAlert";

function postInfo($sendMessage_url,$chat_id,$text) {
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
postInfo($sendMessage_url,$chat_id,$text);
?>