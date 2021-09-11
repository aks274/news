<?php
$dbHost = "localhost";
$dbUser = "news";
$dbPass = "123";
$dbName = "news";
$db = mysqli_connect($dbHost, $dbUser, $dbPass) or die("Ошибка подключения!");
mysqli_select_db($db, "news");

?>