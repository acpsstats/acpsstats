<?php include('header.php'); ?>
		<?php
		$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
		$user_id = $_REQUEST['user'];
		
		$head = 'true';
		if(in_array($current_user,$config['admin'])){
		  $head = '';
		}elseif($user_id != $current_user && !in_array($current_user,$config['admin'])){
		 
		 		header('location:dashboard.php'); exit; 
		}
	    						
		$title = '';
		$error = '';
		$success = '';
		if(isset($_REQUEST['user'])){
			
			if(isset($_POST['delete_control'])){
				$delete_item = $_POST['delete_control'];			
				foreach($delete_item as $delete){					
					delete_user_record($user_id,$delete);
				}
			}			
			if(isset($_REQUEST['delete_record'])){
			  if(delete_user_record($user_id,$_REQUEST['delete_record'])){
				  header('location:user_records.php?user='.$user_id.'&action=view');
			  }
			}elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view'){
				$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
				$results = get_users('single',$user_id);				
				$username = isset($results['txtUserName']) ? $results['txtUserName'] : '';
				$first_name = isset($results['first_name']) ? $results['first_name'] : '';
				$last_name = isset($results['last_name']) ? $results['last_name'] : '';
				$user_email = isset($results['user_email']) ? $results['user_email'] : '';
				$user_state = isset($results['UserState']) ? $results['UserState'] : '';
				
			}
			
			} 
				$records = get_user_records('all');
			?>
		<div class="row-fluid sortable" style="background:#f9f9f9;">		
				<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-user">    User Data Entry</i></h2>
						</div>
						<?php  $results = get_users('all'); ?>
						<div class="box-content">
                         <form id="delete_control" action="<?php echo 'user_records.php?user='.$user_id.'&action=view' ?>" method="post">
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							  <thead>
								  <tr>
									  <th>Full Name</th>
									  <th>Case ID</th>
									  <th>DoB</th>
									  <th>Post Code</th>
									  <th>URN</th>
									  <th>UserName</th>
                                      <th>Facility Code</th>
									  <th>Surgeon Type</th>
									  <th>InitCons Date</th>
									  <th>Admission Date</th>
									  <th>Separation Date</th>
									  <th>Surgery Date</th>
									  <th>Action</th>
								  </tr>
							  </thead>   
							  <tbody>
								<?php
								 if(!empty($records)){
								  foreach($records as $record){
									  
									$staus = ($record['Validated'] == 1) ? 'Active' : 'In_active';
									echo "<tr class='".$staus."'>
										  <td><!--<input type='checkbox' value='".$record['ID']."' name='delete_control[]' class='delete_this' />-->".$record['Firstname']." ".$record['LastName']."</td>
										  <td>".$record['ID']."</td>
										  <td>".date_format_type($record['DoB'])."</td>
										  <td>".$record['PostCode']."</td>
										  <td>".$record['URN']."</td>
										  <td>".ucwords(get_username($record['user_id']))."</td>
										  <td>".display_values('r_facility','FacilityCode','FacilityDescription',$record['FacilityCode'])."</td>
										  <td>".display_values('r_surgeontype','SurgeonTypeCode','SurgeonTypeDesc',$record['SurgeonType'])."</td>
										  <td>".date_format_type($record['InitConsDate'])."</td>
										  <td>".date_format_type($record['AdmissionDate'])."</td>
										  <td>".date_format_type($record['SeparationDate'])."</td>
										  <td>".date_format_type($record['SurgeryDate'])."</td>
										  <td class='center'>
											<a class='btn btn-success' href='dashboard.php?show_record=".$record['ID']."&action=view'>
												<i class='icon-zoom-in icon-white'></i>  
												View                                            
											</a>											
										    <a class='btn btn-danger' data-id='".$record['ID']."' data-name='".$record['Firstname']." ".$record['LastName']."' data-user='".$user_id."' id='delete_record' href='javascript:void(0)' style='margin-top:5px;'>
												<i class='icon-trash icon-white'></i> 
												Delete
											</a>
										</td></tr>"; 
								  }
								
								}
								?>
							  </tbody>
						  </table>  
                         <!-- <button id="delete_this" class="btn btn-danger"><i class='icon-trash icon-white'></i> Bulk Delete</button>-->
                         
                          </form>         
						</div>
				</div><!--/span-->
			</div><!--/row-->
		<?php 
		?>		
<?php include('footer.php'); ?>