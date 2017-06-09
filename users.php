<?php include('header.php'); ?>
	<?php
		$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

		if(!in_array($current_user,$config['admin'])){
			header('location:dashboard.php');
		}?>
			<div class="row-fluid sortable" style="background:#f9f9f9;">		
				<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-user">Members</i></h2>
						</div>
						<?php  $results = get_users('all'); ?>
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							  <thead>
								  <tr>
									  <th>Username</th>
									  <th>Full Name</th>
									  <th>Email Address</th>
									  <th>State</th>
									  <th>Status</th>
                                      <th>Records</th>
									  <th>Actions</th>
								  </tr>
							  </thead>   
							  <tbody>
								<?php
								 if(count($results) > 1){
								  foreach($results as $uers){
									 $staus = ($uers['is_active'] == 1) ? 'Active' : 'In-active';
									 if($staus=='Active')
									 {
									  $btn_astaus='btn-success';
									  $btn_iastaus='btn';
									  $status_n=1;
									 }else {
									   $btn_iastaus='btn-danger';
									   $btn_astaus='btn';
									   $status_n=0;
									 }
									echo "<tr>
										  <td>".$uers['txtUserName']."</td>
										  <td>".$uers['first_name']." ".$uers['last_name']."</td>
										  <td>".$uers['user_email']."</td>
										  <td>".$uers['UserState']."</td>
										  <td>
										   	<a class='btn statusaction btn-active " .$btn_astaus. " '  attr-userid=".$uers['user_id']." attr-status-n=1 href='javascript:void(0)'>
										 	  Active                                        
											</a>
											   	<a class='btn statusaction btn-inactive "  .$btn_iastaus. " '  attr-userid=".$uers['user_id']." attr-status-n=0 href='javascript:void(0)'>
										 	  In-active                                        
											</a>
										  </td>
										  <td>
										  <strong>TOTAL :</strong>".get_count('total',$uers['user_id'])."<br />
										  <a href='user_records.php?user=".$uers['user_id']."&action=view&type=valid'><span style='color:green'><strong>Validated :</strong>".get_count('valid',$uers['user_id'])."</span></a><br />
										  <a href='user_records.php?user=".$uers['user_id']."&action=view&type=non'><span style='color:red'><strong>Non-Validated :</strong>".get_count('non',$uers['user_id'])."</span></a><br />
										  <a title='Missing PRINCIPAL DIAGNOSIS OR 
SECONDARY DIAGNOSES' href='user_records.php?user=".$uers['user_id']."&action=view&type=incomplete'><span style='color:red'><strong>Incomplete :</strong>".get_count('incomplete',$uers['user_id'])."</span></a><br />";

$empty_record=get_count('empty',$uers['user_id']);
if($empty_record>0 && in_array($current_user,$config['admin'])){
echo "<a href='user_records.php?user=".$uers['user_id']."&action=view&type=empty'><span style='color:red'><strong>Null Records :</strong>".get_count('empty',$uers['user_id'])."</span></a><br />";
}
										  echo "</td>
										  <td class='center'>
											<a class='btn btn-success' href='user_records.php?user=".$uers['user_id']."&action=view'>
												<i class='icon-zoom-in icon-white'></i>  
												View                                            
											</a>
											<a class='btn btn-info' href='user_profile.php?user=".$uers['user_id']."&action=edit'>
												<i class='icon-edit icon-white'></i>  
												Edit                                            
											</a>
										<!--<a class='btn btn-danger' href='#'>
												<i class='icon-trash icon-white'></i> 
												Delete
											</a> -->
										</td></tr>"; 
								  }
								}
								?>
							  </tbody>
						  </table>            
						</div>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
	
