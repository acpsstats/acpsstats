<?php include('header.php'); ?>
<?php 
if($_SESSION['type'] !="Admin") header("location:index.php");
$member_array = get_member_list();
?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Users</a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Users</h2>
						<span class="newuserlink"><label class="newuser" for="newuser"><a href="register.php">New User ?</a></label></span>
					</div>
					<?php
					 if(isset($_GET['msg'])){
					   if($_GET['msg'] == 'success'){?>
					     <div class="resultmsg"><label class="success">User Details successfully changed</label></div>
					   <?php } else { ?>
					     <div class="resultmsg"><label class="errormsg">Sorry, Details not updated.</label></div>
					   <?php } 
					 }
					?>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Username</th>
								  <th>Email</th>
								  <th>Date registered</th>
								  <th>Role</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                            <?php foreach($member_array as $key => $members_list){?>
                                <tr>
                                    <td><?php echo ucfirst($members_list['username']);?></td>
									<td><?php echo $members_list['useremail'];?></td>
                                    <td><?php echo date("d/m/Y",strtotime($members_list['created_on']));?></td>
                                    <td><?php echo $members_list['type'];?></td>
                                    <td class="center">
                                        <a class="btn btn-success" href="members_update.php?action=view&mid=<?php echo $members_list['userid'];?>">
                                            <i class="icon-zoom-in icon-white"></i>  
                                            View                                            
                                        </a>
                                        <a class="btn btn-info" href="members_update.php?action=edit&mid=<?php echo $members_list['userid'];?>">
                                            <i class="icon-edit icon-white"></i>  
                                            Edit                                            
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
					
			

			
				  

		  
       
<?php include('footer.php'); ?>
