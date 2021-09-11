<?php
include "database.php";
$deleteID = $_POST['pageIdSend'];
mysqli_query($db,"DELETE FROM content WHERE id = $deleteID");
header("Location: admin_panel.php?OpResult=Новость успешно удалена");
?>