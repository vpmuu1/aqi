<?php


$con1 = mysql_connect("localhost","356636","1q2w3e4r");
if (!$con1)   die('Could not connect: yupage' . mysql_error());

mysql_query("set character set 'utf8'",$con1);
mysql_query("set names 'utf8'",$con1);
mysql_select_db("356636", $con1);

$handle = @fopen("sql.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        echo $buffer;
        if (!mysql_query($buffer,$con1)) echo "Error : " . mysql_error();
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}


?>
