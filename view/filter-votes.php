<?php
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
    }

    include 'includes/header.php';
?>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.min.css">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light navbar-custom">
            <!-- <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="gmb logo" class="navbar-logo"></a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contestants.php">Contestants</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="votes.php">Votes</a>
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
                    <li class="selected"><a href="votes.php"><span class="lnr lnr-thumbs-up"></span> Votes</a></li>
                    <li><a href="gallery.php"><span class="lnr lnr-picture"></span> Image Upload</a></li>
                    <li><a class="nav-link" href="live_stream.php"><span class="lnr lnr-camera-video"></span> Live Stream</a></li>
                    <hr>
                    <li><a href="logout.php"><span class="lnr lnr-power-switch"></span> Logout</a></li>
                </div>

                <!-- main content div -->
                <div class="col-md-10 content-div">
                    <h5 class="text-center">Recent Votes</h5>
                    <p class="text-center">Filter and download votes <br><small> Overall Votes Data</small></p>
                    <div class="row vote-filter-form-div">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <input class="form-control form-control-sm date-input start-date" name="startDate">                              
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End date</label>
                                        <input class="form-control form-control-sm date-input end-date" name="endDate">                              
                                    </div>
                                </div>
                                
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Criteria (Optional)</label>
                                        <input class="form-control form-control-sm input  rawcriteria" name="rawcriteria">                              
                                    </div>
                                </div>

                                <!-- col-md-4 -->
                                <div class="">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-md btn-warning" onclick="filterAndDownloadVotes()">Filter</button>                           
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <p class="text-center">Ussd Votes Only</p>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <input class="form-control form-control-sm date-input ussdstartDate" name="ussdstartDate">                              
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End date</label>
                                        <input class="form-control form-control-sm date-input  ussdendDate" name="ussdendDate">                              
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Criteria (Optional)</label>
                                        <input class="form-control form-control-sm input  ussdcriteria" name="ussdcriteria">                              
                                    </div>
                                </div>
                                <div >
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-md btn-warning" onclick="filterAndDownloadVotesussd()">Filter</button>                           
                                    </div>
                                </div>
                            </div>

                            <br><hr>
                            <p class="text-center">Online Votes Only</p>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <input class="form-control form-control-sm date-input  onlinestartDate" name="onlinestartDate">                              
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End date</label>
                                        <input class="form-control form-control-sm date-input  onlineendDate" name="onlineendDate">                              
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Criteria (Optional)</label>
                                        <input class="form-control form-control-sm input  onlinecriteria" name="criteria">                              
                                    </div>
                                </div>
                                <!-- col-md-4 -->
                                <div class="">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-md btn-warning" onclick="filterAndDownloadVotesonline()">Filter</button>                           
                                    </div>
                                </div>
                            </div>

                            <br><hr>
                            <p class="text-center">SMS Votes Only</p>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <input class="form-control form-control-sm date-input  SMSstartDate" name="SMSstartDate">                              
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End date</label>
                                        <input class="form-control form-control-sm date-input  SMSendDate" name="SMSendDate">                              
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Criteria (Optional)</label>
                                        <input class="form-control form-control-sm input  SMScriteria" name="SMScriteria">                              
                                    </div>
                                </div>
                                <!-- col-md-4 -->
                                <div class="">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-md btn-warning" onclick="filterAndDownloadVotesSMS()">Filter</button>                           
                                    </div>
                                </div>
                            </div>

                            <br><hr>
                            <p class="text-center">Mobile App Votes Only</p>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <input class="form-control form-control-sm date-input  appstartDate" name="appstartDate">                              
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End date</label>
                                        <input class="form-control form-control-sm date-input  appendDate" name="appendDate">                              
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Criteria (Optional)</label>
                                        <input class="form-control form-control-sm input  appcriteria" name="appcriteria">                              
                                    </div>
                                </div>
                                <!-- col-md-4 -->
                                <div class="">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-md btn-warning" onclick="filterAndDownloadAppVotes()">Filter</button>                           
                                    </div>
                                </div>
                            </div>

                            <p class="text-center">[ <a href="get-crawlers.php">Download full crawlers here....</a> ]</p>
                            <p class="text-center">[ <a href="get-smscrawlers.php">Download sms crawlers here.... </a>]</p>
                            <p class="text-center">[<a href="get-momocrawlers.php"> Download momo crawlers here.... </a>]</p>
                            <hr>
                            <br>
                            <h4 class="text-danger">Note <b>: this functionality should not be use during business hours!!</b> </h4>
                            <p class="text-center">Download all failed USSD votes from [ <a href="get-failed-votes.php">here....</a> ]</p>
                            <p class="text-center">Download all failed WEB votes from [ <a href="get-failed-webvotes.php">here.... </a> ]</p>
                            
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <hr>
                    <p class="text-center">Recent Voter Details</p>

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 recent-voters-res">
                            <div class="data-res-placeholder-div">
                                <img src="assets/img/spinner.gif" class="img-fluid data-res-placeholder-div-img">
                                <p class="text-warning"><b>Loading. Please wait...</b></p>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    
                </div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/controller.js"></script>
