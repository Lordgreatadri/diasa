<?php
set_time_limit(120);

include_once "db-config.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $response = array();
    $contestantsArray = array();
    $allContestantsResponse = array();

    $contestantNameArray = array();
    $contestantVoteArray = array();
    $contestantGraphRes = array();

    // get the date of the sunday of this week
    $dateOfSundayOfTheWeek = date('Y-m-d', strtotime('sunday last week'))." 22:00:00";

    // get the date of the sunday of next week
    //get today's date
    $dateOfSundayOfNextWeek = date('Y-m-d', strtotime('sunday this week'))." 21:59:59";

    $clearWeeklyContestantVotesTableQuery = "DELETE FROM weekly_contestant_rank";

    if (mysqli_query($database, $clearWeeklyContestantVotesTableQuery)) {

	    //query to get the category title
	    $getContestantsNamesQuery = "SELECT name FROM contestants WHERE status = 'not_evicted' ORDER BY num_of_votes DESC";

	    $getContestantsNamesResult = mysqli_query($database, $getContestantsNamesQuery);

	    if (mysqli_num_rows($getContestantsNamesResult) > 0) {
	        
	        while ($getContestantsNamesRow = mysqli_fetch_assoc($getContestantsNamesResult)) {
	            $contestantName = $getContestantsNamesRow['name'];

	            // get the transaction id for each successful transaction
	            $getNumberOfVotesQuery = "SELECT SUM(`number_of_votes`) AS num_of_votes FROM `miss_gh_pay` WHERE `response_code` = '0000' AND `transaction_id` IN (SELECT `transac_id` FROM `track_pay` WHERE `nominee_name` = '".$contestantName."' AND `when` BETWEEN '".$dateOfSundayOfTheWeek."' AND '".$dateOfSundayOfNextWeek."')";

	            $getNumberOfVotesResult = mysqli_query($database, $getNumberOfVotesQuery);
	            $getNumberOfVotesRow = mysqli_fetch_assoc($getNumberOfVotesResult);
	            $numberOfContestantVotes = $getNumberOfVotesRow['num_of_votes'] | 0; 


	           //array_push($allContestantsResponse, $contestantsArray);

	           array_push($contestantNameArray, $contestantName);
	           array_push($contestantVoteArray, $numberOfContestantVotes);

	        }

	        $nameArray = array();
	        $voteArray = array();
	        $newGraphRes = array();

	        $combinedValues = array_combine($contestantNameArray, $contestantVoteArray);
	        arsort($combinedValues);

	        foreach ($combinedValues as $name => $votes) {
	            $insertWeeklyContestantRankData = "INSERT INTO weekly_contestant_rank(contestant_name, number_of_votes) VALUES('$name', $votes)";
	            mysqli_query($database, $insertWeeklyContestantRankData);
	        }

	        mysqli_close($database);
	    }
	}
}