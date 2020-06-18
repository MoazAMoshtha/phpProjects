<?php
echo  "<a href='reg.php'>Back</a>";
$host="localhost";
$username="root";
$password="";
$database="admin";
$conn = mysqli_connect($host,$username,$password,$database);

if (isset($_POST["delete"])){
    $id = $_POST['id'];

    $sql = "DELETE FROM `users` WHERE `users`.`id` = '$id' ";
    if ($conn->query($sql) === TRUE) {
        echo "</br>Record deleted successfully";
    } else {
        echo "</br>Error : " . $conn->error;
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>update</title>
</head>
<body class="m-5 pb-5 ">
<form action="" method="post" id="frmLogin">
    <div class="form-group">
        <label for="id">id </label>
        <input required name="id" type="text" class="form-control" />
    </div>
    <div class="form-group">
        <div><input type="submit" name="delete" value="delete" class="btn btn-success" ></span></div>
    </div>
</form>
</body>
</html>
