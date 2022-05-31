<?php
//
// Конттроллер страницы чтения.
//

class C_Product extends C_Base
{
	
	//
	// Конструктор.
	//
	function __construct(){		
		
		parent::__construct();
		
	}
	
	//
	// Наследование
	//
	public function mProduct() {
		
		return $this->mProduct = M_Product::Instance();
   }
   
	//
	//Вывод списка продуктов пользователя
	//
	public function action_index() {
		
		$result_credit = $this->mProduct()->credit_all($this->data('login'),$this->data('status'));
		$res=array();
		if($result_credit){
			foreach($result_credit as $key => $value){
				$res[] = array($value['id'],$value['opening_date'],$value['term'],$value['SUMM'],$value['bid'],$value['payment_type']);
			}
		}
		$credit = $this->mProduct()->output_credit($res);
		$result_deposit = $this->mProduct()->deposit_all($this->data('login'),$this->data('status'));
		
		$res=array();
		if($result_deposit){
			foreach($result_deposit as $key => $value){
				$res[] = array($value['id'],$value['opening_date'],$value['term'],$value['bid'],$value['summ']);
			}
		}
		$deposit = $this->mProduct()->output_deposit($res);
		
		
		//буферизация данных, отправка в шаблон
		$this->content = $this->template('./v/index.php', array('credit' => $credit,'deposit' => $deposit));		
	}
	
	
	//
	// Добавить заявку на кредит
	//
	public function action_addCredit() {
		$this->content = $this->template('./v/add_credit.php');
		
		if((!empty($_POST['opening_date']))&&(!empty($_POST['term']))){
			$opening_date=htmlspecialchars($_POST["opening_date"]);
			$term=htmlspecialchars($_POST["term"]);
			$сredit_type = htmlspecialchars($_POST["сredit_type"]);
			$closing_date = $this->mProduct()->closing_date($opening_date,$term);
			$summ = htmlspecialchars($_POST["summ"]);
			if($сredit_type==="preferential"){
				$payment_type = "аут";
				$bid = 15;
			} else if(($сredit_type==="pension")||($сredit_type==="auto")){
				$payment_type = "дефф";
				$bid =20;
			} 
			
			$user_id = $this->data('user_id');
			$user_status = $this->data('status');
			$user_status = ($user_status ==='customer_individual')?'customer':'legal';
			
		}
		$add=false;
		$this->mProduct()->add_credit($opening_date, $closing_date, $term, $summ, $payment_type, $bid, $user_id,$user_status);
		
		
		
	}
	//
	// Добавить заявку на вклад
	//
	public function action_addDeposit(){
		$this->content = $this->template('./v/add_deposit.php');
		
		if((!empty($_POST['opening_date']))&&(!empty($_POST['term']))){
			$opening_date=htmlspecialchars($_POST["opening_date"]);
			$term=htmlspecialchars($_POST["term"]);
			$deposit_type = htmlspecialchars($_POST["deposit_type"]);
			$closing_date = $this->mProduct()->closing_date($opening_date,$term);
			$summ = htmlspecialchars($_POST["summ"]);
			if($deposit_type==="autumn"){
				$bid=21;
				$percentage_of_capitalization = "В конце срока";
			} else if($deposit_type==="pension"){
				$bid=16;
				$percentage_of_capitalization = "Ежемесячно";
			} else if($deposit_type==="reliable"){
				$bid=15;
				$percentage_of_capitalization = "Ежемесячно";
			} else {
				echo "Ошибка ввода данных";
			}
			$user_id = $this->data('user_id');
			$user_status = $this->data('status');
			$user_status = ($user_status ==='customer_individual')?'customer':'legal';
		}
		$this->mProduct()->add_deposit($opening_date, $closing_date, $term, $bid, $percentage_of_capitalization, $user_id, $user_status, $summ);
	}
	
	
	//
	// Удалить заявку на кредит
	//
	public function action_deleteCredit(){
		$id_application = htmlspecialchars($_GET["id"]);
		$this->mProduct()->delete_credit($id_application);
		header("Location:index.php?act=index");
	}
	
	//
	// Удалить заявку на депозит
	//
	public function action_deleteDeposit(){
		$id_application = htmlspecialchars($_GET["id"]);
		$this->mProduct()->delete_deposit($id_application);
		header("Location:index.php?act=index");
	}
	
	//
	// Рассчитать график платежей
	//
	public function action_graf(){
		
	}
	
	
}
	
	
