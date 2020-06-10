<?php 


session_start();


?>



<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>DI ASA <?php echo date('Y'); ?> | MobileContent.com.gh </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Lordgreat-Adri Emmanuel">
    <!-- Favicon icon -->
    <link rel="icon" href="../../files/assets/images/auth/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../../files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../../files/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="../../files/assets/icon/icofont/css/icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="../../files/assets/icon/feather/css/feather.css">
    <!-- light gallery css -->
    <!--<link rel="stylesheet" type="text/css" href="../files/bower_components/lightgallery/css/lightgallery.min.css">-->
    <!-- Select 2 css -->
    <link rel="stylesheet" href="../../files/bower_components/select2/css/select2.min.css" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../files/assets/css/jquery.mCustomScrollbar.css">



    <style>
        button:hover
        {

            background-color: #45a049;
            color: white;
            border: 1px solid gray;
            border-top-left-radius: 15px;
            border-bottom-right-radius: 15px;
            box-shadow: 0 6px #666;
            transform: translateY(4px);
            background-color: green;
        }

        button:active 
        {
          background-color: #2D9037;
          box-shadow: 0 5px #666;
          transform: translateY(4px);
        }
    </style>
</head>

<body class="code">
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="http://mobilecontent.com.gh" target="_blank">
                        <!-- <img  style="margin-top: 35px; margin-bottom: 25px; border-radius: 100%; width: 80px; height: 80px; background-color: white; border-radius: 50px;" class="img-fluid" src="../files/assets/images/logo.png" alt="Theme-Logo" /> -->
                        <!-- ../files/assets/images/auth/logo.png -->
                        <img style="margin-top: 6px; margin-bottom: 10px; border-radius: 100%; width: 50px; height: 50px; " class="img-fluid" src="logo.jpg" alt="missgh-logo" />
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-bell"></i>
                                    <!-- <span class="badge bg-c-pink">5</span> -->
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <h6>Notifications</h6>
                                        <!-- <label class="label label-danger">New</label> -->
                                        
                                    </li>
                                     
                                </ul>
                            </div>
                        </li>
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-message-square"></i>
                                    <!-- <span class="badge bg-c-green">3</span> -->
                                </div>
                            </div>
                        </li>
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                   <!--  <img src="../files/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>Current User</span>
                                    <i class="feather icon-chevron-down"></i> -->
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                                    <!-- <li>
                                        <a href="auth-normal-sign-in.html">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                    </li> -->
                                </ul>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar chat start -->
        <!-- <div id="sidebar" class="users p-chat-user showChat">
            <div class="had-container">
                <div class="card card_main p-fixed users-main">
                     
                </div>
            </div>
        </div> -->
         
        
        <!-- Sidebar inner chat end-->
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar main-menu">
                        <div class="pcoded-navigatio-lavel">View Performance</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu">
                                <a href="http://bit.ly/diasavote">
                                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                    <span class="pcoded-mtext">Contestant Details</span>
                                </a>
                                 
                             
                        </ul>
                         
                         
                    </div>
                </nav>




                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <div class="d-inline">
                                                    <h4>DI ASA SEASON 3 CONTESTANTS</h4>
                                                    <br>
                                                    <h6 style="color: maroon;">Please press <b>vote</b> button to cast vote </h6>
                                                </div>
                                            </div>
                                        </div>

                                        <?php 

                                        	// include_once '../links-hook.php';
                                        // $database = new mysqli_connect('127.0.0.1', 'root', '#4kLxMzGurQ7Z~', 'miss_gh_mobile');
                                        $conn = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'di_asa');
                                        $query_nominee = mysqli_query($conn, "SELECT * FROM contestants ORDER BY num_of_votes DESC ");// WHERE status = 'not_evicted'
                                        $get_result = mysqli_fetch_assoc($query_nominee);

                                        ?>
                                    </div>
                                </div>

                                <?php 
                                    if(isset($_SESSION['notice_message']) && $_SESSION['notice_message'] != "") 
                                    {
                                        //echo "<span class='text-center success' style='color:gree; margin: 3px auto; font-sieze: 26'>". $_SESSION['notice_message']."</span>";
                                       echo "<div  class='alert alert-info alert-dismissible ' role='alert' style='color: green'><button type='button' class='close' data-dismiss='alert' aria-label ='close'><span aria-hiddden='true'>x</span></button><b>".$_SESSION['notice_message']."</b></div>";
                                        unset($_SESSION['notice_message']);
                                    }else
                                    {
                                        unset($_SESSION['notice_message']);
                                    }
                                ?>
                                <hr>
                                <!-- Page-header end -->

                                    <!-- Page body start -->
                                    <div class="page-body masonry-page">

                                        <!-- Gallery with description card start -->
                                        <h5 class="m-b-20">Gallery with description</h5>
                                        <div class="default-grid row">
                                            <div class="row lightboxgallery-popup">
                                                <?php //foreach ($get_result as $value) :
                                                    // while ($get_result = mysqli_fetch_assoc($query_nominee)) 
                                                    // {
                                                    $connect = new PDO("mysql:host=localhost;dbname=di_asa;charset=utf8","root","#4kLxMzGurQ7Z~");
                                                    $connect->setAttribute(PDO::ATTR_AUTOCOMMIT,FALSE);
                                                    $query = "SELECT * FROM contestants ORDER BY num_of_votes DESC";// WHERE status = 'not_evicted' 

                                                    $statement = $connect->prepare($query);
                                                    $statement->execute();
                                                    $results = $statement->fetchAll();

                                                    foreach ($results as $value) {
                                                ?>

                                                    <div class="col-md-3 default-grid-item">
                                                    <div class="card gallery-desc">
                                                        <div class="masonry-media">
                                                            <a class="media-middle" href="#!">
                                                                <img class="img-fluid" src='<?php echo $value["thumbnail"];?>' alt='<?php echo $value["name"];?>'>
                                                            </a>
                                                        </div>
                                                        <div class="card-block">
                                                            <h6 class="job-card-desc">
                                                             <b>Name: </b>   <?php echo $value['name'];?>
                                                            </h6>
                                                            <p class="text-muted">
                                                              <b>Region: </b>  <?php echo $value['contestant_region'];?>
                                                            </p>
                                                            <div class="job-meta-data">
                                                              <b>Age: </b>  <?php echo $value['age'];?>
                                                            </div>
<!-- 
                                                            <div class="job-meta-data" style="color: maroon;">
                                                              <b>Votes: </b>  <?php //echo $value['num_of_votes'];?>
                                                            </div> -->
                                                            <div class="job-meta-data">
                                                                <button style="background-color: #5F1B9B;" id="btnsubmit" class='btn btn-sm btn-primary1 voter' data-contestant-id ='<?php echo $value["contestant_id"];?>'  data-contestant-name ='<?php echo $value["name"];?>' > <b> Vote </b></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php   //endforeach;
                                                    //mysqli_close($database);
                                                    }
                                                ?>
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                            </div>
                                        </div>


                    <div class="modal" data-keyboard="false"  data-backdrop="static" id="testModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- ../files/assets/images/auth/logo.png -->
                                    <img src="logo.jpg" style="margin-top: 5px; margin-bottom: 5px; border-radius: 100%; width: 50px; height: 50px;" class="img-fluid" >

                                    <h4 class="modal-title pull-right">Payment Plan</h4>
                                    <button class="close pull-left" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="">
                                    
                                </div>
                                <!-- <hr style="border: 1px solid silver; width: 100%"> 22.5  -->
                                
                                <form action="process_online_payment.php"  method="post" name="payment" id="payment"  onsubmit="return validateEntryForm();"> 
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="vote_count">Bulk Vote</label>
                                            <select name="vote_count" class="form-control" id="vote_count">
                                                <option value="">select bulk votes</option>
                                                 <option value="1.2">₵1.2 => 2 votes</option>
                                                <option value="6">₵6 => 10 votes</option>
                                                <option value="12">₵12 => 20 votes</option>
                                                <option value="30">₵30 => 50 votes</option>
                                                <option value="60">₵60 => 100 votes</option>
                                                <option value="120">₵120 => 200 votes</option>
                                                <option value="300">₵300 => 500 votes</option>
                                                <!-- <option value="480.0">₵480 => 1600 votes</option> -->
                                                <option value="600.0">₵600 => 1000 votes</option>
                                            </select>
                                        </div>
                                        <div class="form-group inline">
                                            <label for="inputUserName">Choose payment option</label> <br>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" value="mtn-gh" id="mtn-gh"><!--  onClick="checkIfVodafone()" --> 
                                                <img src="../../files/assets/images/logo_mtn.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" value="tigo-gh" id="tigo-gh" ><!-- onClick="checkIfVodafone()" -->
                                                <img src="../../files/assets/images/logo_tigo.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" value="airtel-gh" id="airtel-gh"><!--  onClick=" return checkIfVodafone();" --> 
                                                <img src="../../files/assets/images/logo_airtel.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" id="rad_voda_token" value="vodafone-gh" ><!-- onClick=" return checkIfVodafone();" -->
                                                <img src="../../files/assets/images/logo_voda.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                             </label>

                                             <label class="radio-inline">
                                                <input type="radio" name="network" id="visa_card" value="visa_card" ><!-- onClick="checkIfVodafone()" -->
                                                <img src="../../files/assets/images/logo_visa.png" style="margin-top: 5px; margin-bottom: 5px; border-radius: 100%; width: 65px; height: 65px;" class="img-fluid">
                                             </label>
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_numb">Momo Number</label>
                                            <input type="text" class="form-control" name="phone_number" id="phone_numb" placeholder="phone number" required="">
                                             <input type="hidden" name="contestant_id" id="contestant_id">
                                             <input type="hidden" name="contestant_name" id="contestant_name">
                                        </div>

                                        <div class="form-group" id="voda_token_div">
                                            <label for="token">Vodafone Token</label>
                                            <input type="text" class="form-control" name="token" id="token" placeholder="voda token">
                                        </div>
                                        <!-- <input type="submit" class="btn btn-primary" name="sender"> -->
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-primary1" type="submit" name="send" style="background-color: #5F1B9B;">Cast Vote</button>
                                        <button class="btn btn-sm btn-primary1" data-dismiss="modal" style="background-color: #5F1B9B;">Close</button>
                                    </div>
                                </form>
                                
                                
                            </div>                          
                        </div>                       
                    </div>


                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                           <!--  <div id="styleSelector">

                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="../../files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="../../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="../../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="../../files/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="../../files/bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- isotope js -->
    <script src="../../files/assets/pages/isotope/jquery.isotope.js"></script>
    <script src="../../files/assets/pages/isotope/isotope.pkgd.min.js"></script>

    <script type="text/javascript" src="../../files/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="../../files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="../../files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="../../files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <!-- Custom js -->

    <script src="../../files/assets/js/pcoded.min.js"></script>
    <script src="../../files/assets/js/vartical-layout.min.js"></script>
    <script src="../../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">   
        $(document).ready(function() {
            $('body').bind('cut copy paste', function (e) {
                e.preventDefault();
            })
            $(".code").on("contextmenu", function(e) {
                return false;
            })
        })
    </script>

    <script type="text/javascript">
        $(window).on('load', function() {
            var $container = $('.filter-container');
            $container.isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            var $grid = $('.default-grid').isotope({
                itemSelector: '.default-grid-item',
                masonry: {}
            });
        });
    </script>
    <script type="text/javascript" src="../files/assets/js/script.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.voter').on('click',function(){
                $("#contestant_id").val($(this).data('contestant-id'));
                $("#contestant_name").val($(this).data('contestant-name'));

                $("#testModal").modal("toggle");
                $("#testModal").modal("show");
        });

       document.getElementById('voda_token_div').style.display="none";
        
    });
    

