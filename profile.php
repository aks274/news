<?php

session_start(); 
include "database.php";
$cont_count = mysqli_query($db,"SELECT * FROM content");
$cont_amount = mysqli_num_rows($cont_count);

$id = $_SESSION["user_id"];
$login = $_SESSION["login"];
$mail = $_SESSION['mail'];
$userRate = $_SESSION["userRate"]; 

if (empty($_SESSION)){
	$loggedin = 'Войти';	
	$redirect = 'auth.html';
	$loggedin1 = 'display: none';
	header("Location: auth_error.html");
} else {
	$loggedin = 'Выйти';
	$redirect = 'exit.php';
	$loggedin1 = '';
}

$dbNews = $db->query("SELECT * FROM content WHERE author = '$login' ORDER BY id DESC");
$arrNews = array();
$cont_amount = count($arrNews);
while ($arrNew = $dbNews->fetch_assoc()){
	$arrNews[$arrNew['id']] = $arrNew;
}

if ($cont_amount == 0) $rows1 = "<h4 style = 'font-size: 1.5rem; margin-bottom: -1rem'>Вы не добавляли новостей.</h4>";
else{
	if ($cont_amount % 2 != 0){
		$number = 0;
		$lastChild = end($arrNews);
		foreach($arrNews as $key => $arrValue)
		{
			$header = iconv("utf-8", "windows-1251", $arrValue["head"]);
			$date_post = $arrValue["date"];
			$preview = iconv("utf-8", "windows-1251", $arrValue["preview"]);
			$img = $arrValue["img"];
			if ($img == '') $img = 'style/img-error.png';
			$link = $key;
			$block = "<div class = 'block'><div class = 'block-img' style = 'background-image: url($img);'></div><h4>$date_post</h4>
					<h3>$header</h3>
					<p>$preview</p>
					<a href = 'page.php?id=$link'>Читать далее...</a></div>";
				if ($number % 2 == 0) {
					if ($key == $lastChild['id']){
					$row = "<div class = 'row'>$block</div>";
					$rows1 .= $row;
					} else $row = "<div class = 'row'>$block";
				} else {
				$row = $row."$block</div>";
				$rows1 = $rows1.$row;
				}
			$number++;	
		}
	} else {
		$number = 0;
		foreach($arrNews as $key => $arrValue)
		{
			$header = iconv("utf-8", "windows-1251", $arrValue["head"]);
			$date_post = $arrValue["date"];
			$preview = iconv("utf-8", "windows-1251", $arrValue["preview"]);
			$img = $arrValue["img"];
			if ($img == '') $img = 'style/img-error.png';
			$link = $key;
			$block = "<div class = 'block'><div class = 'block-img' style = 'background-image: url($img);'></div><h4>$date_post</h4>
					<h3>$header</h3>
					<p>$preview</p>
					<a href = 'page.php?id=$link'>Читать далее...</a></div>";
				if ($number % 2 == 0) $row = "<div class = 'row'>$block";
				else {
				$row = $row."$block</div>";
				$rows1 = $rows1.$row;
				}
			$number++;	
		}
	}
}

$dbComms = $db->query("SELECT * FROM comments WHERE user_login = '$login' ORDER BY id DESC");
$arrComms = array();
while ($arrComm = $dbComms->fetch_assoc()){
	$arrComms[$arrComm['id']] = $arrComm;
}

$number = count($arrComms);
$emptyComm = "";
if ($number == 0) $emptyComm = "Пока вы не оставляли комментариев";
$lastChild = end($arrComms);

if ($number % 2 != 0){
	$c = 0;
	foreach($arrComms as $key => $arrValue)
	{
		$userComm = $arrValue["user_login"];
		$dateComm = $arrValue["date"];
		$pageId = $arrValue["page_id"];
		$comm = iconv("utf-8", "windows-1251", $arrValue["comm"]);
		$block = "<div class = 'block'><h4>$dateComm</h4>
				<h3>$userComm</h3>
				<p>$comm</p>
				<p style = 'margin-bottom: -.5rem'><a href = 'page.php?id=$pageId'>Ссылка</a> на страницу с комментарием</p>
				</div>";
			if ($c % 2 == 0) {
				if ($key == $lastChild['id']){
				$row = "<div class = 'row'>$block</div>";
				$rows .= $row;
				} else $row = "<div class = 'row'>$block";
			} else {
				$row = $row."$block</div>";
				$rows = $rows.$row;
				}
		$c++;	
	}	
}
else {
	foreach($arrComms as $key => $arrValue)
		{
		$userComm = $arrValue["user_login"];
		$dateComm = $arrValue["date"];
		$comm = iconv("utf-8", "windows-1251", $arrValue["comm"]);
		$block = "<div class = 'block'><h4>$dateComm</h4>
				<h3>$userComm</h3>
				<p>$comm</p>
				</div>";
			if ($number % 2 == 0) $row = "<div class = 'row'>$block";
			else {
				$row = $row."$block</div>";
				$rows = $rows.$row;
				}
		$number++;	
		}
}
			
include "profile.html";
?>