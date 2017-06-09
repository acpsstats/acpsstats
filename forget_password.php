<?php
$no_visible_elements=true;
include('header.php'); ?>
<?php 
$success = 0;
$user_id = 0;
$rest_password = '';

if(isset($_POST['reset_password'])){
	$data['user_id'] = $_POST['user_id'];
	$data['txtPassword'] =   md5($config['salt'].$_POST['txtPassword']);
	$data['Password'] =$_POST['txtPassword'];
	$data['user_name'] = $_POST['user_name'];
	$data['user_email'] = $_POST['user_email'];
	$rest_password = forget_password_authenticate($data);
}elseif(isset($_POST['reset'])){
	$user_info['username'] 			=  $_POST['username-list'];
	$user_info['user_email'] 			= $_POST['user_email'];
	$user_array = extract_user_by_email($user_info);
	if(!empty($user_array))	
		$user_id = $user_array['user_id'];
	else
		$error = "Email Address not match with username";	
}
?><div class="row-fluid">
				<div class="span12 center login-header"> 
					<h2>The Australasian College of Podiatric Surgeons <br /> Surgical Audit Tool</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						<?php
							if($rest_password != '') {  echo "Your Password Has been Reset Successfully.Please check your mail.";	}	
							elseif($user_id > 0){ echo "Please Confirm the following Details and reset your Password"; }
							else {echo 'Please Select the Username'; }
			          if(isset($error) && $error!=""){?>
                        <p><label class="errormsg"><?php echo $error;?></label></p>
                        <?php }?>
					</div>
                    
                    <?php if($user_id != 0){ ?>
                    
                    		<form class="form-horizontal" name="registerfrm" id="registerfrm" action="" method="post">
                            
                            <fieldset>
                            
                           <div class="control-group">
										<label class="control-label" for="password">User Name</label>
										<div class="controls" >
										  <?php echo $user_array['txtUserName'] ?>
										</div>
							</div>
                            
                             <div class="control-group">
										<label class="control-label" for="password">First Name</label>
										<div class="controls" >
										  <?php echo $user_array['first_name'] ?>
										</div>
							</div>
                            
                             <div class="control-group">
										<label class="control-label" for="password">Last Name</label>
										<div class="controls" >
										  <?php echo $user_array['last_name'] ?>
                                           <input type="hidden" name="user_name" value="<?php echo $user_array['first_name']." ".$user_array['last_name'] ?>" />
										</div>
							</div>
                            
                            <div class="control-group">
										<label class="control-label" for="password">Email Address</label>
										<div class="controls" >
										  <?php echo $user_array['user_email'] ?>
                                           <input type="hidden" name="user_email" value="<?php echo $user_array['user_email'] ?>" />
                                          <input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
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
                                <div class="clearfix"></div>
                                <p class="center span5">
                                <input type="submit" class="btn btn-primary" value="Reset" name="reset_password" id="reset"/>
                                </p>
                            </fieldset>
                        </form>
                    
                    
                    <?php } else { ?>
                        <form class="form-horizontal" name="loginfrm" id="loginfrm" action="" method="post">
                            <fieldset>
                                <div class="input-prepend" title="">
                                    <span class="add-on" style="float:left;"><i class="icon-user"></i></span>
                                    <span><select style="width:170px;" class="input-select chosen-select" name="username-list" id="username-list">
                                        <option>Select User</option>
                                        <?php echo display_users("reset_form"); ?>
                                    </select></span>
                                </div>
                                
                                <div class="clearfix"></div>
                                <div class="input-prepend" title="Enter Your Email address registered with your account" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-envelope"></i></span><span class="login_pass"><input class="input-large span10" name="user_email" id="user_email" type="email" value="" /></span>
                                </div>
                                <div class="clearfix"></div>
                                
                                
                                <!--<div class="clearfix"></div>
                                <div class="input-prepend" title="Password" data-rel="tooltip">
                                    <span class="add-on"><i class="icon-lock"></i></span><span class="login_pass"><input class="input-large span10" name="password" id="password" type="password" value="" /></span>
                                </div>
                                <div class="clearfix"></div>-->
                                
                                <div class="clearfix"></div>
                                <p class="center span5">
                                <input type="submit" class="btn btn-primary" value="Reset" name="reset" id="reset"/>
                                </p>
                                <div class="center span12">
                                <div class="new-user">
                                <label class="newuser" for="newuser"><a href="login.php">Back to login</a></label>
                                </div> 
                                
                                
                            <!--	<div class="forgot-pwd">
                                <label class="forgotpwd" for="forgotpwd"><a href="reset.php">Forgot Password </a></label>
                                </div> -->
                                </div>
                                
                            </fieldset>
                        </form>
                      <?php } ?>  
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
