<?php
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        // echo "<script>window.location.href = 'index.php';</script>";
    }

    $ussd_user = "";
    if (isset($_GET['all_channel_action'])) 
    {
    	$ussd_user = trim($_GET['all_channel_action']);	
    }
    include 'includes/header.php';
?>

        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light navbar-custom">
            <!-- <a class="navbar-brand" href="#"><img src="logo.jpg" alt="logo" class="navbar-logo" style="border-radius: 100%;"></a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Contestants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="votes.php">Voters</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="http://bit.ly/diasa2019" target="_blank">Cast Vote</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Image Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="live_stream.php">Live Stream</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="articles.php">Articles</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="container-fluid main-div">
            <div class="row">
                <!-- side div -->
                <div class="col-md-2 side-div">
                    <li><a href="dashboard.php"><span class="lnr lnr-pie-chart"></span> Dashboard</a></li>
                    <li><a href="contestants.php"><span class="lnr lnr-users"></span> Contestants</a></li>

                    <li class="selected"><a href="vote_channels.php"><span class="lnr lnr-laptop"></span> Vote Channels</a></li>

                    <li><a href="votes.php"><span class="lnr lnr-thumbs-up"></span> Voters</a></li>

                    <li><a href="http://bit.ly/diasa2019" target="_blank"><span class="lnr lnr-thumbs-up"></span> Cast Vote</a></li>

                    <li><a href="gallery.php"><span class="lnr lnr-picture"></span> Image Upload</a></li>
                    <li><a class="nav-link" href="live_stream.php"><span class="lnr lnr-camera-video"></span> Live Stream</a></li>
                    <hr>
                    <li><a href="logout.php"><span class="lnr lnr-power-switch"></span> Logout</a></li>
                </div>

                <!-- main content div -->
                <div class="container-fluid content-div">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-12">
                            <h5 class="text-center"><b>Contestants details and their voting channels</b></h5><br>
                            <!-- <div class="contestants-summary-res">
                                <div class="data-res-placeholder-div">
                                    <img src="assets/img/spinner.gif" class="img-fluid data-res-placeholder-div-img">
                                    <p class="text-warning"><b>Loading. Please wait...</b></p>

                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-1"></div>

                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Record of contestants and their vote details</strong>
                                 <!-- <p class="text-center">Please click the corresponding channel to view all records</p> -->
                                <h5 class="text-center">ALL details for <b> <?php echo $ussd_user; ?></b></h5>
                                    <?php 
                                          //session_start();
                                        if(isset($_SESSION['member_delete']) && !empty($_SESSION['member_delete'])) 
                                        {
                                         echo $_SESSION['member_delete'];
                                         unset($_SESSION['member_delete']);
                                        }else
                                        {
                                            unset($_SESSION['member_delete']);
                                            // session_destroy();
                                        }
                                    ?>
                                <!-- </p> -->
                               <!--  <span style="float: right;">
                                    <button class="btn btn-secondary"> <a style="text-decoration: none; color: white;" href="controllers/export_contestantchannel.php?channel=<?php //echo 'ussd'; ?>&nominee=<?php //echo $ussd_user; ?>"><b>Export Data</b></a></button>
                                </span> -->
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>CONTESTANT</th>
                                            <th>VOTER</th>
                                            <th>MEDIUM</th>
                                            <th>VOTES</th>
                                            <th>AMOUNT</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>CONTESTANT</th>
                                            <th>VOTER</th>
                                            <th>MEDIUM</th>
                                            <th>VOTES</th>
                                            <th>AMOUNT</th>
                                            <th>DATE</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>

                                         <?php
                                            $i = 1;
                                            include '/controllers/db-config.php';
                                            $conn      = new mysqli('localhost','root', '#4kLxMzGurQ7Z~', 'di_asa');
                                            $stmnt = "SELECT * FROM diasa_pay WHERE contestant_name = '$ussd_user' AND response_code = '0000' ORDER BY `when` DESC LIMIT 0,1000";
                                            $get_val = mysqli_query($conn,$stmnt);
                                            while ($rows = mysqli_fetch_assoc($get_val)) 
                                            {
                                            
                                            
                                                                                                            
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $rows['contestant_name']; ?></td>
                                        <td><?php echo $rows['number'];?></td>
                                        <td> <?php echo $rows['device'];?></td>
               <!-- trash-o -->         <td> <?php echo $rows['number_of_votes'];?></td>
               							<td> <?php echo $rows['amount'];?></td>
               							<td> <?php echo $rows['when'];?></td>
                                        
                                                                              
                                    </tr>
                                        <?php $i++; }//endforeach ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                    <br><br><br>

                    
                </div>
            </div>
        </div>

        

        

<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table').DataTable();
      } );



        // function(){
        //     "colunmDefs":{
        //         "target":[0,3,4,5,6,7],
        //         "orderable":false
        //     }
        //   }
  </script>
<script src="assets/js/controller.js"></script>
<script>
    // getContestantsSummary();
    // showLeaderBoardGraph();
    // showContestantLeaderBoardForWeek();
    // showContestantModalLeaderBoardForWeek();
    // showLeaderBoardModal();
</script>