<? echo $mess?>
<h1>Заявка на вклад</h1>
<form id = 'new_deposit' name = 'new_deposit' action = "../index.php?act=addDeposit" method = "post">
	<label for="opening_date">Дата открытия: </label>
	<input type="date" id="opening_date" name="opening_date"/><br><br><br>
	<label for = 'term'> Срок в месяцах:</label>	
	<input type='text' id='term' name= 'term' size ='10'><br><br><br>
	<label for = 'summ'> Сумма:</label>	
	<input type='text' id='summ' name= 'summ' size ='10'><br><br><br>
	<label for = 'deposit_type'>Тип вклада</label>
	<select name="deposit_type">
		<option value="autumn">Осенний</option>
		<option value="pension">Пенсионный</option>
		<option value="reliable">Надежный</option>
	</select><br><br><br><br>
	
	<input type = 'submit' id = 'add' name = ''  class = 'button' value = "ADD DEPOSIT" onClick="Success()"><br><br><br><br>
	<a href='../index.php?act=index'>Личный кабинет</a>
</form>
