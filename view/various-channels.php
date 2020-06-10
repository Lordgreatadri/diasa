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
                    <li class=""><a href="#"><span class="lnr lnr-users"></span> Contestants</a></li>
                    <li class="selected"><a href="#"><span class="lnr lnr-users"></span> Various Channel</a></li>
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
                            <h5 class="text-center"><b>Contestants details and their perfomance on various channels</b></h5><br>
                            <div class="contestants-summary-res">
                                <div class="data-res-placeholder-div">
                                    <img src="assets/img/spinner.gif" class="img-fluid data-res-placeholder-div-img">
                                    <p class="text-warning"><b>Loading. Please wait...</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br><br> 

                     
                </div>
            </div>
        </div>


<?php include 'includes/footer.php'; ?>
<script src="assets/js/controller.js"></script>
<script>
    //CONTESTANTS PAGE CONTROLLER
function getContestantsChannelSummary() {
    $.get(CONSTANTS.GET_CONTESTANTS_CHANNEL_URL, function(response) {
        if (response.success) {
            var template = ``;
            var counter = 1;
            var statusClassName = '';
            var statusBtnName = '';
            var statusName = '';
            var anim_counter = 0.2;

            if (response.data.length > 0) {

// <th scope="col">Code</th>      <td>${item.contestant_num}</td>

                template += `
                    <table id="dataTable" class="table table-md table-hover table-responsive ">
                        <thead>
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Votes</th>                               
                                <th scope="col">USSD</th>
                                <th scope="col">Web</th>
                                <th scope="col">SMS</th>
                                <th scope="col">App</th>
                                <th scope="col">Last Voted</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                response.data.forEach( function(item) {
                    var itemObj = JSON.stringify(item);

                    // if (item.status == 'not_evicted') {
                    //     statusClassName = 'text-success';
                    //     statusBtnName = 'evict';
                    //     statusName = 'active';
                    // } else if (item.status == 'evicted'){
                    //     statusClassName = 'text-success';
                    //     statusBtnName = 'set as not evicted';
                    //     statusName = 'evicted';
                    //     statusRowColorName = 'table-success';
                    // }
// <td class="${statusClassName}">${statusName}</td>
                    template += `
                        <tr class='wow zoomIn' data-wow-duration='0.8s' data-wow-delay='${anim_counter}s'>
                            <th scope="row">${counter}</th>
                            <td><img src="${item.thumbnail}" class="contestant-summary-item-img rounded-circle"></td>
                            <td>${item.name}</td>
                            <td>${item.num_of_votes}</td>
                            <td>${item.ussd}</td>
                            <td>${item.web}</td>
                            <td>${item.sms}</td>
                            <td>${item.app}</td>
                            <td>${item.date_stamp}</td>
                        </tr>
                    `;

                    counter += 1;
                    anim_counter += 0.1;
                });

                template += `
                        </tbody>

                        <tfooter>
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Votes</th>                               
                                <th scope="col">USSD</th>
                                <th scope="col">Web</th>
                                <th scope="col">SMS</th>
                                <th scope="col">App</th>
                                <th scope="col">Last Voted</th>
                            </tr>
                        </tfooter>

                    </table>
                `;
            } else {
                
            }

            $('.contestants-summary-res').html(template);
            $('#dataTable').DataTable();
        } else {
            
        }
    })
}    
    getContestantsChannelSummary();

</script>