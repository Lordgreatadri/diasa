<?php 
    include_once 'header/header.php';
    // include_once '../links-hook.php';
 ?>

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
<!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/component.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">


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
                                                    <h4>Contestant records</h4>
                                                    <!-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="page-header-breadcrumb">
                                                <ul class="breadcrumb-title">
                                                    <li class="breadcrumb-item">
                                                        <a href="dashboard.php"> <i class="feather icon-home"></i> </a>
                                                    </li>
                                                    <li class="breadcrumb-item">
                                                        <a href="#">Contestant Details</a>
                                                    </li>
                                                    <li class="breadcrumb-item active"><a href="http://bit.ly/diasa2019">Cast Vote</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <!-- Page-body start -->
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12 col-md-12">
                                            
                                            <!-- Language - Comma Decimal Place table start -->
                                            <div class="card">
                                                <div class="card-header">

                                                	<strong class="card-title">Records of all contestant and their performance</strong>
				                                  
				                                 <br>
				                                 
                                                    

                                                </div>


                                                <div class="card-block">
                                                    <div class="dt-responsive table-responsive">
                                                        <table id="lang-dt"
                                                               class="table table-striped table-bordered nowrap">
                                                            <thead>
                                                                <tr>
	                                                                <th>Position</th>
	                                                                <th>Profile</th>
	                                                                <th>Name</th>
	                                                                <th>Region</th>
	                                                                <th>Second Chance</th>
                                                                    <th>Cast Vote</th>
                                                            	</tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                           	 <?php 
                                                                
                                                                 $conn = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'di_asa');

                                                                $query_nominee = mysqli_query($conn, "SELECT * FROM contestants ORDER BY num_of_votes DESC ");// WHERE status = 'not_evicted'

                                                                $i=1;
									                           
                                                                while ($get_result = mysqli_fetch_assoc($query_nominee)) 
                                                                {
                                                                $contestant_profile = $get_result['thumbnail'];
                                                                $contestant_name    = $get_result['name'];
                                                                $region             = $get_result['contestant_region'];
                                                                $vote_count         = $get_result['backlist'];
                                                                $contestant_id = $get_result['contestant_id'];
                                                             ?>
                            									<tr>
									                               <td><?php echo $i;?></td>
									                                  
									                                  
									                                <!--split out profile image.....-->
									                                 <td>
									                                  	<?php 
										                                    if(is_null($contestant_profile))
										                                    {
										                                      echo '<img src="uploads/default/female.png" style="border-radius: 100%;width:35px; height:20px; margin-left:auto; margin-top:5px;" title='.$contestant_name." of ".$region.'>';
										                                    }else
                                                                            {
										                                        echo '<img src='.$contestant_profile.' style="border-radius: 100%; width: 35px; height:35px; margin-left:20px; margin-top:5px;" title='.$contestant_name." of ".$region.'>';
									                                      	}
									                                    ?>
									                                  </td>
									                                  <td><?php echo $contestant_name;?></td>
									                                  <td>
									                                  	<?php echo $region;?>
									                                  </td>

									                                  <td>
									                                  	<?php echo $vote_count;?>
									                                  </td>
                                                                      <td>
                                                                           <button id="btnsubmit" class='btn btn-sm btn-primary voter' data-contestant-id ='<?php echo $contestant_id;?>'  data-contestant-name ='<?php echo $contestant_name;?>' > <b> Vote </b></button>
                                                                      </td>
									                                </tr>
									                                <?php 
                                                                        $i++; 
                                                                        // mysqli_close($database);
                                                                    // endforeach
                                                                    }
                                                                    ?>


                                                            <!-- table row and data here...............?                 -->
                                                
                                                            </tbody>
                                                            <tfoot>
	                                                            <tr>
	                                                                <th>Position</th>
                                                                    <th>Profile</th>
                                                                    <th>Name</th>
                                                                    <th>Region</th>
                                                                    <th>Second Chance</th>
                                                                    <!-- <th>Votes</th> -->
                                                                    <th>Cast Vote</th>
	                                                            </tr>
                                                            </tfoot>
                                                        </table>

                                                        <?php mysqli_close($conn); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Language - Comma Decimal Place table end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-body end -->

                                

                                <br><br>
                                <hr>

                            </div>
                        </div>





                                            <div class="modal" data-keyboard="false"  data-backdrop="static" id="testModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- ../files/assets/images/auth/logo.jpg -->
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
                                                <input type="radio" name="network" value="mtn-gh" id="mtn-gh"> <!--  onClick="checkIfVodafone()" -->
                                                <img src="../files/assets/images/logo_mtn.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" value="tigo-gh" id="tigo-gh"><!--  onClick="checkIfVodafone()" -->
                                                <img src="../files/assets/images/logo_tigo.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" value="airtel-gh" id="airtel-gh"> <!--  onClick=" return checkIfVodafone();" -->
                                                <img src="../files/assets/images/logo_airtel.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="network" id="rad_voda_token" value="vodafone-gh"><!--  onClick=" return checkIfVodafone();" -->
                                                <img src="../files/assets/images/logo_voda.png" style="margin-top: 0px; margin-bottom: 5px; border-radius: 100%; width: 35px; height: 35px;" class="img-fluid">
                                             </label>

                                             <label class="radio-inline">
                                                <input type="radio" name="network" id="visa_card" value="visa_card"><!--  onClick="checkIfVodafone()" -->
                                                <img src="../files/assets/images/logo_visa.png" style="margin-top: 5px; margin-bottom: 5px; border-radius: 100%; width: 65px; height: 65px;" class="img-fluid">
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
                                        <button class="btn btn-sm btn-primary9" type="submit" name="send" style="background-color: #5F1B9B;">Cast Vote</button>
                                        <button class="btn btn-sm btn-primary9" data-dismiss="modal" style="background-color: #5F1B9B;">Close</button>
                                    </div>
                                </form>
                                
                                
                            </div>                          
                        </div>                       
                    </div>
                        <!-- Main-body end -->
                        
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
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
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
<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>


<!-- sweet alert modal.js intialize js -->
    <!-- modalEffects js nifty modal window effects -->
    <script type="text/javascript" src="../files/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="../files/assets/js/classie.js"></script>



<!-- data-table js -->
<script src="../files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="../files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="../files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="../files/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="../files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="../files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>        
<script type="text/javascript" src="../files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script src="../files/assets/pages/data-table/js/data-table-custom.js"></script>

<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vartical-layout.min.js"></script>
<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
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
