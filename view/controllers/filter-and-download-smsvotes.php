<?php
// include_once '../helpers/Database.php';
include_once "db-config.php";
// include_once '../helpers/HelperFunctions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $startDate = $_GET['SMSstartDate'];
    $endDate = $_GET['SMSendDate'];
    $filterKey = $_GET['SMScriteria'];
    $output = "";

    $response = array();
    $votesArray = array();
    $allVotesArray = array();

    if (($startDate != "" || $endDate != "") && $filterKey != "") {
        //query to get the categories
        $query = "SELECT `number` ,contestant_name, device, number_of_votes, amount, description, `when` as date_stamp FROM diasa_pay WHERE (DATE(`when`) BETWEEN '$startDate' AND '$endDate') AND `number` LIKE '%$filterKey%' OR `contestant_name` LIKE '%$filterKey%' AND device = 'sms' ORDER BY `when` DESC ";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = $row['number'];
                $channel = $row['device'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $description = $row['description'];
                $date = $row['date_stamp'];
// '"'.$number.'",'.
                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$description.'",'.'"'.$date.'"'."\n";
            }

            $filename = "sms_smsvote_data.csv";

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
        $query = "SELECT `number` ,contestant_name, device, number_of_votes, amount, description, `when`  FROM diasa_pay WHERE `number` LIKE '%$filterKey%' OR `contestant_name` LIKE '%$filterKey%' AND device = 'sms' ORDER BY `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference",Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = (string)$row['number'];
                $channel = $row['device'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['description'];
                $date = $row['when'];
// '"'.$number.'",'.
                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "ds_sms-criteria_Data.csv";

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
        $query = "SELECT `number` ,contestant_name, device, number_of_votes, amount, description, `when`  FROM diasa_pay WHERE (DATE(`when`) BETWEEN '$startDate' AND '$endDate') AND `device` = 'sms' ORDER BY `when` DESC ";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = (string)$row['number'];
                $channel = $row['device'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['description'];
                $date = $row['when'];
// '"'.$number.'",'.
                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "dssms_".$startDate."_to_".$endDate.".csv";

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
        $query = "SELECT `number` ,contestant_name, device, number_of_votes, amount, description, `when`  FROM diasa_pay WHERE device = 'sms' ORDER BY `when` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Payment channel", "Amount Billed","Contestant Name","Number Of Votes","Reference","Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                // $number = (string)$row['number'];
                $channel = $row['device'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                $client_reference = $row['description'];
                $date = $row['when'];
// '"'.$number.'",'.
                $output .= '"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$client_reference.'",'.'"'.$date.'"'."\n";
            }

            $filename = "rawsms_vote_Data.csv";

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