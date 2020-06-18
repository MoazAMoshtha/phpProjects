<?php
ob_start();
session_start();
$pageTitle = 'Categoris';

if (isset($_SESSION['Username'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') { // Manage Members Page
        $sort = 'ASC';
        $sort_array = array('ASC', 'DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            $sort = $_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
        $stmt2->execute();
        $cats = $stmt2->fetchAll(); ?>
        <br><br><br><br><br>
        <div class="container categoris">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class=""></i>
                    <h1>Manage Categoris</h1>
                </div>
                <div class="panel-body">
                    <?php
                    foreach ($cats as $cat) {
                        echo "<div class='cat'>";
                        echo "<div class='hidden-buttons'>";
                        echo "<a href='categoris.php?do=Edit&catid=" . $cat['ID'] . " ' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
                        echo "<a href='categoris.php?do=Delete&catid=" . $cat['ID'] . " ' class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i> Delete</a>";
                        echo "</div>";
                        echo "<h1>" . $cat['Name'] . '</h1>';
                        echo "<div class='full-view'> <h3>";
                        echo "<p>";
                        if ($cat['Description'] == '') {
                            echo "This Category has no description ";
                        } else {
                            echo $cat['Description'];
                        }
                        echo "</p>";
                        echo "</h3></div>";
                        echo "</div>";
                        echo "<hr>";
                    }
                    ?>
                </div>
            </div>
            <a class="add-category btn btn-primary" href="categoris.php?do=Add"><i></i>
                <h3> Add New Category</h3></a>
        </div>

        <?php

    } elseif ($do == 'Add') { ?>
        <br><br><br><br>
        <div class="container">
            <form class="form-horeizontal" action="?do=Insert" method="POST">
                <h1 class="text-center">Add New Category</h1>
                <div class="container box">
                    <div class="form-group">
                        <label for="login"><h2>Name</h2></label>
                        <input required="" name="name" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>
                    <div class="form-group">
                        <label for="login"><h2>Description</h2></label>
                        <input required="" name="description" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>
                    <div class="form-group">
                        <label for="password"><h2>Ordering</h2></label>
                        <input required="" name="ordering" type="text" value="" class="form-control"
                               style="font-size: 20px">
                    </div>
                    <br>
                </div>

                <!-- Start Submit Field -->
                <div class="form-group form-group-lg">
                    <div class="col-sm-offset-2 col-sm-6">
                        <input type="submit" value="Add Category" class="btn btn-primary btn-lg">
                    </div>
                </div>
                <!-- End Submit Field -->
            </form>
        </div>

        <?php
    } elseif ($do == 'Insert') {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo "<h1 class='text-center'>Insert Category</h1>";
            echo "<div class = 'container'>";
            // Get Varible From The Form

            $name = $_POST['name'];
            $desc = $_POST['description'];
            $order = $_POST['ordering'];


            // Check If Categories Is Exist In Database
            $check = checkItem("Name", "Categories", $name);
            if ($check == 1) {

                echo 'Sorry This Category Is Exist';

            } else {
                // Insert Category Info In Database

                $stmt = $con->prepare("INSERT INTO
          Categories (Name , Description , Ordering)
          VALUES(:zname , :zdesc , :zorder )");
                $stmt->execute(array(
                    'zname' => $name,
                    'zdesc' => $desc,
                    'zorder' => $order,


                ));
                echo 'Recode Insert';
            }

        } else {
            echo "<div class='container'>Sorry You Cant Browse This Page Directly";
            echo "</div>";
        }

        echo "</div>";

    } elseif ($do == 'Edit') {

        //Check ID  Get Request Userid  Is numaric
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

        $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
        $stmt->execute(array($catid));
        $cat = $stmt->fetch();
        $count = $stmt->rowCount();

        // If There's Such ID Show The Form
        if ($count > 0) { ?>

            <h1 class="text-center">Edit Category</h1>
            <div class="container">
                <form class="form-horeizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="catid" value="<?php echo $catid; ?>"/>

                    <!-- Start Name Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="name" class="form-control" required="required"
                                   placeholder="Name Of The Category" value="<?php echo $cat['Name'] ?>">
                        </div>
                    </div>
                    <!-- End Name Field -->
                    <!-- Start Dsecription Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10  col-md-4">
                            <input type="text" name="description" class="form-control"
                                   placeholder="Describ The Category" value="<?php echo $cat['Description'] ?>">
                        </div>
                    </div>
                    <!-- End Dsecription Field -->
                    <!-- Start Ordering Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Ordering</label>
                        <div class="col-sm-10 col-md-4">
                            <input type="text" name="ordering" class="form-control"
                                   placeholder="Number to Arrang Categoris" value="<?php echo $cat['Ordering'] ?>">
                        </div>
                    </div>
                    <!-- End Ordering Field -->
                    <!-- Start Visibelity Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-4">
                            <div>
                                <input id="vis-yes" type="radio" name="visibility"
                                       value="0" <?php if ($cat["Visibility"] == 0) {
                                    echo "checked";
                                } ?>/>
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="visibility"
                                       value="1"<?php if ($cat["Visibility"] == 1) {
                                    echo "checked";
                                } ?> />
                                <label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- End Visibelity Field -->
                    <!-- Start Commenting Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Commenting</label>
                        <div class="col-sm-10 col-md-4">
                            <div>
                                <input id="com-yes" type="radio" name="commenting"
                                       value="0" <?php if ($cat["Allow_Comment"] == 0) {
                                    echo "checked";
                                } ?> />
                                <label for="com-yes">Yes</label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" name="commenting"
                                       value="1" <?php if ($cat["Allow_Comment"] == 1) {
                                    echo "checked";
                                } ?> />
                                <label for="com-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- End Commenting Field -->
                    <!-- Start Ads Field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-4">
                            <div>
                                <input id="ads-yes" type="radio" name="ads"
                                       value="0" <?php if ($cat["Allow_Ads"] == 0) {
                                    echo "checked";
                                } ?>/>
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" name="ads" value="1" <?php if ($cat["Allow_Ads"] == 1) {
                                    echo "checked";
                                } ?>/>
                                <label for="ads-no">No</label>
                            </div>

                        </div>
                    </div>
                    <!-- End Ads Field -->
                    <!-- Start Submit Field -->
                    <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-6">
                            <input type="submit" value="Save" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <!-- End Submit Field -->
                </form>
            </div>

            </div>

        <?php } else {
            echo "<div class'container'>Theres No Such ID";

            echo "</div>";
        }

    } elseif ($do == 'Update') {

        echo "<h1 class='text-center'>Update Category</h1>";
        echo "<div class = 'container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get Varible From The Form

            $id = $_POST['catid'];
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $order = $_POST['ordering'];

            $visible = $_POST['visibility'];
            $comment = $_POST['commenting'];
            $ads = $_POST['ads'];


            // Update The Database With This Info
            $stmt = $con->prepare("UPDATE
                                  categories
                            SET
                                  name = ? ,
                                  Description = ? ,
                                  Ordering = ? ,
                                            WHERE
                                  ID = ?");

            $stmt->execute(array($name, $desc, $order, $id));
            echo "<h1>Recode Updated</h1>";
        } else {
            echo "Sorry You Can't Browse This Page Directly";
        }

        echo "</div>";

    } elseif ($do == 'Delete') {

        //Check ID  Get Request Catid  Is numaric
        echo "<h1 class='text-center'>Delete Category</h1>";
        echo "<div class='container'>";

        $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        $check = checkItem('ID', 'categories', $catid);

        if ($check > 0) {
            $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");
            $stmt->bindParam(":zid", $catid);
            $stmt->execute();

            echo "categories Deleted";
        } else {
            echo "This ID Is Not Exist";
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
