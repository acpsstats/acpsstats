<?php include('header.php');
$member_array = array();
$username = "";
$useremail = "";
$role = "";
if($_SESSION['type'] !="Admin") header("location:index.php");
if(isset($_POST['memberedit'])){
    $mem_info['username'] 			=  $_POST['username'];
	$mem_info['useremail']			=  $_POST['useremail'];
	$mem_info['type'] 				=  $_POST['userrole'];
	$mem_info['department']			=  $_POST['department'];
	if($_POST['password']!="") $mem_info['password'] 	=   md5($_POST['password']);
	
	$updt_res = update_member($mem_info,$_POST['editid']);
	
	if($updt_res){
	   header("Location:members.php?msg=success");
	}
	
}

if(isset($_REQUEST["mid"]) && $_REQUEST["mid"]!=""){
  $member_array = get_member_edit($_REQUEST["mid"]);
}

if(empty($member_array)){
    header("location:members.php?msg=invalid");
}else{
	$username = $member_array[0]['username'];
	$useremail = $member_array[0]['useremail'];
	$role = $member_array[0]['type'];
	$department = $member_array[0]['department'];
}

$view_class = false;
if(isset($_GET['action']) && $_GET['action'] == 'view'){
 $view_class = true;
}

$dept_array = get_department_list();
//print_r($dept_array);
?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Edit User</a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Please Edit the Fields to update user details</h2>
						
					</div>
					<div class="box-content <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='view') echo " viewcontent";?>">
						<form class="form-horizontal" id="memberupdatefrm" id="memberupdatefrm" method="post">
						  <input type="hidden" name="editid" value="<?php echo $_REQUEST["mid"];?>"/>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Name</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="username" name="username" type="text" value="<?php echo $username;?>">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">Password</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="password" name="password" type="password" value="" autocomplete="off">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Email</label>
							  <div class="controls">
								<input class="input-xlarge focused" id="useremail" name="useremail" type="text" value="<?php echo $useremail;?>">
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="department">Department</label>
								<div class="controls">
								   <?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='view'){?>
										<input class="input-xlarge focused" id="userrole" name="userrole" type="text" value="<?php $dept_info =  get_department_by_id($department); echo $dept_info['departmentname'];?>">
								   <?php } else {?>
										<select name="department" class="input-xlarge focused" id="department">
										  <option value="">SELECT DEPARTMENT</option>
										  <?php foreach($dept_array as $index => $dept){?>
											  <option value="<?php echo $dept_array[$index]['dept_id']; ?>" <?php if($department == $dept_array[$index]['dept_id']) echo "selected";?>><?php echo $dept_array[$index]['departmentname'] ?></option>
										  <?php } ?>
										</select>
									<?php } ?>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="selectError3">User Role</label>
								<div class="controls">
								<?php if(isset($_REQUEST['action']) && $_REQUEST['action']=='view'){?>
								   <input class="input-xlarge focused" id="userrole" name="userrole" type="text" value="<?php echo $role;?>">
								<?php } else {?>
								  <select id="userrole" name="userrole">
									<option value="Admin" <?php if($role == "Admin") echo "selected"; ?>>Admin</option>
									<option value="Engineer" <?php if($role == "Engineer") echo "selected"; ?>>Engineer</option>
									<option value="Supervisor" <?php if($role == "Supervisor") echo "selected"; ?>>Supervisor</option>
								  </select>
								  <?php } ?>
								</div>
							</div>
							
							<div class="form-actions">
							  <?php if(!$view_class){ ?><input type="submit" class="btn btn-primary" value="Save changes" name="memberedit" id="memberedit" /> 
							  <button type="reset" class="btn" tabindex="14"> Cancel</button><?php } ?>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			 </div>
					
			

			
				  

		  
       
<?php include('footer.php'); ?>
