<?php


	function lang( $phrase ){

		static $lang = array(

			//Navbar Links

			'ADMIN_HOME' 	=> 'Home',
			'CATICIORES'  	=> 'Catigores',
			'ITEMS'			=> 'Items',
			'MEMMBERS'		=> 'Members',
			'STATISTICS'	=> 'Statistics',
			'LOGS'			=> 'Logs'

);


		return $lang[$phrase];

	}


?>