<?php
$apiToken = $apiToken = "905684105:AAEGtV8_rp-wjzpub40LucuaUJS4FLaQ_Uw";
$options =  array("Yemi Osinbajo","Aba Kyari","Goodluck Jonathan", "Gbajabiamila") ;

$data = ['chat_id' => '@jobsarena',   'question' => 'What is the name of Nigeria Vice President ?',  'options' => json_encode($options), 'is_anonymous' => 'No' ];

$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendPoll?" . http_build_query($data) );
?>

