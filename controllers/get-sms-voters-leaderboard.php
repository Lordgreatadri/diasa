<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $response = array();
        $numberArray = array();
        $votesArray = array();
        $statArray = array();

        //query to get the categories
        $query = "SELECT DISTINCT `number` as voter_num, SUM(number_of_votes) as vote_num FROM `miss_gh_pay` WHERE response_code = '0000' AND device = '' OR device = 'android' GROUP BY `number` ORDER BY vote_num DESC LIMIT 5";

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

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        } else {
            
        	$response['success'] = false;
            $response["message"] = 'No categories';

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        }
    }