
	<?php

	include 'connect.php';

	$tpl  = 'includes/templets/'; 	  // Template Directory
	$lang = 'includes/languages/'; // Language Directory 
	$func = 'includes/functions/'; // Functions Directory
	$css  = 'layout/css/';       	 // Css Directory
	$js   = 'layout/js/';				// JS Directory

		
		//include The Important Files
		include $func . 'functions.php';
		include $lang . 'arabic.php';
		include $tpl . 'header.php';

		// Include Navbar On All Pages Expect The One With $noNavbar Varible
		if (!isset($noNavbar)){

			include $tpl . 'navbar.php';
	}

