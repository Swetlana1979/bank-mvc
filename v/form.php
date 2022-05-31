<div class="container mregister">
	<div class='mess'><?echo $mess?></div>
	<div class="login">
		<h1>Авторизация</h1>
		<form action="index.php?c=User&&act=login" id="registerform" method="post" name="registerform">
			<p><label for="login">Имя пользователя</label><br>
			<input class="input required" id="login" name="login"size="20" type="text" placeholder="Имя пользователя" value="<?echo $username?>"></p>
			<p><label for="password">Пароль</label><br>
			<input class="input required password" id="password" name="password"size="32"   type="password" placeholder="Пароль" value=""></p>
			<label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
			<p>
			<input class="input required" id="status" name="status"size="20" type="radio" value="client_legal_entity">
			<label for="status">Юридическое лицо</label>
			<input class="input required" id="status" name="status"size="20" type="radio" value="customer_individual">
			<label for="status">Физическое лицо</label>
			</p>
			<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Войти"></p>
		</form>
	</div>
	<a href="index.php?c=User&&act=register">Регистрация</a>
</div>