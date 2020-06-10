<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $response = array();
        $votesArray = array();
        $allVotesArray = array();

        //query to get the categories
        // $query = "SELECT * FROM `track_pay` ORDER BY track_id DESC LIMIT 50";

        $query = "SELECT `number`, `channel`, `device`, `amount`, `contestant_name`, `when` FROM diasa_pay WHERE channel = 'momo' AND response_code = '0000' ORDER BY `when` DESC LIMIT 0,1000";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $votesArray['number'] = $row['number'];
                $votesArray['channel'] = $row['channel'];
                $votesArray['device'] = $row['device'];
                $votesArray['amount'] = $row['amount'];
                $votesArray['nominee_name'] = $row['contestant_name'];
                $votesArray['when'] = $row['when'];

                array_push($allVotesArray, $votesArray);
            }

            $response['success'] = true;
        	$response["message"] = 'status got';
        	$response["data"] = $allVotesArray;

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        } else {
            
        	$response['success'] = false;
            $response["message"] = 'No status';

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        }
    }