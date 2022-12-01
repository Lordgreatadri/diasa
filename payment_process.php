<?php 
	error_reporting(0);
	include_once 'diasaHubtelPaymentProcess.php';
	include_once 'Send_sms_response.php';


	$payment_Obj = new HubtelPaymentProcessor();

	$database = new mysqli('localhost', 'root', '', 'di_asa');

	function get_channel_type($voter_number) 
	{
		try 
		{
			//first check if the number recieved in 233 format........
			$myNew_value=null;
			$voting_number ='';//count($striped_num)
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


			//check for channell type.................................
			$result = mb_substr($voting_number, 0, 3);

			$network = '';
			if(trim($result)  == '054'  || trim($result) == '055' || trim($result) == '024')
			{
				$network = 'mtn-gh';
				
			}elseif($result == '026' || $result == '056') 
			{
				$network = 'airtel-gh';
			}elseif($result == '027' || $result == '057') 
			{
				$network = 'tigo-gh';
			}elseif($result == '020' || $result == '050') 
			{
				$network = 'vodafone-gh';
			}

			return $network;
			//var_dump($network);
		} catch (Exception $exc) 
		{
			echo __LINE__ . $exc->getMessage();
		}
	}

	// $contestant_name = ""; process_voda_cash_request
	// $contestant_id   = "";
	// $paying_number   = "";
	// $paying_amount   = "";	


	$query_track_pay = mysqli_query($database, "SELECT * FROM track_level ORDER BY id DESC LIMIT 1");

	while($row = mysqli_fetch_assoc($query_track_pay))
	{
		$contestant_id   = $row['nominee_id'];
		$contestant_name = $row['nominee_name'];
		$paying_number   = $row['payer_phone'];
		$paying_amount   = $row['amount'];
		$user_number     = $row['initiator'];
	}



	// $voda_query = mysqli_query($database, "SELECT * FROM voda_pay ORDER BY id DESC LIMIT 1");

	// while($voda  = mysqli_fetch_assoc($voda_query))
	// {
	// 	$voda_number = $voda['initiator'];
	// 	$token       = $voda['token'];
	// }


	//check channel type from phone number........
	$channel_type = get_channel_type($paying_number);


		file_put_contents('log/aaa.log', print_r("result: $channel,  $paying_number, $paying_amount, $contestant_name, $contestant_id", true));


	var_dump($channel_type);
	if($channel_type == 'vodafone-gh') 
	{
		$push_request = $payment_Obj->process_voda_cash_request('vodafone-gh-ussd', $paying_number, $paying_amount, $contestant_name, $contestant_id);//, $token
file_put_contents('log/aaavod.log', print_r("result: $channel,  $paying_number, $paying_amount, $contestant_name, $contestant_id", true));
		$createdTime = date("Y-m-d");
		$file        = fopen("log/payment_data_voda-$createdTime.log", 'a');
		$request_log = " CODE: $contestant_id , contestant_name: $contestant_name, voter_number: $paying_number , channel_type: '".$channel_type."', amount_billed: '".$paying_number."', \n";//token : $token 
		fwrite($file, "$request_log");
		fclose($file);
		
	}else
	{
		$push_request = $payment_Obj->process_momo_request($channel_type, $paying_number, $paying_amount, $contestant_name, $contestant_id);

		// $createdTime = date("Y-m-d");
		// $file        = fopen("log/payment_data-$createdTime.log", 'a');
		// $request_log = " CODE: $contestant_id , contestant_name: $contestant_name, voter_number: $paying_number , channel_type: '".$channel_type."', amount_billed: '".$paying_amount."', Date: '".$createdTime."' \n";
		// fwrite($file, "$request_log");
		// fclose($file);
	}




	$conte_query = "DELETE FROM track_level WHERE payer_phone = '".$paying_number."' ";
	$get_values  = $database->query($conte_query);


	// $voda_uery    = "DELETE FROM voda_pay WHERE initiator = '$voda_number'";
	// $get_vda      = $database->query($voda_uery);

	$vda_uery    = "DELETE FROM track_level WHERE initiator = '$user_number'";
	$get_va      = $database->query($vda_uery);

	$contestant_name = "";
	$contestant_id   = "";
	$paying_number   = "";
	$paying_amount   = "";

	mysqli_close($database);


?>
