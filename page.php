<?php
session_start(); 
include "database.php";
$cont_count = mysqli_query($db,"SELECT * FROM content");
$cont_amount = mysqli_num_rows($cont_count);

$id = $_SESSION["user_id"];
$login = $_SESSION["login"];

if (empty($_SESSION)){
	$writeComm = "display:none;";
	$loginComm = "";
	$loggedin = 'Войти';	
	$redirect = 'auth.html';
	$loggedin1 = 'display: none';
	session_destroy();
	}
else {
	$writeComm = "";
	$loginComm = "display:none;";
	$loggedin = 'Выйти';
	$redirect = 'exit.php';
	$loggedin1 = '';
}

$news = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM content WHERE id = $_GET[id]"));
$header = iconv("utf-8", "windows-1251", $news["head"]);
$date_post = $news["date"];
$text = iconv("utf-8", "windows-1251", $news["full"]);
$img = $news["img"];
$title = $header;
$author = $news["author"];
$_SESSION["page_id"] = $_GET['id'];

$pageRating = $news["rate"];
$votedCheckQ = mysqli_query($db,"SELECT * FROM rating WHERE pageId = $_GET[id] AND userLogin = '$login'");
$votedCheck = mysqli_num_rows($votedCheckQ);
if (empty($votedCheck))$rateVoted = "";
else $rateVoted = "display:none";

$dbComms = $db->query("SELECT * FROM comments WHERE page_id = $_GET[id] ORDER BY id DESC");
$arrComms = array();
while ($arrComm = $dbComms->fetch_assoc()){
	$arrComms[$arrComm['id']] = $arrComm;
}

$number = count($arrComms);
$emptyComm = "";
if ($number == 0) $emptyComm = "Пока никто не оставил комментариев, будьте первым";
$lastChild = end($arrComms);

if ($number % 2 != 0){
	$c = 0;
	foreach($arrComms as $key => $arrValue)
	{
		$userComm = $arrValue["user_login"];
		$dateComm = $arrValue["date"];
		$comm = iconv("utf-8", "windows-1251", $arrValue["comm"]);
		$block = "<div class = 'block'><h4>$dateComm</h4>
				<h3>$userComm</h3>
				<p>$comm</p>
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
		
include "page.html";
?>