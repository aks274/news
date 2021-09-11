<?php
include "database.php";
$dbNews = $db->query("SELECT * FROM content");
$arrNews = array();
while ($arrNew = $dbNews->fetch_assoc()){
	$arrNews[$arrNew['id']] = $arrNew;
}
echo"<pre>";
var_dump($arrNews);
die;
?>