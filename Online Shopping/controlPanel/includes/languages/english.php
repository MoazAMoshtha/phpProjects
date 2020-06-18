<?php


	function lang( $phrase ){

		static $lang = array(

			'MESSEGE' => 'Welcome',
			'ADMIN'  => 'Administrator'
		);

		return $lang[$phrase];

	}


?>