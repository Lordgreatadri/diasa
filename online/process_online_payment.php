<?php

include_once('onlineHubtelPaymentProcess.php');
$hubtel_Obj = new HubtelPaymentProcessor();
include_once 'card_pay/process_order.php';
// $hubtel_Obj = new hubtelPay();
$card_pay_Obj = new request_card_pay();



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	session_start();
	// $channel_type  = $_POST['channel'];
	$phone_number    = $_POST['phone_number']; 
	$amount_billed   = $_POST['vote_count'];
	$channel_type    = $_POST['network'];
	$contestant_id   = $_POST['contestant_id'];
	$contestant_name = $_POST['contestant_name'];

	// $token = $_POST['token'];
	$useragent = $_SERVER['HTTP_USER_AGENT'];


	// $createdTime = date("Y-m-d");
 //    $file        = fopen("log/ONLINErequest_data-$createdTime.log", 'a');
 //    $request_log = "{contestant_name: $contestant_name, voter_number: $phone_number ,  channel_type: '".$channel_type."', amount_billed: '".$amount_billed."', Date: '".$createdTime."'}, \n";
 //    fwrite($file, "$request_log");
 //    fclose($file);

    //for visa payment
	if($channel_type == 'visa_card') 
	{
		
		if($amount_billed == "0.60" ) 
		{
			header('Location: index.php');
			$_SESSION['notice_message'] = "Visa payment should be above ₵".$amount_billed.". Choose higher amount.Thank you and keep voting.";
			die();
		}

		$success = $card_pay_Obj->stanbic_pay($amount_billed, $contestant_name, $phone_number);//visa payment API
		// die();
	}elseif($channel_type == 'mtn-gh' || $channel_type == 'tigo-gh' || $channel_type == 'airtel-gh') 
	{
		if($contestant_id != "" && $contestant_name != "" && trim($phone_number) != "") 
		{
			header('Location: index.php');
			$_SESSION['notice_message'] = "Payment is being process. Check and confirm payment on your phone of ₵".$amount_billed." for ".$contestant_name.".\nThank you and keep voting.";
		}
		// ?momo payment API mtn, airteltigo
		$send_request = $hubtel_Obj->process_momo_request($channel_type, $phone_number, $amount_billed, $contestant_name, $contestant_id);
		// die();
	}elseif($channel_type == 'vodafone-gh') 
	{
		header('Location: index.php');
			$_SESSION['notice_message'] = "Vodafone cash payment is being process, confirm payment of ₵".$amount_billed." for ".$contestant_name.".\nThank you and keep voting.";
			// vodafone-gh api
		$send_request = $hubtel_Obj->process_voda_cash_request('vodafone-gh-ussd', $phone_number, $amount_billed, $contestant_name, $contestant_id);//, $token
	}else
	{
		header('Location: index.php');
		$_SESSION['notice_message'] = "Sorry, your selections are incorrect.\nPlease check and resubmit your request again. Thank you and keep voting.";
	}
		

}



 
?>