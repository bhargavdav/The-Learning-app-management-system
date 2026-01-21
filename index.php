<?php
include('root/config.php');
if ($_SESSION['aid'] != "") {
?>
    <script type="text/javascript">
        document.location.href = 'dashboard.php';
    </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Page - <?= SITE_TITLE; ?></title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="../images/1.png" type="image/x-icon">

    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body>

    <!-- Start wrapper-->
    <div id="wrapper">
        <div class="height-100v d-flex align-items-center justify-content-center">
            <div class="card card-authentication1 mb-0">
                <div class="login-card">
                    <div class="card-body">
                        <div class="card-content p-2">
                            <div class="text-center">
                                <img src="./get image/logo.png" alt="logo icon" style="width: 130px; height:110px; border-radius: 100%;">
                            </div>
                            <div class="card-title text-uppercase text-center py-3">Administrator Login</div>
                            <form name="frm" id="frm">
                                <div class="form-group">
                                    <label for="exampleInputUsername" class="sr-only">Username</label>
                                    <div class="position-relative has-icon-right">
                                        <input type="text" name="inputUsername" id="inputUsername" class="form-control input-shadow" placeholder="Enter Username" required />
                                        <div class="form-control-position">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword" class="sr-only">Password</label>
                                    <div class="position-relative has-icon-right">
                                        <input type="password" name="inputPass" id="inputPass" class="form-control input-shadow" placeholder="Enter Password" required />
                                        <div class="form-control-position">
                                            <i class="icon-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="login-btn" class="btn btn-primary btn-block">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->



    </div><!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- sidebar-menu js -->
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>
    <script>
        $(document).ready(function() {
            $("#login-btn").click(function() {
                var loginUname = $("#inputUsername").val();
                var loginPassword = $("#inputPass").val();
                if (loginUname == '') {
                    alert("Please Enter Username!");
                    $("#inputUsername").focus();
                    return false;
                }
                if (loginPassword == '') {
                    alert("Please Enter Password!");
                    $("#inputPass").focus();
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        action: "login",
                        loginUname: loginUname,
                        loginPassword: loginPassword
                    },
                    success: function(data) {
                        if (data == "success") {
                            document.location.href = 'dashboard.php';
                        } else if (data == "not active") {
                            alert('Your account is not active. Please contact administrator for that.');
                        } else if (data == "not found1") {
                            alert('not found');
                        } else {
                            alert('Wrong Username OR Password!');
                        }
                    },
                    error: function() {
                        alert('Error while contacting server, please try again');
                    }
                });
            });
        });
    </script>
</body>

</html>