<?php
include "database.php";
session_start();

if(!empty($_SESSION["login"])){
	$login = $_SESSION["login"];
	$pageId = $_SESSION["page_id"];
	$updrate = $_POST['ratingChange'];
	$pageR = mysqli_fetch_assoc(mysqli_query($db,"SELECT rate FROM content WHERE id = $pageId"));
	$rating = $pageR["rate"];
	if (!empty($updrate)) mysqli_query($db,"INSERT INTO rating (pageId, userLogin) VALUES ('$pageId', '$login')");
	if ($updrate == "+") $rating += 1; 
	if ($updrate == "-") $rating -= 1;

	mysqli_query($db,"UPDATE content SET rate = $rating WHERE id = $pageId");
	header("Location: page.php?id=".$pageId);
} else {
	session_destroy();
	header("Location: auth.html");
}
?>