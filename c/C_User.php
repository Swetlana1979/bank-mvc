<?php
//
// Конттроллер страницы чтения
//

class C_User extends C_Base{
	
	
	//
	// Конструктор.
	//
	function __construct()	{		
		
		parent::__construct();
		
	}
	
	//
	// Наследование
	//
	public function mUser() {
		
		return $this->mUser = M_User::Instance();
    }
	
	//
	//Вывод профиля пользователя или формы регистрации
	//
	public function action_index() {
				
		//буферизация данных, отправка в шаблон
		$this->content = $this->template('./v/index.php');		
	}
	
	//
	// Разлогинивание
	//
	public function action_logout() {
		
		unset($_SESSION['session_login']);
		unset($_SESSION['session_id']);
		unset($_SESSION['session_name']);
		unset($_SESSION['session_status']);
		session_destroy();
		header("location:index.php?act=index");
		
	}
	
	//
	// Авторизация
	//
	public function action_login() {
		
		if((!empty($_POST['login'])&&(!empty($_POST['password'])))){
			$username = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$status = htmlspecialchars($_POST['status']);
			$mUser = $this->mUser();
			$row=$mUser->login($username,$status);
			
			if(!empty($row)){
				$dblogin = $row[1];
				$hash = $row[4];
				$dbpass = password_verify($password, $hash);
				$user_id = $row[0];
				$full_Name = $row[5];
				$full_Name = explode(" ",$full_Name);
				if(($username === $dblogin) && ($dbpass===true)){
					$_SESSION['session_login'] = $username;
					$_SESSION['session_id'] = $user_id;
					$_SESSION['session_name'] = $full_Name[1]." ".$full_Name[2];
					$_SESSION['session_status'] = $status;
					header("Location:index.php");
				} else {
					$mess = "Неверный логин или пароль!";
					$this->content = $this->template('./v/index.php', array('username'=>$username,'status'=>$status, 'mess' => $mess));
					
				}				
			} else {
				//буферизация данных, отправка в шаблон
				$mess = "Такой пользователь не зарегистрирован";
				$this->content = $this->template('./v/index.php', array('mess' => $mess));
				
			} 
		} else {
			$this->content = $this->template('./v/index.php');
		}
		
	}
	
	//
	// Регистрация
	//
	public function action_register() {
		
		$this->content = $this->template('./v/registerForm.php');
		
		if((!empty($_POST['login'])&&(!empty($_POST['password'])))){
			$status = htmlspecialchars($_POST['status']);
			$username = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$password_rep = htmlspecialchars($_POST['password_rep']);
			$full_Name = htmlspecialchars($_POST['full_Name']);
			$inn = htmlspecialchars($_POST['inn']);
			if($status === 'customer_individual'){
				$date_of_Birth = htmlspecialchars($_POST['date_of_Birth']);
				$passport_Series = htmlspecialchars($_POST['passport_Series']);
				$passport_ID = htmlspecialchars($_POST['passport_ID']);
				$date_of_issue = htmlspecialchars($_POST['date_of_issue']);
			} else {
				$name_of_company = htmlspecialchars($_POST['name_of_company']);
				$legal_address = htmlspecialchars($_POST['legal_address']);
				$OGRN = htmlspecialchars($_POST['OGRN']);
				$INN_org = htmlspecialchars($_POST['INN_org']);
				$KPP = htmlspecialchars($_POST['KPP']);
			}
			
			
			if($password!==$password_rep){
				$mess = "Пароли не совпадают";
				if($status === 'customer_individual'){
					$this->content = $this->template('./v/registerForm.php',array('username' => $username,'full_Name' => $full_Name,'inn' => $inn,'date_of_Birth' => $date_of_Birth,'passport_Series' => $passport_Series,'passport_ID' => $passport_ID,'date_of_issue' => $date_of_issue, 'mess' => $mess));
				} else {
					$this->content = $this->template('./v/registerForm.php',array('username' => $username,'full_Name' => $full_Name,'inn' => $inn, 'name_of_company' => $name_of_company, 'legal_address' => $legal_address, 'OGRN' => $OGRN, 'INN_org' => $INN_org, 'KPP' => $KPP, 'mess' => $mess));
				}
			} else {
				$mUser = $this->mUser();
				$row=$mUser->login($username,$status);
				
				if(!empty($row)){
					$mess = "Такой пользователь уже зарегистрирован";
					$this->content = $this->template('./v/registerForm.php', array('full_Name' => $full_Name,'inn' => $inn, 'name_of_company' => $name_of_company, 'legal_address' => $legal_address, 'OGRN' => $OGRN, 'INN_org' => $INN_org, 'KPP' => $KPP,'mess' => $mess));
				} else{
					
					$created_at = date("Y-m-d");
					$hash = password_hash($password, PASSWORD_BCRYPT);
					
					if($status === 'customer_individual'){
						$mUser->register_customer_individual($username, $password, $created_at, $hash, $full_Name, $inn, $date_of_Birth, $passport_Series, $passport_ID, $date_of_issue, $user_status);
					} else {
						$mUser->register_client_legal_entity($username, $password, $created_at, $hash, $full_Name, $inn, $name_of_company, $legal_address, $OGRN, $INN_org, $KPP, $user_status);
					}
					$this->content = $this->template('./v/registerSuccess.php',array('username' => $username));
				}
			}
	    } else {
			$this->content = $this->template('./v/registerForm.php');
		} 
	}
}

?>
