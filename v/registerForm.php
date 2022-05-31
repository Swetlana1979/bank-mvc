<div class="container mregister">
    <div class='mess'><?echo $mess?></div>
	<div class="reg">
	<h1>Регистрация</h1>
	<form name="statusform" id="statusforn">
		Физическое лицо<input type='radio' id='' name='stat' value='individual' onClick="Status()"> 
		Юридическое лицо<input type='radio' id='' name='stat' value='legal' checked onClick="Status()">
	</form>
	<div class="none" id='customer_individual' style="display:none">
		
		<form action="index.php?c=User&&act=register" id="registerform" method="post" name="registerform">
			<input class="" id="status" name="status"  type="hidden" value='customer_individual'> 
			<p><label for="login">Имя пользователя<br>
			<input class="input required" id="login" name="login"size="20" type="text"  placeholder="Имя пользователя" value="<?echo $username?>"></label></p>
			<p><label for="full_Name">Фамилия Имя Отчество<br>
			<input class="input required" id="full_Name" name="full_Name"size="20" type="text"  placeholder="Фамилия Имя Отчество" value="<?echo $full_Name?>"></label></p>
			<p><label for="inn">ИНН<br>
			<input class="input required" id="inn" name="inn" size="20" type="text"  placeholder="ИНН" value="<?echo $inn?>"></label></p>
			<p><label for="date_of_Birth">Дата рождения<br>
			<input class="input required" id="date_of_Birth" name="date_of_Birth" size="20" type="date"  placeholder="Дата рождения" value="<?echo $date_of_Birth?>"></label></p>
			<p><label for="passport_Series">Серия паспорта<br>
			<input class="input required" id="passport_Series" name="passport_Series" size="20" type="text"  placeholder="Серия паспорта" value="<?echo $passport_Series?>"></label></p>
			<p><label for="passport_ID">Номер паспорта<br>
			<input class="input required" id="passport_ID" name="passport_ID" size="20" type="text"  placeholder="Номер паспорта" value="<?echo $passport_ID?>"></label></p>
			<p><label for="date_of_issue">Дата получения паспорта<br>
			<input class="input required" id="date_of_issue" name="date_of_issue" size="20" type="date"  placeholder="Дата получения паспорта" value="<?echo $date_of_issue?>"></label></p>
			<p><label for="password">Пароль<br>
			<input class="input required password" id="password" name="password" size="20"   type="password" placeholder="Пароль" value=""></label></p>
			<p><label for="password_rep">Пароль повторно<br>
			<input class="input required password" id="password_rep" name="password_rep" size="38"   type="password" placeholder="Пароль повторно"value=""></label></p>
			<label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
			<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Регистрация"></p>
		</form>
		</div>
		<div class="" id="client_legal_entity">
		
		<form id="registerformClientLegal"  name="registerformClientLegal" action="index.php?c=User&&act=register" method="post">
			<input class="" id="status" name="status"  type="hidden" value='client_legal_entity'>
			<p><label for="login">Имя пользователя<br>
			<input class="input required" id="login" name="login"size="20" type="text"  placeholder="Имя пользователя" value="<?echo $username?>"></label></p>
			<p><label for="full_Name">Фамилия Имя Отчество<br>
			<input class="input required" id="full_Name" name="full_Name"size="20" type="text"  placeholder="Фамилия Имя Отчество" value="<?echo $full_Name?>"></label></p>
			<p><label for="inn">ИНН<br>
			<input class="input required" id="inn" name="inn" size="20" type="text"  placeholder="ИНН" value="<?echo $inn?>"></label></p>
			
			<p><label for="name_of_company">Наименование организации<br>
			<input class="input required" id="name_of_company" name="name_of_company" size="20" type="text"  placeholder="Наименование организации" value="<?echo $name_of_company?>"></label></p>
			<p><label for="legal_address">Юридический адресс<br>
			<input class="input required" id="legal_address" name="legal_address" size="20" type="text"  placeholder="Юридический адресс" value="<?echo $legal_address?>"></label></p>
			<p><label for="OGRN">ОГРН Организации<br>
			<input class="input required" id="OGRN" name="OGRN" size="20" type="text"  placeholder="ОГРН организации" value="<?echo $OGRN?>"></label></p>
			<p><label for="INN_org">ИНН организации<br>
			<input class="input required" id="INN_org" name="INN_org" size="20" type="text"  placeholder="ИНН организации" value="<?echo $INN_org?>"></label></p>
			<p><label for="KPP">КПП организации<br>
			<input class="input required" id="KPP" name="KPP" size="20" type="text"  placeholder="КПП организации" value="<?echo $KPP?>"></label></p>
			
			<p><label for="password">Пароль<br>
			<input class="input required password" id="password" name="password" size="20"   type="password" placeholder="Пароль" value=""></label></p>
			<p><label for="password_rep">Пароль повторно<br>
			<input class="input required password" id="password_rep" name="password_rep" size="38"   type="password" placeholder="Пароль повторно"value=""></label></p>
			<label><input type="checkbox" class="password-checkbox"> Показать пароль</label>
			<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Регистрация"></p>
		</form>
	</div>
	<a href="index.php?c=User&&act=index">Авторизация</a>
</div>