<?php
session_start();
if(isset($_SESSION["userlogin"]))
{
    header("location:login.php");
}
?>
<html>
<head>
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="m-5 pb-5">
<div class="container box">
    <h3 align="center">Welcome -  <?php echo $_COOKIE["userName"];?></h3>
    <br/>
    <p><a href="login.php">Logout</a></p>
</div>
</body>
</html>
