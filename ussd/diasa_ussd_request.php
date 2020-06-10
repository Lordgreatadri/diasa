<?php
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              diasa_ussd_request

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2019-07-17 09:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2019-07-17 10:48:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/
// include "HubtelPaymentProcessor.php";

// error_reporting(1);

include_once "Send_sms_response.php";
$sms_response_Obj = new send_ussd_sms();

$ussdRequest     = json_decode(@file_get_contents('php://input')); 

// Check if no errors occured. 
if($ussdRequest != NULL) 
{
	$conn      = new mysqli('localhost','root', '#4kLxMzGurQ7Z~', 'di_asa');

	//Create a response object. 
	$ussdResponse = new stdClass; 

	if($ussdRequest->Type == "Initiation") 
	{		
		$ussdResponse->Message = "DI ASA - Voting Portal 2019.\n\nEnter the code of the nominee to vote\n# More info";
		$ussdResponse->Type = "Response";
		$ussdResponse->ClientState = 'Sequence1';
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($ussdResponse);
		die();	
	}









	// ***************** SEQUENCE 2   *****************************
	if($ussdRequest->Sequence == "2")
	{
		if(trim($ussdRequest->Message) == '#') 
		{
			$ussdResponse->Message = "Visit (http://bit.ly/disasa2019) for online voting for your favourite nominee.";
			$ussdResponse->Type = "Release";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}

		elseif($ussdRequest->ClientState == 'Sequence1')
		{
			$contestant_id   = "";
	        $contestant_name = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM contestants WHERE name = '".trim($ussdRequest->Message)."' OR contestant_num = '".trim($ussdRequest->Message)."' OR contestant_id = '".trim($ussdRequest->Message)."' AND status = 'not_evicted' LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['contestant_id'];
	            $contestant_name = $row['name'];
	            $contestant_num = $row['contestant_num'];
			}

			file_put_contents('log/con_query.log', print_r($contestant_name, true));

			if(trim($ussdRequest->Message) == $contestant_id || trim($ussdRequest->Message) == $contestant_name || trim($ussdRequest->Message) == $contestant_num) 
	        {
				$query_test = "INSERT INTO track_level(initiator, nominee_id, nominee_code, nominee_name) VALUES('".$ussdRequest->Mobile."', '".$contestant_id."', '".$ussdRequest->Message."', '".$contestant_name."')";
				$save = $conn->query($query_test);

	          	$ussdResponse->Message = $contestant_name."\n1. 1 vote = Ghc1\n2. 10 votes = Ghc10\n3. 25 votes = Ghc25\n4. 50 votes = Ghc50\n5. 100 votes = Ghc100\n6. 200 votes = Ghc200\n7. 500 votes = Ghc500";
			    $ussdResponse->ClientState = 'payment1';
			    $ussdResponse->Type = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);

				// $createdTime = date("Y-m-d");
			 //    $file        = fopen("log/dataFetched-$createdTime.log", 'a');
			 //    $request_log = "  {VOTER: '".$ussdRequest->Mobile."', COED: $contestant_id, NOMINEE: $contestant_name  },.  \n";
			 //    fwrite($file, "$request_log");
			 //    fclose($file);

				die();
	        }else
	        {
	        	$ussdResponse->Message = "Sorry, wrong entry or your nominee is already evicted.";
			    $ussdResponse->Type = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
	        }

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}
	}









	// ***************** SEQUENCE 3   *****************************
	if($ussdRequest->Sequence == "3")
	{
		if($ussdRequest->ClientState = 'payment1') 
		{
			if(trim($ussdRequest->Message) == '1') 
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '1';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '2')
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '10';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '3')
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '25';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '4')
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '50';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '5')
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '100';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '6')
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '200';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '7')
			{
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = '500';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
			else
			{
				$ussdResponse->Message = 'Sorry your selection was wrong';
			    $ussdResponse->Type    = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
		}else
		{
				$ussdResponse->Message = 'Sorry your entry was wrong';
			    $ussdResponse->Type    = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
		}
	}









	// ***************** SEQUENCE 4   *****************************
	if($ussdRequest->Sequence == "4")
	{

		$channel_type = $sms_response_Obj->get_channel_type(trim($ussdRequest->Message));

		if($channel_type == "vodafone-gh") 
		{
			// $ussdResponse->Message = 'Please provide vodafone cash token, or dial *110# to generate a token and restart process.';
	  //   	$ussdResponse->ClientState = $ussdRequest->Message;
   //      	$ussdResponse->Type    = "Response";

		    
        	$contestant_id   = "";
	        $contestant_name = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM track_level WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['nominee_id'];
	            $contestant_name = $row['nominee_name'];
			}

			
			$mtn_update = "UPDATE `track_level` SET `amount`='".$ussdRequest->ClientState."', `payer_phone` = '".$ussdRequest->Message."', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    		$test_run = $conn->query($mtn_update);

			$ussdResponse->Message = "Please authorize payment for '".$contestant_name."'. Thank you. Keep voting.";
		 	$ussdResponse->Type    = "Release";
		 	exec("php /var/www/di_asa/ussd/payment_process.php  > /tmp/diasa_ussd.log 2>&1 &");
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
		   
			die();
		}elseif($channel_type == "mtn-gh" || $channel_type == "airtel-gh" || $channel_type == "tigo-gh") 
		{ 
			$contestant_id   = "";
	        $contestant_name = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM track_level WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['nominee_id'];
	            $contestant_name = $row['nominee_name'];
			}

			$mtn_update = "UPDATE `track_level` SET `amount`='".$ussdRequest->ClientState."', `payer_phone` = '".$ussdRequest->Message."', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    		$test_run = $conn->query($mtn_update);
			
			$ussdResponse->Message = "Please authorize payment for '".$contestant_name."'. Thank you. Keep voting.";
		 	$ussdResponse->Type    = "Release";
		 	exec("php /var/www/di_asa/ussd/payment_process.php  > /tmp/diasa_ussd.log 2>&1 &");
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}else
		{
				$ussdResponse->Message = 'Sorry your selection was wrong';
			    $ussdResponse->Type    = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
		}
		

	}









	// ***************** SEQUENCE 5   *****************************
	if($ussdRequest->Sequence == "5")
	{
			$voda = "INSERT INTO voda_pay(initiator, token) VALUES('".$ussdRequest->Mobile."', '".$ussdRequest->Message."')";
			$token = $conn->query($voda);


			$ussdResponse->Message = 'Please payment is being processed. Thank you. Keep voting.';
		    $ussdResponse->Type    = "Release";
			exec("php /var/www/di_asa/ussd/payment_process.php  > /tmp/diasa_ussd.log 2>&1 &");
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
	}










	// ***************** SEQUENCE 6   *****************************
	if($ussdRequest->Sequence == "6")
	{
		$voda = "INSERT INTO voda_pay(initiator, token) VALUES('".$ussdRequest->Mobile."', '".$ussdRequest->Message."')";
		$token = $conn->query($voda);
		mysqli_close($conn);

		$ussdResponse->Message = 'Please payment is being processed. Thank you. Keep voting.';
		$ussdResponse->Type    = "Release";
		exec("php /var/www/di_asa/ussd/payment_process.php  > /tmp/diasa_ussd.log 2>&1 &");
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($ussdResponse);
		die();
	}

}