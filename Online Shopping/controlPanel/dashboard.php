<?php
ob_start();
session_start();
if (isset($_SESSION['Username'])) {
    $pageTitle = 'Dashboard';
    include 'init.php';
    $latestUsers = 6;
    $theLatest = getlatest('*', 'users', 'UserID', $latestUsers);
    ?>


    <div class="container home-stats text-center">
        <div><br><br><br><br><br><br>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-all">
                    Members
                    <span><a href="members.php"><?php echo countItems('UserID', 'users') ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-all">
                    Categories
                    <span>
						<?php echo countItems('name', 'categories') ?>
					</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-all">
                    Items
                    <span>
                        <?php echo countItems('Name', 'items')?>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-all">
                    last login
                    <span>
                        <?php
                        if(isset($_SESSION['Username'])){
                          echo $_SESSION['Username'];
                        }
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    </div>


    <?php
    include $tpl . 'footer.php';
} else {
    header('location : index.php');
    exit();
}
ob_end_flush();
