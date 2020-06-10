<?php
class CardTransaction{
    // log card transactions...........
	public function log_transaction($contestant_name, $number_of_votes, $vpc_amount, $vpc_batch_no, $vpc_merchant, 
		$vpc_order_info,  $vpc_txn_code, $vpc_transaction_no, $vpc_response_code, $voter){

		$conn = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'di_asa');//

		

		$query_log_transaction = "INSERT INTO card_pay (`id`,`contestant_name`, `number_of_votes`, `vpc_amount`, `vpc_batch_no`,
		`vpc_merchant`, `vpc_order_info`, `vpc_transaction_no`, `vpc_txn_code`,  `vpc_message`, `vpc_response_code`, `voter_number`) VALUES(null, '".$contestant_name."', '".$number_of_votes."', '".$vpc_amount."', '".$vpc_batch_no."', '".$vpc_merchant."', '".$vpc_order_info."', '".$vpc_transaction_no."', '".$vpc_txn_code."',  'pending transaction', '".$vpc_response_code."', '".$voter."')";     
        mysqli_query($conn, $query_log_transaction);
	}

	#prompt the user of the out come.........
    public function send_sms_response($user_number, $message)
    {
        try 
        {
            $myNew_value = null;
            $raw_number  ='';
            if(strlen($user_number) == 10)
            {   //convert your string into array
                $array_num = str_split($user_number);

                for($i = 1; $i <count($array_num) ; $i++)
                {        
                    $myNew_value .= $array_num[$i];
                }
                 
                $raw_number = '233'. $myNew_value;

            }else
            {
                $raw_number = $user_number; 
            }
            
            $msisdn = $raw_number;//var_dump($msisdn);
            $message = urlencode($message);//200.2.168.175:2199 
            $url = "http://54.163.215.114:2788/Receiver?User=mycloudhttp&Pass=M1C2T3&From=1422&To=$msisdn&Text=$message";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));
           
            $result = curl_exec($curl);
            $error = curl_error($curl);

            if ($error) {
                echo "There was an: ". $error;
            } else{
                //var_dump($result);
            }
            // echo json_encode($result);
            curl_close($curl);
            return $result;

        }catch (Exception $exc) 
        {
            
        }
    }

}
?>