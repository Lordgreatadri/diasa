<?php

class SendSms
{
    
   public function send_response($msisdn, $message)
    {
        $message = urlencode($message);
        $url = "";
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
