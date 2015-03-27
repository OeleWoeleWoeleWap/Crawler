<?php
$con = mysql_connect("localhost","importio","KreXuw") or die('MySQL error: '.mysql_error());
$db = mysql_select_db("ImportIO") or die("MySQL error: ".mysql_error());

$site = getopt("c:");
$year = date('Y');
$month = date('m');

$query = "SELECT * FROM Producten";
$producten = mysql_query($query);

$query = "SELECT * FROM `data_to_save` WHERE `crawlerID` = '".$site."'";
$data_to_save = mysql_query($query);

while($datapoint = mysql_fetch_array($data_to_save)){
	if($datapoint['Type'] == 'Num'){
		$value = mysql_num_rows($producten);
	}
}

$query = "INSERT INTO `Data` (Site, Year, Month, NumProducts) VALUES('".chop($site['c'],'<br>')."','".$year."','".$month."','".$numProducts."')";
mysql_query($query) or die(mysql_error());

?>