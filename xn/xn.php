<html>
<body>

Power <?php

echo $_POST["name"];
echo "%<br> from ";
echo  date("H:i:s",strtotime("+480 minutes")) . "<br>to   ";


/*
$mm= (int)"99";

$mm= (int)$$_POST["name"];
*/
$mm= (int)"99";
$mm= (int)$_POST["name"];


$mm=(100-$mm)*4 + 8*60;
$mm2="+".$mm." minutes";
echo  date("H:i:s",strtotime($mm2)) . "<br>";


?>
</body>
</html>

