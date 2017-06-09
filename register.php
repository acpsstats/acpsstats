<?php
$no_visible_elements=true;
include('header.php'); ?>
<?php 
$success = '';
$error = '';
if(isset($_POST['loginbt'])){
	$user_info['username'] 			=  $_POST['username-list'];
	$user_info['password'] 			=  md5($config['salt'].$_POST['password']);
	$success = login_authenticate($user_info);
	if(!$success){
		$error = "Invalid Username or Password, Please try again.";
	}else{
		
	   if(isset($_SESSION['redirect_url']) && $_SESSION['redirect_url']!=""){
	      header("location:".$_SESSION['redirect_url']);
	   }else{
	      header("location:login.php");
	   }
	}
}



if(isset($_REQUEST['newuser'])){
   md5($config['salt'].$_POST['txtPassword']);
  $new_user = array('txtUserName'	=>	$_POST['txtUserName'],
                     'txtPassword'	=>	md5($config['salt'].$_POST['txtPassword']),
					 'UserState'	=>	$_POST['UserState'],
					 'first_name' 	=>  $_POST['first_name'],
					 'last_name'	=>	$_POST['last_name'],
					 'user_email' 	=>  $_POST['user_email']
                     );
  $new_user = register_user($new_user);	
  		 
  if(!$new_user == -1){
     $error = "The Username alreay exists, Please try with some other username";
  }elseif($new_user == 0){
    $error = "The Email address alreay exists with some other account";
  }else{
    $success = "User Has been Successfully added";
  }   
}
?>  	<div class="row-fluid">
				<div class="span12 center login-header"> 
					<h2>The Australasian College of Podiatric Surgeons <br /> Surgical Audit Tool</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid sortable">
				<div class="well span5 center login-box">
					<div class="box-header well" data-original-title>
					    
						<h2><i class="icon-edit"></i>New User Account</h2>
						
                        <?php if($success != ''){?>
                        	<p class="success message" style="position:absolute; top:50px; left:0px;"><?php echo $success ?></p>
                        <?php } ?>
						<?php if($error != ''){
						     echo '<p class="error message" style="position:absolute; top:50px; left:0px;">'.$error.'</p>';
						     } 
						$username = $first_name = $last_name = $user_email = '';
						if($error != ''){	 
							 $username = isset($_POST['txtUserName']) ? $_POST['txtUserName'] : '';
							 $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
							 $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
							 $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
						}
							
							 
							 
							 ?>
						<div style="clear:both"></div>	 
					</div>
					<div class="box-content" style="padding:40px 10px 0px;">
							<form class="form-horizontal" id="registerfrm" name="registerfrm" action="" method="post">
								<fieldset>
									<div class="control-group" title="Username" data-rel="tooltip">
										<label class="control-label" for="username">Username</label>
										<div class="controls">
											<input autofocus class="input-xlarge focused" name="txtUserName" id="username" type="text" value="<?php echo $username ?>"  />
										</div>
									</div>
                                    	<div class="clearfix"></div>
                                    <div class="control-group" title="First Name" data-rel="tooltip">
										<label class="control-label" for="firstname">First Name</label>
										<div class="controls">
											<input autofocus class="input-xlarge" name="first_name" id="first_name" type="text" value="<?php echo $first_name ?>"  />
										</div>
									</div>
                                    
                                    	<div class="clearfix"></div>
                                     <div class="control-group" title="Last Name" data-rel="tooltip">
										<label class="control-label" for="lastname">Last Name</label>
										<div class="controls">
											<input autofocus class="input-xlarge" name="last_name" id="last_name" type="text"  value="<?php echo $last_name ?>" />
										</div>
									</div>
                                    
									<div class="clearfix"></div>
									
									<div class="control-group" title="Email Address" data-rel="tooltip">
										<label class="control-label" for="Email Address">User Email</label>
										<div class="controls" >
										  <input class="input-xlarge" name="user_email" id="email" type="email" value="<?php echo $user_email ?>"/>
										</div>
									</div>
                                    
									<div class="control-group" title="Password" data-rel="tooltip">
										<label class="control-label" for="password">Password</label>
										<div class="controls" >
										  <input class="input-xlarge" name="txtPassword" id="password" type="password" />
										</div>
									</div>
									
									<div class="control-group" title="Re-type  Password" data-rel="tooltip">
										<label class="control-label" for="Re-type  password">Re-type Password</label>
										<div class="controls" >
										  <input class="input-xlarge" name="repassword" id="repassword" type="password" />
										</div>
									</div>						
									
									
                                    
                                    <div class="control-group" title="User State" data-rel="tooltip">
										<label class="control-label" for="role">State</label>
										<div class="controls">
											<select name="UserState" class="input-xlarge focused" id="role">
											  <option value="ACT">ACT</option>
											  <option value="NSW">NSW</option>
											  <option value="NT">NT</option>
                                              <option value="QLD">QLD</option>
                                              <option value="SA">SA</option>
                                              <option value="TAS">TAS</option>
                                              <option value="VIC">VIC</option>
                                              <option value="WA">WA</option>
                                             </select>
										</div>
									</div>
                                    
									
									<div class="clearfix"></div>
									<p class="center span5">
									<input type="submit" class="btn btn-primary" name="newuser" value="Register"/>
									</p>
								</fieldset>
								<div class="span12">
								<a href="login.php">Back</a>
								</div>
							</form>
				    </div><!--/span-->
				</div>
			</div><!--/row-->
<?php include('footer.php'); ?>
