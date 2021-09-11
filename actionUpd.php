<?php
include "database.php";
$updStatusID = $_POST['userIdSend'];
$updStatusLog = $_POST['userLogSend'];
if (!empty($updStatusID)) mysqli_query($db,"UPDATE user SET role = 0 WHERE id = $updStatusID");
if (!empty($updStatusLog)) mysqli_query($db,"UPDATE user SET role = 0 WHERE login = '$updStatusLog'");
if (!empty($updStatusID) && !empty($updStatusLog))mysqli_query($db,"UPDATE user SET role = 0 WHERE id = $updStatusID");
header("Location: admin_panel.php?OpResult=Статус пользователя обновлён");
?>