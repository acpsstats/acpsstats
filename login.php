<?php
$no_visible_elements=true;
include('header.php'); ?>
<?php 

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
    {
       
       header("location:dashboard.php");

    }


$success = 0;
if(isset($_POST['loginbt'])){

	$user_info['username'] 			=  $_POST['username-list'];
	$user_info['password'] 			=  md5($config['salt'].$_POST['password']);
	$success = login_authenticate($user_info);
	
	if($success == 'fail'){
		$error = "Invalid Username or Password, Please try again.";
	}elseif($success == 'inactive'){
	    $error = "Your Account is Disabled,mail to support@acpsstats.com";
	}

	else{
	   if(isset($_SESSION['redirect_url']) && $_SESSION['redirect_url']!=""){
	      header("location:".$_SESSION['redirect_url']);
	   }else{
	      header("location:login.php");
	   }
	}
}
?><div class="row-fluid">
				<div class="span12 center login-header"> 
					<h2>The Australasian College of Podiatric Surgeons <br /> Surgical Audit Tool</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please login with your Username and Password.
                        <?php if(isset($error) && $error!=""){?>
                        <p><label class="errormsg"><?php echo $error;?></label></p>
                        <?php }?>
					</div>
					<form class="form-horizontal" name="loginfrm" id="loginfrm" action="" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on" style="float:left;"><i class="icon-user"></i></span>
                                <span><select style="width:170px;" class="input-select chosen-select" name="username-list" id="username-list">
                                    <option>Select User</option>
									<?php echo display_users(); ?>
                                </select></span>
							</div>
							
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><span class="login_pass"><input class="input-large span10" name="password" id="password" type="password" value="" /></span>
							</div>
							<div class="clearfix"></div>
							
							<div class="clearfix"></div>
							<p class="center span5">
							<input type="submit" class="btn btn-primary" value="Login" name="loginbt" id="loginbt"/>
							</p>
							<div class="center span12">
							<div class="new-user">
							<label class="newuser" for="newuser"><a href="register.php">Create New User Account ?</a></label>
							</div> 
                            
                            <div class="forget_password">
							<label class="newuser" for="newuser"><a href="forget_password.php">Forget Password?</a></label>
							</div> 
							
						<!--	<div class="forgot-pwd">
							<label class="forgotpwd" for="forgotpwd"><a href="reset.php">Forgot Password </a></label>
							</div> -->
							</div>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
            <?php
			 /* global $db;
			   $table_name = 'tblusers'; 
			   $query ='SELECT * FROM '.$table_name;  
			   $mem_info = $db->fetch_all_array($query);
			   $options = '';
			   $salt = 'ACPS@%USER~~';
			   foreach($mem_info as $users){
				 $array = array('txtPassword'=>md5($salt.$users['txtPassword']));
				 $db->query_update("tblusers",$array,"user_id = ".$users['user_id']);
			  } */
			?>
            
<?php include('footer.php'); ?>
