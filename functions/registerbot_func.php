<?php
if(isset($_POST["token"])){
    $token = $_POST["token"];
    $url = $_POST["url"];
    $port = $_POST["port"];
    $conn = $_POST["conn"];
}

$ch = curl_init();
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //"Content-Type:multipart/form-data"
//));
  curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/setwebhook");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  $post = array(
      'url' => $url,
      'port' => $port,
      'max_connections' => $conn,
      //'certificate' => new CURLFile(realpath("/var/www/naijajobs/html/callnect_godaddy.pem")),
  );
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

  $result = curl_exec($ch);
  if($result === false)
  {
      echo "Error Number:".curl_errno($ch)."<br>";
      echo "Error String:".curl_error($ch);
  } else {
    echo $result;
  }
  curl_close($ch);
?>