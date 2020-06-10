<?php
	include "db-config.php";
	$response = array();

	try {
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$imageDescription = $_POST['galleryDescription'];
			$imageUrl = $_POST['downloadURL'];

			$checkImageAvailabilityQuery = "SELECT * FROM banner_gallery";
			$checkImageAvailabilityResult = mysqli_query($database, $checkImageAvailabilityQuery);

			if (mysqli_num_rows($checkImageAvailabilityResult) >= 5) {
				$response['success'] = false;
		    	$response["message"] = "Banner image gallery cannot contain more than 5 images";

		    	mysqli_close($database);

		        header('Content-Type: application/json');
			    echo json_encode($response);
			} else {
				$insertImageDetailsQuery = "INSERT INTO banner_gallery(gallery_image, gallery_description) VALUES('$imageUrl', '$imageDescription')";
				if (mysqli_query($database, $insertImageDetailsQuery)) {
					$response['success'] = true;
		        	$response["message"] = 'image uploaded successfully';

		        	mysqli_close($database);

			        header('Content-Type: application/json');
				    echo json_encode($response);
				} 
			}
		}
	} catch(Exception $e) {
		$response['success'] = false;
    	$response["message"] = 'Error uploading image '.$e();

    	mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
	}