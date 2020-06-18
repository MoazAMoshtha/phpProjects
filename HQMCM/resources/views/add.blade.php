<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Add New Employee</title>
</head>
<body class="m-5 pb-5">
<form action="" method="get">
    <div class="form-group">
        <label for="usr" id="name">Name:</label>
        <input type="text" class="form-control" id="usr" name="name">
    </div>
    <div class="form-group">
        <label  id="email">Email :</label>
        <input type="email" class="form-control" name="email">
    </div>
    <label>Gender :</label>
    <div class="form-check form-check-inline" >
        <input type="radio" class="form-check-input" id="gender.male" name="gender" value="Male">
        <label class="form-check-label" name="Male">Male</label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" id="gender.female" name="gender" value="Female">
        <label class="form-check-label" >Female</label>
    </div>
    <div class="form-group">
        <label for="sel1">Type :</label>
        <select id="type" name="type" class="form-control" id="sel1" >
            <option name="FullTimeEmployee" value="Full Time Employee">Full Time Employee</option>
            <option name="PartTimeEmployee" VALUE="Part Time Employee">Part Time Employee</option>
        </select>
    </div>
    <input type="submit" class="btn btn-outline-dark" name="save">
</form>
<table class="table mt-3">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Gender</th>
        <th scope="col">Type</th>
    </tr>
    </thead>
    </tbody>
</table>
<div class="alert alert-dark mt-3" role="alert">
    <?php
    if (isset($_GET['name'])&&isset($_GET['email'])&&isset($_GET['gender'])&&isset($_GET['type'])){
        echo $_GET['name'] .' | ' . $_GET['email'] . ' | ' . $_GET['gender'] . ' | ' . $_GET['type'];
        $name = $_GET['name'];$email = $_GET['email'];$gender = $_GET['gender'];$type = $_GET['type'];
        if ($type == "Full Time Employee"){
            $e = new full($name,$email,$gender,$type);
        }else{
            $e = new part($name,$email,$gender,$type);
        }
        $arr = ArrayObject::emp;
        $arr.array_push($e);
        echo $_GET['name'] .' | ' . $_GET['email'] . ' | ' . $_GET['gender'] . ' | ' . $_GET['type'];
        foreach ($arr as $value){
        }
    }else{
        echo "Error !";
    }
    ?>
</div>


</body>
</html>
