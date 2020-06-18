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

    <title>Simple login</title>
</head>
<body class="m-5 pb-5 ">
        <?php
        $nameErr = $emailErr = $passErr = "";
        $name = $email = $pass =  "";
            if (empty($_POST["userName"])) {
                $nameErr = "Name is required";
            } else {
                //check if name only contains letters and Number
                if (!preg_match("/^[a-zA-Z0-9]*$/",$name)) {
                    $nameErr = "Only letters and Number allowed";
                }
            }

            if (empty($_POST["userEmail"])) {
                $emailErr = "Email is required";
            } else {
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }
        if(!empty($_POST["remember"]))
        {
            setcookie ("userName",$_POST["userName"],time()+3600);
            setcookie ("userPass",$_POST["userPass"],time()+3600);
            setcookie("userlogin",time()+3600);
            echo "<p class=\"text-center font-weight-bold\">User Profile</p></br>hi - " . $_POST["userName"] . "</br>" . "<a href='index.php'>logout</a>";

        }else{
        if (empty($_POST["remember"])&&isset($_POST["userName"])&&isset($_POST["userPass"])){
            setcookie ("userName",$_POST["userName"],time()+3600);
            echo "<p class=\"text-center font-weight-bold \">User Profile</p></br>hi - " . $_POST["userName"] . "</br>" . "<a href='index.php'>logout</a>";
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

        ?>
<div class="container box">
  <form action="" method="post" id="frmLogin">
    <div class="form-group">
            <label for="login">Username</label>
            <input required name="userName" type="text" value="<?php if(isset($_COOKIE["userName"])) { echo $_COOKIE["userName"]; } ?>" class="form-control" />
        </div>
      <div class="form-group">
          <label for="login">Email</label>
          <input required name="userEmail" type="email" value="<?php if(isset($_COOKIE["userEmail"])) { echo $_COOKIE["userEmail"]; } ?>" class="form-control" />
      </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input required name="userPass" type="password" value="<?php if(isset($_COOKIE["userPass"])) { echo $_COOKIE["userPass"]; } ?>" class="form-control" />
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
<?php } }?>
</body>
</html>
