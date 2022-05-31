<!DOCTYPE html">
<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<link rel="stylesheet" type="text/css" media="screen" href="./v/style.css" />
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
	</head>
	<body>
		<hr/>
		<?echo $content?>
		<hr>
		<small><a href="" id="copy">Копирайт</a> &copy;</small>	
		<script>
			function Status(){
				let stat=$("#customer_individual").css('display');
				if (stat==='none'){
					$("#customer_individual").css('display','block');
					$("#client_legal_entity").css('display','none');
				} else {
					$("#customer_individual").css('display','none');
					$("#client_legal_entity").css('display','block');
				}
			}
			function Success(){
				alert('Заявка добавлена');
			}
		</script>
		<script>
			jQuery.validator.addMethod("accept", function(value, element, param) {
				let length=value.length;
				return value.match(new RegExp(param +"{"+length+"}"+"$"));
			});	

			$(document).ready(function(){
				$("#registerform").validate({
					rules:{
						login:{
							required: true,
							minlength: 2,
							maxlength: 16,
							accept: "[а-яА-ЯёЁa-zA-Z]",
						},
						password:{
							required: true,
							minlength: 6,
							maxlength: 16,
						},
						password_rep: {
							equalTo: "#password"
						},
						inn:{
							required: true,
							minlength: 12,
							maxlength: 12,
						},
						passport_Series:{
							required: true,
							length: 4,
						},
						passport_ID:{
							required: true,
							length: 6,
						},
						
					},
					messages:{
						login:{
							required: "Это поле обязательно для заполнения",
							accept: "Имя пользователя должно содержать латинские или русские буквы",
							minlength: "Имя пользователя должно быть минимум 2 символа",
							maxlength: "Максимальное число символов - 16",
						},
						password:{
							required: "Это поле обязательно для заполнения",
							minlength: "Пароль должен быть минимум 6 символов",
							maxlength: "Пароль должен быть максимум 16 символов",
						},
						password_rep:{
							required: "Это поле обязательно для заполнения",
							equalTo: "Пароли должны совпадать",
						},
						inn:{
							required: "Это поле обязательно для заполнения",
							minlength: "Пароль должен быть минимум 12 символов",
							maxlength: "Пароль должен быть максимум 12 символов",
						},
						passport_Series:{
							required: "Это поле обязательно для заполнения",
							length: "Пароль должен быть 4 символа",
						},
						passport_ID:{
							required: "Это поле обязательно для заполнения",
							length: "Пароль должен быть 6 символа",
						},
					}
				});
				$("#registerformClientLegal").validate({
					rules:{
						login:{
							required: true,
							minlength: 2,
							maxlength: 16,
							accept: "[а-яА-ЯёЁa-zA-Z]",
						},
						password:{
							required: true,
							minlength: 6,
							maxlength: 16,
						},
						password_rep: {
							equalTo: "#password"
						},
						inn:{
							required: true,
							minlength: 12,
							maxlength: 12,
						},
						OGRN:{
							required: true,
							length: 13,
						},
						INN_org:{
							required: true,
							length: 10,
						},
						KPP:{
							required: true,
							length: 9,
						}
					},
					messages:{
						login:{
							required: "Это поле обязательно для заполнения",
							accept: "Имя пользователя должно содержать латинские или русские буквы",
							minlength: "Имя пользователя должно быть минимум 2 символа",
							maxlength: "Максимальное число символов - 16",
						},
						password:{
							required: "Это поле обязательно для заполнения",
							minlength: "Пароль должен быть минимум 6 символов",
							maxlength: "Пароль должен быть максимум 16 символов",
						},
						password_rep:{
							required: "Это поле обязательно для заполнения",
							equalTo: "Пароли должны совпадать",
						},
						inn:{
							required: "Это поле обязательно для заполнения",
							minlength: "Пароль должен быть минимум 12 символов",
							maxlength: "Пароль должен быть максимум 12 символов",
						},
						
					}
				});
			});

			$('body').on('click', '.password-checkbox', function(){
				if ($(this).is(':checked')){
					$('#password').attr('type', 'text');
					$('#password_rep').attr('type', 'text');
				} else {
					$('#password').attr('type', 'password');
					$('#password_rep').attr('type', 'password');
				}
			}); 
		
		</script>
	</body>
</html>
