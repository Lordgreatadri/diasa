<?php
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
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
                    <li class="selected"><a href="#"><span class="lnr lnr-users"></span> Contestants</a></li>
                    <li class=""><a href="backlist.php"><span class="lnr lnr-users"></span> Second Chance</a></li>
                    <li ><a href="vote_channels.php"><span class="lnr lnr-laptop"></span> Vote Channels</a></li>
                    <li class=""><a href="various-channels.php"><span class="lnr lnr-users"></span> Various Channel</a></li>
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
                        <div class="col-md-10">
                            <h5 class="text-center"><b>Contestants details and their perfomance</b></h5><br>
                            <div class="contestants-summary-res">
                                <div class="data-res-placeholder-div">
                                    <img src="assets/img/spinner.gif" class="img-fluid data-res-placeholder-div-img">
                                    <p class="text-warning"><b>Loading. Please wait...</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br><br><br>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-center"><b>Statistics of Votes [<a href="#leaderboard-detail-modal" data-toggle="modal"><small>view full screen</small></a>] </b></h6>
                            <canvas id="leaderboardChart" height="400" width="400"></canvas>
                        </div>

                        <div class="col-md-6">
                            <!-- [<a href="controllers/export-weekly-contestant-ranking.php"> -->
                            <h6 class="text-center"><b>Statistics of Weekly Votes [<a href="#stats-detail-modal" data-toggle="modal"><small>view full screen</small></a>]  &nbsp;&nbsp; [<a href="controllers/export_contestant-vote.php"><small>export data</small></a>]</b></h6>
                            <canvas id="weeklyLeaderBoardChart" height="400" width="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Details of <span class="contestant-name">Contestant</span></b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFRxi3jsAueWmyFScGvV_JREwFVSB7FMkOZV8PJUURDzbnTqF_" alt="photo of contestant" class="constant-detail-img contestant-img">
                        </div>

                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td><span class="contestant-name">Contestant</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Age</b></td>
                                        <td><span class="contestant-age">00</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Height</b></td>
                                        <td><span class="contestant-height">Contestant</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Complexion</b></td>
                                        <td><span class="contestant-complexion">Contestant</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Region</b></td>
                                        <td><span class="contestant-region">Contestant</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>Code</b></td>
                                        <td><span class="contestant-code">Contestant</span></td>
                                    </tr>
                                    <tr>
                                        <td><b>No. of votes</b></td>
                                        <td><b><span class="contestant-votes">Contestant</span></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td><span class="contestant-status">Contestant</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-dismiss="modal">Okay</button>
                </div>
                </div>
            </div>
        </div>

        <!-- modal to show the full screen display of the votes for the contestants -->
        <div class="modal fade full-screen-modal" id="stats-detail-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white"><b>Votes statistics for this week</b></h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <canvas id="weeklyLeaderBoardFullScreenChart" height="250" width="400"></canvas>
                </div>
                </div>
            </div>
        </div>

        <!-- modal to show the full screen for the overall votes for the contestants -->
        <div class="modal fade full-screen-modal" id="leaderboard-detail-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white"><b>Conestant Overall Vote Statistics</b></h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <canvas id="leaderBoardFullScreenChart" height="250" width="400"></canvas>
                </div>
                </div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/controller.js"></script>
<script>
    getContestantsSummary();
    showLeaderBoardGraph();
    showContestantLeaderBoardForWeek();
    showContestantModalLeaderBoardForWeek();
    showLeaderBoardModal();
</script>