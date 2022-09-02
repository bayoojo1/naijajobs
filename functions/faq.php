<?php
// Get the count of total users 
include("../php_includes/mysqli_naijajobs_connect.php");
$sql = "SELECT COUNT(id) FROM telegram_users";
$stmt = $db_connect->prepare($sql);
$stmt->execute();
$user_count = $stmt->rowCount();

$text = "
<p><strong>1. WHAT IS THE PURPOSE OF NAIJA JOBS ARENA?</strong></p>
<p><strong>Ans:</strong> <em>Naija Jobs Arena is a job aggregator that uses Telegram messaging application to alert job seekers about various vacancies from different job portals within Nigeria.</em></p>
<p><strong>2. IS NAIJA JOBS ARENA FREE TO US?</strong></p>
<p><strong>Ans:</strong> <em>Absolutely free!</em></p>
<p><strong>3. HOW CAN I POST JOBS ON NAIJA JOBS ARENA?</strong></p>
<p><strong>Ans:</strong> <em>Naija Jobs Arena platform would soon be opened for all to post jobs. For now, jobs are being posted by Naija Jobs Arena bot. You can also get back to us via the contact us button if you really want to start posting vacancies on the platform.</em></p>
<p><strong>4. HOW DO I CHECK VACANCY ON NAIJA JOBS ARENA?</strong></p>
<p><strong>Ans:</strong> <em>Once you have added our bot in your Telegram app, click on Job_Categories to see the list of available categories. You will see the number of available vacancies in front of each category, e.g. Information Technology 2. This indicates that we have 2 vacancies in Information Technology category. You will need to select your job category options - note that you can select as many as possible. You can always tap on your choice category at any time to see available jobs. Our bot also alerts you of any new posted job based on your category selection.</em></p>
<p><strong>5. HOW MANY USERS DO YOU HAVE ON NAIJA JOBS ARENA PLATFORM?</strong></p>
<p><strong>Ans:</strong> <em>We currently have $user_count as at the time you are checking this. You might see an increase next time you check back.</em></p>
<p><strong>6. WHAT HAPPEN IF I DELETE NAIJA JOBS ARENA BOT?</strong></p>
<p><strong>Ans:</strong> <em>You can always add the bot back whenever you like. But for you to have access to all the features, you need to just send message <strong>/start</strong> to the bot and then you are back!</em></p>
<p><strong>7. HOW AUTHENTIC ARE THE VACANCIES POSTED ON NAIJA JOBS ARENA?</strong></p>
<p><strong>Ans:</strong> <em>Naija Jobs Arena is currently a job aggregator that post vacancies from several job portals. We try as much as possible to vet any vacancy before allowing it to be posted by our bot, we cannot vouch for any posted vacancy beyond that.&nbsp;</em></p>
<p><strong>8. HOW DO I REPORT A POSTED JOB?</strong></p>
<p><strong>Ans:</strong> <em>Below every posted vacancy is a button that can allow you to do that. Tap on the button and it would redirect you to where you can report that particular job.</em></p>";

function faq($sendMessage_url,$chat_id,$text,$jobcat_keyboard) {
    $postfields = array(
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode($jobcat_keyboard)
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
?>