<?php

class SendSmsQuiz
{
    
    public function send_response($msisdn, $message)
    {
        $message = urlencode($message);//
        $url = "";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        
        $result = curl_exec($curl);
        
        curl_close($curl);
        return $result;
    }



    public function prepare_number($voter_number)
    {
        try{
            //first check if the number recieved in 233 format........
            $myNew_value = null;
            $voting_number ='';
            if(strlen($voter_number) > 10)
            {   
                //convert your string into array
                $array_num = str_split($voter_number);

                for($i = 3; $i <count($array_num) ; $i++)
                {        
                    $myNew_value .= $array_num[$i];
                }
                 
                $voting_number = '0'. $myNew_value;
            }else
            {
                $voting_number = $voter_number; 
            }

            return $voting_number;
        } catch (Exception $exc) {
            echo __LINE__ . $exc->getMessage();
        }
            
    }

 


    public function get_voter_value($user_input)
    {
       try{
            $myNew_value = null;
            //convert your string into array
            $array_num = str_split($user_input);

            for($i = 2; $i <count($array_num) ; $i++)
            {        
                $myNew_value .= $array_num[$i];
            }

            return trim($myNew_value);
        } catch (Exception $exc) {
           echo __LINE__ . $exc->getMessage();
        }
    }
}
?>
