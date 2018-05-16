<?php


include 'mysql.php';

$con1 = mysqli_connect($mysql_host,$mysql_user,$mysql_password);
if (!$con1)   die('Could not connect: yupage' . mysql_error());

mysqli_select_db($con1,$mysql_database);

$lines = gzfile('ttgz/tt.gz');
foreach ($lines as $line) {
    echo $line;
    if (!mysqli_query($con1,$line)) echo "Error : " . mysqli_error($con1);

}


?>

