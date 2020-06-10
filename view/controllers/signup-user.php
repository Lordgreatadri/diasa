<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = mysqli_real_escape_string($database, trim($_POST['username']));
        $password = mysqli_real_escape_string($database, trim($_POST['password']));

        // query to check the existence of username
        $checkUsernameQuery = "SELECT * FROM dashboard_users WHERE username = '$username'";

        $checkUsernameResult = mysqli_query($database, $checkUsernameQuery);
        $checkUsernameRow = mysqli_fetch_assoc($checkUsernameResult);

        if ($checkUsernameRow['username'] == $username) {
            $response['success'] = false;
        	$response["message"] = 'username already exists';

            header('Content-Type: application/json');
		    echo json_encode($response);
        } else {
            $hashedPassword = md5($password);

            // query to insert the user into the database
            $insertUserQuery = "INSERT INTO dashboard_users(username,user_password) VALUES('$username', '$hashedPassword')";

            if (mysqli_query($database, $insertUserQuery)) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['UserLoggedIn'] = true;
                
                $response['success'] = true;
                $response["message"] = 'signup successful';

                mysqli_close($database);

                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response['success'] = true;
                $response["message"] = 'could not signup. Please try again';

                mysqli_close($database);

                header('Content-Type: application/json');
                echo json_encode($response);
            }
            
        }
        
    }