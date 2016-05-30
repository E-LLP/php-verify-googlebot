# PHP Verify Googlebot
A simple class to verify GoogleBot. Detect GoogleBot for real!
### Example

```php
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

```

#### Available Pubic Methods

```php
// Detects if an IP is Google Bot's Ip
$ip='66.249.66.1';
$verify->isGoogleIP($ip);

// Detect Google Bot by useragent (if empty current ua will be used)
$useragent=$_SERVER['HTTP_USER_AGENT']
$verify->isGoogleIP($useragent);

// Get current user IP
echo $verify->getClientIP();

```

