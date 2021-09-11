<?php
if(!empty($_POST)){
	include "database.php";
	
	$login = $_POST['login'];
	$mail = $_POST['mail'];
	$password = $_POST['password1'];
	$password = md5($password);
	
	$login_check = mysqli_query($db,"SELECT id FROM user WHERE login = '$login'");
	$count = mysqli_num_rows($login_check);
	if($count > 0){
		$login_check = false;
		$reg_status = "Ошибка регистрации!";
		$log_check = "Такой логин уже используется!";
	}
	else $login_check = true;
	
	$mail_check = mysqli_query($db,"SELECT id FROM user WHERE mail = '$mail'");
	$count = mysqli_num_rows($mail_check);
	if($count > 0) {
		$mail_check = false;
		$reg_status = "Ошибка регистрации!";
		$m_check = "Такая почта уже используется!";
	}
	else $mail_check = true;
	}
	
	if(($login_check)&&($mail_check)){
		mysqli_query ($db,"INSERT INTO user (login, mail, pass) VALUES ('$login', '$mail', '$password')");
		$reg_status = "Вы успешно зарегистрировались!";
	}
	include "reg.html";
?>