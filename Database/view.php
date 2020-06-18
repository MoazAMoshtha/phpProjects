<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "admin";

$error = 0;

$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_error()) {
    die("can't able to connect  " . mysqli_connect_error());
} else {

    if (isset($_POST["Register"])) {
        $name = $_POST["userName"];
        $pass = $_POST["userPass"];


        $que = "INSERT INTO users (id, name, pass) VALUES (NULL, '" . $name . "', '" . $pass . "') ";
        $res = mysqli_query($conn, $que);

        echo "<p class=\"text-center font-weight-bold \">Registration succeeded</p>" . "</br>" . "<a href='reg.php'>login</a>";


    } else {

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
        echo "<div class=\"form-group\">
                    <a href='add.php'>Add</a>
                </div>
                <div class=\"form-group\">
                     <a href='delete.php'>Delete by id</a>
                </div>
                ";
    }

}

session_start();
if (isset($_POST["login"])) {
    $_SESSION['username'] = $_POST["userName"];
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Simple login</title>
</head>
<body class="m-5 pb-5 ">

</body>
</html>
