<?php

$to = "chauhanajay1117@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: firebase435@gmail.com" . "\r\n" .
"CC: chauhanajay1117@gmail.com";

$send= mail($to,$subject,$txt,$headers);
 if ($send==true) 
 {
     echo "mail send";
 }
 else
 {
    echo "not send";
 }
?>


