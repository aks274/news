<?php

session_start();

$id = $_SESSION["user_id"];
$login = $_SESSION["login"];
$status = $_SESSION["role"];

if (empty($_SESSION) || $status == 0){
	echo '�� �� ������ �������� �������. �������, ����� �������� �������. ���� �� ������������, �� ������ ��� ���������, ������, ��� ��� ������� ������������';
}
if(!empty($_POST)){
	include "database.php";
	$preview = $_POST['preview'];
	$full = $_POST['full'];
	$img = $_POST['img'];
	$head = $_POST['head'];
	$theme = $_POST['theme'];
	$author = $login;
	mysqli_query ($db,"INSERT INTO content (preview, full, img, head, theme, author) VALUES ('$preview', '$full', '$img', '$head', '$theme')");
	}
?>
