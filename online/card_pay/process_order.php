<?php
include_once('handle_transactions.php');

// if(isset($_POST['price'])){
//     //$selected_item = $_POST['item'];

//     //$price = $item[$selected_item];

//     $price = $_POST['price'];

//     stanbic_pay($price);

// }

/**
 * 
 */
class request_card_pay
{
	

		public function stanbic_pay($total_cost, $nominee_name, $user_number){
		
		$secretHash= "484B1C117552D6869BB3521DC3D60014";  //"XXXXXXXXXXXXXXXXXXXXXX"; //enter your secrete hash
		$accessCode= '0C706C48'; //'XXXXXXXXX'; //enter your access code
		$merchantId= 'MOBILE01';   //'XXXXXXXX'; //enter your merchant ID


		$ord = "ORD";
		$txn = "TXN";
	    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		
		$txn_ref = $txn.substr(str_shuffle($permitted_chars), 0, 7).time(); //this should always be unique
		$order_info = $ord.substr(str_shuffle($permitted_chars), 0, 7).time(); //this should always be unique
		
		if ($total_cost == 0.6){
	        $amount_to_pay = 60.00;
		}else{

		   $amount_to_pay = $total_cost*100; //$total_cost*100;

		}
		
		$data = array(
			"vpc_AccessCode" => $accessCode,
			"vpc_Amount" => (string)$amount_to_pay,
			"vpc_Command" => 'pay',
			"vpc_Locale" => 'en',
			"vpc_MerchTxnRef" =>  $txn_ref,
			"vpc_Merchant" => $merchantId,
			"vpc_OrderInfo" => $order_info,

			"vpc_ReturnURL" => urldecode("http://mysmsinbox.com/di_asa/online/card_pay/process_visa_pay.php"), //replace with your custom return URL
			"vpc_Version" => '1',
			"vpc_Currency" => 'GHS',//'USD',
			"vpc_SecureHashType" => 'SHA256'    
		);


		ksort($data);
		
		$hash = null;
		
		foreach ($data as $k => $v) {
			if (in_array($k, array('vpc_SecureHash', 'vpc_SecureHashType'))) {
				continue;
			}
			if ((strlen($v) > 0) && ((substr($k, 0, 4)=="vpc_") || (substr($k, 0, 5) =="user_"))) {
				$hash .= $k . "=" . $v . "&";
			}
		}
		
		$hash = rtrim($hash, "&");

		$secureHash = strtoupper(hash_hmac('SHA256', $hash, pack('H*', $secretHash)));
		$paraFinale = array_merge($data, array('vpc_SecureHash' => $secureHash));
		$actionurl = 'https://migs.mastercard.com.au/vpcpay?'.http_build_query($paraFinale);

		//log transaction here.
	    
	    $contestant_name = $nominee_name;//"ifeoma";
	    $vpc_amount = $total_cost;   //$amount_to_pay;
	    $vpc_batch_no = "none";
	    $vpc_merchant = $merchantId;
	    $vpc_order_info = $order_info;
	    $vpc_txn_code = $txn_ref;
	    $vpc_transaction_no = "none";
	    $vpc_response_code = '40';
	    $voter = $user_number;
	    
	    $number_of_votes = 0;
	    if($total_cost == 1.2)
        {
            $number_of_votes   = 2;
        }elseif($total_cost == 12)
        {
            $number_of_votes   = 20;
        }elseif($total_cost == 6)
        {
            $number_of_votes   = 10;
        }elseif($total_cost == 30)
        {
            $number_of_votes   = 50;
        }elseif($total_cost == 60)
        {
            $number_of_votes   = 100;
        }elseif($total_cost == 120)
        {
            $number_of_votes   = 200;  
        }elseif($total_cost == 300) 
        {
            $number_of_votes   = 500;
        }elseif($total_cost == 600) 
        {
            $number_of_votes   = 1000;
        }
	    $obj = new CardTransaction;

		$obj->log_transaction($contestant_name, $number_of_votes, $vpc_amount, $vpc_batch_no, $vpc_merchant, 
			$vpc_order_info, $vpc_txn_code, $vpc_transaction_no, $vpc_response_code, $voter);


		header("LOCATION: " . $actionurl);
		

		$resp = array('action_url' => str_replace("\\/", "/", $actionurl));



		echo json_encode($resp);

		//echo json_decode($resp);

	}
}

