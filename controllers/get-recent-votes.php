<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $response = array();
        $votesArray = array();
        $allVotesArray = array();

        //query to get the categories
        // $query = "SELECT * FROM `track_pay` ORDER BY track_id DESC LIMIT 50";

        $query = "SELECT `t`.`number`,`t`.`channel`, `m`.`device` AS medium,`t`.`amount`,`t`.`nominee_name`,`m`.`when` FROM track_pay t INNER JOIN miss_gh_pay m ON `m`.`transaction_id` = `t`.`transac_id` WHERE response_code = '0000' ORDER BY `m`.`when` DESC LIMIT 0,225";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $votesArray['number'] = $row['number'];
                $votesArray['channel'] = $row['medium'];
                $votesArray['amount'] = $row['amount'];
                $votesArray['nominee_name'] = $row['nominee_name'];
                $votesArray['when'] = $row['when'];

                array_push($allVotesArray, $votesArray);
            }

            $response['success'] = true;
        	$response["message"] = 'stats got';
        	$response["data"] = $allVotesArray;

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        } else {
            
        	$response['success'] = false;
            $response["message"] = 'No stats';

            mysqli_close($database);

            header('Content-Type: application/json');
		    echo json_encode($response);
        }
    }