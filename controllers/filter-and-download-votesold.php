<?php
include_once '../helpers/Database.php';
include_once '../helpers/HelperFunctions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
    $filterKey = $_GET['filterKey'];
	$output = "";

    $response = array();
    $votesArray = array();
    $allVotesArray = array();

    if (($startDate != "" || $endDate != "") && $filterKey != "") {
        //query to get the categories
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`gmb_pay`.`number_of_votes` FROM track_pay INNER JOIN gmb_pay ON `gmb_pay`.`transaction_id` = `track_pay`.`transac_id`  WHERE  (DATE(`gmb_pay`.`when`) BETWEEN '$startDate' AND '$endDate') AND `track_pay`.`number` LIKE '%$filterKey%' ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Cost","Text content","Number Of Votes","Date texted"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$date.'"'."\n";
            }

            $filename = "GMA_Vote_Data.csv";

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
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`gmb_pay`.`number_of_votes` FROM track_pay INNER JOIN gmb_pay ON `gmb_pay`.`transaction_id` = `track_pay`.`transac_id` WHERE `track_pay`.`number` LIKE '%$filterKey%' ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Cost","Text content","Number Of Votes","Date texted"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$date.'"'."\n";
            }

            $filename = "GMA_Vote_Data.csv";

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
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`gmb_pay`.`number_of_votes` FROM track_pay INNER JOIN gmb_pay ON `gmb_pay`.`transaction_id` = `track_pay`.`transac_id`  WHERE DATE(`gmb_pay`.`when`) BETWEEN '$startDate' AND '$endDate' ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Cost","Text content","Number Of Votes","Date texted"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$date.'"'."\n";
            }

            $filename = "GMA_Vote_Data.csv";

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
        $query = "SELECT `track_pay`.`number`,`track_pay`.`channel`,`track_pay`.`amount`,`track_pay`.`nominee_name`,`track_pay`.`when`,`gmb_pay`.`number_of_votes` FROM track_pay INNER JOIN gmb_pay ON `gmb_pay`.`transaction_id` = `track_pay`.`transac_id`  ORDER BY track_id DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Cost","Text content","Number Of Votes","Date texted"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$date.'"'."\n";
            }

            $filename = "GMA_Vote_Data.csv";

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