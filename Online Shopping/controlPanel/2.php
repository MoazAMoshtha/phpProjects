<?php


ob_start();
session_start();

$pageTitle = "Items";

if(isset($_SESSION['Username'])){
  include 'init.php';

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
    
  if ($do == 'Manage'){ // Manage Members Page
    echo "wellcome to items page";
  }elseif ($do == 'Add') { ?>
  
    <h1 class="text-center">Add New Items</h1>
    <div class="container">
      <form class="form-horeizontal" action="?do=Insert" method="POST">
        <!-- Start Name Field -->
        <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10 col-md-4">
            <input
                type="text"
                name="name"
                class="form-control"
                required = "required"
                placeholder="Name Of The Item">
          </div>
        </div>
        <!-- End Name Field -->
        <!-- Start Description Field -->
        <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10 col-md-4">
            <input
                type="text"
                name="description"
                class="form-control"
                required = "required"
                placeholder="Description Of The Item">
          </div>
        </div>
        <!-- End Description Field -->
        <!-- Start Price Field -->
        <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10 col-md-4">
            <input
                type="text"
                name="price"
                class="form-control"
                required = "required"
                placeholder="Price Of The Item">
          </div>
        </div>
        <!-- End Price Field -->
        <!-- Start Country Field -->
        <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Country</label>
          <div class="col-sm-10 col-md-4">
            <input
                type="text"
                name="country"
                class="form-control"
                required = "required"
                placeholder="Country of Made">
          </div>
        </div>
        <!-- End Country Field -->
        <!-- Start Status Field -->
        <div class="form-group form-group-lg">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10 col-md-4">
            <select class="form-control" name="status">
              <option value="0">...</option>
              <option value="1">New</option>
              <option value="2">Like New</option>
              <option value="3">Used</option>
              <option value="4">Very Old</option>
            </select>
          </div>
        </div>
        <!-- End Status Field -->
        <!-- Start Submit Field -->
        <div class="form-group form-group-lg">
          <div class="col-sm-offset-2 col-sm-6">
            <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
          </div>
        </div>
        <!-- End Submit Field -->
      </form>
    </div>

    <?php
  }elseif($do == 'Insert'){

  } elseif ($do == 'Edit') {

  }elseif ($do == 'Update'){

  }elseif ($do == 'Approve'){

  }
    include $tpl .'footer.php';
  }else{
    header('location : index.php');
	  exit();
  }

  ob_end_flush();





 ?>
