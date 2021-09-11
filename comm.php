<?php
session_start();
include 'database.php';
$comm = iconv("windows-1251", "utf-8", $_POST['comm']);
$login = $_SESSION['login'];
$page_num = $_SESSION['page_id'];
mysqli_query ($db,"INSERT INTO comments (user_login, page_id, comm) VALUES ('$login', '$page_num', '$comm')");
header('Location: page.php?id='.$page_num);
//session_unset($_SESSION['page_id']);
?>	