<?php

$con1 = mysql_connect("localhost","643731","1q2w3e4r");
if (!$con1)   die('Could not connect: yupage' . mysql_error());

mysql_query("set character set 'utf8'",$con1);
mysql_query("set names 'utf8'",$con1);

// some code

$inss=$_GET['sql'];
mysql_select_db("643731", $con1);
print $inss;
mysql_query($inss,$con1);

$inss="insert into tt (id) values ('a乌a')";
print $inss;
mysql_query($inss,$con1);


?>
