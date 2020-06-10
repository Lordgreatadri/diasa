<?php
// include_once '../helpers/Database.php';
include_once "controllers/db-config.php";
// include_once '../helpers/HelperFunctions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') 
{
	
	$output = "";

    $response = array();
    $votesArray = array();
    $allVotesArray = array();


        //query to get the categories
        $query = "SELECT `contestant_name` FROM diasa_pay WHERE `response_code` = '0000' AND `channel` = 'sms' ORDER BY `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= ''."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $nominee = $row['contestant_name'];

                $output .= $nominee.",";
            }

            $filename = "contestants_SMScrawlers.txt";

            header('Content-Type: application/txt');
            header('Content-Disposition: attachment, filename='.$filename);
            echo $output;

            mysqli_close($database);
        } else {
            
            mysqli_close($database);
            echo "<script>
                alert('no data found');
                window.history.back();
            </script>";
        }

}


?>