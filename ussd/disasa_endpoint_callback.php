<?php

/**------------------------------------------------------------------------------------------------------------------------------------------------
 * @@Name:              Hubtel_endpoint
 
 * @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
 * @@Tell:              +233543645688/+233273593525
 
 * @Date:               2019-03-04 14:30:30
 * @Last Modified by:   Lordgreat -  Adri Emmanuel
 * @Last Modified time: 2019-03-04 15:00:10

 * @Copyright:          MobileContent.Com Ltd <'owner'>
 
 * @Website:            https://mobilecontent.com.gh
 *-------------------------------------------------------------------------------------------------------------------------------------------------
 */



    $callback_obj = file_get_contents("php://input");
    $json = json_decode($callback_obj, true);
    $ResponseCode = $json['ResponseCode'];
    $AmountAfterCharges = $json['Data']['AmountAfterCharges'];
    $TransactionId = $json['Data']['TransactionId'];
    $ClientReference = $json['Data']['ClientReference'];
    $Description = $json['Data']['Description'];
    $ExternalTransactionId = $json['Data']['ExternalTransactionId'];
    $Amount = $json['Data']['Amount'];
    $Charges = $json['Data']['Charges'];

    // $contestant_name = "";
    // $response_code   = "";
    // $contestant_code = "";
    // $amount_billed   = "";
    // $description     = "";
    // $voting_number   = "";
    // $channel_type    = "";



    // $conn = new mysqli('127.0.0.1','root', '', 'miss_gh');//
    $conn = new mysqli('localhost', 'root', '~', 'di_asa');


    // loop through data and then update the contestant_table with the right vote count.......  
    $description_update = "UPDATE `temp_monitor_payment` SET `description`='".$Description."', `res_code` = '".$ResponseCode."' WHERE (`transaction_id`='".$TransactionId."') ";
    $descriptiong_run = $conn->query($description_update);

   
    $query_track_pay = mysqli_query($conn, "SELECT * FROM temp_monitor_payment WHERE transaction_id = '".$TransactionId."' ORDER BY id DESC LIMIT 1");
    while($response_handular = mysqli_fetch_assoc($query_track_pay))
    {
        $contestant_name = $response_handular['contestant_name'];
        $response_code   = $response_handular['response_code'];
        $contestant_code = $response_handular['contestant_code'];
        $amount_billed   = $response_handular['amount'];
        $description     = $response_handular['description'];
        $voting_number   = $response_handular['phone_number'];
        $channel_type    = $response_handular['channel_type'];
    }

    $createdTime = date("Y-m-d");
    $file        = fopen("log/endPoint_payment-$createdTime.log", 'a');
    $request_log = "Description: $Description, Amount_Billed: $amount_billed , Contestant_votedfor: $contestant_name \n";
    fwrite($file, "$request_log");
    fclose($file);

   
    $query_nominee_val = mysqli_query($conn, "SELECT * FROM contestants WHERE `contestant_id` = '".$contestant_code."' LIMIT 1");
    while($rows = mysqli_fetch_assoc($query_nominee_val))
    {
        $old_vote    = $rows['num_of_votes'];
    }

    $vote_count = 0;      
    if($amount_billed == 1)
    {
        $vote_count   = 1;
    }elseif($amount_billed == 10)
    {
        $vote_count   = 10;
    }elseif($amount_billed == 25)
    {
        $vote_count   = 25;
    }elseif($amount_billed == 50)
    {
        $vote_count   = 50;
    }elseif($amount_billed == 100)
    {
        $vote_count   = 100;
    }elseif($amount_billed == 200)
    {
        $vote_count   = 200;  
    }elseif($amount_billed == 500)
    {
        $vote_count   = 500;
    }elseif($Amount == 0.01) 
    {
        $vote_count   = 1;
    }                 
                
    $new_vote    = $old_vote  + $vote_count;

                
    $createdTime = date("Y-m-d");
    $file        = fopen("log/endpoint_data-$createdTime.log", 'a');
    $request_log = "contestant_name: $contestant_name, voter_number: $voting_number , transaction_id: '".$json['Data']['TransactionId']."', ResponseCode: '".$json['ResponseCode']."', channel_type: '".$channel_type."', amount_billed: '".$Amount."', DESCRIPTION : $description, Date: '".$createdTime."' \n";
    fwrite($file, "$request_log");
    fclose($file);


    if($ResponseCode == "0000") 
    {
        $update_contestant_cotes = "UPDATE contestants SET num_of_votes = '".$new_vote."' WHERE contestant_id = '".$contestant_code."'";
        $begin_update_run = $conn->query($update_contestant_cotes);

        $update_conte_cotes = "UPDATE contestants_weekly SET num_of_votes = '".$new_vote."' WHERE contestant_id = '".$contestant_code."'";
        $begin_upd_run = $conn->query($update_conte_cotes);


        //SUM UP ALL IN ONE TABLE IF SUCCESSFUL
        $when = date("Y-m-d H:i:s");
        $gmb_query = "INSERT INTO diasa_pay(`transaction_id`, `amt_after_charges`, `client_reference`, `contestant_name`, `external_trans_id`, `number`, `channel`, `number_of_votes`, `amount`, `response_code`, `charges`, `description`, `when`) VALUES('".$json['Data']['TransactionId']."', '".$AmountAfterCharges."', '".$ClientReference."', '".$contestant_name."', '".$ExternalTransactionId."', '".$voting_number."', '".$channel_type."', '".$vote_count."', '".$amount_billed."', '".$ResponseCode."', '".$Charges."', '".$Description."', '".$when."')";                
        $track_gmb= $conn->query($gmb_query);

        
        $createdTime = date("Y-m-d");
        $file        = fopen("log/vote_update_success-$createdTime.log", 'a');
        $request_log = "Description: $description, Amount_Billed: $amount_billed , Contestant_Updated: $contestant_name , with_vote: $vote_count, new_vote : $new_vote.<br/>\n";
        fwrite($file, "$request_log");
        fclose($file);
    }

    #prompt tthe user of the out come.........
    function send_sms_response($user_number, $message)
    {
        try 
        {
            $myNew_value=null;
            $raw_number ='';//count($striped_num)
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
            
            $msisdn = $raw_number;
            $message = urlencode($message);
            $url = "";
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

    // for nominee #".$contestant_code." => ".$contestant_name.".
    if($ResponseCode == "0000") 
    {
        $message = "Voting processed successfully, current votes : ".$new_vote.".\nThank you and keep voting. Online votes @ bit.ly/diasa2019 \nPowered by mobilecontent.com.gh . Reach us for Mobile App & USSD, VAS services etc";

        $check_success = send_sms_response($voting_number, $message);

    }
    elseif($ResponseCode == "2051" || $ResponseCode == "2001" || $ResponseCode == "2050" || $ResponseCode == "4090") 
    {
        $message = "Sorry voting failed.\n".$description.". Thank you!.\nPowered by mobilecontent.com.gh . Reach us for Mobile App & USSD, VAS services etc";

        $check_success = send_sms_response($voting_number, $message);

        $createdTime = date("Y-m-d");
        $file        = fopen("log/failed_data-$createdTime.log", 'a');
        $request_log = "{ contestant_name: $contestant_name, voter_number: $voting_number, transaction_id: '".$json['Data']['TransactionId']."', ResponseCode: '".$json['ResponseCode']."', channel_type: '".$channel_type."', amount_billed: '".$Amount."', Date: '".$createdTime."'} \n";
        fwrite($file, "$request_log");
        fclose($file);
    }


    // Create temporal log ffor Debug 
    $createdTime = date("Y-m-d");
    $file        = fopen("log/HubTel_payment_endpoint-$createdTime.log", 'a');
    $request_log = "ResponseCode $ResponseCode, TransactionId: $TransactionId, ClientReference: $ClientReference, Amount: $Amount, Description: $Description, Contestant: $contestant_name, \n";
    fwrite($file, "$request_log");
    fclose($file);

    $contestant_name = "";
    $response_code   = "";
    $contestant_code = "";

    $contestant_name = null;
    $response_code   = null;
    $contestant_code = null;
