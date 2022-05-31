<?php
class M_User
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (синглтон)
	//
	public static function instance(){
		if (self::$instance == null)
			self::$instance = new M_User();
		return self::$instance;
	}
	
	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = M_MSQL::instance();
	}
	
	public function login($login,$status){
		if($status === 'customer_individual'){
			$sql="SELECT * FROM customer_individual WHERE login = ?";
		} else {
			$sql="SELECT * FROM client_legal_entity WHERE login = ?";
		}
		$row=$this->msql->login($sql,$login);
		return $row;
	}
	
	//
	// Регистрация
	// $login - имя пользователя
	// $password - пароль
	// $created_at - время создания
	// $row - данные зарегистрированного пользователя
	//
	public function register_customer_individual($username, $password, $created_at, $hash, $full_Name, $inn, $date_of_Birth, $passport_Series, $passport_ID, $date_of_issue){
		 
		$sql="INSERT INTO customer_individual(login, password, created_at, hash, full_Name, inn, date_of_Birth, passport_Series, passport_ID, date_of_issue, user_status)VALUES(?,?,?,?,?,?,?,?,?,?,)"; 
		$row=$this->msql->register($sql,$username, $password, $created_at, $hash, $full_Name, $inn, $date_of_Birth, $passport_Series, $passport_ID, $date_of_issue);
		
	}
	
	//
	// Регистрация
	// $login - имя пользователя
	// $password - пароль
	// $created_at - время создания
	// $row - данные зарегистрированного пользователя
	//
	public function register_client_legal_entity($login, $password, $created_at, $hash, $full_Name, $inn, $name_of_company, $legal_address, $OGRN, $INN_org, $KPP){
		
		$sql="INSERT INTO client_legal_entity(login, password, created_at, hash, full_Name, inn, name_of_company, legal_address, OGRN, INN_org, KPP, user_status)VALUES(?,?,?,?,?,?,?,?,?,?,?,)"; 
		$row=$this->msql->register_client_legal($sql,$login, $password, $created_at, $hash, $full_Name, $inn, $name_of_company, $legal_address, $OGRN, $INN_org, $KPP);
		
	}
}
?>