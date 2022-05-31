<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;
	
	public static function Instance(){
		if (self::$instance == null)
			self::$instance = new M_MSQL();
		return self::$instance;
	}
	//
	// Конструктор
	//
	private function __construct(){
		
		
	}
	
	//
	// Соединение с БД
	//
	public function con(){
		
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (!$con) {
			printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
			exit;
		}
		return $con;
	}
	
	//
	// Авторизация пользователя
	//
	public function login($sql,$login){
		
		$con = $this->con();
		$stmt = mysqli_prepare($con,$sql); 
		if(!$stmt){
			echo 'не удалось получить данные';		  
		} else {
			mysqli_stmt_bind_param($stmt, "s", $login);
			mysqli_stmt_execute($stmt);
			$numrows = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($numrows, MYSQLI_NUM);
			mysqli_stmt_close($stmt);
			return $row;
		}
	}
	
	//
	// Регистрация физического лица
	//
	public function register($sql,$login, $password, $created_at, $hash, $full_Name, $inn, $date_of_Birth, $passport_Series, $passport_ID, $date_of_issue){
		$con =  $this->con();
		$stmt = mysqli_prepare($con,$sql); 
		if(!$stmt){
			echo 'не удалось получить данные';		  
		} else {
			mysqli_stmt_bind_param($stmt,"sssssisiis", $login, $password, $created_at, $hash, $full_Name, $inn, $date_of_Birth, $passport_Series, $passport_ID, $date_of_issue);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}
	
	//
	// Регистрация юридического лица
	//
	public function register_client_legal($sql, $login, $password, $created_at, $hash, $full_Name, $inn, $name_of_company, $legal_address, $OGRN, $INN_org, $KPP){
		
		$con =  $this->con();
		$stmt = mysqli_prepare($con,$sql); 
		var_dump($stmt);
		if(!$stmt){
			echo 'не удалось получить данные';		  
		} else {
			mysqli_stmt_bind_param($stmt,"sssssissiii", $login, $password, $created_at, $hash, $full_Name, $inn, $name_of_company, $legal_address, $OGRN, $INN_org, $KPP);
			mysqli_stmt_execute($stmt);
			var_dump(mysqli_stmt_execute($stmt));
			mysqli_stmt_close($stmt);
		}
	}
	
	//
	// Выборка кредитов пользователя
	//
	public function select($query,$login){
		
		$con = $this->con();
		$stmt = mysqli_prepare($con,$query);
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		if (!$result)
		    die();
		return $result;
	}
	
	//
	// Добавление заявки на депозит
	//
	public function insert_deposit($sql, $opening_date, $closing_date, $term, $bid, $periodicity_of_capitalization, $user_id, $user_status, $summ){
		
		$con = $this->con();
		$stmt = mysqli_prepare($con, $sql); 
        mysqli_stmt_bind_param($stmt, "ssiisisi", $opening_date, $closing_date, $term, $bid, $periodicity_of_capitalization, $user_id, $user_status, $summ);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return true;
		
	}
	
	//
	// Добавление заявки на кредит
	//
	public function insert_credit($sql, $opening_date, $closing_date, $term, $summ, $payment_type, $bid, $user_id, $user_status){
		$con = $this->con();
		$stmt = mysqli_prepare($con, $sql); 
        mysqli_stmt_bind_param($stmt, "ssiisiis", $opening_date, $closing_date, $term, $summ, $payment_type, $bid, $user_id, $user_status);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		return true;
	}
	
		
	//
	// Удалить заявку
	//
	
	public function delete($sql, $id){
		
		$con = $this->con();
		$stmt = mysqli_prepare($con,$sql);
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}
