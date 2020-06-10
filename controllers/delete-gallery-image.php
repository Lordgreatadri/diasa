<?php
	include "db-config.php";
	$response = array();

	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$galleryId = $_POST['gallery_id'];
			$deleteImageDeleteQuery = "DELETE FROM gallery WHERE gallery_id = $galleryId";
			if (mysqli_query($database, $deleteImageDeleteQuery)) {
				$response['success'] = true;
	        	$response["message"] = 'images deleted successfully';

	        	mysqli_close($database);

		        header('Content-Type: application/json');
			    echo json_encode($response);
			} 
		}
	} catch(Exception $e) {
		$response['success'] = false;
    	$response["message"] = 'Error uploading image '.$e();

    	mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
	}