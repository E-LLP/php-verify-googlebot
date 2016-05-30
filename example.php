<?php
require_once __DIR__.'/VerifyGoogleBot.class.php';
$google_ip='66.249.66.1';
$verify=New VerifyGoogleBot();
var_dump($verify->isGoogleIP($google_ip));