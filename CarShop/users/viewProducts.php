<?php
ob_start();
session_start();
$pageTitle = "Cars";
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
        <h1 class="text-center">All Cars</h1><br>
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
                    </tr>
                    <?php

                    foreach ($cars as $item) {
                        echo "<tr>";
                        echo "<td><h2>" . $item['id'] . "</h2></td>";
                        echo "<td><h2>" . $item['manufacturer'] . "</h2></td>";
                        echo "<td><h2>" . $item['model'] . "</h2></td>";
                        echo "<td><h2>" . $item['price'] . "</h2></td>";
                        $carimg = $item['image'] . ".jpg";
                        echo "<td class='w-25'><img src='carImg/$carimg' alt='' class=' w-50 p-0 m-0'></td>";
                        echo "<td>
                           
							<a href ='cars.php?do=Edit&carid=" . $item['id'] . " 'class='btn btn-success'><i class='fa fa-edit'></i><h2>Edit</h2></a>
							<a href ='cars.php?do=Delete&carid=" . $item['id'] . " ' class='btn btn-danger confirm'><i class='fa fa-close'></i> <h2>Delete</h2> </a>";

                        echo "</td>";
                        echo "</tr>";
                    }
                    include $tpl . 'footer.php';

                    ob_end_flush();

                    ?>

                </table>
            </div>
        </div>
    <?php }
} ?>