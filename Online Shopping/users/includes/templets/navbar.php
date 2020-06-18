<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<nav class="nav navbar-inverse" >
    <li class="navbar-inverse" style="padding-top: 10px;"><div class="nav-link"><h2 class="text-white"> <?php
                if(isset($_SESSION['Username'])){
                    echo $_SESSION['Username'];
                }
                ?></h2></div></li>
    <div class="navbar-nav flex-row ml-md-auto d-none d-md-flex"></div>
    <li class="navbar-inverse"><a class="nav-link" href="Logout.php"><h2 class="text-white">Logout</h2></a></li>

</nav>
</body>
</html>
