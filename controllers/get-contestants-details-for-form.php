<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $response = array();
        $contestantsArray = array();
        $allContestantsResponse = array();

        //query to get the category title
        $getContestantLeaderBoardQuery = "SELECT contestant_id, name FROM  contestants ORDER BY name ASC";

        $getContestantLeaderBoardResult = mysqli_query($database, $getContestantLeaderBoardQuery);

        if (mysqli_num_rows($getContestantLeaderBoardResult) > 0) {
            
            while ($row = mysqli_fetch_assoc($getContestantLeaderBoardResult)) {
               $contestantsArray['id'] = $row['contestant_id'];
               $contestantsArray['name'] = $row['name'];


               array_push($allContestantsResponse, $contestantsArray);
            }

            $response['success'] = true;
        	 $response["message"] = 'contestants got';
            $response["data"] = $allContestantsResponse;

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        } else {

            $response['success'] = true;
        	$response["message"] = 'contestants not got';
            $response["data"] = array();
            
            mysqli_close($database);
            
            header('Content-Type: application/json');
		    echo json_encode($response);
        }
    }