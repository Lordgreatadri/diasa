<?php
    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
       $contestantId = $_POST['contestantId'];

       $query = "SELECT `name`, `status` FROM `contestants` WHERE `contestant_id` = $contestantId";

       $result = mysqli_query($database, $query);

        if (mysqli_num_rows($result) > 0) {
            $row  = mysqli_fetch_assoc($result);

            $name = $row['name'];
            $status = $row['status'];

            if($status == 'not_evicted') {
                $new_status = 'evicted';
                $update_query = "UPDATE `contestants` SET `status` = '$new_status', num_of_votes = '0', backlist = 'True' WHERE `contestant_id` = $contestantId";

                $update_query1 = "UPDATE `contestants` SET num_of_votes = '0' WHERE backlist = 'False'";
                
                $update_week = "UPDATE `contestants_weekly` SET `status` = '$new_status', num_of_votes = '0', backlist = 'True' WHERE `contestant_id` = $contestantId";
                $update_week1 = "UPDATE `contestants_weekly` SET num_of_votes = '0' WHERE backlist = 'False' ";
                
                $channel_votes = "UPDATE `channel_votes` SET `ussd` = '0', num_of_votes = '0', web = '0', sms = '0', app = '0' WHERE backlist = 'False' ";
                $channel_votes1 = "UPDATE `channel_votes` SET `ussd` = '0', num_of_votes = '0', web = '0', sms = '0', app = '0', backlist = 'True' WHERE `contestant_id` = $contestantId ";

                if(mysqli_query($database, $update_query)) {
                    mysqli_query($database, $update_query1);
                    mysqli_query($database, $update_week);
                    mysqli_query($database, $update_week1);
                    mysqli_query($database, $channel_votes);
                    mysqli_query($database, $channel_votes1);

                    $response['success'] = true;
                    $response["message"] = "status of '$name' changed to $new_status successfully";

                    mysqli_close($database);

                    header('Content-Type: application/json');
                    echo json_encode($response);
                }else
                {
                    $response['success'] = false;
                    $response["message"] = "status of '$name' could not be updated.";

                    mysqli_close($database);

                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } else if ($status == 'evicted') {
                $new_status = 'not_evicted';
                $update_query = "UPDATE `contestants` SET `status` = '$new_status' WHERE `contestant_id` = $contestantId";

                if (mysqli_query($database, $update_query)) {
                    $update_week = "UPDATE `contestants_weekly` SET `status` = '$new_status' WHERE `contestant_id` = $contestantId";
                    mysqli_query($database, $update_week);

                    $new_status = 'not evicted';
                    $response['success'] = true;
                    $response["message"] = "status of '$name' changed to '$new_status' successfully";

                    mysqli_close($database);
                    
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }else{
                    $response['success'] = false;
                    $response["message"] = "status of '$name' could not be updated.";

                    mysqli_close($database);

                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
            {
                $response['success'] = false;
                $response["message"] = 'some went wrong, status updated failed.';

                mysqli_close($database);

                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    }