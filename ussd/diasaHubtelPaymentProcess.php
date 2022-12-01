<?php


class HubtelPaymentProcessor
{

	// other networks 
	public function process_momo_request($channel, $number, $amount, $nominee_name, $contestant_id)
	{
		$receive_momo_request = array(
          'CustomerName' => '',
		  'CustomerMsisdn'=> $number,
		  'CustomerEmail'=> 'support@mobilecontent.com.gh',
		  'Channel'=> $channel,
		  'Amount'=> $amount,//0.01, // 
		  'PrimaryCallbackUrl'=> '', 
		 
		  'Description'=> 'diasa ussd votes',
		  'ClientReference'=> 'DIASA_USSD',
		);


		//API Keys

		$clientId = '';
		$clientSecret = '';
		$basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
		$request_url = '';
		$receive_momo_request = json_encode($receive_momo_request);

		$ch =  curl_init($request_url);  
				curl_setopt( $ch, CURLOPT_POST, true );  
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $receive_momo_request);  
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
				    'Authorization: '.$basic_auth_key,
				    'Cache-Control: no-cache',
				    'Content-Type: application/json',
				  ));

		$result = curl_exec($ch); 
		$err = curl_error($ch);
		curl_close($ch);

		file_put_contents('log/hubtel_API.log', print_r("result: ".$result, true));

		if($err)
		{
			echo $err;

			$createdTime = date("Y-m-d");
		    $file        = fopen("log/hutel_error-$createdTime.log", 'a');
		    $request_log = "{Description: $err},.\n";
		    fwrite($file, "$request_log");
		    fclose($file);
		}else
		{

			// $database = new mysqli('127.0.0.1', 'root', '', 'miss_gh');//
			$database = new mysqli('localhost', 'root', '', 'di_asa');
			
			$json = json_decode($result, true);

			$response_code = $json['ResponseCode'];//['ResponseCode'];

			$query = "INSERT INTO temp_monitor_payment(`transaction_id`, `contestant_code`, `contestant_name`, `phone_number`, `channel_type`, `amount`, `response_code`) VALUES('".$json['Data']['TransactionId']."', '".$contestant_id."', '".$nominee_name."', '".$number."', '".$channel."', '".$amount."', '".$response_code."' )";			 
            $track_pay = $database->query($query);

            $when = date("Y-m-d H:i:s");
            $query1 = "INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `amount`, `when`) VALUES('".$json['Data']['TransactionId']."', 'ussd', '".$nominee_name."', '".$number."', '".$channel."', '".$amount."', '".$when."' )";			 
            $track_pay1 = $database->query($query1);

           //  file_put_contents('log/save_monitor_query.log', print_r($query, true));
          	// file_put_contents('log/monitor_saved.log', print_r($track_pay, true));

			echo $result;
		}

		mysqli_close($database);
	}


	// vodafone cash
	public function process_voda_cash_request($channel, $number, $amount, $nominee_name, $contestant_id)
	{
		$receive_momo_request = array(
          'CustomerName' => 'DIASA',
		  'CustomerMsisdn'=> $number,
		  'CustomerEmail'=> 'support@mobilecontent.com.gh',
		  'Channel'=> $channel,
		  'Amount'=> $amount,
		  'PrimaryCallbackUrl'=> '', 
		  // 'Token'=> $token,
		  'Description'=> 'diasa ussd votes',
		  'ClientReference'=> 'DIASA_USSD',
		);

		//API Keys

		$clientId = '';
		$clientSecret = '';
		$basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
		$request_url = '';
		$receive_momo_request = json_encode($receive_momo_request);

		$ch =  curl_init($request_url);  
				curl_setopt( $ch, CURLOPT_POST, true );  
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $receive_momo_request);  
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
				    'Authorization: '.$basic_auth_key,
				    'Cache-Control: no-cache',
				    'Content-Type: application/json',
				  ));

		$result = curl_exec($ch); 
		$err = curl_error($ch);
		curl_close($ch);

		if($err)
		{
			echo $err;

			$createdTime = date("Y-m-d");
		    $file        = fopen("log/hutel_voda_error-$createdTime.log", 'a');
		    $request_log = "{Description: $err},.\n";
		    fwrite($file, "$request_log");
		    fclose($file);
		}else{
			$database = new mysqli('localhost', 'root', '', 'di_asa');

			$json = json_decode($result, true);

			$response_code = $json['ResponseCode'];//['ResponseCode'];

			$query = "INSERT INTO temp_monitor_payment(`transaction_id`, `contestant_code`, `contestant_name`, `phone_number`, `channel_type`, `amount`, `response_code`) VALUES('".$json['Data']['TransactionId']."', '".$contestant_id."', '".$nominee_name."', '".$number."', '".$channel."', '".$amount."', '".$response_code."' )";
            $track_pay = $database->query($query);


            $when = date("Y-m-d H:i:s");
            $query1 = "INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `amount`, `when`) VALUES('".$json['Data']['TransactionId']."', 'ussd', '".$nominee_name."', '".$number."', '".$channel."', '".$amount."', '".$when."' )";			 
            $track_pay1 = $database->query($query1);

			echo $result;
		}

		mysqli_close($database);
	}
	
}
?>
