<?php
class Common{
	function isLogged(){
		if(isset($_SESSION['userid']) && $_SESSION['userid'] !=""){
			return true;
		}else{
			return false;
		}
	}
	function isAdmin(){
		if($_SESSION['usr_type']=='1'){
			return true;
		}else{
			return false;
		}
	}
	
	function page_authentication(){
		$pagename =  preg_replace('/\.[^.]+$/','',basename($_SERVER['PHP_SELF']));	
		
		if(!isset($_SESSION['user_id']) && ($pagename == 'register')){		 
		 if(!isset($_REQUEST['register']))
		   header("location:register.php?register=new");
		}elseif(!isset($_SESSION['user_id']) && ($pagename == 'forget_password')){		 
		if(!isset($_REQUEST['register']))
		   header("location:forget_password.php?register=password");
		}elseif(!isset($_SESSION['user_id']) && ($pagename != 'login')){		 
		  header("location:login.php");
		}
		
		  /*$pagename =  preg_replace('/\.[^.]+$/','',basename($_SERVER['PHP_SELF']));
		  $required_login 				= array("dashboard","register");
		  $login_notrequired		    = array("login");
		  
		  if(in_array($pagename,$required_login) && !$this->isLogged()){
		    $_SESSION['redirect_url'] = basename($_SERVER['PHP_SELF']);
			header("location:login.php");
		  }
		  
		  if(in_array($pagename,$login_notrequired) && $this->isLogged()){
			header("location:index.php");
		  }*/
	}
	
	function login_required($required){
		if($required){
			if(!$this->isLogged()){
				header("location:login.php");
			}
		}
	}
	
	function gen_random_string($length=16)
		{
			$chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
			$final_rand='';
			for($i=0;$i<$length; $i++)
			{
				$final_rand .= $chars[ rand(0,strlen($chars)-1)];
		 
			}
			return $final_rand;
		}
	
	function formatdate($format,$datevalue)
	{  
	   if($datevalue !="0000-00-00 00:00:00"){
	     $datevalue = date($format,strtotime($datevalue));
		 return $datevalue;
	   }
	  return "";
	}
	
}
?>