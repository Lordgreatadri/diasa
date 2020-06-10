<?php
// include_once '../helpers/Database.php';
include_once "db-config.php";
// include_once '../helpers/HelperFunctions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
    $filterKey = $_GET['rawcriteria'];
	$output = "";

    $response = array();
    $votesArray = array();
    $allVotesArray = array();

    if (($startDate != "" || $endDate != "") && $filterKey != "") {
        //query to get the categories
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`miss_gh_pay`.`number_of_votes`,`miss_gh_pay`.`device` FROM track_pay INNER JOIN miss_gh_pay ON `miss_gh_pay`.`transaction_id` = `track_pay`.`transac_id`  WHERE  (DATE(`miss_gh_pay`.`when`) BETWEEN '$startDate' AND '$endDate') AND `track_pay`.`number` = '$filterKey' AND response_code = '0000' ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['device'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "mssgh_Vote_Data.csv";

            header('Content-Type: application/csv');
            header('Content-Disposition: attachment, filename='.$filename);
            echo $output;

            mysqli_close($database);
        } else {
            
            mysqli_close($database);
            echo "<script>
                alert('no data found for date range');
                window.history.back();
            </script>";
        }
    } else if (($startDate == "" && $endDate == "") && $filterKey != "") {
        //query to get the categories
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`miss_gh_pay`.`number_of_votes`, `miss_gh_pay`.`device` FROM track_pay INNER JOIN miss_gh_pay ON `miss_gh_pay`.`transaction_id` = `track_pay`.`transac_id` WHERE `track_pay`.`number` = '$filterKey' AND response_code = '0000' ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['device'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "ms_Vote_Data.csv";

            header('Content-Type: application/csv');
            header('Content-Disposition: attachment, filename='.$filename);
            echo $output;

            mysqli_close($database);
        } else {
            
            mysqli_close($database);
            echo "<script>
                alert('no data found for keyword');
                window.history.back();
            </script>";
        }
    } else if (($startDate != "" && $endDate != "") && $filterKey == "") {
        //query to get the categories
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`miss_gh_pay`.`number_of_votes`, `miss_gh_pay`.`device` FROM track_pay INNER JOIN miss_gh_pay ON `miss_gh_pay`.`transaction_id` = `track_pay`.`transac_id` WHERE DATE(`miss_gh_pay`.`when`) BETWEEN '$startDate' AND '$endDate' AND response_code = '0000' ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                 $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['device'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "mgh_Vote_Data.csv";

            header('Content-Type: application/csv');
            header('Content-Disposition: attachment, filename='.$filename);
            echo $output;

            mysqli_close($database);
        } else {
            
            mysqli_close($database);
            echo "<script>
                alert('no data found for date range');
                window.history.back();
            </script>";
        }
    } else {
        //query to get the categories
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`miss_gh_pay`.`number_of_votes`, `miss_gh_pay`.`device` FROM track_pay INNER JOIN miss_gh_pay ON `miss_gh_pay`.`transaction_id` = `track_pay`.`transac_id` AND response_code = '0000'  ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['device'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "rawVote_Data.csv";

            header('Content-Type: application/csv');
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
}


?>