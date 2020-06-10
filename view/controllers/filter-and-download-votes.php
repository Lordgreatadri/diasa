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
        $query = "SELECT `channel`, `amount`, `contestant_name`, `when`, `number_of_votes`, `client_reference`, `amt_after_charges` FROM diasa_pay WHERE  (DATE(`diasa_pay`.`when`) BETWEEN '$startDate' AND '$endDate') AND  `number` LIKE '%$filterKey%' AND `diasa_pay`.`response_code` = '0000' ORDER BY `diasa_pay`.`when` ASC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"AmountAfterCharge","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = $row['amt_after_charges'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "dsas_Vote_Data.csv";

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
        $query = "SELECT `number`, `channel`, `amount`, `contestant_name`, `when`, `diasa_pay`.`number_of_votes`, `diasa_pay`.`client_reference`, `amt_after_charges` FROM  diasa_pay WHERE `diasa_pay`.`number` LIKE '%$filterKey%' AND response_code = '0000' ORDER BY `diasa_pay`.`when` ASC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"AmountAfterCharge","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                 $number = $row['amt_after_charges'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "ds_Vote_Data.csv";

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
        $query = "SELECT `amt_after_charges`, `channel`, `amount`, `contestant_name`, `when`,`diasa_pay`.`number_of_votes`, `diasa_pay`.`client_reference` FROM  diasa_pay  WHERE DATE(`diasa_pay`.`when`) BETWEEN '$startDate' AND '$endDate' AND `diasa_pay`.`response_code` = '0000' ORDER BY `diasa_pay`.`when` ASC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"AmountAfterCharge","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                 $number = $row['amt_after_charges'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "dis_Vote_Data.csv";

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
        $query = "SELECT `amt_after_charges`, `channel`, `amount`, `contestant_name`, `when`,`diasa_pay`.`number_of_votes`, `diasa_pay`.`client_reference` FROM diasa_pay WHEN `diasa_pay`.`response_code` = '0000'  ORDER BY `diasa_pay`.`when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"AmountAfterCharge","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                 $number = $row['amt_after_charges'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
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