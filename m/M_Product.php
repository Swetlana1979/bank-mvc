<?php
class M_Product
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 			// драйвер БД
	
	//
	// Получение единственного экземпляра (синглтон)
	//
	public static function Instance(){
		
		if (self::$instance == null){
			self::$instance = new M_Product();
		}
		return self::$instance;
	}
	
	//
	// Конструктор
	//
	public function __construct() {
		
		$this->msql = M_MSQL::Instance();
	}
	
	//
	// Приведение даты из БД к нужному формату
	//
	public function reverse_date($date){
		
		$mass=explode('-',$date);
		$mass=array_reverse($mass);
		$date=implode('.',$mass);
		return $date;
	}
	
	// 
	// Вывод кредитов пользователя
	// $arr - массив кредитов
	//
	public function output_credit($arr){
		
		$array=array();
		for($i=0; $i<count($arr); $i++){
			$id = $arr[$i]['0'];
			$num = $i+1;
			$opening_date=$this->reverse_date($arr[$i]['1']);
			$trem = $arr[$i]['2'];
			$href = "index.php?act=graf&id=".$id."&opening_date=".$opening_date."&term=".$trem."&summ=".$arr[$i]['3']."&bid=".$arr[$i]['4']."&payment_type=".$arr[$i]['5'];;
			$href1 = "index.php?act=deleteCredit&id=".$id;
			$str ="<tr><td>".$num."</td><td>"."кредит </td><td>".$opening_date."</td><td> ".$trem."</td><td> ".$arr[$i]['3']."</td><td> ".$arr[$i]['4']."</td><td>".$arr[$i]['5']."</td><td>".
			"<a href ='".$href."'>Рассчитать график платежей </a></td><td>"."<a href ='".$href1."'> Удалить заявку</a></td></tr>";
			$array[]=$str;				
		}
		return $array;
	}
	
	// 
	// Вывод депозитов пользователя
	// $arr - массив кредитов
	//
	public function output_deposit($arr){		
		$array=array();		
		for($i=0; $i<count($arr); $i++){
			$id = $arr[$i]['0'];
			$num = $i+1;
			$opening_date=$this->reverse_date($arr[$i]['1']);
			$trem=$arr[$i]['2'];
			$href = "index.php?act=deleteDeposit&id=".$id;
			$str ="<tr><td>".$num."</td><td>"."вклад </td><td>".$opening_date."</td><td>".$trem."</td><td> ".$arr[$i]['3']."</td><td> ".$arr[$i]['4']." </td><td></td><td></td><td>"."<a href ='".$href."'> Удалить заявку</a></td></tr>";
			$array[]=$str;
			
		}
		return $array;
	}
	//
	// Рассчет даты закрытия заявки
	//
	public function closing_date($opening_date, $term){
		
		$mass = explode('-',$opening_date);
		$str=$opening_date[5].$opening_date[6];
		$int=(int)$str;
		$summ = $int+$term;
		
		if(($mass[2]<31)&&($mass[1]!=='02')){
			$dey=($mass[2]>10)?$mass[2]:'0'.$mass[2];
		} else if(($mass[2]==31)&&(($mass[1]=='04')||($mass[1]=='06')||($mass[1]=='09')||($mass[1]=='11'))){
			$dey=30;
		} else if(($mass[2]>28)&&(($mass[1]=='02'))){
			$dey=28;
		}
		
		if($summ<12){
			$month=($summ<10)?'0'.$summ:$summ;
			$closing_date=$mass[0]."-".$month."-".$dey;
		} else {
			$mod = $summ%12;
			$del = floor($summ/12);
			$year = $mass[0]+$del;
			$month=($mod<10)?'0'.$mod:$mod;
			$closing_date=$year."-".$month."-".$dey;
		}
		return $closing_date;
	}
	
  //
  // Список всех кредитов пользователя
  // $login - логин пользователя
  // $credit - массив кредитов пользователя
  //
	public function credit_all($login,$status){
		if($status==='customer_individual'){
			$query = "SELECT customer_individual.login, credit.id, credit.opening_date, credit.closing_date, credit.term, credit.SUMM, credit.payment_type, credit.bid FROM `customer_individual`,`credit` 
			WHERE credit.user_id=customer_individual.id AND credit.user_status='customer' AND customer_individual.login=?"; 
		} else {
			$query = "SELECT client_legal_entity.login, credit.id, credit.opening_date, credit.closing_date, credit.term, credit.SUMM, credit.payment_type, credit.bid FROM `client_legal_entity`,`credit` 
			WHERE credit.user_id=client_legal_entity.id AND credit.user_status='legal' AND client_legal_entity.login=?"; 
		}
		$result = $this->msql->select($query,$login);
		
		return $result;
	}
	
  // Список всех депозитов пользователя
  // $login - логин пользователя
  // $credit - массив кредитов пользователя
  //
	public function deposit_all($login,$status){
		if($status==='customer_individual'){		
			$query = "SELECT customer_individual.login, deposit.id, deposit.opening_date, deposit.closing_date, deposit.term, deposit.bid, deposit.periodicity_of_capitalization, deposit.summ  FROM `customer_individual`,`deposit` 
			WHERE deposit.user_id=customer_individual.id AND deposit.user_status='customer' AND customer_individual.login= ?"; 
		} else {
			$query = "SELECT client_legal_entity.login, deposit.id, deposit.opening_date, deposit.closing_date, deposit.term, deposit.bid, deposit.periodicity_of_capitalization, deposit.summ  FROM `client_legal_entity`,`deposit` 
			WHERE deposit.user_id=client_legal_entity.id AND deposit.user_status='legal' AND client_legal_entity.login= ?"; 
		}
		$result = $this->msql->select($query,$login);
		return $result;
	}
	
	
   //
   // Добавить заявку на вклад
   // 
    public function add_deposit($opening_date, $closing_date, $term, $bid, $periodicity_of_capitalization, $user_id, $user_status,$summ){
		$sql = "INSERT INTO `deposit`(opening_date, closing_date, term, bid, periodicity_of_capitalization, user_id, user_status, summ)VALUES(?,?,?,?,?,?,?,?)"; 
		$this->msql->insert_deposit($sql, $opening_date, $closing_date, $term, $bid, $periodicity_of_capitalization, $user_id, $user_status,$summ);
		
	 }
	//
   // Добавить заявку на кредит
   // 
	 
	 public function add_credit($opening_date, $closing_date, $term, $summ, $payment_type, $bid, $user_id, $user_status){
		$sql = "INSERT INTO `credit`(opening_date, closing_date, term, summ, payment_type, bid, user_id, user_status)VALUES(?,?,?,?,?,?,?,?)"; 
		$this->msql->insert_credit($sql, $opening_date, $closing_date, $term, $summ, $payment_type, $bid, $user_id, $user_status);
				
	 }
	 
		
   //
   // Удалить заявку на кредит
   //
   public function delete_credit($id_credit){
	   
		$sql = "DELETE FROM credit WHERE id=?";
		$this->msql->delete($sql, $id_credit);
		return true;
	}

	//
   // Удалить заявку на депозит
   //
   public function delete_deposit($id_deposit){
	   
		$sql = "DELETE FROM deposit WHERE id=?";
		$this->msql->delete($sql, $id_deposit);
		return true;
	}
} 

 
