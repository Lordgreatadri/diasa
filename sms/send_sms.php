<?php

class SendSms
{
    
   public function send_response($msisdn, $message)
    {
        $message = urlencode($message);
        $url = "http://54.163.215.114:2776/Receiver?User=shscheck&Pass=place12ment&From=1400&To=$msisdn&Text=$message";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        
        $result = curl_exec($curl);

        var_dump($result);
        
        curl_close($curl);
        restun $result;
    }
}
?>
