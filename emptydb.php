<?php
$con = mysql_connect("localhost","importio","KreXuw") or die('MySQL error: '.mysql_error());
$db = mysql_select_db("ImportIO") or die("MySQL error: ".mysql_error());
$query = "DROP TABLE  `Producten`";
mysql_query($query) or die(mysql_error());
$query = "CREATE TABLE `Producten` (ID INT(7) AUTO_INCREMENT PRIMARY KEY)";
mysql_query($query) or die(mysql_error());

?>