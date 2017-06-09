<?php include('header.php');
$member_array = array();
$username = "";
$useremail = "";
$edit_msg = "";
$member_array = get_member_edit($_SESSION['userid']);
$error_msg = "";
$updt_res = 0;

if(isset($_POST['profileedit'])){
    $mem_info['username'] 			=  $_POST['username'];
	$mem_info['useremail']			=  $_POST['useremail'];
	
	
	if($_POST['password']!="") $mem_info['password'] 	=   md5($_POST['password']);
	
	if(check_username_exists($_POST['username'],"update") == 0){
	  $error_msg .= "<span>Username already exists</span>";
	}
	if(check_email_exists($_POST['username'],"update") == 0){
	  $error_msg .= "<span>Email already exists</span>";
	}
	
	if($error_msg == "") $updt_res = update_member($mem_info,$_SESSION['userid']);
	
	if($updt_res){
	   $edit_msg = "Your profile was updated successfully";
	}
	
}

if(empty($member_array)){
    header("location:members.php?msg=invalid");
}else{
	$username = $member_array[0]['username'];
	$useremail = $member_array[0]['useremail'];
}

?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Edit Profile</a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Please Edit the Fields to update profile details</h2>
						<?php if($edit_msg !=""){?>
						<p class="success"><?php echo $edit_msg;?></p>
						<?php } ?>
						<?php if($error_msg!=""){?>
						<p class="errormsg"><?php echo $error_msg;?></p>
						<?php } ?>
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="profilefrm" id="profilefrm" method="post">
						  <input type="hidden" name="editid" value="<?php echo $_SESSION['userid'];?>"/>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="username">User Name</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="username" name="username" type="text" value="<?php echo $username;?>">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="password">Password</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="password" name="password" type="password" value="" autocomplete="off">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="confirm_password">Confirm Password</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="confirm_password" name="confirm_password" type="password" value="" autocomplete="off">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="useremail">User Email</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="useremail" name="useremail" type="text" value="<?php echo $useremail;?>">
							  </div>
							</div>
							
							<div class="form-actions">
							   <input type="submit" class="btn btn-primary" value="Save changes" name="profileedit" id="profileedit" /> 
							  <a type="reset" class="btn" href="index.php">Cancel</a>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			 </div>
       
<?php include('footer.php'); ?>
