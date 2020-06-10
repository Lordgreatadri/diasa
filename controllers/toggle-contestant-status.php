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

            if ($status == 'not_evicted') {
                $new_status = 'evicted';
                $update_query = "UPDATE `contestants` SET `status` = '$new_status' WHERE `contestant_id` = $contestantId";

                $update_query1 = "UPDATE `contestants_weekly` SET `status` = '$new_status' WHERE `contestant_id` = $contestantId";
                
                if (mysqli_query($database, $update_query)) {
                    $response['success'] = true;
                    $response["message"] = 'status of $name changed to $new_status successfully';

                    mysqli_query($database, $update_query1);

                    mysqli_close($database);

                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            } else if ($status == 'evicted') {
                $new_status = 'not_evicted';
                $update_query = "UPDATE `contestants` SET `status` = '$new_status' WHERE `contestant_id` = $contestantId";

                $update_query11 = "UPDATE `contestants_weekly` SET `status` = '$new_status' WHERE `contestant_id` = $contestantId";

                if (mysqli_query($database, $update_query)) {
                    $new_status = 'not evicted';
                    $response['success'] = true;
                    $response["message"] = 'status of $name changed to $new_status successfully';

                    mysqli_query($database, $update_query11);

                    mysqli_close($database);
                    
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
        }
    }