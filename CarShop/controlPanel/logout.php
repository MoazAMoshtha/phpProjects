<?php

	session_start(); // session Start

	session_unset(); // unset session

	session_destroy(); // Destroy session

	header('location: http://localhost/CarShop/index.php');

