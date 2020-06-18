<?php
include 'init.php';
if (isset($_POST['register'])){
    if (isset($_POST['username'])){

        $user 	= $_POST['username'];
        $pass 	= $_POST['password'];
        $email 	= $_POST['email'];
        $name 	= $_POST['full'];

        $hashPass = sha1($_POST['password']);

        $formError = array();
        if (strlen($user) < 4){
            $formError[] = 'Username Cant Be less Than<strong> 4 Chracter</strong>';
        }
        if (strlen($user) > 20){
            $formError[] = 'Username Cant Be More Than<strong>20 Chracter</strong>';
        }
        if (empty($user)){
            $formError[] = 'Username Cant be <strong>empty</strong>';
        }
        if (empty($pass)){
            $formError[] = 'Password Cant be <strong>empty</strong>';
        }
        if (empty($name)){
            $formError[] = 'Full Name Cant be <strong>empty</strong>';
        }if (empty($email)){
            $formError[] = 'Email Cant be <strong>empty</strong>';
        }
        // Loop Into Error Array And Echo It

        foreach ($formError as $error) {

            echo '<div class = "alert alert-danger">' . $error . '</div>';
        }
        // Check If There Is No Error Proceed  The Update Opration
        if (empty($formError)){
            // Check If user Is Exist In Database
            $check = checkItem("Username" , "users" , $user);
            if ($check == 1){
                echo "Sorry This User Is Exist";

            }else{
                // Insert The Database With This Info
                $stmt = $con->prepare("INSERT INTO
							users (Username , Password , Email , FullName  , Date)
							VALUES(:zuser , :zpass , :zemail , :zname , now())");
                $stmt->execute(array(
                    'zuser' 	=> $user,
                    'zpass' 	=> $hashPass,
                    'zemail' 	=> $email,
                    'zname' 	=> $name
                ));
                echo "Recode Insert ";
                header('location: http://localhost/Online%20Shopping/index.php');


            }
        }
    }else {
        echo "<div class='container'>Sorry You Cant Browse This Page Directly";

        echo "</div>";
    }



}
?>
        <div>
                <br><br><br><br>
            </div>
			<h1 class="text-center">Registration</h1>
			<div class="container">
				<form class="form-horeizontal" action="?do=Insert" method="POST">
                    <div class="container box">
                        <div class="form-group">
                            <label for="Name"><h2>Name</h2></label>
                            <input required="" name="username" type="text" value="" class="form-control" style="font-size: 20px">
                        </div>
                        <div class="form-group">
                            <label for="Email"><h2>Email</h2></label>
                            <input required="" name="email" type="text" value="" class="form-control" style="font-size: 20px">
                        </div>
                        <div class="form-group">
                            <label for="Password"><h2>Password</h2></label>
                            <input required="" name="password" type="password" value="" class="form-control" style="font-size: 20px">
                         
                        </div>
                        <div class="form-group">
                            <label for="Full Name"><h2>Full Name</h2></label>
                            <input required="" name="full" type="text" value="" class="form-control" style="font-size: 20px">
                        </div>
                    </div>
					<div class="form-group">
						<div class="col-sm-1" >
							<input style="font-size: 15px" type="submit" value="register" class="btn btn-primary btn-lg" name="register">
						</div>
					</div>
				</form>
			</div>