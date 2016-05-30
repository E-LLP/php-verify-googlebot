<?php
require_once __DIR__.'/VerifyGoogleBot.class.php';
$verify=New VerifyGoogleBot();

// Example with A manually assigned IP
$google_ip='66.249.66.1'; // Real Google Bot IP

if($verify->isGoogleBot($google_ip)){
    echo 'Yap! This is real Google Bot IP!';
}
else{
    echo 'Nope! This IP isn\'t real!!';
}

echo '<hr/>';

// Example to check if current user is Really GoogleBot

if($verify->isGoogleBot()){
    echo 'The client is really a Google Bot! :)';
}
else{
    echo 'Nope! This client is just a simple user :/';
}
