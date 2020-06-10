<?php include 'includes/header.php'; ?>

        <div class="container login-signup-div wow zoomIn" data-wow-duration='0.5s' data-wow-delay='0.3s'>
            <div class="row">
                <div class="col-md-4 col-lg-4"></div>
                <div class="col-md-4 col-lg-4">
                    <div class="card login-signup-form-div">
                        <img src="assets/img/logo.png" alt="gmb logo" class="login-signup-form-logo">
                        <h4 class="text-center text-custom"><small>DASHBOARD SIGNUP</small></h4>
                        <br>
                        <form class="login-signup-form signup-form">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm signup-username" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm signup-password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control form-control-sm signup-password-conf" placeholder="Confirm Password">
                            </div>

                            <button class="btn bg-custom" type="submit" name="action">Create Login Account</button>

                            <br><br><br>
                            <p class="text-center"><small><a href="index.php">already have a login account</a></small></p>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4"></div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/auth-controller.js"></script>