<?php

    include_once "db-config.php";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $response = array();
        $statsArray = array();

        //query to get the total number contestants
        $getNumberOfContestantsQuery = "SELECT * FROM contestants";
        $getNumberOfContestantsResult = mysqli_query($database, $getNumberOfContestantsQuery);
        $getNumberOfContestants  = mysqli_num_rows($getNumberOfContestantsResult) | 0;

        // query to get the total number of evicted contestants
        $getNumberOfEvictedContestantsQuery = "SELECT * FROM contestants WHERE status ='evicted'";
        $getNumberOfEvictedContestantsResult = mysqli_query($database, $getNumberOfEvictedContestantsQuery);
        $getNumberOfEvictedContestants  = mysqli_num_rows($getNumberOfEvictedContestantsResult) | 0;

        // query to get the total number of remaining contestants
        $getNumberOfRemainingContestantsQuery = "SELECT * FROM contestants WHERE status ='not_evicted'";
        $getNumberOfRemainingContestantsResult = mysqli_query($database, $getNumberOfRemainingContestantsQuery);
        $getNumberOfRemainingContestants  = mysqli_num_rows($getNumberOfRemainingContestantsResult) | 0;

        // // query to get the total number of valid contestant votes
        // $getNumberOfVotesQuery = "SELECT SUM(num_of_votes) AS num_of_valid_votes FROM contestants";
        // $getNumberOfVotesResult = mysqli_query($database, $getNumberOfVotesQuery);
        // $row = mysqli_fetch_assoc($getNumberOfVotesResult);
        // $getNumberOfValidVotes  = $row['num_of_valid_votes']| 0;


        // query to get the total number of valid contestant votes
        $getNumberOfVotesQuery = "SELECT SUM(number_of_votes) AS num_of_valid_votes FROM `diasa_pay` WHERE response_code = '0000'";
        $getNumberOfVotesResult = mysqli_query($database, $getNumberOfVotesQuery);
        $row = mysqli_fetch_assoc($getNumberOfVotesResult);
        $getNumberOfValidVotes  = $row['num_of_valid_votes']| 0;



        // //query to get the total number of votes
        // $getTotalNumberOfVotesQuery = "SELECT SUM(`number_of_votes`) as total_vote_num FROM `miss_gh_pay` WHERE response_code = '0000'";
        // $getTotalNumberOfVotesResult = mysqli_query($database, $getTotalNumberOfVotesQuery);
        // $row0 = mysqli_fetch_assoc($getTotalNumberOfVotesResult);
        // $getTotalNumberOfVotes  = $row0['total_vote_num'] | 0;


         //query to get the total number of votes
        $getTotalNumberOfVotesQuery = "SELECT SUM(`number_of_votes`) as total_vote_num FROM `track_pay` ";
        $getTotalNumberOfVotesResult = mysqli_query($database, $getTotalNumberOfVotesQuery);
        $row0 = mysqli_fetch_assoc($getTotalNumberOfVotesResult);
        $getTotalNumberOfVotes  = $row0['total_vote_num'] | 0;

        // query to get total number of mobile number votes
        $getNumberOfMOMOVotesQuery = "SELECT SUM(`number_of_votes`) as sms_vote_num FROM `diasa_pay` WHERE `channel` = 'momo' AND  response_code = '0000'"; //`channel` = 'momo' OR  `channel` = 'mtn-gh' OR  `channel` = 'vodafone-gh'  OR  `channel` = 'airtel-gh' OR  `channel` = 'tigo-gh' AND
        $getNumberOfMOMOVotesResult = mysqli_query($database, $getNumberOfMOMOVotesQuery);
        $row1 = mysqli_fetch_assoc($getNumberOfMOMOVotesResult);
        $getNumberOfMOMOVotes  = $row1['sms_vote_num'] | 0;

        // query to get total number of mobile number votes
        $getNumberOfSMSVotesQuery = "SELECT SUM(`number_of_votes`) as momo_vote_num FROM `diasa_pay` WHERE `channel` = 'sms' AND response_code = '0000'";
        $getNumberOfSMSVotesResult = mysqli_query($database, $getNumberOfSMSVotesQuery);
        $row2 = mysqli_fetch_assoc($getNumberOfSMSVotesResult);
        $getNumberOfSMSVotes  = $row2['momo_vote_num'] | 0;

        

        ###############################

        // query to get total number of visa number votes
        $getNumberOfallVISAVotesQuery = "SELECT SUM(`number_of_votes`) as visal_vote_num FROM `card_pay`";
        $getNumberOfallVISAVotesResult = mysqli_query($database, $getNumberOfallVISAVotesQuery);
        $row3 = mysqli_fetch_assoc($getNumberOfallVISAVotesResult);
        $getNumberOfallVISAVotes  = $row3['visal_vote_num'] | 0;


        // query to get total number of valid visa number votes
        $getNumberOfVISAVotesQuery = "SELECT SUM(`number_of_votes`) as visa_vote_num FROM `card_pay` WHERE `vpc_message` = 'Approved' AND vpc_response_code = '0'";
        $getNumberOfVISAVotesResult = mysqli_query($database, $getNumberOfVISAVotesQuery);
        $row3 = mysqli_fetch_assoc($getNumberOfVISAVotesResult);
        $getNumberOfVISAVotes  = $row3['visa_vote_num'] | 0;


        
        // query to get the revenue amount for the visa payment
        $getAmountForVISARevenueQuery = "SELECT SUM(vpc_amount) as visa_revenue_amount FROM `card_pay` WHERE vpc_message = 'Approved'";
        $getAmountForVISARevenueResult = mysqli_query($database, $getAmountForVISARevenueQuery);
        $row4 = mysqli_fetch_assoc($getAmountForVISARevenueResult);
        $getAmountForVISARevenue  = $row4['visa_revenue_amount'] | 0;


        // query to get total number of valid WEB number votes
        $getNumberOfWEBVotesQuery = "SELECT SUM(`number_of_votes`) as web_vote_num FROM `diasa_pay` WHERE `device` = 'web' AND response_code = '0000'";
        $getNumberOfWEBVotesResult = mysqli_query($database, $getNumberOfWEBVotesQuery);
        $row3 = mysqli_fetch_assoc($getNumberOfWEBVotesResult);
        $getNumberOfWEBVotes  = $row3['web_vote_num'] | 0;


        // query to get total number of valid USSD number votes
        $getNumberOfUSSDVotesQuery = "SELECT SUM(`number_of_votes`) as ussd_vote_num FROM `diasa_pay` WHERE `device` = 'ussd' AND response_code = '0000'";
        $getNumberOfUSSDVotesResult = mysqli_query($database, $getNumberOfUSSDVotesQuery);
        $row3 = mysqli_fetch_assoc($getNumberOfUSSDVotesResult);
        $getNumberOfUSSDVotes  = $row3['ussd_vote_num'] | 0;


        // query to get total number of valid ANDROID number votes
        $getNumberOfAPPVotesQuery = "SELECT SUM(`number_of_votes`) as app_vote_num FROM `diasa_pay` WHERE `device` = 'android' AND response_code = '0000'";
        $getNumberOfAPPVotesResult = mysqli_query($database, $getNumberOfAPPVotesQuery);
        $row3 = mysqli_fetch_assoc($getNumberOfAPPVotesResult);
        $getNumberOfAPPVotes  = $row3['app_vote_num'] | 0;
        #######################


        // query to get the revenue amount for the momo payment
        $getAmountForMoMoRevenueQuery = "SELECT SUM(amount) as momo_revenue_amount FROM `diasa_pay` WHERE response_code = '0000' OR response_code = '9999'";
        $getAmountForMoMoRevenueResult = mysqli_query($database, $getAmountForMoMoRevenueQuery);
        $row5 = mysqli_fetch_assoc($getAmountForMoMoRevenueResult);
        $getAmountForMoMoRevenue  = $row5['momo_revenue_amount'] | 0;

        $total_revenue_generated = $getAmountForMoMoRevenue + $getAmountForVISARevenue;

        $statsArray["numberOfContestants"] = $getNumberOfContestants;
        $statsArray["numberOfEvictedContestants"] = $getNumberOfEvictedContestants;
        $statsArray["numberOfRemainingContestants"] = $getNumberOfRemainingContestants;
        $statsArray["numberOfValidVotes"] = $getNumberOfValidVotes + $getNumberOfVISAVotes;
        $statsArray['numberOfInvalidVotes'] = (($getTotalNumberOfVotes + $getNumberOfallVISAVotes) - $getNumberOfValidVotes) | 0;
        $statsArray["numberOfTotalVotes"] = ($getTotalNumberOfVotes + $getNumberOfallVISAVotes);
        $statsArray["numberOfSMSVotes"] = $getNumberOfSMSVotes;
        $statsArray["numberOfMOMOVotes"] = $getNumberOfMOMOVotes;
        $statsArray["numberOfVisaVotes"] = $getNumberOfVISAVotes;
        $statsArray["numberOfWEBVotes"] = $getNumberOfWEBVotes;
        $statsArray["numberOfUSSDVotes"] = $getNumberOfUSSDVotes;
        $statsArray["numberOfAPPVotes"] = $getNumberOfAPPVotes;
        $statsArray["amountForMoMoRevenue"] = number_format($total_revenue_generated);//$getAmountForMoMoRevenue + $getAmountForVISARevenue;
        

        $response['success'] = true;
        $response["message"] = 'results got';
        $response["data"] = $statsArray;

        mysqli_close($database);

        header('Content-Type: application/json');
        echo json_encode($response);
    }