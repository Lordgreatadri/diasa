<?php
// include_once '../helpers/Database.php';
include_once "db-config.php";
// include_once '../helpers/HelperFunctions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$startDate = $_GET['onlinestartDate'];
	$endDate = $_GET['onlineendDate'];
    $filterKey = $_GET['onlinecriteria'];
	$output = "";

    $response = array();
    $votesArray = array();
    $allVotesArray = array();

    if (($startDate != "" || $endDate != "") && $filterKey != "") {
        //query to get the categories
        $query = "SELECT `t`.`number`,`t`.`channel`,`t`.`amount`,`t`.`nominee_name`,`t`.`when`,`m`.`number_of_votes`, `m`.`client_reference` FROM track_pay t INNER JOIN diasa_pay m ON `m`.`transaction_id` = `t`.`transac_id` WHERE (DATE(`m`.`when`) BETWEEN '$startDate' AND '$endDate') AND `t`.`number` LIKE '%$filterKey%' OR `t`.`nominee_name` LIKE '%$filterKey%' AND `m`.`device` = 'web' ORDER BY `m`.`when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "dss_onlinevote_data.csv";

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
        $query = "SELECT `t`.`number`,`t`.`channel`,`t`.`amount`,`t`.`nominee_name`,`t`.`when`,`m`.`number_of_votes`, `m`.`client_reference` FROM track_pay t INNER JOIN diasa_pay m ON `m`.`transaction_id` = `t`.`transac_id` WHERE `t`.`number` LIKE '%$filterKey%' OR `t`.`nominee_name` LIKE '%$filterKey%' AND `m`.`device` = 'web' ORDER BY `m`.`when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference",Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['number'];
                $channel = $row['channel'];
                $amount = $row['amount'];
                $nominee = $row['nominee_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "ds_online-criteria_Data.csv";

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
        $query = "SELECT `channel`, `amount`, `amt_after_charges`, `contestant_name`, `when`, `number_of_votes`,  `client_reference` FROM diasa_pay WHERE (DATE(`when`) BETWEEN '$startDate' AND '$endDate') AND `device` = 'web' ORDER BY `when` DESC ";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed",  "Contestant Name","Number Of Votes","Reference","Date"'."\n";

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

            $filename = "DISonline_".$startDate."_to_".$endDate.".csv";

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
        $query = "SELECT `channel`, `amount`, `amt_after_charges`, `contestant_name`, `when`, `number_of_votes`,  `client_reference` FROM diasa_pay WHERE `device` = 'web' ORDER BY `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed", "amt_after_charges", "Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $channel = $row['channel'];
                $amount = $row['amount'];
                $amt_after_charges = $row['amt_after_charges'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['client_reference'];
                $date = $row['when'];

                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$amt_after_charges.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "online_vote_Data.csv";

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