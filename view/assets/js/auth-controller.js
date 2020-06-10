// event to sign up a user
$('.signup-form').on('submit', function(event) {
    event.preventDefault();

    var username = $('.signup-username').val().trim(),
        password = $('.signup-password').val().trim(),
        passwordConf= $('.signup-password-conf').val().trim();

    if (username == "") {
        showWarningMessage("Please provide username");
    } else if (password == "") {
        showWarningMessage("Please provide password");
    } else if(passwordConf == "") {
        showWarningMessage("Please provide confirmation password");
    } else if (password != passwordConf) {
        showWarningMessage("Passwords do not match");
    } else {
        var data = {
            username: username,
            password: password,
        }

        $.post(CONSTANTS.SIGNUP_USER_URL, data, function(response) {
            console.log(response)
            if (response.success) {
                showSuccessMessage(response.message);
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 2000);
            } else {
                showErrorMessage(response.message);
            }
        })
    }
});

// event to log a user into the system
$('.login-form').on('submit', function(event) {
    event.preventDefault();

    var username = $('.login-username').val().trim(),
        password = $('.login-password').val().trim();

    if (username == "") {
        showWarningMessage("Please provide username");
    } else if (password == "") {
        showWarningMessage("Please provide password");
    
    } else {
        var data = {
            username: username,
            password: password,
        }

        $.post(CONSTANTS.LOGIN_USER_URL, data, function(response) {
            console.log(response)
            if (response.success) {
                showSuccessMessage(response.message);
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 2000);
            } else {
                showErrorMessage(response.message);
            }
        })
    }
});