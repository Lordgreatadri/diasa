<?php 
	
	error_reporting(0);

	/**
	 * 
	 */
	include_once("SendSmsQuiz.php");
	// include_once("DBCon_quiz.php");
	
	$sendSms = new SendSmsQuiz();
	// $db = new DBCon();
	// $db->connect();


	$_REQUEST['sender'] = "233543645688";//233247954362 

	$_REQUEST['receiver'] = "1413";

	$_REQUEST['text'] = "DS as6";//  quiz  

	if(isset($_REQUEST['sender']) && isset($_REQUEST['receiver']) && isset($_REQUEST['text'])) 
	{
		$db = mysqli_connect('localhost', 'root', '#~', 'di_asa');// #~
	    
	    $sender               = $db->real_escape_string($_REQUEST['sender']);
	    $receiver             = $db->real_escape_string($_REQUEST['receiver']);
	    $msg                  = $db->real_escape_string($_REQUEST['text']);
	    $get_clean_msg        = strtoupper(trim($msg)) ;
	    $received_date        = date("Y-m-d H:i:s");
	    $today                = getdate();


	    // if user send empty message....................
	    if($get_clean_msg === '' || empty($get_clean_msg)) 
	    {
	        $empty_msg =  "You sent an empty message please try again!";
	        $sendSms->send_response($sender, $empty_msg);
	        echo $empty_msg;
	        die();
	    }

	    #CHECK FOR THE USER INPUT*******************
        function get_prefix_type($user_mesage)
        {
            try 
            {
                $result = mb_substr($user_mesage, 0, 2);

                if(strtoupper(trim($result))   == 'ds'  || strtoupper(trim($result)) == 'DS')
                {
                    $prefix = 'DS';                       
                }

                return $prefix;
            } catch (Exception $exc) 
            {
                echo LINE . $exc->getMessage();
            }
        }


        $get_clean_user_msg = get_prefix_type($get_clean_msg);
        var_dump($get_clean_user_msg);
       


	    //vote process function..........................
	    function process_sms_vote($get_clean_user_msg, $sender, $get_clean_msg)
	    {
	    	include_once("SendSmsQuiz.php");
			
			$sendSms = new SendSmsQuiz();
			$db = mysqli_connect('localhost', 'root', '#~', 'di_asa');  #~

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $trac_info       = substr(str_shuffle($permitted_chars), 0, 22).time();

		    // $val          = uniqid('', false).rand(10000000, 100);
		    $external_t_id   = rand(100000000000, 1000);

		    $received_date   = date("Y-m-d H:i:s");

	    	$user_number     = $sendSms->prepare_number($sender);
	        var_dump($user_number);

	        $voter_value     = $sendSms->get_voter_value(trim($get_clean_msg));
	        var_dump($voter_value);


	    	//get help for user.............................
		    if($get_clean_msg == 'DS HELP') 
		    {
		        $help_response = "1. Send DS with the correct code or name of the person more to increase your nominee chance of winning the contest.\nPowered by mobilcontent.com.gh , visit us for Mobile App & USSD, VAS Services, Software etc.";

		        echo $help_response;
		        // Send response to user.!
		        $sendSms->send_response($sender, $help_response);

		        die();
		    }


		    $quest_save = $db->query("INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `number_of_votes`, `amount`, `when`) VALUES ('$trac_info', 'sms', '$voter_value', '$user_number', 'sms', '1', '0.60', '$received_date')");

	    	//get the total votes for the nominee............
		    $get_users_score = mysqli_query($db, "SELECT * FROM contestants WHERE contestant_num = '$voter_value' OR name = '$voter_value' LIMIT 1 ");
		    while($row = mysqli_fetch_assoc($get_users_score))
			{
				// var_dump($row); 
				$id              = $row['contestant_id'];
		        $name            = $row['name'];
		        $contestant_num  = $row['contestant_num'];
		        $number_of_votes = $row['num_of_votes'];
			}

		    $new_vote = $number_of_votes + 1;

			//process user votes..............................
			if(trim(strtoupper($name)) == trim(strtoupper($voter_value)) || trim(strtoupper($contestant_num)) == trim(strtoupper($voter_value))) 
			{
				//credit vote to nominee......................
				$update_user_id   = $db->query("UPDATE contestants SET num_of_votes = '$new_vote' WHERE contestant_id = '" . $id . "' ");

				//prompt user of successful vote..............
				$message = "Congrats\nYou have voted successfuly for : '".$name."'. Thank you.\nPowered by mobilcontent.com.gh , visit us for Mobile App & USSD, VAS Services, Software etc.";
				$success = $sendSms->send_response($sender, $message);
				

				var_dump($message);

				//log successful vote details.................
				$do_insert_vote = $db->query("INSERT IGNORE INTO diasa_pay(`response_code`, `amt_after_charges`, `transaction_id`, `client_reference`, `contestant_name`, `description`, `external_trans_id`, `amount`, `number_of_votes`, `charges`, `number`, `channel`, `device`, `when`) VALUES ('0000', '0.0700', '$trac_info', 'SMS_VOTE', '$name', 'sms payment for ".$name."', '$external_t_id', '0.60', '1', '0.0030', '$user_number', 'sms', 'sms', '$received_date')");
				var_dump($do_insert_vote);

				var_dump($success);
			}else
			{
				//prompt user of successful vote..............
				$fail_message = "Sorry\nYour vote failed for : '".$voter_value."'. Thank you.\nPowered by mobilcontent.com.gh , visit us for Mobile App & USSD, VAS Services, Software etc.";
				$fail = $sendSms->send_response($sender, $fail_message);

				var_dump($fail_message);
			}

	    }




	    // if($get_clean_msg == strtoupper('vote') || $get_clean_msg == strtoupper('votes')) 
	    // {
	    //     $get_user_scores = "You have total of '$subscriber_score' points.";

	    //     //send the total score of this user
	    //     $sendSms->send_response($sender, $get_user_scores);
	    //     echo $get_user_scores;

	    //     $db->sql("INSERT INTO vote_cms_sms(`from_numb`, `response`) VALUES ('$sender', '$msg')");
	    //    	die();
	    // }





	    #*******   process votes   **************************   
        if($get_clean_user_msg === 'DS') 
        {
            process_sms_vote($get_clean_user_msg, $sender, $get_clean_msg);  
        }else
        {
            //$sos_operation = get_sos_answers($get_clean_msg);
            die("Ooops!!!. You are not welcome in this empire. You've got to nock another door guy!!");
        }

	     
	}
?>
