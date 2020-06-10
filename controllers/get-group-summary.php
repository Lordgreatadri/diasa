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
        $getContestantLeaderBoardQuery = "SELECT * FROM contestants WHERE type = 'group' ORDER BY num_of_votes DESC";

        $getContestantLeaderBoardResult = mysqli_query($database, $getContestantLeaderBoardQuery);

        if (mysqli_num_rows($getContestantLeaderBoardResult) > 0) {
            
            while ($row = mysqli_fetch_assoc($getContestantLeaderBoardResult)) {
               $contestantsArray['contestant_id'] = $row['contestant_id'];
               $contestantsArray['name'] = $row['name'];
               $contestantsArray['num_of_votes'] = $row['num_of_votes'];
               $contestantsArray['thumbnail'] = $row['thumbnail'];
               $contestantsArray['contestant_region'] = $row['contestant_region'];
               $contestantsArray['contestant_num'] = $row['contestant_num'];
               $contestantsArray['status'] = $row['status'];
               $contestantsArray['height'] = $row['height'];
               $contestantsArray['complexion'] = $row['complexion'];
               $contestantsArray['age'] = $row['age']; 	 


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