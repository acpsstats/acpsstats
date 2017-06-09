<?php include('header.php'); ?>
		<?php
		$title = '';
		$error = '';
		$success = '';	
		$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
		$user_id = $_REQUEST['user'];
		if(isset($_REQUEST['user'])){
			if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){ 
			if(in_array($current_user,$config['admin']) || $user_id == $current_user){	 	
				if(isset($_REQUEST['newuser'])){
					$update_user = array('UserState'	=>	$_POST['UserState'],
										 'first_name' 	=>  $_POST['first_name'],
										 'last_name'	=>	$_POST['last_name'],
										 'user_email' 	=>  $_POST['user_email']
										);
					if($_POST['txtPassword'] != '')
						$update_user['txtPassword'] = md5($config['salt'].$_POST['txtPassword']);
						
					$new_user = update_user($update_user,$user_id);
					if(!$new_user)
						$error = "The Email address alreay exists with some other account";
					else	
						$success = "User Has been Successfully added";	
				}	
			
				
				$results = get_users('single',$user_id);
				$username = isset($results['txtUserName']) ? $results['txtUserName'] : '';
				$first_name = isset($results['first_name']) ? $results['first_name'] : '';
				$last_name = isset($results['last_name']) ? $results['last_name'] : '';
				$user_email = isset($results['user_email']) ? $results['user_email'] : '';
				$user_state = isset($results['UserState']) ? $results['UserState'] : '';
				
				
				
			?>
		<div class="row-fluid sortable">		
			<div class="well span5 center login-box">	
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i>User Profile : <?php echo $username ?> </h2>
			</div>
			<div class="box-content" style="padding:40px 10px 0px; margin-left:-30px;">
			<?php if($success != ''){?>
                        	<p class="success message" style="position:absolute; top:50px; left:0px;"><?php echo $success ?></p>
            <?php } ?>
			<?php if($error != ''){
			     echo '<p class="error message" style="position:absolute; top:50px; left:0px;">'.$error.'</p>';
			 }  ?>	 
			<form class="form-horizontal" id="profilefrm" name="profilefrm" action="" method="post">
					<fieldset>
						<div class="control-group" title="Username" data-rel="tooltip">
							<label class="control-label" for="username">Username</label>
							<div class="controls">
								<input autofocus class="input-xlarge focused" name="txtUserName" readonly id="username" type="text" value="<?php echo $username ?>"  />
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
							<!--<label class="control-label" for="role">State</label>-->
							<div class="controls">
                              <input type="hidden" name="UserState" value="<?php echo $user_state?>" />
							<?php //$array = array('ACT','NT','QLD','SA','TAS','VIC','WA','NSW'); ?>
								<!--<select name="UserState" class="input-xlarge focused" id="role">
								 <?php
									/*foreach($array as $items){
										
										if($user_state == $items)
											echo "<option selected='selected' val='".$items."'>".$items."</option>";
										else
											echo "<option val='".$items."'>".$items."</option>";
									}*/
									?>
								  
								 </select>-->
							</div>
						</div>
						
						
						<div class="clearfix"></div>
						<p class="center span5">
						<input type="submit" class="btn btn-primary" name="newuser" value="Update"/>
						</p>
					</fieldset>
				</form>
				</div>
			</div>
		</div>
		 <?php		}else{
						header('Location:http://acpsstats.com/user_profile.php?action=edit&user='.$current_user);
						exit;
		 			}	
				}
			 }
		 ?>
					
		</div><!--/span-->
	</div><!--/row-->
<?php include('footer.php'); ?>