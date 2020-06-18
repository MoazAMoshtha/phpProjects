<?php
/*
** Title Function v1.0
** That Echo The Pafe Title In Case The Page
** Has The Variable $pageTitle And Echo Defult Title For Other Pages
*/
function getTitle(){

	global $pageTitle;
	if (isset($pageTitle)){

		echo $pageTitle;
	}else{
		echo 'Defult';
	}
}

/**
** Home Redirect Function V2.0
**  This Fanction Accept Parameters
** $theMsg = Echo The Error Message [Error | Sucsees | Warnign]
** $url = The Link You Want to Redirect To
** $second  = Second Before Redirecting
**/
function redirectHome ($theMsg , $url = null, $seconds = 3){

	if ($url == null){
		$url = 'index.php';
		$link = 'HomePage';

	}else{
		if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
			$url = $_SERVER['HTTP_REFERER'];
			$link = 'Previous Page';
		}else{
			$url = 'index.php';
			$link = 'HomePage';
		}
	}
	echo $theMsg;
	echo "<div class='alert alert-info'>You Will Redirected To $link After $seconds Seconds.</div>";
	header("refresh:$seconds; url=$url");
	exit();

}

	/**
	** Check Items Function V1.0
	** Function To Check Items In Database [ Function Accept Parameters]
	** $select = The Items To Select [Example: users , items , categoris]
	** $from = The Table To Select  From  [Example: users , items , categoris]
	** $vlaue  = The Value Of Selcet  [Example: Mohammed , Box  , Electronics]
	**/

	function checkItem($select , $from , $value){
		global $con;
		$statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statment->execute(array($value));
		$count = $statment->rowCount();

		return $count;
	}

/* Count Number Of Items Function v1.0
** Function To Count Of Items Rows
** $item = The Item To Count
** $table = The Table To Choose From
*/
function countItems($item ,$table){
	global $con;

	$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
	$stmt2->execute();
	return $stmt2->fetchColumn();
}

/*
** Get latest Recods Function v1.0
** Function To Get latest Items From Database [ users , items | Comments]
** $SELECT = Field To Select
** $Table = The Table To Choose Form
** $order = The Desc Ordering
** $limit = Number of Record To Get
*/
function getlatest($select , $table ,$order, $limit = 5){
	global $con;
	$getStmt = $con->prepare("SELECT $select FROM users ORDER BY $order DESC LIMIT $limit");
	$getStmt->execute();
	$rows = $getStmt->fetchAll();

	return $rows;
}
