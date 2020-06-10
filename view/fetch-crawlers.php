<?php 
/**------------------------------------------------------------------------------------------------------------------------------------------------
 * @@Name: 				filter-votes
 
 * @@Author: 			Lordgreat -  Adri Emmanuel <'rexmerlo@gmail.com'>
 * @@Tell:				+233543645688/+233273593525

 * @Date:   			2019-02-18 02:30:30
 * @Last Modified by:   Lordgreat - Adri Emmanuel
 * @Last Modified time: 2019-02-18 03:35:10

 * @Copyright: 			MobileContent.Com Ltd <'owner'>
 
 * @Website: 			https://mobilecontent.com.gh
 *-------------------------------------------------------------------------------------------------------------------------------------------------
 */

	session_start();
	// include 'configure.php';
	include_once "controllers/db-config.php";
	if($_SERVER['REQUEST_METHOD'] == 'GET') 
	{
	    $startDate = $_GET['startDate'];
	    $endDate = $_GET['endDate'];
	    $output = "";

	    $response = array();
	    $votesArray = array();
	    $allVotesArray = array();

	    if ($startDate != "" || $endDate != "") {

	         $sql = "SELECT contestant_name FROM  diasa_pay WHERE (DATE(`when`) BETWEEN '$startDate' AND '$endDate') AND response_code = '0000'";
	        $result = mysqli_query($database, $sql);

	        if (mysqli_num_rows($result) > 0) {
	            $output .= ''."\n";

	            while ($row = mysqli_fetch_assoc($result)) {
	                $nominee = $row['contestant_name'];

	                $output .= $nominee.",";
	            }

	            $filename = "'$startDate'_-_'$endDate'_diasaDatasort.txt";

	            header('Content-Type: application/txt');
	            header('Content-Disposition: attachment, filename='.$filename);
	            echo $output;

	            mysqli_close($database);
	        } else {
	            
	            mysqli_close($database);
	            echo "<script>
	                alert('no data found');
	                window.history.back();
	            </script>";
	        }
	    } else //if (($startDate == "" && $endDate == "")) 
	    {
	        $sql = "SELECT contestant_name FROM  diasa_pay WHERE  response_code = '0000'  ORDER BY `when` DESC ";
	        $result = mysqli_query($database, $sql);

	        if (mysqli_num_rows($result) > 0) {
	            $output .= ''."\n";

	            while ($row = mysqli_fetch_assoc($result)) {
	                $nominee = $row['contestant_name'];

	                $output .= $nominee.",";
	            }

	            $filename = "contestants_RAWcrawlers.txt";

	            header('Content-Type: application/txt');
	            header('Content-Disposition: attachment, filename='.$filename);
	            echo $output;

	            mysqli_close($database);
	        } else {
	            
	            mysqli_close($database);
	            echo "<script>
	                alert('no data found');
	                window.history.back();
	            </script>";
	        }
	    }
}