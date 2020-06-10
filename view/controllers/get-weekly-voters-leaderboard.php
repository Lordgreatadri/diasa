<?php

include_once "db-config.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $response = array();
    $numberArray = array();
    $votesArray = array();
    $statArray = array();

    $dateOfSundayOfTheWeek = date('Y-m-d', strtotime('sunday last week'))." 22:00:00";

    $dateOfSundayOfNextWeek = date('Y-m-d', strtotime('sunday this week'))." 21:59:59";//$dateOfSundayOfNextWeek

    //query to get the categories  $dateOfSundayOfTheWeek 2019-09-23 21:59:59  |  2019-09-29 21:59:59
    $query = "SELECT DISTINCT `number` as voter_num, SUM(number_of_votes) as vote_num FROM `diasa_pay` WHERE response_code = '0000' AND `when` BETWEEN '$dateOfSundayOfTheWeek' AND '$dateOfSundayOfNextWeek'  GROUP BY `number` ORDER BY vote_num DESC LIMIT 5";

    $result = mysqli_query($database, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $voterPhoneNumber = $row['voter_num'];
            $numberOfVotes = $row['vote_num'];
            
            $voterPhoneNumber = $voterPhoneNumber.' ('.$numberOfVotes.' votes)';

            array_push($numberArray, $voterPhoneNumber);
            array_push($votesArray, $numberOfVotes);
        }

        $statArray['labels'] = $numberArray;
        $statArray['data'] = $votesArray;

        $response['success'] = true;
    	$response["message"] = 'stats got';
    	$response["data"] = $statArray;

        header('Content-Type: application/json');
	    echo json_encode($response);
    } else {
        $statArray['labels'] = array();
        $statArray['data'] = array();
        
    	$response['success'] = true;
        $response["message"] = 'No categories';
        $response["data"] = $statArray;

        mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
    }
}