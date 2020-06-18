<?php

/*
======================================
== Template Page
======================================
*/
ob_start();
session_start();

if(isset($_SESSION['Username'])){
  include 'init.php';

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
  if ($do == 'Manage'){ // Manage Members Page

  }elseif ($do == 'Add') {
    echo "Welcome";
  }elseif($do == 'Insert'){

  } elseif ($do == 'Edit') {

  }elseif ($do == 'Update'){

  }elseif ($do == 'Activate'){

  }
    include $tpl .'footer.php';
  }else{
    header('location : index.php');
	  exit();
  }

  ob_end_flush();





 ?>
