<?php
$servername = getenv(strtoupper(getenv("DATABASE_SERVICE_NAME"))."_SERVICE_HOST");
$username = getenv("DATABASE_USER");
$password = getenv("DATABASE_PASSWORD");

$mysql_host = $servername;
$mysql_database = "default";
$mysql_user = $username;
$mysql_password = $password;
?>
