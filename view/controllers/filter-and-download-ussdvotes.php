<?php
// include_once '../helpers/Database.php';
include_once "db-config.php";
// include_once '../helpers/HelperFunctions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $startDate = $_GET['ussdstartDate'];
    $endDate = $_GET['ussdendDate'];
    $filterKey = $_GET['ussdcriteria'];
    $output = "";

    $response = array();
    $votesArray = array();
    $allVotesArray = array();

    if (($startDate != "" || $endDate != "") && $filterKey != "") {
        //query to get the categories
        $query = "SELECT `channel`, `amount`, `contestant_name`, `when`, `number_of_votes`,  `client_reference` FROM  diasa_pay WHERE (DATE(`when`) BETWEEN '$startDate' AND '$endDate') AND `number` LIKE '%$filterKey%' OR `contestant_name` LIKE '%$filterKey%' AND `device` = 'ussd' ORDER BY  `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = $row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "sds_USSDvote_data.csv";

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
    } else if (($startDate == "" && $endDate == "") && $filterKey != "") 
    {
        //query to get the categories
        $query = "SELECT `channel`, `amount`, `contestant_name`, `when`, `number_of_votes`, `client_reference` FROM diasa_pay WHERE `number` LIKE '%$filterKey%' OR `contestant_name` LIKE '%$filterKey%' AND `device` = 'ussd' ORDER BY `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference",Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "ds_ussd-criteria_Data.csv";

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
        $query = "SELECT `channel`,`amount`,  `contestant_name`,`when`,`number_of_votes`, `client_reference`, `amt_after_charges` FROM  diasa_pay  WHERE (DATE(`when`) BETWEEN '$startDate' AND '$endDate') AND `device` = 'ussd' ORDER BY `when` DESC ";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                // $amt_after_charges = $row['amt_after_charges'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "dsussd_".$startDate."_to_".$endDate.".csv";

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
        $query = "SELECT `channel`, `amount`, `contestant_name`, `when`, `number_of_votes`, `client_reference` FROM  diasa_pay WHERE `device` = 'ussd' ORDER BY `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "ussd_vote_Data.csv";

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