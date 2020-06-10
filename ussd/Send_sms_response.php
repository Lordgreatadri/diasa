<?php

/**------------------------------------------------------------------------------------------------------------------------------------------------
 * @@Name:              sms_reponse
 
 * @@Author:            Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
 * @@Tell:              +233543645688/+233273593525
 
 * @Date:               2019-02-01 14:40:30
 * @Last Modified by:   Lordgreat - Adri Emmanuel
 * @Last Modified time: 2019-02-01 15:00:10

 * @Copyright:          MobileContent.Com Ltd <'owner'>
 
 * @Website:            https://mobilecontent.com.gh
 *-------------------------------------------------------------------------------------------------------------------------------------------------
 */

// error_reporting(1);

/**
 * 
 */
class send_ussd_sms //extends AnotherClass
{
	//sending sms to the user.........................., $message
	public function send_sms_response($user_number, $message)
	{
		try 
		{

			$myNew_value=null;
			$raw_number ='';//count($striped_num)
			if(strlen($user_number) == 10)
			{	//convert your string into array
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
			
			$msisdn = $raw_number;var_dump($msisdn);
			$message = urlencode($message);
			//http://54.163.215.114:2788/Receiver?User=mycloudhttp&Pass=M1C2T3&From=1400&To=$msisdn&Text=$message
	        $url = "http://54.163.215.114:2799/Receiver?User=test&Pass=test&From=1400&To=$msisdn&Text=$message";
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
	        	var_dump($result);
	        }
	        // echo json_encode($result);
	        curl_close($curl);
	        return $result;

		}catch (Exception $exc) 
		{
			
		}
	}


	//getting the channel type from use phone number used.............
	public function get_channel_type($voter_number)
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
}


