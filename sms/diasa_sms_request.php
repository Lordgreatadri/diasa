<?php 
	
	error_reporting(0);

	/**
	 * 
	 */
	include_once("SendSmsQuiz.php");
	include_once("DBCon_quiz.php");
	
	$sendSms = new SendSmsQuiz();
	$db = new DBCon();
	$db->connect();


	// $_REQUEST['sender'] = "233543645688";//233247954362 233543645688

	// $_REQUEST['receiver'] = "1422";

	// $_REQUEST['text'] = "as9";//  quiz  

	if(isset($_REQUEST['sender']) && isset($_REQUEST['receiver']) && isset($_REQUEST['text'])) 
	{
	    
	    $sender               = $db->escapeString($_REQUEST['sender']);
	    $receiver             = $db->escapeString($_REQUEST['receiver']);
	    $msg                  = $db->escapeString($_REQUEST['text']);
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
			include_once("DBCon_quiz.php");
			
			$sendSms = new SendSmsQuiz();
			$db      = new DBCon();
			$db->connect();

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
		        $help_response = "1. Send DS with the correct code or name of the person more to increase your nominee chance of winning the contest (e.g DS AS16, OR DS 14 or GINA).\nPowered by www.mobilecontent.com.gh , visit us for Mobile App & USSD, Value Added Services, Software etc.";

		        echo $help_response;
		        // Send response to user.!
		        $sendSms->send_response($sender, $help_response);

		        die();
		    }

		    ##########################################################################################################
		    // pending possible user entries for asigned names such as AB, PM, BB, MD, AMA BA ........................
			$possible_input_values = array("A B", "A.B", "AB", "A,B", "PM", "P M","P.M", "BB", "B B", "B.B", "BB", "B,B", "MD", "M D", "M.D", "AMA BA", "AMA B.A", "AMA B A");

			//check if these values were found in use entry..........
			$code = 0;
			if(trim(in_array(strtoupper($voter_value), $possible_input_values))) 
			{	
				echo "Congrants, your input ". $voter_value." is found.\n";
				if(trim(strtoupper($voter_value)) == "PM" || trim(strtoupper($voter_value)) == "P M" || trim(strtoupper($voter_value)) == "P.M" || trim(strtoupper($voter_value)) == "P,M" ) {
					$code = 9;
				}elseif(trim(strtoupper($voter_value)) == "A B" || trim(strtoupper($voter_value)) == "A.B" || trim(strtoupper($voter_value)) == "AB" || trim(strtoupper($voter_value)) == "A,B" ) {
					$code = 32;
				}elseif(trim(strtoupper($voter_value)) == "BB" || trim(strtoupper($voter_value)) == "B B" || trim(strtoupper($voter_value)) == "B.B" || trim(strtoupper($voter_value)) == "B,B" ) {
					$code = 20;
				}elseif(trim(strtoupper($voter_value)) == "MD" || trim(strtoupper($voter_value)) == "M D" || trim(strtoupper($voter_value)) == "M.D" || trim(strtoupper($get_clean_msg)) == "M,D" ) {
					$code = 4;
				}elseif(trim(strtoupper($voter_value)) == "AMA BA" || trim(strtoupper($voter_value)) == "AMA B A" || trim(strtoupper($voter_value)) == "AMA B.A" || trim(strtoupper($voter_value)) == "AMA B,A" ) {
					$code = 24;
				}

				echo $code;

			}else
			{
				echo 'Invalid entry';
			}
			#################################################


		    $quest_save = $db->sql("INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `number_of_votes`, `amount`, `when`) VALUES ('$trac_info', 'sms', '$voter_value', '$user_number', 'sms', '1', '0.30', '$received_date')");


	    	//get the total votes for the nominee............ `status` = 'not_evicted' AND
		    $get_users_score = $db->sql("SELECT * FROM contestants WHERE contestant_num = '$voter_value' OR name = '$voter_value' OR contestant_id = '$voter_value' OR contestant_id = '$code' LIMIT 1 ");
		    $retrived_record = $db->getResult();

		    //loop through these records. 
		    foreach ($retrived_record as $subscriber_val) 
		    {
		        $id              = $subscriber_val['contestant_id'];
		        $name            = $subscriber_val['name'];
		        $contestant_num  = $subscriber_val['contestant_num'];
		        $number_of_votes = $subscriber_val['num_of_votes'];
		    }


		    $new_vote = $number_of_votes + 1;

		    $get_users_score1 = $db->sql("SELECT * FROM channel_votes WHERE  contestant_num = '$contestant_num' OR name = '$name' OR id = '$id' LIMIT 1 ");
		    $retrived_record1 = $db->getResult();

		    //loop through these records. 
		    foreach ($retrived_record1 as $subscriber_val1) 
		    {
		        $number_ofsms_votes = $subscriber_val1['sms'];
		    }

		    $sms_votes = $number_ofsms_votes + 1;

			//process user votes..............................
			if( trim(strtoupper($name)) == trim(strtoupper($voter_value)) || trim(strtoupper($contestant_num)) == trim(strtoupper($voter_value)) || trim(strtoupper($id)) == trim(strtoupper($voter_value)) || trim(strtoupper($id)) == trim(strtoupper($code))) 
			{
				//credit vote to nominee......................
				$update_user_id   = $db->sql("UPDATE contestants SET num_of_votes = '$new_vote' WHERE contestant_id = '" . $id . "' ");

				$update_user_vo   = $db->sql("UPDATE contestants_weekly SET num_of_votes = '$new_vote' WHERE contestant_id = '" . $id . "' ");

				$update_sms_vo   = $db->sql("UPDATE channel_votes SET num_of_votes = '$new_vote', sms = '$sms_votes'  WHERE id = '" . $id . "' OR contestant_num = '$contestant_num' ");

				//prompt user of successful vote..............
				$message = "Congrats\nYou have voted successfuly for : '".$name."'.\nPowered by www.mobilecontent.com.gh , visit us for Mobile App & USSD, Value Added Services, Software etc.";
				$success = $sendSms->send_response($sender, $message);
				
				var_dump($message);

				//log successful vote details.................
				$do_insert_vote = $db->sql("INSERT IGNORE INTO diasa_pay(`response_code`, `amt_after_charges`, `transaction_id`, `client_reference`, `contestant_name`, `description`, `external_trans_id`, `amount`, `number_of_votes`, `charges`, `number`, `channel`, `device`, `when`) VALUES ('0000', '0.0700', '$trac_info', 'SMS_VOTE', '$name', 'sms payment for ".$name."', '$external_t_id', '0.30', '1', '0.0030', '$user_number', 'sms', 'sms', '$received_date')");
				var_dump($do_insert_vote);

				// $when = date("Y-m-d H:i:s");
        		$diff_query = "INSERT INTO diff_sum_all(`transaction_id`, `amt_after_charges`, `client_reference`, `contestant_name`, `external_trans_id`, `number`, `channel`, `number_of_votes`, `amount`, `response_code`, `charges`, `description`) VALUES('".$trac_info."', '0.0700', 'SMS_VOTE', '".$name."', '".$external_t_id."', '".$user_number."', 'sms', '1', '0.30', '0000', '0.0030', 'sms payment for ".$name.")";// , '".$when."'    , `date_stamp`           
        		$track_diff= $db->sql($diff_query);
        		var_dump($track_diff);

				var_dump($success);
			}else
			{
				//prompt user of successful vote..............
				$fail_message = "Sorry\nYour entry was wrong. Text DS HELP for more info.\nPowered by www.mobilecontent.com.gh , visit us for Mobile App & USSD, Value Added Services, Software etc.";
				$fail = $sendSms->send_response($sender, $fail_message);

				var_dump($fail_message);


				$do_insert_vote = $db->sql("INSERT IGNORE INTO diasa_pay(`response_code`, `amt_after_charges`, `transaction_id`, `client_reference`, `contestant_name`, `description`, `external_trans_id`, `amount`, `number_of_votes`, `charges`, `number`, `channel`, `device`, `when`) VALUES ('9999', '0.0700', '$trac_info', 'SMS_VOTE', '$name', 'sms vailed vote - $get_clean_msg ', '$external_t_id', '0.30', '0', '0.0030', '$user_number', 'sms', 'sms', '$received_date')");
			}

	    }


	    //for none prefix users/////////
	    function none_prefixe_voters($sender, $get_clean_msg)
	    {

	    	include_once("SendSmsQuiz.php");
			include_once("DBCon_quiz.php");
			
			$sendSms = new SendSmsQuiz();
			$db      = new DBCon();
			$db->connect();

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $trac_info       = substr(str_shuffle($permitted_chars), 0, 22).time();

		    // $val          = uniqid('', false).rand(10000000, 100);
		    $external_t_id   = rand(100000000000, 1000);

		    $received_date   = date("Y-m-d H:i:s");

	    	$user_number     = $sendSms->prepare_number($sender);
	        var_dump($user_number);



	    	if($get_clean_msg == 'HELP') 
		    {
		        $help_response = "1. Send the correct code or name of the person more to increase your nominee chance of winning the contest (e.g AS16, OR 14 or GINA).\nPowered by www.mobilecontent.com.gh , visit us for Mobile App & USSD, Value Added Services, Software etc.";

		        echo $help_response;
		        // Send response to user.!
		        $sendSms->send_response($sender, $help_response);

		        die();
		    }


		    $quest_save = $db->sql("INSERT INTO track_pay(`transac_id`, `device`, `nominee_name`, `number`, `channel`, `number_of_votes`, `amount`, `when`) VALUES ('$trac_info', 'sms', '$get_clean_msg', '$user_number', 'sms', '1', '0.30', '$received_date')");

		    ##########################################################################################################
		    // pending possible user entries for asigned names such as AB, PM, BB, MD, AMA BA ........................
			$possible_input_values = array("A B", "A.B", "AB", "A,B", "PM", "P M","P.M", "BB", "B B", "B.B", "BB", "B,B", "MD", "M D", "M.D", "AMA BA", "AMA B.A", "AMA B A");

			//check if these values were found in use entry..........
			$code = 0;
			if(trim(in_array(strtoupper($get_clean_msg), $possible_input_values))) 
			{	
				echo "Congrants, your input ". $get_clean_msg." is found.\n";
				if(trim(strtoupper($get_clean_msg)) == "PM" || trim(strtoupper($get_clean_msg)) == "P M" || trim(strtoupper($get_clean_msg)) == "P.M" || trim(strtoupper($get_clean_msg)) == "P,M" ) {
					$code = 9;
				}elseif(trim(strtoupper($get_clean_msg)) == "A B" || trim(strtoupper($get_clean_msg)) == "A.B" || trim(strtoupper($get_clean_msg)) == "AB" || trim(strtoupper($get_clean_msg)) == "A,B" ) {
					$code = 32;
				}elseif(trim(strtoupper($get_clean_msg)) == "BB" || trim(strtoupper($get_clean_msg)) == "B B" || trim(strtoupper($get_clean_msg)) == "B.B" || trim(strtoupper($get_clean_msg)) == "B,B" ) {
					$code = 20;
				}elseif(trim(strtoupper($get_clean_msg)) == "MD" || trim(strtoupper($get_clean_msg)) == "M D" || trim(strtoupper($get_clean_msg)) == "M.D" || trim(strtoupper($get_clean_msg)) == "M,D" ) {
					$code = 4;
				}elseif(trim(strtoupper($get_clean_msg)) == "AMA BA" || trim(strtoupper($get_clean_msg)) == "AMA B A" || trim(strtoupper($get_clean_msg)) == "AMA B.A" || trim(strtoupper($get_clean_msg)) == "AMA B,A" ) {
					$code = 24;
				}

				echo $code;

			}else
			{
				echo 'Invalid entry';
			}
			#################################################

	    	//get the total votes for the nominee............ `status` = 'not_evicted' AND 
		    $get_users_score = $db->sql("SELECT * FROM contestants WHERE contestant_num = '$get_clean_msg' OR name = '$get_clean_msg' OR contestant_id = '$get_clean_msg' OR contestant_id = '$code' LIMIT 1 ");
		    $retrived_record = $db->getResult();

		    //loop through these records. 
		    foreach ($retrived_record as $subscriber_val) 
		    {
		        $id              = $subscriber_val['contestant_id'];
		        $name            = $subscriber_val['name'];
		        $contestant_num  = $subscriber_val['contestant_num'];
		        $number_of_votes = $subscriber_val['num_of_votes'];
		    }


		    $new_vote = $number_of_votes + 1;

		    $get_users_score1 = $db->sql("SELECT * FROM channel_votes WHERE  contestant_num = '$contestant_num' OR name = '$name' OR id = '$id' LIMIT 1 ");
		    $retrived_record1 = $db->getResult();

		    //loop through these records. 
		    foreach ($retrived_record1 as $subscriber_val1) 
		    {
		        $number_ofsms_votes = $subscriber_val1['sms'];
		    }

		    $sms_votes = $number_ofsms_votes + 1;

		    //process user votes..............................
			if(trim(strtoupper($name)) == trim(strtoupper($get_clean_msg)) || trim(strtoupper($contestant_num)) == trim(strtoupper($get_clean_msg )) || trim(strtoupper($id)) == trim(strtoupper($get_clean_msg))  || trim(strtoupper($id)) == trim(strtoupper($code))) 
			{
				//credit vote to nominee......................
				$update_user_id   = $db->sql("UPDATE contestants SET num_of_votes = '$new_vote' WHERE contestant_id = '" . $id . "' ");

				$update_user_vo   = $db->sql("UPDATE contestants_weekly SET num_of_votes = '$new_vote' WHERE contestant_id = '" . $id . "' ");

				$update_sms_vo   = $db->sql("UPDATE channel_votes SET num_of_votes = '$new_vote', sms = '$sms_votes'  WHERE id = '" . $id . "' OR contestant_num = '$contestant_num' ");

				//prompt user of successful vote..............
				$message = "Congrats\nYou have voted successfuly for : '".$name."'. Thank you.\nPowered by www.mobilecontent.com.gh , visit us for Mobile App & USSD, Value Added Services, Software etc.";
				$success = $sendSms->send_response($sender, $message);
				

				var_dump($message);


				//track successful votes.....................
				$do_insert_vote = $db->sql("INSERT IGNORE INTO diasa_pay(`response_code`, `amt_after_charges`, `transaction_id`, `client_reference`, `contestant_name`, `description`, `external_trans_id`, `amount`, `number_of_votes`, `charges`, `number`, `channel`, `device`, `when`) VALUES ('0000', '0.0700', '$trac_info', 'SMS_VOTE', '$name', 'sms payment for ".$name."', '$external_t_id', '0.30', '1', '0.0030', '$user_number', 'sms', 'sms', '$received_date')");
				var_dump($do_insert_vote);

				// $when = date("Y-m-d H:i:s");
        		$diff_query = "INSERT INTO diff_sum_all(`transaction_id`, `amt_after_charges`, `client_reference`, `contestant_name`, `external_trans_id`, `number`, `channel`, `number_of_votes`, `amount`, `response_code`, `charges`, `description`) VALUES('".$trac_info."', '0.0700', 'SMS_VOTE', '".$name."', '".$external_t_id."', '".$user_number."', 'sms', '1', '0.30', '0000', '0.0030', 'sms payment for ".$name."')";// , '".$when."'    , `date_stamp`           
        		$track_diff = $db->sql($diff_query);
        		var_dump($track_diff);

				var_dump($success);
			}else
			{
				//prompt user of successful vote..............
				$fail_message = "Sorry\nYour entry was wrong. Text HELP for more info.\nPowered by www.mobilecontent.com.gh , visit us for Mobile App & USSD, Value Added Services, Software etc.";
				$fail = $sendSms->send_response($sender, $fail_message);

				var_dump($fail_message);


				$do_insert_vote = $db->sql("INSERT IGNORE INTO diasa_pay(`response_code`, `amt_after_charges`, `transaction_id`, `client_reference`, `contestant_name`, `description`, `external_trans_id`, `amount`, `number_of_votes`, `charges`, `number`, `channel`, `device`, `when`) VALUES ('9999', '0.0700', '$trac_info', 'SMS_VOTE', '$name', 'sms failed vote - $get_clean_msg', '$external_t_id', '0.30', '0', '0.0030', '$user_number', 'sms', 'sms', '$received_date')");
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
        	none_prefixe_voters($sender, $get_clean_msg); 
            //$sos_operation = get_sos_answers($get_clean_msg);

        	//prompt user to use aproved inputs to vote..............
			// $fail_message = "Sorry\nEnter the DS with code or ID or name of the person to vote (e.g DS AS14, OR DS 14 or GINA).\nPowered by mobilcontent.com.gh , visit us for Mobile App & USSD, VAS Services, Software etc.";
			// $fail = $sendSms->send_response($sender, $fail_message);

   //          die("Ooops!!!. You are not welcome in this empire. You've got to nock another door guy!!");
        }

	     
	}
?>