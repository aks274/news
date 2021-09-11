function login_check(){
	var login = document.registration.login.value;
	var regv1 = /^[A-Za-z][\w\.\-]*$/;
	if(!regv1.test(login)){
		document.getElementById("output1").innerHTML="<h4 style = 'margin-top: 0.5rem'>Логин может содержать только латинские буквы и цифры. Должен начинаться с латинской буквы</h4>";
		return false;
	}
		else {
		if(login == "deleted" || login == "admin" || login == "moderator"){
				document.getElementById("output1").innerHTML="<h4 style = 'margin-top: 0.5rem'>Вы не можете создать аккаунт с таким логином</h4>";
				return false;
			}
			document.getElementById("output1").innerHTML="";
			return true;
		}
}
function password1_check(){
	var password1=document.registration.password1.value;
	var regv2=/^[\w\.,!\-\*\?'#][\w\.,!\-\*\?'#]*$/;
	if(!regv2.test(password1)){
		document.getElementById("output2").innerHTML="<h4 style = 'margin-top: 0.5rem'>Пароль может содержать латинские буквы, цифры и символы .,!?-_#*'<h4>";
		return false;
	}
		else {
			document.getElementById("output2").innerHTML="";
			return true;
		}
}
function password2_check(){
	var password1 = document.registration.password1.value;
	var password2 = document.registration.password2.value;
	if(password1 != password2){
		document.getElementById("output3").innerHTML = "<h4 style = 'margin-top: 0.5rem'>Введённые пароли не совпадают</h4>";
		return false;
	}
		else {
			document.getElementById("output3").innerHTML = "";
			return true;
		}
}

function check(event){
	if(!login_check()||!password1_check()||!password2_check())event.preventDefault();
}