<?php
ob_start();
session_start();
if(isset($_SESSION['Username'])){
	$pageTitle = 'Members';
	include 'init.php';
	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
		if ($do == 'Manage'){
			$query = '';
			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {
				$query = 'AND RegStatus = 0';
			}
			$stmt = $con->prepare("SELECT * FROM users $query");
			$stmt->execute();
			$rows =$stmt->fetchAll();

			?><div>
                <br><br>
            </div>
			<h1 class="text-center">Manage Members</h1>
            <div>
                <br><br>
            </div>
			<div class="container">
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
                            <td><h2>ID</h2></td>
                            <td><h2>Usernamer</h2></td>
                            <td><h2>Email</h2></td>
                            <td><h2>Full Name</h2></td>
                            <td><h2>Registerd Date</h2></td>
                            <td><h2>Control</h2></td>
						</tr>
						<?php

						foreach ($rows as $row) {
							echo "<tr>";
							echo "<td><h2>" . $row['UserID'] . "</h2></td>";
							echo "<td><h2>" . $row['Username'] . "</h2></td>";
							echo "<td><h2>" . $row['Email'] . "</h2></td>";
							echo "<td><h2>" . $row['FullName'] . "</h2></td>";
							echo "<td><h2>" . $row['Date'] . "</h2></td>";
							echo "<td>
							<a href ='members.php?do=Edit&userid=" . $row['UserID']. " 'class='btn btn-success'><i class='fa fa-edit'></i><h2> Edit</h2></a>
							<a href ='members.php?do=Delete&userid=" . $row['UserID']. " ' class='btn btn-danger confirm'><i class='fa fa-close'></i> <h2>Delete</h2> </a>";

							echo "</td>";
							echo "</tr>";
						}

						?>

					</table>
				</div>
                <a href = 'members.php?do=Add' class="btn btn-primary"><i ></i><h2>New Member</h2></a>
			</div>

		<?php	}elseif ($do == 'Add') { // Add Members Page ?>
            <div>
                <br><br><br><br>
            </div>
			<h1 class="text-center">Add New Member</h1>
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
                            <i class="show-pass fa fa-eye fa-2x"></i>
                        </div>
                        <div class="form-group">
                            <label for="Full Name"><h2>Full Name</h2></label>
                            <input required="" name="full" type="text" value="" class="form-control" style="font-size: 20px">
                        </div>
                    </div>

					<div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-4">
							<input type="submit" value="Add Member" class="btn btn-primary btn-lg">
						</div>
					</div>

				</form>
			</div>

			<?php
		}elseif($do == 'Insert'){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				echo "<div>
<br><br><br><br>
</div><h1 class='text-center'>Update Member</h1>";
				echo "<div class = 'container'>";

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
							users (Username , Password , Email , FullName , RegStatus , Date)
							VALUES(:zuser , :zpass , :zemail , :zname , 0, now())");
						$stmt->execute(array(
							'zuser' 	=> $user,
							'zpass' 	=> $hashPass,
							'zemail' 	=> $email,
							'zname' 	=> $name
						));
						echo "Recode Insert ";

					}
				}
			}else {
				echo "<div class='container'>Sorry You Cant Browse This Page Directly";

				echo "</div>";
			}

			echo "</div>";

} elseif ($do == 'Edit') {
	$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
	$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
	$stmt->execute(array($userid));
	$row = $stmt->fetch();
	$count = $stmt->rowCount();
	if ($count> 0){ ?>
        <div>
            <br><br><br><br>
        </div>
		<h1 class="text-center">Edit Member</h1>
		<div class="container">
			<form class="form-horeizontal" action="?do=Update" method="POST">
				<input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" name="username" value="<?php echo $row['Username']?>" class="form-control" autocomplete="off" required = "required">
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10  col-md-4">
						<input type="hidden" name="oldpassword" value="<?php echo $row['Password']?>">
						<input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank If You Don't Want To Change">
					</div>
				</div>


				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required = "required">
					</div>
				</div>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label">Full Name</label>
					<div class="col-sm-10 col-md-4">
						<input type="text" name="full" value="<?php echo $row['FullName'] ?>" class="form-control" required = "required">
					</div>
				</div>

				<div class="form-group form-group-lg">
					<div class="col-sm-offset-2 col-sm-4">
						<input type="submit" value="Save" class="btn btn-primary btn-lg">
					</div>
				</div>

			</form>
		</div>
	<?php } else {
		echo "<div class='container'>There's No Such ID";

		echo "</div>";


	}
}elseif ($do == 'Update'){

	echo "<div>
<br><br><br><br>
</div><h1 class='text-center'>Update Member</h1>";
	echo "<div class = 'container'>";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

				// Get Varible From The Form

		$id 	= $_POST['userid'];
		$user 	= $_POST['username'];
		$email 	= $_POST['email'];
		$name 	= $_POST['full'];

				// Password Trick

		$pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
 				// validate The Form
		$formError = array();
		if (strlen($user) < 4){
			$formError[] = 'Username Cant Be less Than<strong> 4 Chracter</strong>';
		}
		if (strlen($user) > 20){
			$formError[] = 'Username Cant Be More Than<strong>20 Chracter</strong>';
		}
		if (empty($user)){
			$formError[] = 'Username Cant be <strong>empty</strong>';
		} if (empty($name)){
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
					// Update The Database With This Info
			$stmt = $con->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ? , Password = ?WHERE UserID = ?");
			$stmt->execute(array($user, $email , $name , $pass ,$id));
			echo "Recode Updated";
		}

	}else {
echo "Sorry You Can't Browse This Page Directly";

	}

	echo "</div>";
}elseif($do == 'Delete'){
			//Check ID  Get Request Userid  Is numaric
	echo "<div>
<br><br><br><br>
</div><h1 class='text-center'>Delete Member</h1>";
	echo "<div class='container'>";

	$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
	$check = checkItem('userid', 'users', $userid);

	if ($check > 0){
		$stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
		$stmt->bindParam(":zuser" , $userid);
		$stmt->execute();
echo "Recode Deleted";
	}else{
		echo "This ID Is Not Exist";
	}
	echo "</div>";


}elseif ($do == 'Activate') {

	echo "<div>
<br><br><br><br>
</div><h1 class='text-center'>Activate Member</h1>";
	echo "<div class='container'>";

	$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

	$check = checkItem('userid', 'users', $userid);

	if ($check > 0){
		$stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
		$stmt->execute(array($userid));
echo "Recode Activated ";
	}else{
		echo "This ID Is Not Exist";
	}
	echo "</div>";		}

	include $tpl .'footer.php';
}else{
	header('location : index.php');
	exit();
}
ob_end_flush();
