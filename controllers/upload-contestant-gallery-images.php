<?php
	include "db-config.php";
	$response = array();

	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$contestantId = $_POST['contestantId'];
			$downloadURL = $_POST['downloadURL'];

			$insertImageDetailsQuery = "INSERT INTO contestant_gallery(contestant_id, contestant_photo_url) VALUES($contestantId, '$downloadURL')";

			if (mysqli_query($database, $insertImageDetailsQuery)) {
				$response['success'] = true;
	        	$response["message"] = 'images uploaded successfully';
				mysqli_close($database);

	            header('Content-Type: application/json');
			    echo json_encode($response);
			}
		}
	} catch(Exception $e) {
		$response['success'] = false;
    	$response["message"] = 'Error uploading image '.$e->getMessage();

    	mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
	}