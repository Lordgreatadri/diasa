<?php
set_time_limit(0);

$conn = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'gmb');
$query_get_userId = mysqli_query($conn, "SELECT  `signal_id` FROM signal ");
$query_live_video = mysqli_query($conn, "SELECT  `video_id`, `push_status` FROM live_stream LIMIT 1");

$live_video = "";
$signal_id = "";

$player_ids = array();

$row2 = mysqli_fetch_assoc($query_live_video);

$live_video = $row2['video_id'];
$push_status = $row2['push_status'];


if($push_status == 0){

	while($row = mysqli_fetch_assoc($query_get_userId)){

	    $signal_id = $row['signal_id'];
	    
	    array_push($player_ids, $signal_id);
	}


	$content = array("en" => $prediction_type.' GMB is Live now ');
			
	$fields = array(
		'app_id' => "dd83a4a3-1f49-417c-a164-1909c3016197",
		'include_player_ids' =>  $player_ids,//array($signal_id),
		'data' => array(

				    "live_video" => "$live_video"),

		'contents' => $content
	);
	
	$fields = json_encode($fields);
	print("\nJSON sent:\n");
	print($fields);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
											   'Authorization: Basic NTM2ODRhM2QtNWViOC00MDgxLTg2MmUtODhiNjYxNzQxMzAw'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	$response = curl_exec($ch);
	curl_close($ch);

	mysqli_query($conn, "UPDATE live_stream SET push_status = 1");
	
	return $response;
}
		
?>
