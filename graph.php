<?php
function graph_data(){
  $monthsKey = array("Jan","Feb","Mrt","Apr",'Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec');
  $result = '[';
  $j = 0;
	$con = mysql_connect("localhost","importio","KreXuw") or die('MySQL error: '.
    mysql_error());
	$db = mysql_select_db("ImportIO") or die("MySQL error: ".mysql_error());
	$query = "SELECT DISTINCT Site FROM `Data` ORDER BY Site";
	$sitesRaw = mysql_query($query);
  $sites = array();
  while($site = mysql_fetch_array($sitesRaw)){
    $sites[] = $site['Site'];
  }
  $query = "SELECT DISTINCT Year, Month FROM `Data` ORDER BY Year, Month";
  $months = mysql_query($query);
  while($month = mysql_fetch_array($months)){
    $result = $result.'["'.$monthsKey[intval($month['Month'])-1].' '.$month['Year'].'",';
    $j++;
    foreach($sites as $i => $site){
      $query = "SELECT NumProducts FROM `Data` WHERE `Site`='".$site.
      "' AND `Year`='".$month['Year']."' AND `Month`='".$month['Month']."'";

      $numProducts = mysql_fetch_array(mysql_query($query));
      $numProducts = intval($numProducts['NumProducts']);
      $result .= $numProducts.',';
    }
    $result = rtrim($result,',').'],';
  }

  return rtrim($result,',').']';
}

function clients(){
  $result = "[";
  $con = mysql_connect("localhost","importio","KreXuw") or die('MySQL error: '.
    mysql_error());
  $db = mysql_select_db("ImportIO") or die("MySQL error: ".mysql_error());
  $query = "SELECT DISTINCT Site FROM `Data` ORDER BY Site";
  $sitesRaw = mysql_query($query);
  $sites = array();
  while($site = mysql_fetch_array($sitesRaw)){
    $result .= '"'.$site['Site'].'",';
  }
  echo $result;
  return rtrim($sites,',').']';
}
?>


<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

              google.load('visualization', '1', {packages: ['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'X');

      var clients = <?php echo clients();?>;
      for(var i=0;i<clients.length;++i)
        data.addColumn('number', clients[i]);
      data.addRows(<?php echo graph_data(); ?>);

      var options = {
        width: 1000,
        height: 563,
        hAxis: {
          title: ''
        },
        vAxis: {
          title: 'Num Products (#)'
        }
      };

      var chart = new google.visualization.LineChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);

    }
     console.log(<?php echo graph_data(); ?>)

    </script>
  </head>

  <body>

    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>