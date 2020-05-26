<?php
$token = "1180159193:AAGmdFUATIfLWwy2jUiFWi5Anu-2aKRjz2w";
$sendPhoto_url = "https://api.telegram.org/bot$token/sendPhoto";
$chat_id = "770892840";


$text = "";
$text .= "<b><u>INTRODUCING NAIJA JOBS ARENA</u></b> \n";
$text .= "\n";
$text .= "Hello, \n"; 
$text .= "Naija Jobs Arena is a Telegram platform set up for the purpose of sharing #job #opportunities. \n
We aggregate the vacancies posted on major job portals and place them in your hand without you having to search the Internet for them, leveraging on Telegram Bot.\n
To start receiving our vacancies alerts, simply 'tap' this <a href='https://t.me/naijajobsarena_bot'>FOLLOW US</a> link, then on our Telegram bot, 'tap' START, and you are set.\n 
#VacanciesAtYourFingerTips #NaijaJobsArena";

function postAdverts($sendPhoto_url,$chat_id,$text) {
    $postfields = array(
        'chat_id' => $chat_id,
        'photo' => "https://www.callnect.com/images/welcome.jpeg",
        'caption' => $text,
        'parse_mode' => 'HTML'
);
if (!$curld = curl_init()) {
exit;
}

curl_setopt($curld, CURLOPT_POST, true);
curl_setopt($curld, CURLOPT_POSTFIELDS, $postfields);
curl_setopt($curld, CURLOPT_URL,$sendPhoto_url);
curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($curld);
    
if(curl_errno($curld)){
    echo 'Request Error:' . curl_error($curld);
} else {
    echo 'success';
}

curl_close ($curld);
}
postAdverts($sendPhoto_url,$chat_id,$text);
?>