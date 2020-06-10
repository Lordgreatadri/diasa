<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

        $response = array();
        $contestantsArray = array();
        $allContestantsResponse = array();

        $contestantNameArray = array();
        $contestantVoteArray = array();
        $contestantGraphRes = array();

        // get the date of the sunday of this week
        $dateOfSundayOfTheWeek = date('Y-m-d', strtotime('sunday this week'))." 22:00:00";

        // get the date of the sunday of next week
        //get today's date
        $dateOfSundayOfNextWeek = date('Y-m-d', strtotime('sunday next week'))." 21:59:59";

        //query to get the category title
        $getContestantsNamesQuery = "SELECT name, num_of_votes FROM contestants_weekly WHERE type = 'group' ORDER BY num_of_votes DESC";

        $getContestantsNamesResult = mysqli_query($database, $getContestantsNamesQuery);

        if (mysqli_num_rows($getContestantsNamesResult) > 0) {
            
            while ($getContestantsNamesRow = mysqli_fetch_assoc($getContestantsNamesResult)) {
                $contestantName = $getContestantsNamesRow['name'];
                $numberOfContestantVotes = $getContestantsNamesRow['num_of_votes']| 0;

                
                array_push($contestantNameArray, $contestantName);
                array_push($contestantVoteArray, $numberOfContestantVotes);
            }



            $nameArray = array();
            $voteArray = array();
            $newGraphRes = array();

            $combinedValues = array_combine($contestantNameArray, $contestantVoteArray);
            arsort($combinedValues);

            foreach ($combinedValues as $name => $votes) {
                array_push($nameArray, $name);
                array_push($voteArray, $votes);
            }

            $contestantGraphRes['labels'] = $nameArray;
            $contestantGraphRes['data'] = $voteArray;

            // $newGraphRes['labels'] = $nameArray;
            // $newGraphRes['data'] = $voteArray;

            $response['success'] = true;
            $response["message"] = 'leaderboard got';
            $response["graph"] = $contestantGraphRes;
            // $response["new"] = $newGraphRes;

            mysqli_close($database);

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $contestantGraphRes['labels'] = array();
            $contestantGraphRes['data'] = array();

            $response['success'] = true;
            $response["message"] = 'leaderboard not got';
            $response["graph"] = $contestantGraphRes;
            
            mysqli_close($database);

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }