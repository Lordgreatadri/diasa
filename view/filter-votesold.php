<?php
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
    }

    include 'includes/header.php';
?>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.min.css">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light navbar-custom">
            <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="gmb logo" class="navbar-logo"></a>
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
                    <p class="text-center"><small>Filter and download votes</small></p>
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

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-sm btn-secondary" onclick="filterAndDownloadVotes()">Filter and download</button>                           
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div><br>

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
            filterKey = jQuery(".dataTables_filter input.form-control-sm").val().trim();

        if (filterKey != null || filterKey != undefined) {
            window.location.href = "controllers/filter-and-download-votes.php?startDate="+startDate+"&endDate="+endDate+"&filterKey="+filterKey;
        } else {
            alert("No Data Available")
        }
    }
</script>