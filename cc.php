<?php
$con = mysql_connect("58.56.46.100","uaqi","123456");
//$con = mysql_connect("localhost","uaqi","123456");

if (!$con)
  {
  die('Could not connect: 5856' . mysql_error());
  }

// some code


mysql_select_db("aqi", $con);

$con1 = mysql_connect("localhost","643731","1q2w3e4r");
if (!$con1)   die('Could not connect: yupage' . mysql_error());


// some code


mysql_select_db("aqi", $con);
mysql_select_db("643731", $con1);

mysql_query("set character set 'utf8'",$con);
mysql_query("set names 'utf8'",$con);

$sql = "SELECT * FROM aqi where dt= '".$_GET['dt']."' ";
//$dt="2013-07-21 19:00:00";
//$sql = "SELECT * FROM aqi where dt= '".$dt."' ";


print $sql;
$result = mysql_query($sql,$con);
while($row = mysql_fetch_array($result))
  {

//  echo "<td>" . $row['name'] . " " . $row['aqi'] . "  " . $row['dt']."</td>";
  $inss="INSERT INTO `aqi` (`id`, `cityname`, `JCZD_MC`, `AQI`, `PM25`, `PM`, `SO2`, `NO2`, `O31`, `O38`, `dt`, `CO`, `SJLY`, `myaqi`, `firstp`) VALUES ('".$row['id']."','" .$row['cityname']."','".$row['JCZD_MC']."',".$row['AQI']."," . $row['PM25'].",".$row['PM'].",".$row['SO2'].",".$row['NO2'].",".$row['O31'].",".$row['O38'].",'".$row['dt']."',".$row['CO'].",'".$row['SJLY']."',".$row['myaqi'].",'".$row['firstp']."')";
//print $inss;
mysql_query($inss,$con1);

}

$sql = "SELECT * FROM city where dt= '".$_GET['dt']."' ";


print $sql;
$result = mysql_query($sql,$con);
while($row = mysql_fetch_array($result))
  {

//  echo "<td>" . $row['name'] . " " . $row['aqi'] . "  " . $row['dt']."</td>";
  $inss="INSERT INTO `city` (`name`, `dt`, `aqi`, `delta`) VALUES ('".$row['name']."','" .$row['dt']."',".$row['aqi'].",".$row['delta'].")";
//print $inss;
mysql_query($inss,$con1);

}


?>
