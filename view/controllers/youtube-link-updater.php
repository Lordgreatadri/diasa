<?php
include "db-config.php";

$update = "UPDATE live_stream SET `video_id` = '".$_POST['vid_id']."', `push_status` = 0"; 
if(mysqli_query($database, $update)){
   echo $_POST['vid_id'];
}else{
   
   echo "Oops!! Error";
}

?>