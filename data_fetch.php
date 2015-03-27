<?php
$con = mysql_connect("localhost","importio","KreXuw") or die('MySQL error: '.mysql_error());
$db = mysql_select_db("ImportIO") or die("MySQL error: ".mysql_error());
$obj = json_decode(file_get_contents('php://input'),true);
foreach($obj['results'] as $i => $product){
	$keys = "";
	$values = "";
	foreach($product as $key => $value){
		$query = "SHOW COLUMNS FROM `Producten` LIKE '".$key."';";
		$exists = mysql_num_rows(mysql_query($query))?TRUE:FALSE;
		if(!$exists){
			$query = "ALTER TABLE `Producten` ADD `".$key."` varchar(255);" or die(mysql_error());
			mysql_query($query);
		}
		$keys = $keys.'`'.$key.'`,';
		$values = $values."'".$value."',";

	}
	$query = "INSERT INTO Producten(".trim($keys,",").") VALUES (".trim($values,",").")";
	$result = mysql_query($query) or die('MySQL error: '.mysql_error());
	
}
?>