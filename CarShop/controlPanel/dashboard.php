<?php
ob_start();
session_start();
if (isset($_SESSION['Username'])) {
    $pageTitle = 'Dashboard';
    include 'init.php';
    $latestUsers = 6;
    $theLatest = getlatest('*', 'users', 'id', $latestUsers);
    ?>


    <div class="container home-stats text-center">
        <div><br><br><br><br><br><br>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="stat st-all">
                    Users
                    <span><a href="members.php"><?php echo countItems('username', 'users') ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-all">
                    Cars
                    <span>
                        <?php echo countItems('manufacturer', 'cars')?>
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
