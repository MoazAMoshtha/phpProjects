<?php
session_start();
if(isset($_SESSION["userlogin"]))
{
    header("location:home.php");
}

if (empty($_POST["remember"])&&isset($_POST["userName"])){
    setcookie ("userName",$_POST["userName"],time()+3600);
    header("location:home.php");
}

if(!empty($_POST["remember"]))
{
    setcookie ("userName",$_POST["userName"],time()+3600);
    setcookie ("userPass",$_POST["userPass"],time()+3600);
    setcookie("userlogin",time()+3600);
    header("location:home.php");
}
else
{
    if(isset($_COOKIE["userName"]))
    {
        setcookie ("userName","",time()-3600);
    }
    if(isset($_COOKIE["userPass"]))
    {
        setcookie ("userPass","",time()-3600);
    }
    if (isset($_COOKIE["userlogin"]))
    {
        setcookie ("userlogin","",time()-3600);

    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body class="m-5 pb-5 ">
<div class="container box">
    <form action="" method="post" id="frmLogin">
        <div class="form-group">
            <label for="login">Username</label>
            <input name="userName" type="text" value="<?php if(isset($_COOKIE["userName"])) { echo $_COOKIE["userName"]; } ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="userPass" type="password" value="<?php if(isset($_COOKIE["userPass"])) { echo $_COOKIE["userPass"]; } ?>" class="form-control" />
        </div>
        <div class="form-group">
            <input type="checkbox" name="remember" <?php if(isset($_COOKIE["userlogin"])) { ?> checked <?php } ?> />
            <label for="remember-me">Remember me</label>
        </div>
        <div class="form-group">
            <div><input type="submit" name="login" value="Login" class="btn btn-success" ></span></div>
        </div>
    </form>
    <br />
</div>
</body>
</html>
