<?php

    include "controllers/db-config.php";
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
    }
    

    $current_vid_id = "USpOqBa-kMYvideo";
    $query = mysqli_query($database,"SELECT `video_id`  FROM live_stream LIMIT 1");

    while($row = mysqli_fetch_assoc($query)){
     
        //$post['video_id'] = (int)$row['video_id'];
        $current_vid_id = $row['video_id'];
    }

    include 'includes/header.php';
?>

        <link rel="stylesheet" type="text/css" href="assets/css/lightbox.min.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Votes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                    </li>

                    <li class="nav-item active">
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
                    <li><a href="votes.php"><span class="lnr lnr-thumbs-up"></span> Votes</a></li>
                    <li class=""><a href="gallery.php"><span class="lnr lnr-picture"></span> Gallery</a></li>
                    <!-- <li><a href="articles.php"><span class="lnr lnr-pencil"></span> Articles</a></li> -->

                    <li class="selected"><a class="nav-link" href="live_stream.php"><span class="lnr lnr-camera-video"></span> Live Stream</a></li>
                    <hr>
                    <li><a href="logout.php"><span class="lnr lnr-power-switch"></span> Logout</a></li>
                </div>

                <!-- main content div -->
                <div class="col-md-10 content-div">
                    <div class="container">
                        <div class="jumbotron jumbotron-custom">
                            <h5><b>YouTube Live Streaming Link Update</b></h5>
                            <hr>
                            <p> <span style="color: #aa0000; font-weight: bold;">Current Live Video :</span> <span id="youtube" style=" color: #000; "><?php echo $current_vid_id; ?></span></p>
                            <form role="form" id="form-buscar" method="POST" action="">
                                <div class="form-group">
                                    <div class="input-group">
                                      <input id="vid_id" class="form-control" type="text" name="vid_id" placeholder="Copy and paste live video ID here. E.g - (USpOqBa-kMY)" required/>
                                       <span class="input-group-btn">
                                           <button type="button" style="text-color:#fff" name="go-live" class="btn btn-success" onClick="updateStreamLink()">
                                               <i class="glyphicon glyphicon-search"  aria-hidden="true"></i> GO LIVE
                                           </button>
                                       </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/live-stream-controller.js"></script>