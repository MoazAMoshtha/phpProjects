<?php
echo "<table class=\"table\">";
echo "<tr class=\"thead-dark\"><th class=\"thead-dark\">Id</th><th class=\"thead-dark\">Name</th><th class=\"thead-dark\">ISBN</th><th class=\"thead-dark\">Year</th><th class=\"thead-dark\">Category</th>";

class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current()
    {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren()
    {
        echo "<tr>";
    }

    function endChildren()
    {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `books` ");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
        echo $v;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
echo  "<a href='view.php'>Back</a>";
$host="localhost";
$username="root";
$password="";
$database="admin";
$conn = mysqli_connect($host,$username,$password,$database);

if (isset($_POST["delete"])){
    $id = $_POST['id'];

    $sql = "DELETE FROM `books` WHERE `books`.`id` = '$id' ";
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
