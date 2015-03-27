<?php
$con = mysql_connect("localhost","importio","KreXuw") or die('MySQL error: '.mysql_error());
$db = mysql_select_db("ImportIO") or die("MySQL error: ".mysql_error());
$query = "SELECT * FROM crawlers";
$crawlers = mysql_query($query) or die('MySQL error: '.mysql_error());
while($crawler = mysql_fetch_array($crawlers)){
	shell_exec("rm /var/www/ontwikkel/data_crawler/import.io/db/*");
	shell_exec("php /var/www/ontwikkel/data_crawler/emptydb.php /var/www/ontwikkel/data_crawler/");
	shell_exec("timeout ".$crawler['timeOut']." /var/www/ontwikkel/data_crawler/import.io/import.io -crawl /var/www/ontwikkel/data_crawler/crawlers/".$crawler['fileName']." /var/www/ontwikkel/data_crawler/import.io/auth_config.json");
	shell_exec("php -q /var/www/ontwikkel/data_crawler/procesData.php -c".$crawler['ID']);
}

?>