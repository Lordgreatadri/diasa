<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $response = array();
        $contestantsArray = array();
        $allContestantsResponse = array();

        $contestantNameArray = array();
        $contestantVoteArray = array();
        $contestantGraphRes = array();

        //query to get the category title
        $getContestantLeaderBoardQuery = "SELECT * FROM  channel_votes ORDER BY num_of_votes DESC";

        $getContestantLeaderBoardResult = mysqli_query($database, $getContestantLeaderBoardQuery);

        if (mysqli_num_rows($getContestantLeaderBoardResult) > 0) {
            
            while ($row = mysqli_fetch_assoc($getContestantLeaderBoardResult)) {
               $contestantsArray['id'] = $row['id'];
               $contestantsArray['name'] = $row['name'];
               $contestantsArray['num_of_votes'] = $row['num_of_votes'];
               $contestantsArray['thumbnail'] = $row['thumbnail'];
               $contestantsArray['ussd'] = $row['ussd'];
               $contestantsArray['web'] = $row['web'];
               $contestantsArray['app'] = $row['app'];
               $contestantsArray['sms'] = $row['sms'];
               $contestantsArray['date_stamp'] = $row['date_stamp']; 	 


               array_push($allContestantsResponse, $contestantsArray);
            }

            $response['success'] = true;
        	  $response["message"] = 'leaderboard got';
            $response["data"] = $allContestantsResponse;

            mysqli_close($database);

            header('Content-Type: application/json');
		        echo json_encode($response);
        } else {

            $response['success'] = true;
        	  $response["message"] = 'leaderboard not got';
            $response["data"] = array();

            mysqli_close($database);
            
            header('Content-Type: application/json');
		        echo json_encode($response);
        }
    }