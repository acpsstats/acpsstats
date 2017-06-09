<?php
$no_visible_elements=true;
include('header.php'); 
if($_SESSION['type'] !="Admin") header("location:index.php");
$user_info = array();
$validate_false = "";
if(isset($_POST['newuser'])){
	$user_info['username'] 			=  $_POST['username'];
	$user_info['password'] 			=  md5($_POST['password']);
	$user_info['useremail']			=  $_POST['email'];
	$user_info['type'] 				=  $_POST['role'];
	if(!check_email_exists($_POST['email'],'new')){
	    $validate_false .= '<p class="errormsg"> Email already exists, Please try with different email address </p>';
	}if(!check_username_exists($_POST['username'],'new')){
	   $validate_false .= '<p class="errormsg"> Username already exists, Please try with different username </p>';
	}else{
	   $last_id = register_user($user_info);
	   if($last_id){
			 header("location:".$_SERVER['PHP_SELF']."?msg=success");
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
						Please Fill the Required Details.
                        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'){?>
                        	<p class="success">New user created</p>
                        <?php } ?>
						<?php if(isset($validate_false) && $validate_false != ''){
						     echo $validate_false;
						     } ?>
					</div>
					<form class="form-horizontal" id="registerfrm" name="registerfrm" action="" method="post">
						<fieldset>
							<div class="input-prepend userreg" title="Username" data-rel="tooltip">
								<label>Username</label><input autofocus class="input-large span10" name="username" id="username" type="text"  />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend userreg" title="Password" data-rel="tooltip">
								<label>Password</label><input class="input-large span10" name="password" id="password" type="password" />
							</div>
							
							<div class="input-prepend userreg" title="Email Address" data-rel="tooltip">
								<label>Email ID</label><input class="input-large span10" name="email" id="email" type="email"  />
							</div>
                            
                            <div class="input-prepend userreg" title="User Role" data-rel="tooltip">
								<label>Role</label>
                                <select class="user_role" name="role" id="role">
                                  <option value="Admin">Admin</option>
                                  <option value="Engineer">Engineer</option>
                                  <option value="Supervisor">Supervisor</option>
                                </select>
							</div>
							
							<div class="clearfix"></div>

							
							<div class="clearfix"></div>

							<p class="center span5">
							<input type="submit" class="btn btn-primary" name="newuser" value="Register"/>
							</p>
							<div class="center span5">
							<div class="new-user">
							<label class="newuser" for="newuser"><a href="login.php">Already Registered ?</a></label>
							</div>
							
							<div class="forgot-pwd">
							<label class="forgotpwd" for="forgotpwd"><a href="reset.php">Forgot Password </a></label>
							</div>
							</div>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
