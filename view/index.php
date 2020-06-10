<?php include 'includes/header.php'; ?>

        <div class="container login-signup-div wow zoomIn" data-wow-duration='0.5s' data-wow-delay='0.3s'>
            <div class="row">
                <div class="col-md-4 col-lg-4"></div>
                <div class="col-md-4 col-lg-4">
                    <div class="card login-signup-form-div">
                        <!-- <img src="logo.jpg" alt="mssgh logo" class="login-signup-form-logo" style=" border-radius: 100%;  "> -->
                        <h4 class="text-center text-custom"><small>DASHBOARD LOGIN</small></h4>
                        <br>
                        <form class="login-signup-form login-form">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm login-username" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm login-password" placeholder="Password">
                            </div>

                            <button class="btn bg-custom" type="submit" name="action"><b>Login</b></button>

                            <br><br><br>
                            
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4"></div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/auth-controller.js"></script>