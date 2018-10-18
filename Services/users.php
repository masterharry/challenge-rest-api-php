<?php
/***********************************************/
/* Module   : Service                          */
/* Author   : Hiren Master                     */
/* Purpose  : Service to call rest api         */
/* Date     : 18/10/2018                       */
/***********************************************/
require_once(BASE_PATH."/Dbaccess/UserDao.php");
class users
{
	private $module = 'users';
	private $UserDao;
	public function __construct(){
		$this->UserDao	= new UserDao();
	}		
   
   /* intaily load this function */
	public function load(){
		try{
			$result = array();
			if($_SERVER['REQUEST_METHOD'] == "GET"){
				if( isset($_GET['role']) &&  $_GET['role'] != ""){
						// get user list by role
						$result = $this->get_userlist();
						if($result->resultStatus == "Success"){
							echo json_encode($result->resultData['list']);	
						}
				}else{
						if( isset($_GET['id']) &&  $_GET['id'] != ""){
						$result =  $this->get_user();
						if($result->resultStatus == "Success"){
							echo json_encode($result->resultData['list']);	
						}
						
					}
				}
			}else if($_SERVER['REQUEST_METHOD'] == "POST"){
				$postdata =  file_get_contents('php://input') ;
				$user_data = json_decode($postdata,true);

				if( $user_data['role'] != ""  &&  $user_data['name'] != "" ){
					$result =  $this->crate_user($user_data['role'],$user_data['name']);	

					echo json_encode($result);	
				}
			}
		}
		catch(Exception $e){
			echo $e;
			 
		}		
	}
	
	/* intaily load this function */
	public function crate_user($role,$name){
		try{
			
			$result = array();
			$this->UserDao->name =  $name;
			$this->UserDao->role =  $role;
			$res = $this->UserDao->InsertUser();
			return $res;
		}catch(Exception $e){
			echo $e;
		}		
	}
	
	/* intaily load this function */
	public function get_userlist(){
		try{
			$this->UserDao->role =  $_REQUEST['role'];
			$res = $this->UserDao->GetUserList();
			return $res;
		}
		catch(Exception $e){
			echo $e;
		}		
	}
	
	/* intaily load this function */
	public function get_user(){
		try{
			$result = array();
			$this->UserDao->id = $_GET['id'];
			$res = $this->UserDao->GetUser();
			return $res;
		}
		catch(Exception $e){
			echo $e;
		}		
	}	
}				
?>
