<?php
error_reporting(0);
include_once 'handle_transactions.php';
$card_pay_Obj = new request_card_pay();


$conn = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'di_asa');

//$callback_obj = file_get_contents("php://input");
//$json = json_decode($callback_obj, true);
$old_vote = 0;
$new_vote = "";
$contestant_name = "";
$amount = $_REQUEST['vpc_Amount'] / 100;
$valid = 0;
$batch = "";


//$amount = $_REQUEST['vpc_Amount'];
/*


*/
//exit();


/*
vpc_Amount=0
&vpc_BatchNo=0&
vpc_Command=pay&vpc_Locale=en_GH&vpc_Merchant=MOBILE01&vpc_Message=E5015%3A+Currency+Code+%5BGH%5D+is+invalid&
vpc_OrderInfo=1562593588&vpc_TransactionNo=0&vpc_TxnResponseCode=0
*/


/*
$_REQUEST['vpc_Amount'];
$_REQUEST['vpc_BatchNo'];
$_REQUEST['vpc_Merchant'];
$_REQUEST['vpc_OrderInfo'];
$_REQUEST['vpc_TransactionNo'];
$_REQUEST['vpc_TxnResponseCode'];
$_REQUEST['vpc_Message'];
*/

echo 'hello......';
if($_REQUEST['vpc_TxnResponseCode'] == 0){
   
   //check for this values in the database
   $query = mysqli_query($conn, "SELECT `contestant_name`, `vpc_order_info`, `vpc_response_code`, `voter_number`  FROM card_pay WHERE `vpc_order_info` = '".$_REQUEST['vpc_OrderInfo']."' ");

    if(mysqli_num_rows($query) > 0){

      /*means values are genuine so update
        so update the following fields
        vpc_batch_no, vpc_transaction_no, vpc_message and then
        vpc_response_code.

      */

      while($row = mysqli_fetch_assoc($query)){

      	$contestant_name = $row['contestant_name'];
      	$vpc_response_code = $row['vpc_response_code'];
        $voter_number  = $row['voter_number'];

      	if($vpc_response_code == 40){
           
           $valid = 1;
      	}

      }


   	  $query_update = "UPDATE card_pay SET `vpc_batch_no` = '".$_REQUEST['vpc_BatchNo']."',
   	  `vpc_transaction_no` = '".$_REQUEST['vpc_TransactionNo']."', `vpc_message` = '".$_REQUEST['vpc_Message']."', `vpc_response_code` = '".$_REQUEST['vpc_TxnResponseCode']."' WHERE `vpc_order_info` = '".$_REQUEST['vpc_OrderInfo']."' ";

      mysqli_query($conn, $query_update);

      $message   = $_REQUEST['vpc_Message'];
	    $message1   = "Congrats your vote has been approved successfully for <b>'$contestant_name'</b> Powered by <a href='mobilecontent.com.gh'> Mobilecontent.com Ltd.</a> \nWe render services like, App & Software development, VAS services, USSD etc";
      

      $file_item = $amount.', name = '.$contestant_name.',  batchno= '.$_REQUEST['vpc_BatchNo'].' , orderinfo= '.$_REQUEST['vpc_OrderInfo'].',mechant= '.$_REQUEST['vpc_Merchant '].', rescode= '.$_REQUEST['vpc_TxnResponseCode'].', message= '.$_REQUEST['vpc_Message'];
    $createdTime = date("Y-m-d");
    $file        = fopen("callbackdata-$createdTime.log", 'a');
    $request_log = $file_item;
    fwrite($file, "$request_log");
    fclose($file);


      //get the initiator number to prompt them......................
      if( !isset( $_SESSION ) ):
        session_start();
      endif;
      // echo '<h1>' . __FILE__  .'</h1>';
      //$user_number = $_SESSION['user_number'];

	    //get contestant name
	    $query_nominee = mysqli_query($conn, "SELECT `num_of_votes` FROM contestants WHERE `name` = '".trim(strtoupper($contestant_name))."' "); 



      while($row2 = mysqli_fetch_assoc($query_nominee))
      {
        $batch = 0;
        if($amount == 1.2)
        {
            $batch   = 2;
        }elseif($amount == 12)
        {
            $batch   = 20;
        }elseif($amount == 6)
        {
            $batch   = 10;
        }elseif($amount == 30)
        {
            $batch   = 50;
        }elseif($amount == 60)
        {
            $batch   = 100;
        }elseif($amount == 120)
        {
            $batch   = 200;  
        }elseif($amount == 300) 
        {
            $batch   = 500;
        }elseif($amount == 600) 
        {
            $batch   = 1000;
        }

	    $old_vote = $row2['num_of_votes'];

	    $new_vote = $old_vote  + $batch;

	    $query_vote_update = "UPDATE contestants SET `num_of_votes` = '".$new_vote."' WHERE `name` = '".trim(strtoupper($contestant_name))."' ";
                

        $query_weekly_vote_update = "UPDATE contestants_weekly SET `num_of_votes` = '".$new_vote."' WHERE  `name` = '".trim(strtoupper($contestant_name))."' ";
               

        $messagePh = "Congrats your vote has been approved successfully for '$contestant_name', current votes: ".$new_vote;
        
        if($valid == 1){
          $success = $card_pay_Obj->send_sms_response($voter_number, $messagePh);         

        	mysqli_query($conn, $query_vote_update);
        	mysqli_query($conn, $query_weekly_vote_update);          
        }
        
      }     

	    header("Location:404.php?message='".$message1."' ");

    }else{

   	  $message = $_REQUEST['vpc_Message'];
	  $message = "Oops something went wrong couldnt get order";

      header("Location:404.php?message='".$message."' ");
    }
   
}else{

	$message = $_REQUEST['vpc_Message'];
	$message = "Oops something went wrong please contact <a href='mobilecontent.com.gh'>Mobilecontent.com Ltd.</a>\nWe render services like, App & Software development, VAS services, USSD etc";

    header("Location:404.php?message='".$message."' ");
}

mysqli_close($conn);
//destroy session after use.........
// unset($_SESSION['user_number']);

?>