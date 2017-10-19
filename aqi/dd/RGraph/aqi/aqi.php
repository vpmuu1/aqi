<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 

<?php
header("content-type:text/html; charset=gbk");
    /**
    * Change these to your own credentials
    */
//$con = mysql_connect("58.56.46.100","uaqi","123456");
include '../../../../mysql.php';
$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password);
//$con = mysql_connect("58.56.46.100","uaqi","123456");
//$con = mysql_connect("mysql.yupage.com","u666673805_aqi","1q2w3e4r");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

// some code


mysqli_select_db($con, $mysql_database);
print $_GET['city'];



//mysqli_query("set character set 'utf8'");
//mysql_query("set names 'utf8'");

//$result = mysql_query("SELECT dt,aqi,concat('<div style=\"text-align: center;\"> <b>',aqi,'</b><br />',dt) tips FROM city where name='济南' order by dt");   
//$result = mysql_query("select * from (SELECT 100 line,dt,aqi,concat('<div style=\"text-align: center;\"> <b>',aqi,'</b><br />',dt) tips FROM city where name='".$_GET['city']."' order by dt desc limit 40) as tbl order by dt");   

$result = mysqli_query($con, "update citycnt set cnt=cnt+1 where name='".$_GET['city']."'");   
$result = mysqli_query($con, "select * from (SELECT dt,aqi,concat('',aqi,'') tips FROM city where name='".$_GET['city']."' order by dt desc limit 40) as tbl order by dt");   

 if ($result) {
    
        $labels = array();
        $data   = array();

        $tips   = array();
    
        while ($row = mysqli_fetch_assoc($result)) {
            $labels[] = $row["dt"];
            $data[]   = $row["aqi"];
            $tips[]   = $row["tips"];

        }

        // Now you can aggregate all the data into one string
        $data_string = "[" . join(", ", $data) . "]";
        $labels_string = "['" . join("', '", $labels) . "']";
        $tips_string = "['" . join("', '", $tips) . "']";
    } else {
        print('MySQL query failed with error: ' . mysql_error());
    }
?>


    <link rel="stylesheet" href="demos.css" type="text/css" media="screen" />
    
    <script src="../libraries/RGraph.common.core.js" ></script>
    <script src="../libraries/RGraph.common.dynamic.js"></script>
    <script src="../libraries/RGraph.common.tooltips.js"></script>
    <script src="jquery.min.js"></script>
    <script src="../libraries/RGraph.line.js" ></script>

    <!--[if lt IE 9]><script src="../excanvas/excanvas.js"></script><![endif]-->
    
    <title>turbo AQI</title>
    
    <meta name="description" content="turbo AQI" />
</head>
<body>

    <h1>turbo AQI</h1>

    <canvas id="cvs" width="1200" height="550">[No canvas support]</canvas>
    
    <script>

       $(document).ready(function ()
        {
           var line = new RGraph.Line('cvs', [<?php print($data_string) ?>,[100,100]])
                .Set('labels',  <?php print($labels_string) ?>)
                .Set('chart.labels.ingraph',<?php print($tips_string) ?>)

                .Set('chart.text.angle', 45)
                .Set('chart.gutter.bottom',111)
                .Set('chart.gutter.left',95)
                .Set('tickmarks', 'filledcircle')
                .Set('tooltips.hotspot.xonly', true)
                .Set('colors', [['red','green'],'blue'])
                .Set('chart.colors.alternate', true)
                .Set('chart.linewidth',1)
		        .Set('chart.shadow',false)
                .Draw()    
        })
    </script>

<table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
<tbody>
<tr><td>No</td><td>mc</td><td>aqi</td><td>PM25</td><td>PM10</td><td>SO2</td><td>NO2</td><td>O31</td><td>O38</td><td>CO</td><td>first</td></tr>
<?php
//$result = mysql_query(" select  * from aqi where myaqi>1 and cityname='".$_GET['city']."' and dt=(select max(dt) from aqi);");
//$result = mysql_query(" select aa.*,aa.myaqi-bb.myaqi daqi,aa.pm25-bb.pm25 dpm25,aa.pm-bb.pm dpm from aqi as aa,aqi as bb where aa.myaqi>1 and aa.cityname='".$_GET['city']."' and aa.dt=(select max(dt) from aqi) and bb.jczd_mc=aa.jczd_mc and bb.cityname=aa.cityname and bb.dt=DATE_ADD(aa.dt, INTERVAL '-1' HOUR)  order by aa.JCZD_MC;");
$result = mysqli_query($con, " select vaa.*,vaa.myaqi-vbb.myaqi daqi,vaa.pm25-vbb.pm25 dpm25,vaa.pm-vbb.pm dpm from vaa,vbb where vaa.myaqi>1 and vaa.cityname='".$_GET['city']."' and vbb.jczd_mc=vaa.jczd_mc and vbb.cityname=vaa.cityname  order by vaa.JCZD_MC;

");

$no=1;
while($row = mysqli_fetch_array($result))
  {

//  echo "<td>" . $row['name'] . " " . $row['aqi'] . "  " . $row['dt']."</td>";
  echo "<tr>"; 
   echo "<td>" ;
    echo $no++;
    echo "</td>" ;

    echo "<td><a href='dd/RGraph/aqi/aqi.php?city=".$row['JCZD_MC']."'>" ;
    echo $row['JCZD_MC'];
    echo "</a></td>" ;

    echo "<td>".$row['myaqi'];
    if (substr($row['daqi'],0,1)=="-") echo "<small><small><span style='color: green;'>[".$row['daqi']."]</span></small></small></td>";
    else if (substr($row['daqi'],0,1)!="0") echo "<small><small><span style='color: red;'>[+".$row['daqi']."]</span></small></small></td>";

    echo "<td>".$row['PM25']."</td>" ;
    echo "<td>".$row['PM']."</td>" ;
    echo "<td>".$row['SO2']."</td>" ;
    echo "<td>".$row['NO2']."</td>" ;
    echo "<td>".$row['O31']."</td>" ;
    echo "<td>".$row['O38']."</td>" ;
    echo "<td>".$row['CO']."</td>" ;
    echo "<td>".$row['firstp']."</td>" ;

//    if ($row['delta']>0) echo "<td style='background-color: red;'>".$row['delta']."<br></td>";
//    else echo "<td style='background-color: rgb(153, 255, 153);'>".$row['delta']."<br></td>";

  echo "</tr>" ;
//  echo "<br />";
  }

mysqli_close($con);

?>
</tr></table>
</tbody>
</table>

    <p>
        <a href="/">&laquo; Back</a>
    </p>
    email:webmaster@aqi.yupage.com
</body>
</html>
