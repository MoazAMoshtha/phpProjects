<?php


ob_start();
session_start();
$pageTitle = "Items";
if(isset($_SESSION['Username'])){
  include 'init.php';
  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;
      if ($do == 'Manage'){
			$stmt = $con->prepare("SELECT * FROM items");
			$stmt->execute();
			$items =$stmt->fetchAll();
			?>
          <div>
              <br><br></div>
			<h1 class="text-center">Manage products</h1><br>
          <div>
              <br><br>
          </div>
			<div class="container">
				<div class="table-responsive ">
					<table class="main-table text-center table table-bordered ">
						<tr class="">
							<td><h2>ID</h2></td>
							<td><h2>Name</h2></td>
							<td><h2>Description</h2></td>
							<td><h2>Price</h2></td>
							<td><h2>Control</h2></td>
						</tr>
						<?php

						foreach ($items as $item) {
							echo "<tr>";
							echo "<td><h2>" . $item['ItemID'] . "</h2></td>";
							echo "<td><h2>" . $item['Name'] . "</h2></td>";
							echo "<td><h2>" . $item['Description'] . "</h2></td>";
							echo "<td><h2>" . $item['Price'] . "</h2></td>";
							echo "<td>
                            
							<a href ='items.php?do=Edit&itemid=" . $item['ItemID']. " 'class='btn btn-success'><i class='fa fa-edit'></i><h2>Edit</h2></a>
							<a href ='items.php?do=Delete&itemid=" . $item['ItemID']. " ' class='btn btn-danger confirm'><i class='fa fa-close'></i> <h2>Delete</h2> </a>";

							echo "</td>";
							echo "</tr>";
						}

						?>

					</table>
				</div>
                <a href = 'items.php?do=Add' class="btn btn-primary"><h2>Add New product</h2></a>
			</div>

		<?php	}
  elseif ($do == 'Add') { ?>
<div>
    <br><br><br><br>
</div>

<div class="container">
    <form class="form-horeizontal" action="?do=Insert" method="POST">
        <h1 class="text-center">Add New Product </h1>
        <div class="container box">
            <div class="form-group">
                <label for="Name"><h2>Name</h2></label>
                <input required="" name="name" type="text" value="" class="form-control" style="font-size: 20px">
            </div>
            <div class="form-group">
                <label for="Description"><h2>Description</h2></label>
                <input required="" name="description" type="text" value="" class="form-control" style="font-size: 20px">
            </div>
            <div class="form-group">
                <label for="Price"><h2>Price</h2></label>
                <input required="" name="price" type="text" value="" class="form-control" style="font-size: 20px">
            </div>
            <br>
        </div>


        <div class="form-group">
            <label for="Category" class="col-sm-2 control-label"><h2>Category</h2></label>
            <select class="form-control" id="category" name="cataegory">
                <option value="0">select category</option>
                <?php
                $stmt2 =$con->prepare("SELECT * FROM categories ");
                $stmt2->execute();
                $cats =$stmt2-> fetchAll();
                foreach($cats as $cat){
                    echo"<option value='".$cat['ID']."'>".$cat['Name']."</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group form-group-lg" >
                <input type="submit" value="Add Item" class="btn btn-primary btn-sm" style="font-size: 20px">
        </div>


    </form>
</div>

<?php
  }elseif($do == 'Insert'){

			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				echo "<h1 class='text-center'></h1>";
				echo "<div class = 'container'>";
		// Get Varible From The Form
     
				$name 	= $_POST['name'];
				$desc 	= $_POST['description'];
				$price 	= $_POST['price'];
				$cat	= $_POST['cataegory'];

				$formErrors = array();
                	
				if (empty($name)){
					$formError[] = 'name can/t be <strong> empty</strong>';
				}
				if (empty($desc)){
					$formError[] = 'description can/t be <strong> empty</strong>';
				}
				if (empty($price)){
					$formError[] = 'price can/t be <strong> empty</strong>';
				}
				if ($cat==0){
					$formError[] = 'cat can/t be <strong> empty</strong>';
				}


			// Check If There Is No Error Proceed  The Update Opration
				if (empty($formError)){
		
					// Insert The Database With This Info
						$stmt = $con->prepare("INSERT INTO
							items(Name, Description, Price,  CatID)
							VALUES(:zname, :zdesc, :zprice, :zcat)");
						$stmt->execute(array(

							'zname' => $name,
							'zdesc' => $desc,
							'zprice' => $price,
							'zcat' => $cat,

						));
                    echo "<br><br><br><br><h1>" . "Product Insert" . "</h1>";


					
				}
			}else {
				echo "<div class='container'>Sorry You Cant Browse This Page Directly";

				echo "</div>";
			}

			echo "</div>";

      
      
      
      
      
      
      
      
      
      
      
      
  } elseif ($do == 'Edit') {
      
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
	$stmt = $con->prepare("SELECT * FROM items WHERE ItemID = ?");
	$stmt->execute(array($itemid));
	$item = $stmt->fetch();
	$count = $stmt->rowCount();
	if ($count> 0){ ?>

		<h1 class="text-center">Edit Product</h1>
<div class="container">
    <form class="form-horeizontal" action="?do=Update" method="POST">
          				<input type="hidden" name="itemid" value="<?php echo $itemid; ?>"/>

        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Name Of The Item" value="<?php  echo $item['Name']?>">
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="description" class="form-control" placeholder="Description Of The Item" value="<?php  echo $item['Description']?>">
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10 col-md-4">
                <input type="text" name="price" class="form-control" placeholder="Price Of The Item" value="<?php  echo $item['Price']?>">
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10 col-md-4">
                <select name="cataegory">
                    <option value="0">...</option>
                    <?php
                $stmt2 =$con->prepare("SELECT * FROM categories ");
                $stmt2->execute();
      $cats =$stmt2-> fetchAll();
      foreach($cats as $cat){
          echo"<option value='".$cat['ID']."'";
           if($item['CatID']==$cat['ID']){echo 'selected';}
          echo ">".$cat['Name']."</option>";
      }
                ?>
                </select>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <div class="col-sm-offset-2 col-sm-6">
                <input type="submit" value="Save Item" class="btn btn-primary btn-sm">
            </div>lo
        </div>
    </form>
</div>
	<?php } else {
		echo "<div class'container'>";
		$theMsg = "<div class='alert alert-danger'>Theres No Such ID</div>";
		redirectHome($theMsg);
		echo "</div>";


	}

  }elseif ($do == 'Update'){
echo "<h1 class='text-center'>Update Product</h1>";
	echo "<div class = 'container'>";
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$id 	= $_POST['itemid'];
$name 	= $_POST['name'];
				$desc 	= $_POST['description'];
				$price 	= $_POST['price'];
				$country 	= $_POST['country'];
				$status 	= $_POST['status'];
                $member 	= $_POST['member'];
				$cat	= $_POST['cataegory'];
		
			$formErrors = array();
                	
				if (empty($name)){
					$formError[] = 'name can/t be <strong> empty</strong>';
				}
				if (empty($desc)){
					$formError[] = 'description can/t be <strong> empty</strong>';
				}
				if (empty($price)){
					$formError[] = 'price can/t be <strong> empty</strong>';
				}
				if (empty($country)){
					$formError[] = 'country can/t be <strong> empty</strong>';
				}
				if ($status == 0){
					$formError[] = 'you must choose the <strong> status</strong>';
				}if ($member==0){
					$formError[] = 'country can/t be <strong> empty</strong>';
				}if ($cat==0){
					$formError[] = 'country can/t be <strong> empty</strong>';
				}
		// Loop Into Error Array And Echo It

				foreach ($formError as $error) {

					echo '<div class = "alert alert-danger">' . $error . '</div>';
				}


		if (empty($formError)){
			$stmt = $con->prepare("UPDATE items SET name = ? , Description = ? , Price = ? , CountryMade = ? ,Status =? ,CatID=?,MemberID=?
            WHERE ItemID = ?");
			$stmt->execute(array($name, $desc , $price , $country ,$status,$cat,$member,$id));
			$theMsg ="<div class = 'alert alert-success'>" .$stmt->rowCount()  .' ' ."Product Updated </div>";
			redirectHome($theMsg, 'back');
		}

	}else {

		$theMsg = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly</div>";
		redirectHome($theMsg);

	}

	echo "</div>";

  }elseif ($do == 'Delete'){

	echo "<div class='container'>";

	$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
	$check = checkItem('ItemID', 'items', $itemid);

	if ($check > 0){
		$stmt = $con->prepare("DELETE FROM items WHERE ItemID = :zid");
		$stmt->bindParam(":zid" , $itemid);
		$stmt->execute();


	echo '<div>
<br><br><br><br></div><h1>Product Deleted</h1>';
	}else{
		$theMsg = "This ID Is Not Exist";

	}
	echo "</div>";

  }
    include $tpl .'footer.php';
  }else{
    header('location : index.php');
	  exit();
  }

  ob_end_flush();





 ?>
