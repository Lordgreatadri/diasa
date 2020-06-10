<?php
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
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
                        <a class="nav-link" href="votes.php">Votes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Image Upload</a>
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
                    <li><a href="votes.php"><span class="lnr lnr-thumbs-up"></span> Votes</a></li>
                    <li class="selected"><a href="#"><span class="lnr lnr-picture"></span> Image Upload</a></li>
                    <li><a class="nav-link" href="live_stream.php"><span class="lnr lnr-camera-video"></span> Live Stream</a></li>
                    <hr>
                    <li><a href="logout.php"><span class="lnr lnr-power-switch"></span> Logout</a></li>
                </div>

                <!-- main content div -->
                <div class="col-md-10 content-div">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-general-gallery-tab" data-toggle="tab" href="#nav-general-gallery" role="tab" aria-controls="nav-general-gallery" aria-selected="true">General Gallery</a>
                            <a class="nav-item nav-link" id="nav-contestants-gallery-tab" data-toggle="tab" href="#nav-contestants-gallery" role="tab" aria-controls="nav-contestants-gallery" aria-selected="false">Contestants Gallery</a>
                            <a class="nav-item nav-link" id="nav-banner-gallery-tab" data-toggle="tab" href="#nav-banner-gallery" role="tab" aria-controls="nav-banner-gallery" aria-selected="false">App Banner Gallery</a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-general-gallery" role="tabpanel" aria-labelledby="nav-general-gallery-tab">
                            <div class="general-gallery-div">
                                <p class="text-center text-danger"><small><b>* Size of Images Must Not Be Greater Than 3MB</b></small></p>
                                <form class="general-gallery-form">
                                    <label for="general-gallery-image-input" class="general-gallery-images-gallery-label">
                                        Select General Images
                                    </label>
                                    <input type="file" id="general-gallery-image-input" class="general-gallery-image-input" accept="image/*" multiple>&nbsp;&nbsp;&nbsp;
                                    

                                    <button type="submit" class="btn btn-outline-info">Upload Images</button>
                                </form>
                                <hr>

                                <div class="container-fluid">
                                    <div class="row gallery-res"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="nav-contestants-gallery" role="tabpanel" aria-labelledby="nav-contestants-gallery-tab">
                            <div class="contestants-gallery-div">
                                <p class="text-center text-danger"><small><b>* Size of Images Must Not Be Greater Than 3MB</b></small></p>
                                <form class="contestants-gallery-form">
                                    <div class="form-group">
                                        <select class="form-control contestant-gallery-select" required></select>
                                    </div>&nbsp;&nbsp;&nbsp;

                                    <label for="contestants-gallery-image-input" class="contestants-gallery-images-gallery-label">
                                        Select Contestant Images
                                    </label>
                                    <input type="file" id="contestants-gallery-image-input" class="contestants-gallery-image-input" accept="image/*" multiple>&nbsp;&nbsp;&nbsp;
                                    

                                    <button type="submit" class="btn btn-outline-info">Upload Images</button>
                                </form>
                                <hr>

                                <div class="container-fluid">
                                    <div class="contestants-gallery-res"></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-banner-gallery" role="tabpanel" aria-labelledby="nav-banner-gallery-tab">
                            <div class="contestants-gallery-div">
                                <p class="text-center text-danger"><small><b>* Size of Images Must Not Be Greater Than 3MB</b></small></p>
                                <form class="banner-gallery-form">
                                    <div class="form-group">
                                        <input type="text" class="form-control banner-gallery-description" required>
                                    </div>&nbsp;&nbsp;&nbsp;

                                    <label for="banner-gallery-image-input" class="banner-gallery-images-gallery-label">
                                        Select Banner Images
                                    </label>
                                    <input type="file" id="banner-gallery-image-input" class="banner-gallery-image-input" accept="image/*">&nbsp;&nbsp;&nbsp;
                                    

                                    <button type="submit" class="btn btn-outline-info">Upload Images</button>
                                </form>
                                <hr>

                                <div class="container-fluid">
                                    <div class="row banner-gallery-res"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
<script src="assets/js/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyD8HjPz-BzmSyBn4vo02xKvpTvjRHf5f_4",
    authDomain: "g-m-b-22934.firebaseapp.com",
    databaseURL: "https://g-m-b-22934.firebaseio.com",
    projectId: "g-m-b-22934",
    storageBucket: "g-m-b-22934.appspot.com",
    messagingSenderId: "1004980920445"
  };
  firebase.initializeApp(config);
</script>
<script src="assets/js/gallery-controller.js"></script>