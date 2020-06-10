<?php


class HubtelPaymentProcessor
{

	// mtn,airteltigo payment
	public function process_momo_request($channel, $number, $amount, $nominee_name, $contestant_id)
	{
		$receive_momo_request = array(
          'CustomerName' => 'DIASA',
		  'CustomerMsisdn'=> $number,
		  'CustomerEmail'=> 'support@mobilecontent.com.gh',
		  'Channel'=> $channel,
		  'Amount'=> $amount,//0.01, // 
		  'PrimaryCallbackUrl'=> 'http://mysmsinbox.com/di_asa/online/disasa_web_endpoint_callback.php', 
		  //'http://54.224.225.219/ekb/ussd/.php',
		  'Description'=> 'diasa web votes',
		  'ClientReference'=> 'DIASA_WEB',
		);


		//API Keys

		$clientId = 'nQjNGkw';
		$clientSecret = '553548c3-c96d-4cb5-a81c-7e354dff845c';
		$basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
		$request_url = 'https://api.hubtel.com/v1/merchantaccount/merchants/HM0102180009/receive/mobilemoney';
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
		file_put_contents('log/hubtel_APIdata.log', print_r("phone: ".$number.', nominee= '.$nominee_name.', amount= '. $amount.', channel= '.$channel, true));


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

			// $database = new mysqli('127.0.0.1', 'root', 'FAg8(3P^tJVnBDsF%F', 'miss_gh');//Bim32!@b)omiss_gh_mobile
			$database = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'di_asa');
			
			$vote_count = 0;      
		    if($amount == 1.2)
		    {
		        $vote_count   = 2;
		    }elseif($amount == 12)
		    {
		        $vote_count   = 20;
		    }elseif($amount == 6)
		    {
		        $vote_count   = 10;
		    }elseif($amount == 30)
		    {
		        $vote_count   = 50;
		    }elseif($amount == 60)
		    {
		        $vote_count   = 100;
		    }elseif($amount == 120)
		    {
		        $vote_count   = 200;  
		    }elseif($amount == 300) 
		    {
		        $vote_count   = 500;
		    }elseif($amount == 600) 
		    {
		        $vote_count   = 1000;
		    }

			$json = json_decode($result, true);

			$response_code = $json['ResponseCode'];//['ResponseCode'];

			$query = "INSERT INTO temp_monitor_online_payment(`transaction_id`, `contestant_code`, `contestant_name`, `phone_number`, `channel_type`, `amount`, `response_code`) VALUES('".$json['Data']['TransactionId']."', '".$contestant_id."', '".$nominee_name."', '".$number."', '".$channel."', '".$amount."', '".$response_code."' )";			 
            $track_pay = $database->query($query);

            $when = date("Y-m-d H:i:s");
            $query1 = "INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `number_of_votes`, `amount`, `when`) VALUES('".$json['Data']['TransactionId']."', 'web', '".$nominee_name."', '".$number."', '".$channel."', '".$vote_count."', '".$amount."', '".$when."' )";			 
            $track_pay1 = $database->query($query1);
			echo $result;
		}

		mysqli_close($database);
	}

	// vodafone cash payment
	public function process_voda_cash_request($channel, $number, $amount, $nominee_name, $contestant_id)//, $token
	{
		$receive_momo_request = array(
          'CustomerName' => 'DIASA',
		  'CustomerMsisdn'=> $number,
		  'CustomerEmail'=> 'support@mobilecontent.com.gh',
		  'Channel'=> $channel,
		  'Amount'=> $amount,
		  'PrimaryCallbackUrl'=> 'http://mysmsinbox.com/di_asa/online/disasa_web_endpoint_callback.php',
		  //'http://54.224.225.219/ekb/ussd/.php', 
		  // 'Token'=> $token,
		  'Description'=> 'diasa online votes',
		  'ClientReference'=> 'DIASA_WEB',
		);

		//API Keys

		$clientId = 'nQjNGkw';
		$clientSecret = '553548c3-c96d-4cb5-a81c-7e354dff845c';
		$basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
		$request_url = 'https://api.hubtel.com/v1/merchantaccount/merchants/HM0102180009/receive/mobilemoney';
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
			$database = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'di_asa');

			$vote_count = 0;      
		    if($amount == 1.2)
		    {
		        $vote_count   = 2;
		    }elseif($amount == 12)
		    {
		        $vote_count   = 20;
		    }elseif($amount == 6)
		    {
		        $vote_count   = 10;
		    }elseif($amount == 30)
		    {
		        $vote_count   = 50;
		    }elseif($amount == 60)
		    {
		        $vote_count   = 100;
		    }elseif($amount == 120)
		    {
		        $vote_count   = 200;  
		    }elseif($amount == 300) 
		    {
		        $vote_count   = 500;
		    }elseif($amount == 600) 
		    {
		        $vote_count   = 1000;
		    }        

			$json = json_decode($result, true);

			$response_code = $json['ResponseCode'];//['ResponseCode'];

			$query = "INSERT INTO temp_monitor_online_payment(`transaction_id`, `contestant_code`, `contestant_name`, `phone_number`, `channel_type`, `amount`, `response_code`) VALUES('".$json['Data']['TransactionId']."', '".$contestant_id."', '".$nominee_name."', '".$number."', '".$channel."', '".$amount."', '".$response_code."' )";
            $track_pay = $database->query($query);


            $when = date("Y-m-d H:i:s");
            $query1 = "INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `number_of_votes`, `amount`, `when`) VALUES('".$json['Data']['TransactionId']."', 'web', '".$nominee_name."', '".$number."', '".$channel."', '".$vote_count."', '".$amount."', '".$when."' )";			 
            $track_pay1 = $database->query($query1);

			echo $result;
		}

		mysqli_close($database);
	}



	
}
?>