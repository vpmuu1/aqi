<?php


include 'mysql.php';

$con1 = mysql_connect($mysql_host,$mysql_user,$mysql_password);
if (!$con1)   die('Could not connect: yupage' . mysql_error());

mysql_query("set character set 'utf8'",$con1);
mysql_query("set names 'utf8'",$con1);
mysql_select_db($mysql_database, $con1);

$lines = gzfile('tt.gz');
foreach ($lines as $line) {
    echo $line;
    if (!mysql_query($line,$con1)) echo "Error : " . mysql_error();

}


?>
