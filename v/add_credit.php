<? echo $mess?>
<h1>Заявка на кредит</h1>
<form id = 'new_credit' name = 'new_credit' action = "../index.php?act=addCredit" method = "post">
	<label for = "opening_date">Дата открытия: </label>
	<input type="date" id="opening_date" name="opening_date"/><br><br><br>
	<label for = 'term'> Срок в месяцах:</label>	
	<input type='text' id='term' name= 'term' size='10'><br><br><br>
	<label for = 'summ'> Сумма:</label>	
	<input type='text' id='summ' name= 'summ'><br><br><br>
	<label for = 'credit_type'>Тип кредита</label>
	<select id="сredit_type" name = "сredit_type">
		<option value="preferential">Льготный</option>
		<option value="pension">Пенсионный</option>
		<option value="auto">Авто</option>
	</select>
	<br><br><br><br>	
	<input type = 'submit' id = 'add' name = ''  class = 'button' value = "ADD CREDIT" onClick="Success()"><br><br><br><br>
	<a href='../index.php?act=index'>Личный кабинет</a>
</form>