<?php

include "database.php";
session_start();

$status = $_SESSION["role"];

if ($status!=1 || empty($_SESSION)) {
	echo "У вас нет доступа к это странице!";
	die;
}

$login = $_POST["login"];
$user_id = $_POST["user_id"];

$search = mysqli_query($db,"SELECT * FROM user WHERE login = '$login' OR id = '$user_id'");
$searchArr =  mysqli_fetch_assoc($search);
$count = mysqli_num_rows($search);

if ($count == 0){
	$searchRes = "Ничего не найдено";
	$searchId = "";
	$buttonDisabled = "disabled";
	$userResId = "";
	$userResLog = "";
}
else {
	$searchRes = $searchArr["login"];
	$searchId = $searchArr["id"];
	$buttonDisabled = "";
	$userResId = $searchId;
	$userResLog = $searchRes;
}

$pageId = $_POST["pageId"];

$searchPage = mysqli_query($db,"SELECT * FROM content WHERE id = '$pageId'");
$searchArrP =  mysqli_fetch_assoc($searchPage);
$countPage = mysqli_num_rows($searchPage);

if ($countPage == 0){
	$searchResP = "Ничего не найдено";
	$searchPId = "#";
	$buttonPDisabled = "disabled";
	$searchResId = "";
}
else {
	$searchResP = iconv("utf-8", "windows-1251",$searchArrP["head"]);
	$searchPId = "page.php?id=".$searchArrP["id"];
	$searchResId = $searchArrP["id"];
	$buttonPDisabled = "";
	$_GET['OpResult'] = "";
}

include "admin_panel.html"
?>