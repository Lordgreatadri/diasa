<?php
// get-failed-votes.php
include_once "controllers/db-config.php";
// $query = "SELECT `t`.`nominee_name`, `t`.`number_of_votes`, `t`.`device`, `t`.`number`, `t`.`channel`, `t`.`amount`, `t`.`when`  FROM track_pay t INNER JOIN diasa_pay m ON `m`.`transaction_id` = `t`.`transac_id` WHERE `m`.`response_code` != '0000' AND `m`.`channel` != 'sms' ORDER BY `m`.`when` DESC";

$query = "SELECT `contestant_name`, `description`, `phone_number`, `channel_type`, `amount`, `date_stamp`  FROM temp_monitor_payment WHERE `res_code` != '0000' ORDER BY `date_stamp` DESC";

        $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $output .= '"Mobile number","Payment channel", "Amount Billed","Contestant Name","Number Of Votes", "Description", "Date"'."\n";

            while ($row = mysqli_fetch_assoc($result)) {
                $number = (string)$row['phone_number'];
                $channel = $row['channel_type'];
                $amount = $row['amount'];
                $nominee = $row['contestant_name'];
                $number_of_votes = $row['number_of_votes'];
                // $client_reference = $row['device'];
                $description = $row['description'];
                $date = $row['date_stamp'];

                $output .= '"'.$number.'",'.'"'.$channel.'",'.'"'.$amount.'",'.'"'.$nominee.'",'.'"'.$number_of_votes.'",'.'"'.$description.'",'.'"'.$date.'"'."\n";
            }

            $filename = "failed_USSDvote_Data.csv";

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
