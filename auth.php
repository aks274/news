<?php

include "database.php";
session_start();

$login = $_POST["login"];
$password = md5($_POST["password"]);
$comp = false;

$check = mysqli_query($db,"SELECT id FROM user WHERE login = '$login' AND pass ='$password'");
$arr =  mysqli_fetch_assoc($check);
$num = $arr['id'];
$count = mysqli_num_rows($check);

if ($count > 0){
	$que1 = mysqli_query($db,"SELECT * FROM user WHERE id = '$num'");
	$arr1 =  mysqli_fetch_assoc($que1);
	if ($arr1['role'] == 0){
		$auth_status = 'Ваш аккаунт заблокирован';
		require_once("auth.html");
	}
	else {
		$_SESSION["user_id"] = $num;
		$log = $arr1['login'];
		$_SESSION["login"] = $log;
		$eml = $arr1['mail'];
		$_SESSION["mail"] = $eml;
		$status = $arr1['role'];
		/*$rateCount = mysqli_query($db,"SELECT rate FROM content WHERE author = '$login'");
		$comp = mysqli_num_rows($rateCount);
		if ($comp != 0){ 
			$arrRate =  mysqli_fetch_assoc($rateCount);
			foreach($arrRate as $key => $arrValue){
				$sum += (int)$arrValue['rate'];
				echo $arrValue['rate'];
			}
			$userRate = $arr1['userRate'];
			if ($sum != $userRate)
			mysqli_query($db,"UPDATE user SET userRate = '$sum' WHERE login = '$log'");
		}
		$_SESSION["role"] = $status;
		$userRate = $arr1['userRate'];
		$_SESSION["userRate"] = $userRate;*/
		header("Location: index.php");
	}
}
else {
	$auth_status = 'Неправильный логин или пароль';
	require_once("auth.html");
}
?>