<?php

include_once "db-config.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $response = array();
    $galleryArray = array();
    $allGalleryArray = array();

    //query to get the category title
    $getGalleryImagesQuery = "SELECT * FROM  gallery ORDER BY gallery_id DESC";

    $getGalleryImagesResult = mysqli_query($database, $getGalleryImagesQuery);

    if (mysqli_num_rows($getGalleryImagesResult) > 0) {
        
        while ($row = mysqli_fetch_assoc($getGalleryImagesResult)) {
           $galleryArray['gallery_id'] = $row['gallery_id'];
           $galleryArray['gallery_title'] = $row['gallery_title'];
           $galleryArray['gallery_image'] = $row['gallery_image'];

           array_push($allGalleryArray, $galleryArray);
        }

        $response['success'] = true;
    	$response["message"] = 'gallery images got';
        $response["data"] = $allGalleryArray;

        mysqli_close($database);

        header('Content-Type: application/json');
	    echo json_encode($response);
    } else {

        $response['success'] = true;
    	$response["message"] = 'gallery images got';
        $response["data"] = array();
        
        mysqli_close($database);
        
        header('Content-Type: application/json');
	    echo json_encode($response);
    }
}