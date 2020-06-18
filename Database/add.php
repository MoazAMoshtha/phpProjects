<?php
echo  "<a href='view.php'>Back</a>";
$host="localhost";
$username="root";
$password="";
$database="admin";
$conn = mysqli_connect($host,$username,$password,$database);

if (isset($_POST["add"])){
    $bookName=$_POST['bookName'];
    $isbn=$_POST['isbn'];
    $year=$_POST['year'];
    $category=$_POST['category'];
    $sql = "INSERT INTO `books` (`id`, `title`, `isbn`, `year`, `category`) VALUES (NULL, '".$bookName."', '".$isbn."', '".$year."', '".$category."') ";
    if ($conn->query($sql) === TRUE) {
        echo "</br>Add successfully";
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

    <title>Add New Books</title>
</head>
<body class="m-5 pb-5 ">
<form action="" method="post" id="frmLogin">
    <div class="form-group">
        <label for="bookName">Book Name</label>
        <input required name="bookName" type="text" class="form-control" />
    </div>
    <div class="form-group">
        <label for="isbn">International Standard Book Number (ISBN)</label>
        <input required name="isbn" type="text" class="form-control" />
    </div>
    <div class="form-group">
        <label for="year">Year</label>
        <input required name="year" type="text" class="form-control" />
    </div>
    <div class="form-group">
        <label for="Category">Category</label>
        <select class="form-control" id="category" name="category">
            <option>Science</option>
            <option>History</option>
            <option>Art</option>
        </select>
    </div>
    <div class="form-group">
        <div><input type="submit" name="add" value="Add" class="btn btn-success" ></span></div>
    </div>
</form>
</body>
</html>
