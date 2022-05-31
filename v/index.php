    
	<?if(empty($_SESSION['session_login'])){
		include_once('form.php');
	} else {?>	
		<h2>Добро пожаловать, <span><?php echo $_SESSION['session_name'];?>! </span></h2>
		<p><a href = "index.php?c=User&&act=logout">Выйти из системы </a></p>
		
		<? if(!empty($credit)){?>
			<? echo "<h2>Список заявок на кредит</h2>";?>
			<table><tr><td>№</td><td>Вид заявки</td><td>Дата открытия кредита</td><td>Срок(мес)</td><td>Cумма</td><td>Ставка</td><td>Тип кредита</td><td></td><td></td></tr>
				<?foreach($credit as $key=>$value){
					echo $num.$value."<br>";
				}
			}?>
			</table>
		<?
		if(!empty($deposit)){
			echo "<h2>Список заявок на вклад</h2>";?>
			<table><tr><td>№</td><td>Вид заявки</td><td>Дата открытия вклада</td><td>Срок(мес)</td><td>Ставка</td><td>Сумма</td><td></td><td></td><td></td></tr>
			<?
			foreach($deposit as $key=>$value){
				echo $value."<br>";
				
			} ?>
			</table><br><br><br><br><br>
		<?}
		include_once('add_form.php');
	    }
		
	?>
   	
	    
		
		
    


			
			
			
			
			
	        
			
