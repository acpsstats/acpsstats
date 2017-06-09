<?php
$no_visible_elements=true;
include('header.php'); 
?>
<?php 
$validate_false = false;
$validate_text = "";
$useremail = "";
$username = "";
if(isset($_POST['reset'])){
    /*if(!check_email_exists($_POST['username'],'new')){
		    $validate_false = true;
			$username = get_username_byemail($_POST['username']);
			$useremail = $_POST['username'];
	}*/
	if(!check_username_exists($_POST['username'],'new')){
			$validate_false = true;
			$username = $_POST['username'];
			$useremail = get_email_byusername($_POST['username']);
	}
	
	if(!$validate_false){
	  $validate_text = '<p class="errormsg"> Username  does not exists </p>';
	}
	if($useremail){
	  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	  if (preg_match($regex, $useremail)) {
	    send_reset_password_email($useremail,$username);
	  }else{
	    $validate_text = '<p class="errormsg"> Invalid Email format</p>';
	  }
	}
	
}
?>

			<div class="row-fluid">
				<div class="span12 center login-header"> 
					<h2>Welcome to Work Order Management System</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please Fill the Required Details to Reset Password.
						<?php if(isset($validate_text) && $validate_text != ''){
								echo $validate_text;
						 } ?>
					</div>
					<form class="form-horizontal" id="resetfrm" name="resetfrm" action="" method="post">
						<fieldset>
							<div class="input-prepend userforgt" title="Username" data-rel="tooltip">
								<label>Username </label><input autofocus class="input-large span10" name="username" id="username" type="text"  />
							</div>
							<div class="clearfix"></div>
						
							
							<div class="clearfix"></div>

							
							<div class="clearfix"></div>

							<p class="center span5">
							<input type="submit" class="btn btn-primary" name="reset" id="reset" value="Submit">
							</p>
							<div class="center span5">
							<div class="new-user">
							<label class="newuser" for="newuser"><a href="login.php">Login</a></label>
							</div>
							
							</div>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