</script>


<script >
    function validateEntryForm()
    {
        var vote_count = document.forms['payment']['vote_count'];
        var network = document.forms['payment']['network'];
        var phone_number = document.forms['payment']['phone_number'];
        // var visa_card = document.forms['payment']['visa_card'];
        var token = document.forms['payment']['token'];


        if(vote_count.value.trim() =="")
        {
            alert("please select bulk vote");
            return false;
        }

        if(network.value.trim() =="")
        {
           alert("please select your payment option");
           return false;
        }

        if(network.value == 'visa_card') 
        {

        }else
        {
            if(phone_number.value.trim() == "")
            {
                alert("please enter mobile money number!");
                return false;
            }
        }
        

        // if(network.value == 'vodafone-gh') 
        // {
        //     if(token.value.trim() == "")
        //     {
        //         alert("please enter vodafone token or dial *110# to generate payment token");
        //         return false;
        //     }
        // }


        if(phone_number.value.trim() != "") 
        {
            if(phone_number.value.trim().length <= 14)
            {
              return  validatePhoneNumber(phone_number);
            }
        }
    }


    function validatePhoneNumber(contactValue)
    {
        var phonenoFormat = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        if(contactValue.value.match(phonenoFormat))
        {
           return true;
        }else
        {
            alert("Contact value not valid, enter valid numbers only");
            return false;
        }
    }


    function checkIfVodafone()
    {
        if(document.getElementById('rad_voda_token').checked) 
        {
           document.querySelector('#voda_token_div').style.display = 'block';
        }else{
           document.querySelector('#voda_token_div').style.display = 'none';
        }    
    }
</script>
</body>



</html>
