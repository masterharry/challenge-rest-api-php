<?php
/***********************************************/
/* Module   : UserDao                          */
/* Author   : Hiren Master                     */
/* Purpose  : Query Operations for Users Table */
/* Date     : 18/10/2018                       */
/***********************************************/

class UserDao {
	
	#Object Variables - Start
	private $log;
	public  $params;
	#Object Variables - End
	
	#Object Variables - Getter/Setter - Start
	function __construct(){
		try{
			$this->log=new logger();
			$this->params = array();
		}
		catch(Exception $e){
			throw $e;
		}
    }
	
	public function __set( $name, $value ){
		$name	= strtolower( $name );
		if( is_string( $value ) || trim( $value )=='' ){
			$value	= addslashes( $value );
			$value	= trim( $value );
			$value	= strip_tags( $value );
			$str	='$this->'."$name="."'".$value."'";
		}
		else{
			$str	='$this->'."$name=".$value."";
		}
		eval("$str;");	
    }
	
	public function __get($name){
		$name	= strtolower($name);
		$str	= '$this->'."$name";
		eval("\$str = \"$str\";");
		return $str;
	}
	
	public function InsertUser(){
		$result=new resultobject();
		try{
			$dao=new dao();
			if( !$this->IsExistUser() ){
				//insert User
			    $str = "";
			    $second_str = '';
			    $third_str = '';
			    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
			    $max = count($characters) - 1;

			    $digits = 4;
			    $num = rand(pow(10, $digits-1), pow(10, $digits)-1);

			    for ($i = 0; $i < 8; $i++) {
			        $rand = mt_rand(0, $max);
			        $str .= $characters[$rand];
			    }

			    for ($i = 0; $i < 4; $i++) {
			        $rand = mt_rand(0, $max);
			        $second_str .= $characters[$rand];
			    }

			    for ($i = 0; $i < 4; $i++) {
			        $rand = mt_rand(0, $max);
			        $forth_str .= $characters[$rand];
			    }

			    for ($i = 0; $i < 12; $i++) {
			        $rand = mt_rand(0, $max);
			        $fifth_str .= $characters[$rand];
			    }

			    $user_id = $str.'-'.$second_str.'-'.$num.'-'.$forth_str.'-'.$fifth_str;

				$str_sql = "INSERT INTO `users` (`id`, `name`, `role`) VALUES (:id, :name, :role)";
				 
				$dao->initCommand($str_sql);
				$dao->addParameter(":id",$user_id);
				$dao->addParameter(":name",$this->name);
				$dao->addParameter(":role",$this->role);
				
				$dao->executeNonQuery();
				$result->resultData["msg"] = "User Created";
				$result->resultStatus = "Success";
			}else{
				$result->resultData["msg"] = "User Name Alrady Exist";
				$result->resultStatus = "Warning";
			}
		}catch(Exception $e){
			$this->log->logIt(get_class($this)."-"."InsertUser"."-".$e);
		}	
		return $result;
	}
	
	public function IsExistUser(){
		$result=0;
		try{
			$dao=new dao();
			$this->log->logIt(get_class($this)."-"."is_exists");			
			$str_sql = "select name
					   from users  
					   where name = :name";
					   
			$dao->initCommand($str_sql);
			$dao->addParameter(":name",trim($this->name));
							
			$result =  count($dao->executeQuery());
			
			$this->log->logIt(get_class($this)."-"."is_exists:".$result);
			
			return $result;
			 									   
		}catch(Exception $e){
			$this->log->logIt(get_class($this)."-"."is_exists"."-".$e);
			
		}			
		return $result;
	}
	
	public function GetUser(){
		$result=new resultobject();
		try{
			$dao=new dao();
			$this->log->logIt(get_class($this)."-"."GetUser");			
			$str_sql = "select name,role
					   from users 
					   where id =:id";
					   
			$dao->initCommand($str_sql);
			
			$dao->addParameter(":id",$this->id);
			
			$result->resultStatus = "Success";
			
			$result->resultData["list"] = $dao->executeQuery();
					
			return $result;
		}catch(Exception $e){
			$this->log->logIt(get_class($this)."-"."GetUser"."-".$e);
		}			
		return $result;		
	}
	
	public function GetUserList(){
		$result=new resultobject();
		try{
			$dao=new dao();
			$this->log->logIt(get_class($this)."-"."GetUserList");			
			$str_sql = "select id,name,role
					   from users 
					   where role =:role";
					   
			$dao->initCommand($str_sql);
			$dao->addParameter(":role",$this->role);
			
			$result->resultStatus = "Success";		
			$result->resultData["list"] = $dao->executeQuery();
			return $result;
		}catch(Exception $e){
			$this->log->logIt(get_class($this)."-"."GetUserList"."-".$e);		
		}			
		return $result;		
	}
}
?>