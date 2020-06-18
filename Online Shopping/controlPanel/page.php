	<?php  

	//Catigorys 
	$do = isset($_GET['do']) ? $_GET['do'] : 'Manage' ;

	
		//If The Page Is Main page
	if($do == 'Manage'){

		echo "Welcome You Are In Manage Category page";
			echo '<a href="?do=Insert">Add New Category + </a>';
	}elseif ($do == 'Add') {
		
		echo "Welcome You Are In Add Category page";
	}elseif ($do == 'Insert') {
		
		echo "Welcome You Are In Insert Category page";
	
	}else{
		echo "Error There's No Page With This Name ";
	}