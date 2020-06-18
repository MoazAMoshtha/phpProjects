<?php
session_start();
if(isset($_POST["userName"]))
{
    $_SESSION['username']=$_POST["userName"];
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

    <title>PHP Forms Validation</title>
</head>
<body class="m-5 pb-5 ">
<?php
$nameErr=$passErr = "";
if(!empty($_POST["remember"])&&preg_match("/[a-zA-Z0-9]/",$_POST["userName"])&&preg_match("/[A-Z]+[a-z]+[0-9]/", $_POST["userPass"]))
{
    setcookie ("userName",$_POST["userName"],time()+3600);
    setcookie ("userPass",$_POST["userPass"],time()+3600);
    setcookie("userlogin",time()+3600);
    echo "<p class=\"text-center font-weight-bold\">User Profile</p></br>hi - " . $_POST["userName"] . "</br>" . "<a href='PhpFormsValidation.php'>logout</a>";
}else{
    if (empty($_POST["remember"])&&isset($_POST["userName"])&&isset($_POST["userPass"])&&preg_match("/[a-zA-Z0-9]/",$_POST["userName"])&&preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $_POST["userPass"])){
        setcookie ("userName",$_POST["userName"],time()+3600);
        echo "<p class=\"text-center font-weight-bold \">User Profile</p></br>hi - " . $_POST["userName"] . "</br>" . "<a href='PhpFormsValidation.php'>logout</a>";
    }
    else
    {
        $nameErr="Name Should only contain letters, numbers .";
        $passErr="
    * Should be a minimum of 8 characters</br>
    * Should be contain at least 1 number</br>
    * Should be contain at least one uppercase character
";
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
        ?>
        <div class="container box">
            <form action="" method="post" id="frmLogin">
                <div class="form-group">
                    <label for="login">Username</label>
                    <input required name="userName" type="text" value="<?php if(isset($_COOKIE["userName"])) { echo $_COOKIE["userName"]; } ?>" class="form-control" />
                    <?php
                    if (isset($_POST["userName"])&&!preg_match("/^[a-zA-Z ]*$/",$_POST["userName"])){
                        echo "<p class='text-danger'>$nameErr</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="login">Email</label>
                    <input required name="userEmail" type="email" value="<?php if(isset($_COOKIE["userEmail"])) { echo $_COOKIE["userEmail"]; } ?>" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required name="userPass" type="password" value="<?php if(isset($_COOKIE["userPass"])) { echo $_COOKIE["userPass"]; } ?>" class="form-control" />
                    <?php
                    if (isset($_POST["userPass"])&&!preg_match('@[A-Z][a-z][0-9]@', $_POST["userPass"])&&strlen($_POST["userPass"]) < 8){
                        echo "<p class='text-danger'>$passErr</p>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" <?php if(isset($_COOKIE["userlogin"])) { ?> checked <?php } ?> />
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="form-group">
                    <div><input type="submit" name="login" value="Login" class="btn btn-success" ></span></div>
                </div>
            </form>
            <br/>
        </div>
    <?php } }

?>
</body>
</html>
