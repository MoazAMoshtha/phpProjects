<?php


ob_start();
session_start();
$pageTitle = "Car";
if (isset($_SESSION['Username'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') {
        $stmt = $con->prepare("SELECT * FROM cars");
        $stmt->execute();
        $cars = $stmt->fetchAll();
        ?>
        <div>
            <br><br></div>
        <h1 class="text-center">Manage Cars</h1><br>
        <div>
            <br><br>
        </div>
        <div class="container">
            <div class="table-responsive ">
                <table class="main-table text-center table table-bordered ">
                    <tr class="">
                        <td><h2>ID</h2></td>
                        <td><h2>manufacturer</h2></td>
                        <td><h2>model</h2></td>
                        <td><h2>price</h2></td>
                        <td><h2>image</h2></td>
                        <td><h2>Control</h2></td>
                    </tr>
                    <?php

                    foreach ($cars as $item) {
                        echo "<tr>";
                        echo "<td><h2>" . $item['id'] . "</h2></td>";
                        echo "<td><h2>" . $item['manufacturer'] . "</h2></td>";
                        echo "<td><h2>" . $item['model'] . "</h2></td>";
                        echo "<td><h2>" . $item['price'] . "</h2></td>";
                        $carimg =$item['image'] . ".jpg";
                        echo "<td class='w-25'><img src='carImg/$carimg' alt='' class=' w-50 p-0 m-0'></td>";
                        echo "<td>
                           
							<a href ='cars.php?do=Edit&carid=" . $item['id'] . " 'class='btn btn-success'><i class='fa fa-edit'></i><h2>Edit</h2></a>
							<a href ='cars.php?do=Delete&carid=" . $item['id'] . " ' class='btn btn-danger confirm'><i class='fa fa-close'></i> <h2>Delete</h2> </a>";

                        echo "</td>";
                        echo "</tr>";
                    }

                    ?>

                </table>
            </div>
            <a href='cars.php?do=Add' class="btn btn-primary"><h2>Add New Car</h2></a>
        </div>

    <?php } elseif ($do == 'Add') { ?>
        <div>
            <br><br><br><br>
        </div>

        <div class="container">
            <form class="form-horeizontal" action="?do=Insert" method="POST">
                <h1 class="text-center">Add New Car </h1>
                <div class="container box">
                    <div class="form-group">
                        <label for="Name"><h2>manufacturer</h2></label>
                        <input required="" name="manufacturer" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>
                    <div class="form-group">
                        <label for="Description"><h2>model</h2></label>
                        <input required="" name="model" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>
                    <div class="form-group">
                        <label for="Price"><h2>price</h2></label>
                        <input required="" name="price" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>
                    <div class="form-group">
                        <label for="Price"><h2>image</h2></label>
                        <input required="" name="image" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>

                    <br>
                </div>

                <div class="form-group form-group-lg">
                    <input type="submit" value="Add Item" class="btn btn-primary btn-sm" style="font-size: 20px">
                </div>
            </form>
        </div>

        <?php
    } elseif ($do == 'Insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<h1 class='text-center'></h1>";
            echo "<div class = 'container'>";
            // Get Varible From The Form
            $manufacturer = $_POST['manufacturer'];
            $model = $_POST['model'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            $formErrors = array();

            if (empty($manufacturer)) {
                $formError[] = 'manufacturer can/t be <strong> empty</strong>';
            }
            if (empty($model)) {
                $formError[] = 'model can/t be <strong> empty</strong>';
            }
            if (empty($price)) {
                $formError[] = 'price can/t be <strong> empty</strong>';
            }
            if (empty($image)) {
                $formError[] = 'image can/t be <strong> empty</strong>';
            }


            // Check If There Is No Error Proceed  The Update Opration
            if (empty($formError)) {

                // Insert The Database With This Info
                $stmt = $con->prepare("INSERT INTO
							cars(id ,manufacturer, model, price,  image)
							VALUES(null,:zmanufacturer, :zmodel, :zprice, :zimage)");
                $stmt->execute(array(

                    'zmanufacturer' => $manufacturer,
                    'zmodel' => $model,
                    'zprice' => $price,
                    'zimage' => $image,

                ));
                echo "<br><br><br><br><h1>" . "Cars Insert" . "</h1>";


            }
        } else {
            echo "<div class='container'>Sorry You Cant Browse This Page Directly";

            echo "</div>";
        }

        echo "</div>";


    } elseif ($do == 'Edit') {

        $carid = isset($_GET['carid']) && is_numeric($_GET['carid']) ? intval($_GET['carid']) : 0;
        $stmt = $con->prepare("SELECT * FROM cars WHERE id = ?");
        $stmt->execute(array($carid));
        $item = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) { ?>

            <h1 class="text-center">Edit Cars</h1>
            <div class="container">
                <form class="form-horeizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="carid" value="<?php echo $carid; ?>"/>

                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">manufacturer</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="manufacturer" class="form-control"
                                   placeholder="manufacturer Of The car" value="<?php echo $item['manufacturer'] ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">model</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="model" class="form-control" placeholder="model Of The car"
                                   value="<?php echo $item['model'] ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="price" class="form-control" placeholder="Price Of The car"
                                   value="<?php echo $item['price'] ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="image" class="form-control" placeholder="image Of The car"
                                   value="<?php echo $item['image'] ?>">
                        </div>
                    </div>


                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-6">
                            <input type="submit" value="Save car" class="btn btn-primary btn-sm">
                        </div>
                    </div>
                </form>
            </div>
        <?php } else {
            echo "<div class'container'>";
            $theMsg = "<div class='alert alert-danger'>Theres No Such ID</div>";
            redirectHome($theMsg);
            echo "</div>";


        }

    } elseif ($do == 'Update') {
        echo "<h1 class='text-center'>Update Product</h1>";
        echo "<div class = 'container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['carid'];
            $manufacturer = $_POST['manufacturer'];
            $model = $_POST['model'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            $formErrors = array();

            if (empty($manufacturer)) {
                $formError[] = 'manufacturer can/t be <strong> empty</strong>';
            }
            if (empty($model)) {
                $formError[] = 'model can/t be <strong> empty</strong>';
            }
            if (empty($price)) {
                $formError[] = 'price can/t be <strong> empty</strong>';
            }
            if (empty($image)) {
                $formError[] = 'image can/t be <strong> empty</strong>';
            }

            if (empty($formError)) {
                $stmt = $con->prepare("UPDATE cars SET manufacturer = ? , model = ? , price = ? , image = ? WHERE id = ?");
                $stmt->execute(array($manufacturer, $model, $price, $image, $id));
                echo $stmt->rowCount() . ' ' . 'Car Updated';

            }

        } else {

           echo "Sorry You Can't Browse This Page Directly";

        }

        echo "</div>";

    } elseif ($do == 'Delete') {

        echo "<div class='container'>";

        $carid = isset($_GET['carid']) && is_numeric($_GET['carid']) ? intval($_GET['carid']) : 0;
        $check = checkItem('id', 'cars', $carid);

        if ($check > 0) {
            $stmt = $con->prepare("DELETE FROM cars WHERE id = :zid");
            $stmt->bindParam(":zid", $carid);
            $stmt->execute();


            echo '<div>
<br><br><br><br></div><h1>Car Deleted</h1>';
        } else {
            $theMsg = "This ID Is Not Exist";

        }
        echo "</div>";

    }
    include $tpl . 'footer.php';
} else {
    header('location : index.php');
    exit();
}

ob_end_flush();


?>
