<?php
session_start();
$noNavbar = '';
$pageTitle = 'Login';
if (isset($_SESSION['Username'])) {
    header('location: controlPanel/dashboard.php');
}
include 'Startup\init.php';
if (isset($_POST['username'])) {
    if ($_POST['username'] == 'admin' && $_POST['pass'] == 'admin') {
        $_SESSION['Username'] = $_POST['username'];
        header('location: controlPanel/dashboard.php');
        exit();
    } else {
        if (isset($_POST['signin'])) {
            $username = $_POST['username'];
            $password = $_POST['pass'];
            $sql = "SELECT `Username` FROM `users` WHERE `Username`='" . $username . "'";
            $result = $con->query($sql);
            if ($result->rowCount() >= 1) {
                $_SESSION['Username'] = $_POST['username'];
                header('location: users/viewProducts.php');
                exit();
            } else {

            }
        }
    }


}

?>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="bootstrap/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/util.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/main.css">
    <!--===============================================================================================-->

    <link rel="icon" href="bootstrap/img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="bootstrap/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/css/argon.css?v=1.2.0" type="text/css">
</head>
<body>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="container-login100" style="background-image: url('bootstrap/images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
            <form class="login100-form validate-form">
				<span class="login100-form-title p-b-37">
					Sign In
				</span>

                <div class="wrap-input100 validate-input m-b-20" type="text" name="user" placeholder="Username"
                     autocomplete="off">
                    <input class="input100" type="text" name="username" placeholder="username or email">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-25" data-validate="Enter password">
                    <input class="input100" type="password" name="pass" placeholder="Password"
                           autocomplete="new-password">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <input class="login100-form-btn" type="submit" value="Sign In" name="signin">
                </div>


                <div class="text-center">
                    <br>
                    <a href="users/sginup.php" class="txt2 hov1">
                        Sign Up
                    </a>
                </div>
            </form>


        </div>
    </div>


    <div id="dropDownSelect1"></div>
</form>
<!--===============================================================================================-->
<script src="bootstrap/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="bootstrap/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="bootstrap/vendor/bootstrap/js/popper.js"></script>
<script src="bootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="bootstrap/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="bootstrap/vendor/daterangepicker/moment.min.js"></script>
<script src="bootstrap/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="bootstrap/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="bootstrap/js/main.js"></script>
<script src="bootstrap/vendor/jquery/dist/jquery.min.js"></script>
<script src="bootstrap/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="bootstrap/vendor/js-cookie/js.cookie.js"></script>
<script src="bootstrap/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="bootstrap/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="bootstrap/vendor/chart.js/dist/Chart.min.js"></script>
<script src="bootstrap/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="bootstrap/js/argon.js?v=1.2.0"></script>


</body>