<script>
    getRecentVotes();

    $('.date-input').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    function filterAndDownloadVotes() {
        var startDate = jQuery(".start-date").val().trim(),
            endDate = jQuery(".end-date").val().trim(),
            rawcriteria = jQuery(".rawcriteria").val().trim();
            //filterKey = jQuery(".dataTables_filter input.form-control-sm").val().trim();

        if (rawcriteria != null || rawcriteria != undefined) {
            window.location.href = "controllers/filter-and-download-votes.php?startDate="+startDate+"&endDate="+endDate+"&rawcriteria="+rawcriteria;
        } else {
            alert("No Data Available")
        }
    }


    function filterAndDownloadVotesussd() {
        var ussdstartDate = jQuery(".ussdstartDate").val().trim(),
            ussdendDate = jQuery(".ussdendDate").val().trim(),
            ussdcriteria = jQuery(".ussdcriteria").val().trim();
            //filterKey = jQuery(".dataTables_filter input.form-control-sm").val().trim();

        if (ussdcriteria != null || ussdcriteria != undefined) {
            window.location.href = "controllers/filter-and-download-ussdvotes.php?ussdstartDate="+ussdstartDate+"&ussdendDate="+ussdendDate+"&ussdcriteria="+ussdcriteria;
        } else {
            alert("No Data Available")
        }
    }




    function filterAndDownloadVotesSMS() {
        var SMSstartDate = jQuery(".SMSstartDate").val().trim(),
            SMSendDate = jQuery(".SMSendDate").val().trim(),
            SMScriteria = jQuery(".SMScriteria").val().trim();
            // filterKey = jQuery(".dataTables_filter input.form-control-sm").val().trim();

        if(SMScriteria != null || SMScriteria != undefined) 
        {
            window.location.href = "controllers/filter-and-download-smsvotes.php?SMSstartDate="+SMSstartDate+"&SMSendDate="+SMSendDate+"&SMScriteria="+SMScriteria;
        } else {
            alert("No Data Available")
        }
    }



    function filterAndDownloadVotesonline() {
        var onlinestartDate = jQuery(".onlinestartDate").val().trim(),
            onlineendDate = jQuery(".onlineendDate").val().trim(),
            onlinecriteria = jQuery(".onlinecriteria").val().trim();
            // filterKey = jQuery(".dataTables_filter input.form-control-sm").val().trim();

        if(onlinecriteria != null || onlinecriteria != undefined) 
        {
            window.location.href = "controllers/filter-and-download-onlinevotes.php?onlinestartDate="+onlinestartDate+"&onlineendDate="+onlineendDate+"&onlinecriteria="+onlinecriteria;
        } else {
            alert("No Data Available")
        }
    }



    function filterAndDownloadAppVotes() {
        var appstartDate = jQuery(".appstartDate").val().trim(),
            appendDate = jQuery(".appendDate").val().trim(),
            appcriteria = jQuery(".appcriteria").val().trim();
            //filterKey = jQuery(".dataTables_filter input.form-control-sm").val().trim();

        if (appcriteria != null || appcriteria != undefined) {
            window.location.href = "controllers/filter-and-download-appvotes.php?appstartDate="+appstartDate+"&appendDate="+appendDate+"&appcriteria="+appcriteria;
        } else {
            alert("No Data Available")
        }
    }
</script>


