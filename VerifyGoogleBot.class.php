<?php
/**
* Verify Googlebot for Real!
* @author Miraz Mac <mirazmac@gmail.com>
* @version 1.0
* @link http://mirazmac.info
* @license LICENSE The MIT License
*/
class VerifyGoogleBot
{

    /**
     * Detects if client is Google Bot( really :D )
     * @return boolean
     */
    public function isGoogleBot($ip='')
    {
        /** If IP is assigned manually we will skip user-agent verification */
        if($ip):
            return $this->isGoogleIP($ip);
        endif;
        /** No IP assigned manually! */
        if($this->isGoogleUa() && $this->isGoogleIP($this->getClientIP()))
            return true;
        else
            return false;

    }

    /**
     * Function to check if IP is a valid Google Bot IP
     * @param  string  $ip A valid IP address
     * @return boolean
     */
    public function isGoogleIP($ip)
    {
        $status=false;
        if(!filter_var($ip, FILTER_VALIDATE_IP))
            return $status;
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
            $user_agent=$_SERVER['HTTP_USER_AGENT'];
        $user_agent=mb_strtolower($user_agent);
        
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
        $ip='127.0.0.1';
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
