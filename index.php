<?php

session_start(); 
include "database.php";
$cont_count = mysqli_query($db,"SELECT * FROM content");
$cont_amount = mysqli_num_rows($cont_count);

$id = $_SESSION["user_id"];
$login = $_SESSION["login"];

if (empty($_SESSION)){
	$loggedin = 'Войти';	
	$redirect = 'auth.html';
	$loggedin1 = 'display: none';
} else {
	$loggedin = 'Выйти';
	$redirect = 'exit.php';
	$loggedin1 = '';
}

$dbNews = $db->query("SELECT * FROM content ORDER BY id DESC LIMIT 10 OFFSET 1");
$arrNews = array();
while ($arrNew = $dbNews->fetch_assoc()){
	$arrNews[$arrNew['id']] = $arrNew;
}

function news($theme){
	global $db;
	
	$dbTNews = $db->query("SELECT * FROM content WHERE theme = '$theme' ORDER BY id DESC LIMIT 30 OFFSET 1");
	$arrTNews = array();
	while ($arrTNew = $dbTNews->fetch_assoc()){
		$arrTNews[$arrTNew['id']] = $arrTNew;
	}
	
	$tcount_amount = count($arrTNews);
	
	if ($tcount_amount % 2 != 0){
		$number = 0;
		$lastChild = end($arrTNews);
		foreach($arrTNews as $key => $arrValue)
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
					$rows .= $row;
					} else $row = "<div class = 'row'>$block";
				} else {
				$row = $row."$block</div>";
				$rows = $rows.$row;
				}
			$number++;	
		}
	} else {
		$number = 0;
		foreach($arrTNews as $key => $arrValue)
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
				$rows = $rows.$row;
				}
			$number++;	
		}
	}
	return $rows;
}

function head_news($theme){
	global $db, $header0, $date_post0, $preview0, $img0, $link0;
	$news = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM content WHERE theme = '$theme' ORDER BY id DESC LIMIT 1"));
	$header0 = iconv("utf-8", "windows-1251", $news["head"]);
	$date_post0 = $news["date"];
	$preview0 = iconv("utf-8", "windows-1251", $news["preview"]);
	$img0 = $news["img"];
	$link0 = $news["id"];
}

if ($_GET['p']=='index' || $_GET[p]==''){
	$cur_page0 = "class='active'";
	$title = "Главная";
	$href0 = '';
	$news = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM content ORDER BY id DESC LIMIT 1"));
	$header0 = iconv("utf-8", "windows-1251", $news["head"]);
	$date_post0 = $news["date"];
	$preview0 = iconv("utf-8", "windows-1251", $news["preview"]);
	$img0 = $news["img"];
	$link0 = $news["id"];
	
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
					$rows .= $row;
					} else $row = "<div class = 'row'>$block";
				} else {
				$row = $row."$block</div>";
				$rows = $rows.$row;
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
				$rows = $rows.$row;
				}
			$number++;	
		}
	}
} else $href0 = "<a href = '?p=index'>";

if ($_GET['p']=='politics'){
	$cur_page1 = "class='active'";
	$title = "Политика";
	$href1 = "";
	head_news('politics');
	$rows = news('politics');
} else $href1 = "<a href = '?p=politics'>";

if ($_GET['p']=='sport'){
	$cur_page2 = "class='active'";
	$title = "Спорт";
	$href2 = '';
	head_news('sport');
	$rows = news('sport');
} else $href2 = "<a href = '?p=sport'>";

if ($_GET['p']=='culture'){
	$cur_page3 = "class='active'";
	$title = "Культура";
	$href3 = "";
	head_news('culture');
	$rows = news('culture');
} else $href3 = "<a href = '?p=culture'>";

if ($_GET['p']=='tech'){
	$cur_page4 = "class='active'";
	$title = "Технологии";
	$href4 = '';
	head_news('tech');
	$rows = news('tech');
} else $href4 = "<a href = '?p=tech'>";

if ($_GET['p']=='offtop'){
	$cur_page5 = "class='active'";
	$title = "#Оффтоп";
	$href5 = "";
	head_news('offtop');
	$rows = news('offtop');
} else $href5 = "<a href = '?p=offtop'>";

include "index.html";
?>