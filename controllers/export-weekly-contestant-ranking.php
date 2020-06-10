<?php  

include_once "db-config.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$output = "";

    $contestantNameArray = array();
    $contestantVoteArray = array();

    $dateOfSundayOfTheWeek = date('d-m-Y', strtotime('sunday this week'));
    $dateOfSundayOfNextWeek = date('d-m-Y', strtotime('sunday next week'));

    //query to get the categories
    $query = "SELECT name, num_of_votes FROM contestants_weekly WHERE status = 'not_evicted' ORDER BY num_of_votes DESC";

    $result = mysqli_query($database, $query);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $contestantName = $row['name'];
            $numberOfContestantVotes = $row['num_of_votes']| 0;

            
            array_push($contestantNameArray, $contestantName);
            array_push($contestantVoteArray, $numberOfContestantVotes);
        }



        $combinedValues = array_combine($contestantNameArray, $contestantVoteArray);
        arsort($combinedValues);

        $output .= "<table class='table' border='1'>
    					<tr>
    						<th>Contestant Weekly Vote From $dateOfSundayOfTheWeek To $dateOfSundayOfNextWeek</th>
    					</tr>
    					<tr>
    						<th>Contestant Name</th>
    						<th>Number Of Votes</th>
    					</tr>
    	";

        foreach ($combinedValues as $name => $votes) {
            $output .= "
            	<tr>
            		<td>$name</td>
            		<td>$votes</td>
            	</tr>
            ";
        }

        $output .= "</table>";

        mysqli_close($database);

        $filename = "missgh_weekly_contestants_ranking($dateOfSundayOfTheWeek - $dateOfSundayOfNextWeek).xls";

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment, filename='.$filename);
	    echo $output;
    } else {
        
        mysqli_close($database);
    	echo "<script>
    		alert('no data available');
    		window.history.back();
    	</script>";
    }
}

?>