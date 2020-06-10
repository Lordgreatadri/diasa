<?php
/**------------------------------------------------------------------------------------------------------------------------------------------------
* @@Name:              mother_ussd_request

* @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
* @@Tell:              +233543645688/+233273593525

* @Date:               2019-05-01 09:40:30
* @Last Modified by:   Lordgreat - Adri Emmanuel
* @Last Modified time: 2019-05-02 10:48:17

* @Copyright:          MobileContent.Com Ltd <'owner'>

* @Website:            https://mobilecontent.com.gh
*-------------------------------------------------------------------------------------------------------------------------------------------------
*/
// include "HubtelPaymentProcessor.php";

// error_reporting(1);


include_once "Send_sms_response.php";
include_once 'HubtelPaymentProcess.php';
// // include_once 'DAL.php';
$sms_response_Obj = new send_ussd_sms();
$payment_Obj = new HubtelPaymentProcessor();
// $data_Obj = new acc_DAL();


$ussdRequest     = json_decode(@file_get_contents('php://input')); 

// Check if no errors occured. 
if($ussdRequest != NULL) 
{
	// $DB_SERVER = "127.0.0.1";//127.0.0.1 localhost
	// $DB_NAME = "miss_gh"; //"gmb";
	// $DB_USER = "root";
	// $DB_PASS = 'FAg8(3P^tJVnBDsF%F'; //#4kLxMzGurQ7Z~ Bim32!@b)o FAg8(3P^tJVnBDsF%F
	// $database = new mysqli($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME);

	$conn      = new mysqli('localhost','root', '#4kLxMzGurQ7Z~', 'miss_gh_mobile');

	//Create a response object. 
	$ussdResponse = new stdClass; 

	if($ussdRequest->Type == "Initiation") 
	{
		// if ($ussdRequest->Mobile != '233543645688' && $ussdRequest->Mobile != '23324463269')2 
		// {
		// 	$ussdResponse->Message = "Please you can't access the system now, try in few minutes. Thank you";
		// 	$ussdResponse->Type = "Release";
		// 	$ussdResponse->ClientState = 'Sequence1';
		// 	header('Content-type: application/json; charset=utf-8');
		// 	echo json_encode($ussdResponse);
		// 	die();
		// }else
		// {
			$ussdResponse->Message = "Welcome to Miss Ghana Voting Portal.\n\nEnter Nominee's code or stage name to vote\n0. More info";
			$ussdResponse->Type = "Response";
			$ussdResponse->ClientState = 'Sequence1';
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();	
		// }
		
	}









	// ***************** SEQUENCE 2   *****************************http://bit.ly/Missghana
	if($ussdRequest->Sequence == "2")
	{
		if(trim($ussdRequest->Message) == '0') 
		{
			$ussdResponse->Message = "Visit (http://bit.ly/Missghana) for online voting for your favourite nominee.";
			$ussdResponse->Type = "Release";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}

			
		if(trim($ussdRequest->Message) == "#") 
		{
			$ussdResponse->Message = "0. More info\n11. Nana \n12. Harriet\n13. Gifty\n14. Rebecca\n15. Beatrice\n16. Leah\n17. Josephine\n18. Henrietta\n19. Mabel\n20. Suzzy";
			$ussdResponse->Type = "Response";
			$ussdResponse->ClientState = 'contestant2';
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}


		if($ussdRequest->ClientState == 'Sequence1')
		{
			$contestant_id   = "";
	        $contestant_name = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM contestants WHERE name = '".trim($ussdRequest->Message)."' OR contestant_id = '".trim($ussdRequest->Message)."' OR contestant_num = '".trim($ussdRequest->Message)."' LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['contestant_id'];
	            $contestant_name = $row['name'];
			}

			file_put_contents('log/con_query.log', print_r($contestant_name, true));

			if(trim($ussdRequest->Message) == $contestant_id || trim(strtoupper($ussdRequest->Message)) == trim(strtoupper($contestant_name))) 
	        {
				$query_test = "INSERT INTO track_process(initiator, nominee_id, nominee_name) VALUES('".$ussdRequest->Mobile."', '".$contestant_id."', '".$contestant_name."')";
				$save = $conn->query($query_test);

	          	$ussdResponse->Message = $contestant_name."\n1. 1 Vote = Ghc1\n2. 25 Votes = Ghc25\n3. 50 Votes = Ghc50\n4. 100 Votes = Ghc100\n5. 200 Votes = Ghc200\n6. 500 Votes = Ghc500";
			    $ussdResponse->ClientState = 'payment1';
			    $ussdResponse->Type = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);

				$createdTime = date("Y-m-d");
			    $file        = fopen("log/dataFetched-$createdTime.log", 'a');
			    $request_log = "  {VOTER: '".$ussdRequest->Mobile."', COED: $contestant_id, NOMINEE: $contestant_name  },.  \n";
			    fwrite($file, "$request_log");
			    fclose($file);

				die();
	        }else
	        {
	        	$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
				$get_va      = $conn->query($vda_uery);

	        	$ussdResponse->Message = "Sorry, wrong data entry\nTry again.";
			    $ussdResponse->ClientState = 'contestant2';
			    $ussdResponse->Type = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
	        }

			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}
	}









	// ***************** SEQUENCE 3   *****************************http://bit.ly/Missghana
	if($ussdRequest->Sequence == "3")
	{
		if($ussdRequest->ClientState == 'contestant2') 
		{
			if(trim($ussdRequest->Message) == '0') 
			{
				$ussdResponse->Message = "Visit (http://bit.ly/Missghana) for online voting for your favourite nominee.";
			    // $ussdResponse->ClientState = 'payment2';
			    $ussdResponse->Type = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}


			$contestant_id   = "";
	        $contestant_name = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM contestants WHERE name = '".trim($ussdRequest->Message)."' OR contestant_id = '".trim($ussdRequest->Message)."' OR contestant_num = '".trim($ussdRequest->Message)."' LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['contestant_id'];
	            $contestant_name = $row['name'];
			}


			if(trim($ussdRequest->Message) == $contestant_id || trim(strtoupper($ussdRequest->Message)) == trim(strtoupper($contestant_name))) 
	        {


				$query_test = "INSERT INTO track_process(initiator, nominee_id, nominee_name) VALUES('".$ussdRequest->Mobile."', '".$contestant_id."', '".$contestant_name."')";
				$save = $conn->query($query_test);


	          	$ussdResponse->Message = $contestant_name."\n1. 1 Vote = Ghc1\n2. 25 Votes = Ghc25\n3. 50 Votes = Ghc50\n4. 100 Votes = Ghc100\n5. 200 Votes = Ghc200\n6. 500 Votes = Ghc500";
			    $ussdResponse->ClientState = 'payment2';
			    $ussdResponse->Type = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);


				// $createdTime = date("Y-m-d");
			 //    $file        = fopen("log/dataFetched-$createdTime.log", 'a');
			 //    $request_log = "  {VOTER: '".$ussdRequest->Mobile."', COED: $contestant_id, NOMINEE: $contestant_name  },.   ";
			 //    fwrite($file, "$request_log");
			 //    fclose($file);
				die();
	        }else
	        {
	        	$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
				$get_va      = $conn->query($vda_uery);

	        	$ussdResponse->Message = "Sorry, wrong entry or your nominee is already evicted.";
			    // $ussdResponse->ClientState = 'payment';
			    $ussdResponse->Type = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
	        }
		}




		elseif($ussdRequest->ClientState = 'payment1') 
		{
			$contestant_id   = "";
	        $contestant_name = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM track_process WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['nominee_id'];
	            $contestant_name = $row['nominee_name'];
			}

			if(trim($ussdRequest->Message) == '1') 
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='1', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '2')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='25', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '3')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='50', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '4')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='100', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '5')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='200', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '6')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='500', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
			else
			{
				$ussdResponse->Message = "Sorry your selection was wrong\nRetry again.";
				$ussdResponse->ClientState = 'payment2';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
		}else
		{		$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
				$get_va      = $conn->query($vda_uery);

				$ussdResponse->Message = 'Sorry your selection was wrong';
				// $ussdResponse->ClientState = '500.0';
			    $ussdResponse->Type    = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
		}
	}









	// ***************** SEQUENCE 4   *****************************
	if($ussdRequest->Sequence == "4")
	{

		//check if the user is entering momo number
		if (trim($ussdRequest->ClientState) == 'MOMO_NUMBER') 
		{
			if(is_numeric(trim($ussdRequest->Message)) && trim(strlen($ussdRequest->Message)) == 10) 
			{
				//$ussdResponse->Message = 'Please authorize a payment of GHC'.$ussdRequest->ClientState.' on '.$ussdRequest->Message.'. Thank you. Keep voting.';
				
				$contestant_id   = "";
		        $contestant_name = "";
		        $amount 		 = "";
				$query_track_pay = mysqli_query($conn, "SELECT * FROM track_process WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
				while($row = mysqli_fetch_assoc($query_track_pay))
				{
					$contestant_id   = $row['nominee_id'];
		            $contestant_name = $row['nominee_name'];
		            $amount 		 = $row['amount'];
				}

				$mtn_update = "UPDATE `track_process` SET `amount`='".$amount."', `payer_phone` = '".$ussdRequest->Message."', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
	    		$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = "Please authorize payment of GHC'".$amount."' for '".$contestant_name."' on ".$ussdRequest->Message.".\nThank you. Keep voting.";
			 	$ussdResponse->Type    = "Release";
			 	exec("php /var/www//mssgh_online/ussd/payment_process.php > /tmp/miss_gh_ussd.log 2>&1 &");
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}else
			{
				$ussdResponse->Message = 'Please enter valid mobile money number.';
				$ussdResponse->Type    = "Response";
				$ussdResponse->ClientState = 'MOMO_NUMBER';
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
		}
		elseif($ussdRequest->ClientState = 'payment2') 
		{
			$contestant_id   = "";
		    $contestant_name = "";
		    $amount 		 = "";
			$query_track_pay = mysqli_query($conn, "SELECT * FROM track_process WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
			while($row = mysqli_fetch_assoc($query_track_pay))
			{
				$contestant_id   = $row['nominee_id'];
		        $contestant_name = $row['nominee_name'];
			}

			if(trim($ussdRequest->Message) == '1') 
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='1', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '2')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='25', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '3')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='50', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '4')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='100', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '5')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='200', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}elseif(trim($ussdRequest->Message) == '6')
			{
				//update amount directly.......
				$mtn_update = "UPDATE `track_process` SET `amount`='500', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
    			$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}else
			{
				$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
				$get_va      = $conn->query($vda_uery);

				$ussdResponse->Message = 'Sorry your selection was wrong';
				// $ussdResponse->ClientState = '500.0';
			    $ussdResponse->Type    = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}

			die();
		}else
		{
			$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
			$get_va      = $conn->query($vda_uery);


			$ussdResponse->Message = 'Please enter valid mobile money number.';
			// $ussdResponse->ClientState = '500.0';
			$ussdResponse->Type    = "Release";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}
		
	}















	// ***************** SEQUENCE 5   *****************************
	if($ussdRequest->Sequence == "5")
	{
		// $channel_type = $sms_response_Obj->get_channel_type(trim($ussdRequest->Message));
		//check if the user is entering momo number
		if (trim($ussdRequest->ClientState) == 'MOMO_NUMBER') 
		{
			if(is_numeric(trim($ussdRequest->Message)) && trim(strlen($ussdRequest->Message)) == 10)
			{
				$contestant_id   = "";
		        $contestant_name = "";
		        $amount 		 = "";
				$query_track_pay = mysqli_query($conn, "SELECT * FROM track_process WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
				while($row = mysqli_fetch_assoc($query_track_pay))
				{
					$contestant_id   = $row['nominee_id'];
		            $contestant_name = $row['nominee_name'];
		            $amount 		 = $row['amount'];
				}

				$mtn_update = "UPDATE `track_process` SET `amount`='".$amount."', `payer_phone` = '".$ussdRequest->Message."', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
	    		$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = "Please authorize payment of GHC'".$amount."' for '".$contestant_name."' on ".$ussdRequest->Message.".\nThank you. Keep voting.";
			    $ussdResponse->Type    = "Release";
				exec("php /var/www/mssgh_online/ussd/payment_process.php > /tmp/miss_gh_ussd.log 2>&1 &");
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}else
			{
				// try again........................
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
			
		}else
		{
			$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
			$get_va      = $conn->query($vda_uery);

			$ussdResponse->Message = 'Please your entry was wrong.';
		    $ussdResponse->Type    = "Release";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}
	}










	// ***************** SEQUENCE 6   *****************************
	if($ussdRequest->Sequence == "6")
	{
		if (trim($ussdRequest->ClientState) == 'MOMO_NUMBER') 
		{
			if(is_numeric(trim($ussdRequest->Message)) && trim(strlen($ussdRequest->Message)) == 10)
			{
				$contestant_id   = "";
		        $contestant_name = "";
		        $amount 		 = "";
				$query_track_pay = mysqli_query($conn, "SELECT * FROM track_process WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
				while($row = mysqli_fetch_assoc($query_track_pay))
				{
					$contestant_id   = $row['nominee_id'];
		            $contestant_name = $row['nominee_name'];
		            $amount 		 = $row['amount'];
				}

				$mtn_update = "UPDATE `track_process` SET `amount`='".$amount."', `payer_phone` = '".$ussdRequest->Message."', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
	    		$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = "Please authorize payment of GHC'".$amount."' for '".$contestant_name."' on ".$ussdRequest->Message.".\nThank you. Keep voting.";
			    $ussdResponse->Type    = "Release";
				exec("php /var/www/mssgh_online/ussd/payment_process.php > /tmp/miss_gh_ussd.log 2>&1 &");
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}else
			{
				// try again........................
				$ussdResponse->Message = 'Please enter mobile money number to vote';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Response";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
			
		}else
		{
			$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
			$get_va      = $conn->query($vda_uery);


			$ussdResponse->Message = 'Please your entry was wrong.';
		    $ussdResponse->Type    = "Release";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}
	}







	// ***************** SEQUENCE 7   *****************************
	if($ussdRequest->Sequence == "7")
	{
		if (trim($ussdRequest->ClientState) == 'MOMO_NUMBER') 
		{
			if(is_numeric(trim($ussdRequest->Message)) && trim(strlen($ussdRequest->Message)) == 10)
			{
				$contestant_id   = "";
		        $contestant_name = "";
		        $amount 		 = "";
				$query_track_pay = mysqli_query($conn, "SELECT * FROM track_process WHERE initiator = '".$ussdRequest->Mobile."' ORDER BY id DESC LIMIT 1");
				while($row = mysqli_fetch_assoc($query_track_pay))
				{
					$contestant_id   = $row['nominee_id'];
		            $contestant_name = $row['nominee_name'];
		            $amount 		 = $row['amount'];
				}

				$mtn_update = "UPDATE `track_process` SET `amount`='".$amount."', `payer_phone` = '".$ussdRequest->Message."', nominee_id = '".$contestant_id."', nominee_name = '".$contestant_name."' WHERE (`initiator`='".$ussdRequest->Mobile."') ";
	    		$test_run = $conn->query($mtn_update);

				$ussdResponse->Message = "Please authorize payment of GHC'".$amount."' for '".$contestant_name."' on ".$ussdRequest->Message.".\nThank you. Keep voting.";
			    $ussdResponse->Type    = "Release";
				exec("php /var/www/mssgh_online/ussd/payment_process.php > /tmp/miss_gh_ussd.log 2>&1 &");
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}else
			{
				$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
				$get_va      = $conn->query($vda_uery);

				// try again chance is terminated here........................
				$ussdResponse->Message = 'Please enter mobile money number was wrong.';
				$ussdResponse->ClientState = 'MOMO_NUMBER';
			    $ussdResponse->Type    = "Release";
			    header('Content-type: application/json; charset=utf-8');
				echo json_encode($ussdResponse);
				die();
			}
			
		}else
		{
			$vda_uery    = "DELETE FROM track_process WHERE initiator = '".$ussdRequest->Mobile."'";
			$get_va      = $conn->query($vda_uery);

			$ussdResponse->Message = 'Please your entry was wrong.';
		    $ussdResponse->Type    = "Release";
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($ussdResponse);
			die();
		}
	}

}