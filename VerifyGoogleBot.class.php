<?php
error_reporting('-1');
/**
* Verify Googlebot for Real!
* @author Miraz Mac <mirazmac@gmail.com>
* @version 1.0
* @link http://mirazmac.info
* @license LICENSE The MIT License
*/
class VerifyGoogleBot
{
    /** @var string The client IP Address */
    private $CLIENT_IP;

    /**
     * Construct the class
     * @param string $client_ip A valid IP Address in case you wanna check an ip manually
     */
    function __construct($client_ip='')
    {
        /** Assign the user provided ip */
        if($client_ip){
            if(filter_var($client_ip, FILTER_VALIDATE_IP))
                $this->CLIENT_IP=$client_ip;
            else
                throw new Exception("PHP Verify Googlebot requires a valid IP Address!", 1);
        }
    }

    public function isGoogle()
    {
        if(isset($this->CLIENT_IP)):
            return $this->isGoogleIP($this->CLIENT_IP);
        endif;
        /** No IP assigned manually! */
        
    }

    public function isGoogleIP($ip)
    {
        if(!filter_var($ip, FILTER_VALIDATE_IP))
            throw new Exception("Please provide a valid IP Address!", 1);
        $status=false;
        $hostname = gethostbyaddr($ip);

        /** Checking if the host matches with Google */
        if(preg_match('/\.googlebot|google\.com$/i', $hostname)){
            $hosts = gethostbynamel($hostname);

            /** But We will run some additional checks! */
            foreach ($hosts as $host) {
                if($host == $ip)
                    $status=true;
            }
        }
        return $status;
    }

    /**
     * Detect if the useragent is Google Bot
     * @param  string  $user_agent The user agent to check (optional)
     * @return boolean
     */
    public function isGoogleUa($user_agent='')
    {
        $status=false;
        if(empty($user_agent))
            $user_agent=mb_strtolower($_SERVER['HTTP_USER_AGENT']);

        /** Not so robust but works anyway! */
        if(preg_match('#googlebot#', $user_agent))
            $status=true;
        return $status;
    }

    /**
     * Get the client's IP Address
     * @return string
     */
    public function getClientIP()
    {
        $ip='';
        if(!empty($_SERVER['HTTP_CLIENT_IP'])):
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        else:
            $ip=$_SERVER['REMOTE_ADDR'];
        endif;
        return $ip;
    }
}
