<?php

include_once "db-config.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $response = array();
    $contestantArray = array();
    $galleryArray = array();
    $allContestantsArray = array();

    //query to get the category title
    $getContestantsQuery = "SELECT DISTINCT contestant_id FROM contestant_gallery";

    $getContestantsResult = mysqli_query($database, $getContestantsQuery);

    if (mysqli_num_rows($getContestantsResult) > 0) {
        
        while ($row = mysqli_fetch_assoc($getContestantsResult)) {
        	$contestantId = $row['contestant_id'];

        	$getContestantNameQuery = "SELECT name FROM contestants WHERE contestant_id = $contestantId";
        	$getContestantNameResult = mysqli_query($database, $getContestantNameQuery);
        	$getContestantNameRow = mysqli_fetch_assoc($getContestantNameResult);
        	$contestantName = $getContestantNameRow['name'];


        	$getContestantImagesQuery = "SELECT contestant_photo_url FROM contestant_gallery WHERE contestant_id = $contestantId";
        	$getContestantImagesResult = mysqli_query($database, $getContestantImagesQuery);

        	if (mysqli_num_rows($getContestantImagesResult) > 0) {
        		while ( $getContestantImagesRow = mysqli_fetch_assoc($getContestantImagesResult)) {
        			array_push($galleryArray, $getContestantImagesRow['contestant_photo_url']);
        		}
        	}


        	$contestantArray['id'] = $contestantId;
        	$contestantArray['name'] = $contestantName;
           	$contestantArray['images'] = $galleryArray;

            array_push($allContestantsArray, $contestantArray);
            $galleryArray = array();
        }

        $response['success'] = true;
    	$response["message"] = 'contestants gallery images got';
        $response["data"] = $allContestantsArray;

        mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
    } else {

        $response['success'] = true;
    	$response["message"] = 'contestants gallery images got';
        $response["data"] = array();

        mysqli_close($database);
        
        header('Content-Type: application/json');
	    echo json_encode($response);
    }
}