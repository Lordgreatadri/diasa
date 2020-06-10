<?php
	include "db-config.php";
	$response = array();

	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$fileName = "GMB Gallery Image";
			$imageUrl = $_POST['galleryImage'];
			$insertImageDetailsQuery = "INSERT INTO gallery(gallery_title, gallery_image) VALUES('$fileName', '$imageUrl')";
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
    	$response["message"] = 'Error uploading image '.$e();

    	mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
	}