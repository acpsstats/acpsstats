<?php
	ini_set('memory_limit', '-1'); 
    include_once('config.php');
	include_once('pagination.php');	
	//include_once('acps_backup.php');
	//error_reporting(E_ALL);	

	if(isset($_REQUEST['chekuser'])){
	    include_once('config.php');
		$user_name = $_REQUEST['username'];
		echo check_user_exsist($user_name);
		exit();
	}
	
  if(isset($_REQUEST['action']) && $_REQUEST['action']=='changestatus' ){
  	
			$id=$_REQUEST['id'];
			 $is_active=$_REQUEST['status_no'];
			if($is_active==1){ $data['is_active']=1;} else { $data['is_active']=0; } 
			$where = "user_id = ".$id; 
			$db->query_update('tblusers',$data,$where);
  }

	if(isset($_REQUEST['search']) && isset($_REQUEST['search_String'])){
	  $key = $_REQUEST['search_String'];
	   global $db,$config;	   
	   $user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';	   
	   $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';	   
	   if($user_name != ''){
		if(in_array($user_id,$config['admin']))
		   $query = "SELECT * FROM tblmasterpoddata WHERE (LastName LIKE '%".$key."%' OR Firstname LIKE '%".$key."%' OR URN LIKE '%".$key."%'  OR PostCode LIKE '%".$key."%' OR DoB LIKE '%".$key."%')";
		else
		    $query = "SELECT * FROM tblmasterpoddata WHERE (LastName LIKE '%".$key."%' OR Firstname LIKE '%".$key."%' OR URN LIKE '%".$key."%'  OR PostCode LIKE '%".$key."%' OR DoB LIKE '%".$key."%') AND UserName = '".$user_name."'";
		$records = $db->fetch_all_array($query);
	} 
	}
	
	if(isset($_REQUEST['delete_record']) && $_REQUEST['delete_record'] != ''){
	   global $db,$config;
	   $record_id = $_REQUEST['delete_record'];	 
	   
	  
	   $user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	   $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	   
	   $query_record = "Select user_id FROM  tblmasterpoddata WHERE ID = " . $record_id;
	   $records_info =  $db->query_first($query_record);
	   
	   
	  
	   
	   $query = '';
	   if($user_name != ''){
	      if(in_array($user_id,$config['admin'],true))		  
		    $query = "DELETE FROM tblmasterpoddata WHERE ID = ".$record_id;
		  elseif($user_id == $records_info['user_id'])
			$query = "DELETE FROM tblmasterpoddata WHERE ID = $record_id";
			
		  	if($query != ''){
			   		$array_tabs = array('mktbcomorbidities','mktblproccodes_forrpt08','mktbsdxcodes','mktbcomplications','mktblpdxcodes','mktblproccodes');
			   foreach($array_tabs as $tabs){
				 $query_in = "DELETE FROM ".$tabs." WHERE pod_id = ".$record_id;
				 $db->query($query_in);
			   }
			  $db->query($query);	
		   }
	   }
	}
	
	
	
	if(isset($_REQUEST['action']) && isset($_REQUEST['step'])){
		
		$step = $_REQUEST['step'];
		
		$data = $_POST;

		if(isset($data['DoB']))		
				$data['DoB'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['DoB'])));
			 if(isset($data['InitConsDate']))  
			   $data['InitConsDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['InitConsDate'])));
			 if(isset($data['SurgeryDate'])) 
			   $data['SurgeryDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['SurgeryDate'])));
			  if(isset($data['AdmissionDate']))  
			   $data['AdmissionDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['AdmissionDate'])));
			 if(isset($data['SeparationDate']))  
			   $data['SeparationDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['SeparationDate'])));
			 $data['DaySurgOutcome1_1_UnvntflDisch'] 		= isset($data['DaySurgOutcome1_1_UnvntflDisch'])?$data['DaySurgOutcome1_1_UnvntflDisch'] : 1;
 			 $data['DaySurgOutcome1_2_RetToOR'] 				=  isset($data['DaySurgOutcome1_2_RetToOR'])?$data['DaySurgOutcome1_2_RetToOR'] : 1;
			 $data['DaySurgOutcome1_3_TransferOvernight'] 	= isset($data['DaySurgOutcome1_3_TransferOvernight'])?$data['DaySurgOutcome1_3_TransferOvernight'] : 1;
			 $data['DaySurgOutcome1_4_TransferOtherFacility'] = isset($data['DaySurgOutcome1_4_TransferOtherFacility'])?$data['DaySurgOutcome1_4_TransferOtherFacility'] : 1;
			 $data['DaySurgOutcome1_5_Cancel_FailArrive'] 	= isset($data['DaySurgOutcome1_5_Cancel_FailArrive'])?$data['DaySurgOutcome1_5_Cancel_FailArrive'] : 1;
			 $data['DaySurgOutcome1_6_CancelPreExistCond'] 	=  isset($data['DaySurgOutcome1_6_CancelPreExistCond'])?$data['DaySurgOutcome1_6_CancelPreExistCond'] : 1;
			 $data['DaySurgOutcome1_7_CancelAcuteMedCond']	= isset($data['DaySurgOutcome1_7_CancelAcuteMedCond'])?$data['DaySurgOutcome1_7_CancelAcuteMedCond'] : 1;
			 $data['DaySurgOutcome1_9_UnplDelayDisch'] 		=  isset($data['DaySurgOutcome1_9_UnplDelayDisch'])?$data['DaySurgOutcome1_9_UnplDelayDisch'] : 1;
			 $data['DaySurgOutcome1_8_CancelAdminOrg'] 		= isset($data['DaySurgOutcome1_8_CancelAdminOrg'])?$data['DaySurgOutcome1_8_CancelAdminOrg'] : 1;
			 $data['DaySurgOutcome1_9_UnplDelayDisch'] 		= isset($data['DaySurgOutcome1_9_UnplDelayDisch'])?$data['DaySurgOutcome1_9_UnplDelayDisch'] : 1;
			 $data['PostOpProphylaxis_Antibiotic'] 		= isset($data['PostOpProphylaxis_Antibiotic'])?$data['PostOpProphylaxis_Antibiotic'] : 1;
				//$data['InpatientOutcome'] = 0;
				
			$data['Comorbidity01']	 	= isset($data['Comorbidity01'])?$data['Comorbidity01'] : 0; 
	    	$data['Comorbidity02']	 	= isset($data['Comorbidity02'])?$data['Comorbidity02'] : 0;
	    	$data['Comorbidity03']	 	= isset($data['Comorbidity03'])?$data['Comorbidity03'] : 0;
	    	$data['Comorbidity04']	 	= isset($data['Comorbidity04'])?$data['Comorbidity04'] : 0;
	    	$data['Comorbidity05']	 	= isset($data['Comorbidity05'])?$data['Comorbidity05'] : 0;
	    	$data['Comorbidity06']	 	= isset($data['Comorbidity06'])?$data['Comorbidity06'] : 0;
	    	$data['Comorbidity07']	 	= isset($data['Comorbidity07'])?$data['Comorbidity07'] : 0;
	    	$data['Comorbidity08']	 	= isset($data['Comorbidity08'])?$data['Comorbidity08'] : 0;
	    	$data['Comorbidity09']	 	= isset($data['Comorbidity09'])?$data['Comorbidity09'] : 0;
	    	$data['Comorbidity10']	 	= isset($data['Comorbidity10'])?$data['Comorbidity10'] : 0;
			
			 
			 
			 
			 
			  
			if($_REQUEST['action'] == 'update'){
				$data['is_validate'] = 0;
				if(isset($_REQUEST['isvalidate']) && $_REQUEST['isvalidate'] == 1):
				   $data['is_validate'] = 1;
				endif;	 
				
				$id = '';
			 	$data['update_record'] = $_REQUEST['id']; 
			 	$id = $_REQUEST['id'];		
						
				
						
						
			 	$update_id = update_pod_data($data);

			}elseif($_REQUEST['action'] == 'insert'){
				  
				$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
				$data['user_id'] = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';				
				$data['UserState'] = (isset($_SESSION['UserState'])) ? $_SESSION['UserState'] : '';
				unset($data['update_record']);
			    unset($data['is_validate']); 
				unset($data['ass_cond']);
				unset($data['add_new_record']);	
				$data['Validated'] = 0;			
				if($data['user_id'] != '' && isset($data['LastName']) &&  $data['LastName'] != '')
					$id = $db->query_insert('tblmasterpoddata',$data);
			}	
		if($id != ''){
			$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';	
			 $total_records = get_count('total',$user_id);
			 $valid = get_count('valid',$user_id);
			 $non = get_count('non',$user_id);
			 $incomplete = get_count('incomplete',$user_id);
			 $validate = $data['is_validate'];
			 
			 $array_response = array('id' => $id,'total' => $total_records,'valid' => $valid,'non' => $non,'incomplete' => $incomplete,'is_validate' => $validate);
			 
		}else{
				$array_response = array('response' => 'something went wrong');
		}
		echo json_encode($array_response);
		exit;		 
	}
	
	
	function update_pod_data($data){
	   global $db,$config;
	   $user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	   $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	   
	   unset($data['submit']);
	   
	   unset($data["ass_cond"]);
	   if($user_id != ''){
			$data['DaySurgOutcome1_1_UnvntflDisch'] 		= isset($data['DaySurgOutcome1_1_UnvntflDisch'])?$data['DaySurgOutcome1_1_UnvntflDisch'] : 0;
			$data['DaySurgOutcome1_2_RetToOR'] 				=  isset($data['DaySurgOutcome1_2_RetToOR'])?$data['DaySurgOutcome1_2_RetToOR'] : 0;
			$data['DaySurgOutcome1_3_TransferOvernight'] 	= isset($data['DaySurgOutcome1_3_TransferOvernight'])?$data['DaySurgOutcome1_3_TransferOvernight'] : 0;
			$data['DaySurgOutcome1_4_TransferOtherFacility'] = isset($data['DaySurgOutcome1_4_TransferOtherFacility'])?$data['DaySurgOutcome1_4_TransferOtherFacility'] : 0;
			$data['DaySurgOutcome1_5_Cancel_FailArrive'] 	= isset($data['DaySurgOutcome1_5_Cancel_FailArrive'])?$data['DaySurgOutcome1_5_Cancel_FailArrive'] : 0;
			$data['DaySurgOutcome1_6_CancelPreExistCond'] 	=  isset($data['DaySurgOutcome1_6_CancelPreExistCond'])?$data['DaySurgOutcome1_6_CancelPreExistCond'] : 0;
			$data['DaySurgOutcome1_7_CancelAcuteMedCond']	= isset($data['DaySurgOutcome1_7_CancelAcuteMedCond'])?$data['DaySurgOutcome1_7_CancelAcuteMedCond'] : 0;
			$data['DaySurgOutcome1_9_UnplDelayDisch'] 		=  isset($data['DaySurgOutcome1_9_UnplDelayDisch'])?$data['DaySurgOutcome1_9_UnplDelayDisch'] : 0;
			$data['DaySurgOutcome1_8_CancelAdminOrg'] 		= isset($data['DaySurgOutcome1_8_CancelAdminOrg'])?$data['DaySurgOutcome1_8_CancelAdminOrg'] : 0;
			$data['DaySurgOutcome1_9_UnplDelayDisch'] 		= isset($data['DaySurgOutcome1_9_UnplDelayDisch'])?$data['DaySurgOutcome1_9_UnplDelayDisch'] : 0;
			$data['PostOpProphylaxis_Antibiotic'] 		= isset($data['PostOpProphylaxis_Antibiotic'])?$data['PostOpProphylaxis_Antibiotic'] : 0;
			//$data['InpatientOutcome'] = 0;
			
			$data['ComorbiditiesYesNo'] = isset($data['ComorbiditiesYesNo'])?$data['ComorbiditiesYesNo'] : 0;
			
			$data['Comorbidity01']	 	= isset($data['Comorbidity01'])?$data['Comorbidity01'] : 0;
			$data['Comorbidity02']	 	= isset($data['Comorbidity02'])?$data['Comorbidity02'] : 0;
			$data['Comorbidity03']	 	= isset($data['Comorbidity03'])?$data['Comorbidity03'] : 0;
			$data['Comorbidity04']	 	= isset($data['Comorbidity04'])?$data['Comorbidity04'] : 0;
			$data['Comorbidity05']	 	= isset($data['Comorbidity05'])?$data['Comorbidity05'] : 0;
			$data['Comorbidity06']	 	= isset($data['Comorbidity06'])?$data['Comorbidity06'] : 0;
			$data['Comorbidity07']	 	= isset($data['Comorbidity07'])?$data['Comorbidity07'] : 0;
			$data['Comorbidity08']	 	= isset($data['Comorbidity08'])?$data['Comorbidity08'] : 0;
			$data['Comorbidity09']	 	= isset($data['Comorbidity09'])?$data['Comorbidity09'] : 0;
			$data['Comorbidity10']	 	= isset($data['Comorbidity10'])?$data['Comorbidity10'] : 0;
			
			$data['IntraOp_2ndDose']	 	= isset($data['IntraOp_2ndDose'])?$data['IntraOp_2ndDose'] : 0;
			
			if(isset($data['DoB']))		
			   $data['DoB'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['DoB'])));
			 if(isset($data['InitConsDate']))  
			   $data['InitConsDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['InitConsDate'])));
			 if(isset($data['SurgeryDate'])) 
			   $data['SurgeryDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['SurgeryDate'])));
			 if(isset($data['AdmissionDate']))  
			   $data['AdmissionDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['AdmissionDate'])));
			 if(isset($data['SeparationDate']))  
			   $data['SeparationDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['SeparationDate'])));
			  
			  $record_id = $data['update_record'];
			  
			   unset($data['update_record']);
			   
			   
			  if(isset($data['is_validate']) && $data['is_validate'] == 1){
					$data['Validated'] = 1;
			   }else{
				 $data['Validated'] = 0;
			  }		   
			  
			  
			  
			  unset($data['is_validate']); 
			  
			  if(isset($data['add_new_record']))
				unset($data['add_new_record']);
					
			  if(in_array($user_id,$config['admin']))	
				$where = "ID = ".$record_id;			
			  else
				$where = "ID = ".$record_id." AND user_id = '".$user_id."'"; 
			
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";
			exit;*/
			
				 
				
			$update = $db->query_update('tblmasterpoddata',$data,$where);
			
			if(isset($_REQUEST['is_validate']) && $record_id != ''){	 		
			
				$userstate = isset($_SESSION['UserState']) ? $_SESSION['UserState'] : '';
				// ADDING ELEMENTS FOR mktbcomorbidities
				for($i = 1;$i <= 10; $i++){
					if($i <= 9)
						$var = 'Comorbidity0'.$i;
					else
						$var = 'Comorbidity'.$i;
					if(isset($data[$var]) && $data[$var] != ''){	
						$qry = "select ID from mktbcomorbidities WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_comorbidities = array(
											 'Comorbidity' => $data[$var],
											 'order_index'	=> $i
											 );
											 
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktbcomorbidities',$upadate_comorbidities,$where);
						}else{
							$mktbcomorbidities  = array(
													 'pod_id' => $record_id,
													 'Comorbidity' => $data[$var],
													 'order_index'	=> $i
													 );
							
							$add_new = $db->query_insert('mktbcomorbidities',$mktbcomorbidities);
						}							
					}elseif($data[$var] == '' || $data[$var] == 0 ){
						$qry = "select ID from mktbcomorbidities WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktbcomorbidities WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				}  // ADDING ELEMENTS FOR mktbcomorbidities END HERE
				 
				 
				 
				 //mktblproccodes_forrpt08
				 for($i = 1;$i <= 24; $i++){
					if($i <= 9)
						$var = 'Proc0'.$i;
					else
						$var = 'Proc'.$i;
					if(isset($data[$var]) && $data[$var] != ''){	
						$qry = "select ID from mktblproccodes_forrpt08 WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_forrpt08 = array(
											 'Proc' => $data[$var],
											 'order_index'	=> $i
											 );
											 
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktblproccodes_forrpt08',$upadate_forrpt08,$where);
						}else{
							$mktblproccodes_forrpt08  = array( 
													 'pod_id' => $record_id,
													 'Proc' => $data[$var],
													 'order_index'	=> $i
													 );
													
							
							$add_new = $db->query_insert('mktblproccodes_forrpt08',$mktblproccodes_forrpt08);
						}							
					}else{
						$qry = "select ID from mktblproccodes_forrpt08 WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktblproccodes_forrpt08 WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				}
	
				 
				// ADDING ELEMENTS FOR mktbsdxcodes
				
				for($i = 1;$i <= 24; $i++){
					if($i <= 9)
						$var = 'SDx0'.$i;
					else
						$var = 'SDx'.$i;
					if(isset($data[$var]) && $data[$var] != ''){	
						$qry = "select ID from mktbsdxcodes WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_mktbsdxcodes = array(
											 'Diags' => $data[$var],
											 'order_index'	=> $i
											 );
											 
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktbsdxcodes',$upadate_mktbsdxcodes,$where);
						}else{
							$mktbsdxcodes  = array( 
													 'pod_id' => $record_id,
													 'Diags' => $data[$var],
													 'order_index'	=> $i
													 );
													
							
							$add_new = $db->query_insert('mktbsdxcodes',$mktbsdxcodes);
						}							
					}else{
						$qry = "select ID from mktbsdxcodes WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktbsdxcodes WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				}  // ADDING ELEMENTS FOR mktbsdxcodes END HERE
				
				
				// ADDING ELEMENTS FOR ComplicationCode 			
				for($i = 1;$i <= 5; $i++){
					$var = 'ComplicationCode'.$i;
					if(isset($data[$var]) && $data[$var] != ''){	
						$qry = "select ID from mktbcomplications WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_ComplicationCode = array(
											 'Complication' => $data[$var],
											 'order_index'	=> $i
											 );
											 
							
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktbcomplications',$upadate_ComplicationCode,$where);
						}else{
							$ComplicationCode  = array( 
													 'pod_id' => $record_id,
													 'Complication' => $data[$var],
													 'order_index'	=> $i
													 );
												 
													
							
							$add_new = $db->query_insert('mktbcomplications',$ComplicationCode);
							
						}							
					}else{
						$qry = "select ID from mktbcomplications WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktbcomplications WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				} // ADDING ELEMENTS FOR ComplicationCode END HERE
				
				
				if(isset($data['PDx']) && $data['PDx'] != ''){	
						$qry = "select ID from mktblpdxcodes WHERE pod_id = ".$record_id." AND 	order_index = 1";
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_mktblpdxcodes = array(
											 'Diags' => $data['PDx'],
											 'order_index'	=> 1
											);
											 
							
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktblpdxcodes',$upadate_mktblpdxcodes,$where);
						}else{
							$mktblpdxcodes  = array(
													 'pod_id' => $record_id,
													 'Diags' => $data['PDx'],
													 'order_index'	=> 1
													 );
													
							
							$add_new = $db->query_insert('mktblpdxcodes',$mktblpdxcodes);
							
						}							
					}else{
						$qry = "select ID from mktblpdxcodes WHERE pod_id = ".$record_id." AND 	order_index = ".$i;
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktblpdxcodes WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				
				$qry = "select ID from mktblproccodes WHERE pod_id = ".$record_id;
				$data_proccodes = $db->query_first($qry);
				if(isset($data_proccodes['ID'])){
					$mktblproccodes = array(																	
											'Proc01' => $_POST['Proc01'],									
											'FacilityCode' => $data['FacilityCode'],
											'ASACategory' => $data['ASACategory'],
											'AnaesthesiaType1' =>$data['AnaesthesiaType1'],
											'AnaesthesiaType2' =>$data['AnaesthesiaType2'],
											'AnaesthesiaType3' => $data['AnaesthesiaType3'],
											'IntraOpProphylaxis_Thrombo' =>$data['IntraOpProphylaxis_Thrombo'],
											'IntraOpProphylaxis_Antibiotic' => $data['IntraOpProphylaxis_Antibiotic'],
											'PostOpProphylaxis_Thrombo' => $data['PostOpProphylaxis_Thrombo'],
											'PostOpProphylaxis_Antibiotic' => $data['PostOpProphylaxis_Antibiotic'],
											'PrevSurgery' =>  $data['PrevSurgery']
											);
											
					$where = "ID = ".$data_proccodes['ID'];		
					$update = $db->query_update('mktblproccodes',$mktblproccodes,$where);
				
				
				}else{
					$data_mktblproccodes = array('pod_id' => $record_id,
										'Proc01' => $_POST['Proc01'],									
										'FacilityCode' => $data['FacilityCode'],
										'ASACategory' => $data['ASACategory'],
										'AnaesthesiaType1' =>$data['AnaesthesiaType1'] ,
										'AnaesthesiaType2' =>$data['AnaesthesiaType2'] ,
										'AnaesthesiaType3' => $data['AnaesthesiaType3'],
										'IntraOpProphylaxis_Thrombo' =>$data['IntraOpProphylaxis_Thrombo'] ,
										'IntraOpProphylaxis_Antibiotic' => $data['IntraOpProphylaxis_Antibiotic'],
										'PostOpProphylaxis_Thrombo' => $data['PostOpProphylaxis_Thrombo'],
										'PostOpProphylaxis_Antibiotic' => $data['PostOpProphylaxis_Antibiotic'],
										'PrevSurgery' =>  $data['PrevSurgery']
										);
					$add_new = $db->query_insert('mktblproccodes',$data_mktblproccodes);
				} 						
			}
			return $update;
		}
	}
	function add_new_entry($data){
	  global $db,$config;
	  unset($data['submit']);
	  unset($data["ass_cond"]);
	  $user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	  $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	 
	    if($user_name != ''){
		if(isset($data['DoB']))		
		   $data['DoB'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['DoB'])));
		 if(isset($data['InitConsDate']))  
		   $data['InitConsDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['InitConsDate'])));
		 if(isset($data['SurgeryDate'])) 
		   $data['SurgeryDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['SurgeryDate'])));
		 if(isset($data['AdmissionDate']))  
		   $data['AdmissionDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['AdmissionDate'])));
		 if(isset($data['SeparationDate']))  
		   $data['SeparationDate'] = date('Y-m-d H:i:s',strtotime(str_replace('/','-',$data['SeparationDate'])));
		  // $data['UserName'] = $user_name;
		   $data['UserState'] =  (isset($_SESSION['UserState'])) ? $_SESSION['UserState'] : ''; 		   
		    $data['user_id'] = $user_id;
			unset($data['is_validate']); 
		   unset($data['add_new_record']);	
		   $add_new = $db->query_insert('tblmasterpoddata',$data);
		   return $add_new;
		}
	}
	
	
	
	function extract_user_by_email($data){
		
		global $db,$config;
		$login_qry = "select * from tblusers where user_id = '".$data['username']."' AND user_email = '".$data['user_email']."'";
		$loggedin_user = $db->query_first($login_qry);
		return $loggedin_user;
	}
	
	function forget_password_authenticate($data = null){
		global $db,$config;		
		$password = array('txtPassword' => $data['txtPassword']);
		$forget_status=$db->query_update("tblusers",$password,"user_id  = ".$data['user_id']);
		if($forget_status) {
			 return FP_Mail($data);
		}
	}
	
	function FP_Mail($userinfo){
        global $config;
		$to=$userinfo["user_email"];
		$subject="Password Updated Successfully :: ACPS";
		$from = $config["corporateMail"];
		$body='Hi '.$userinfo["name"].', <br/> <br/>You have successfully updated your Password. Please find your updated password below : <br />  New Password : '.$userinfo['Password'].' <br><br>Click here to login <a href="http://acpsstats.com/login.php"> acpsstats.com </a>';
		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        return mail($to,$subject,$body,$headers);
}

	
	function check_user_exsist($user = ''){
		global $db,$config;
		$login_qry = "select * from tblusers where txtUserName = '".$user."'";
		$loggedin_user = $db->query_first($login_qry);
		if(!empty($loggedin_user)){
		   return true;
		}else{
		  return false;	
		}
	 
	}
	
	function check_user_exsist_by_type($feild = '' , $val = '',$id = ''){
		global $db,$config;
		$login_qry = "select * from tblusers where $feild = '".$val."'";
		$loggedin_user = $db->query_first($login_qry);
		if(!empty($loggedin_user)){
		   return true;
		}else{
		  return false;	
		}
	 
	}
	
	function get_users($type ='',$id = ''){
		global $db,$config;
		$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
		if($id != ''){
		  $login_qry = "select * from tblusers WHERE user_id = ".$id;
			return $db->query_first($login_qry);
		}elseif($type == 'all' && in_array($current_user,$config['admin'])){
			$login_qry = "select * from tblusers WHERE user_id!=".$current_user;
			return $db->fetch_all_array($login_qry);
		}
		
		
	}
	
 	function register_user($user_info){
		global $db,$config;
		$user_name = check_user_exsist_by_type('txtUserName',$user_info['txtUserName']);
		$email = check_user_exsist_by_type('user_email',$user_info['user_email']);
		if($user_name){
			return '-1';		
		}elseif($email){
			return '0';		
		}else{
			 $lastid = $db->query_insert('tblusers',$user_info);
			 return $lastid;
		}
	
	}
	
	
	function update_user($data = null,$id = ''){
		 global $db,$config;
		if($id != ''){
			$login_qry = "select * from tblusers where user_email = '".$data['user_email']."' AND user_id != ".$id;
			$loggedin_user = $db->query_first($login_qry);
			if(!empty($loggedin_user)){
				   return false;
			}else{
				  $update_user=$db->query_update("tblusers",$data,"user_id  = ".$id);
				  if($update_user) {
				  	 $user_data['UserState']=$data['UserState'];
				     return   $db->query_update("tblmasterpoddata",$user_data,"user_id  = ".$id);
				  }
			}	
		}
	}
	function login_authenticate($user_info){
		global $db,$config;
		$login_qry = "select * from tblusers where txtUserName = '".$user_info['username']."' and txtPassword = '".$user_info['password']."' ";
		$loggedin_user = $db->query_first($login_qry);		
		if(!empty($loggedin_user)){  
		  $activate = ($loggedin_user['is_active'] != 1) ? "False" : 'True';
		  if($activate != 'True'){
			$return = 'inactive';
		  }else{
			store_session($loggedin_user);
			$return = "success";
		  }
		}else{
			$return = "fail";	
		}
	  return $return;	
	}
	function store_session($session_var){
	global $db,$config;
		foreach($session_var as $sess_key => $sess_values){
			$_SESSION[$sess_key] = $sess_values;
			$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
			if(in_array($user_id,$config['admin'])){
			$_SESSION['redirect_url'] = 'dashboard.php?action=current_user';
			}else{
			$_SESSION['redirect_url'] = 'dashboard.php';
			}
		}
	}
	
	
	
	
	/*function reset_new_password($username,$newpassword){
	      global $db;
		  $user_info['password'] = md5($newpassword);
		  return $db->query_update("user",$user_info,"username  = '".$username."' ");
	}*/
	
	
	function changedtformat($format,$datevalue){
	  global $com;
	  return $com->formatdate($format,$datevalue);
	}
	
	function date_format_type($val){
	  return date('d/m/Y',strtotime($val));
	}
	
	
	
  
  function display_users($type = ''){
	global $db;  
	$table_name = 'tblusers';
	$query ='SELECT txtUserName as username,user_id FROM '.$table_name." WHERE is_active = 1";  
	$mem_info = $db->fetch_all_array($query);
	$options = '';
	foreach($mem_info as $users){
    	if($type != '')
			$options .= '<option value="'.$users['user_id'].'">'.$users['username'].'</option>';
		else
		   $options .= '<option value="'.$users['username'].'">'.$users['username'].'</option>';
	} 
	return $options;
  }
  
function get_options_value($table = '',$val1 = '',$val2 = '',$selected = ''){
    global $db;  
	$table_name = $table;
	$query ='SELECT '.$val1.','.$val2.' FROM '.$table_name; 
	$mem_info = $db->fetch_all_array($query);
	$options = '';
	$in_elem = array();
	foreach($mem_info as $users){
	 	$data = explode(' ',$users[$val2]);
		$message = explode('(',$users[$val2]);
		if(isset($in_elem[$data[0]])){
		   $in_elem[$data[0]]['max'] = $users[$val1];
		}else{
			$in_elem[$data[0]]['min'] = $users[$val1];
			$in_elem[$data[0]]['message'] = $message[0];
		}
	}
	foreach($in_elem as $key=>$val){
		$min = isset($val['min']) ? $val['min'] : '';
		$max = isset($val['max']) ? $val['max'] : '';
		$info = isset($val['message']) ? $val['message'] : '';
		$options .= '<div class="options_innner '.$key.'" data-min="'.$min.'" data-message="'.$info.'" data-max="'.$max.'"></div>';
	}
	for($i=1;$i<=5;$i++){
		$options .= '<input type="hidden" id="Complication_Code'.$i.'" value="" class="selected_in">';
	}	
	return $options;	
											 	
}
function display_sel($table = '',$val1 = '',$val2 = '',$selected = ''){
	global $db;  
	$table_name = $table;
	$query ='SELECT '.$val1.','.$val2.' FROM '.$table_name; 
    //echo $query;
	
	$mem_info = $db->fetch_all_array($query);
	$options = '<option value="">Select Options</option>';
	foreach($mem_info as $users){
	
	 if($users[$val1] == $selected)
	    $options .= '<option selected="selected" value="'.$users[$val1].'">'.$users[$val1] .'  '. $users[$val2].'</option>';
	 else	
       $options .= '<option value="'.$users[$val1].'">'.$users[$val1] .'  '. $users[$val2].'</option>';
	} 
	return $options;
  }   
  
function get_all_case_records(){
	global $db,$config;
	$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	$admin_data = false;		
  if(in_array($user_id,$config['admin'])){
			 $query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) 
		LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) 
    LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE  ORDER BY tblmasterpoddata.ID desc LIMIT $limit_interval,1";
	}  
	
	  $records = $db->fetch_all_array($query);
	  return $records;
	  
	  
	

   }
   
  function get_user_saved_records($limit  = 1){
    global $db,$config;
	$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	if($user_id != ''){
	$limit_interval = $limit - 1;
	
	$admin_data = false;		
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'current_user'){ 
		$admin_data = true;	
	}
	if(in_array($user_id,$config['admin']) && !$admin_data){
		$query = "SELECT * FROM tblmasterpoddata WHERE Firstname != '' AND LastName != ''  ORDER BY ID desc LIMIT $limit_interval,1";
	}else{
			  $query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) 
		LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) 
    LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_id."' ORDER BY tblmasterpoddata.ID desc LIMIT $limit_interval,1";
     }

	  $records = $db->query_first($query);
	  return $records;
	}
  }
  
  function pagination($current_page = 1){
  
    global $db,$config;
	$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	$cond = $key = '';
	$searchform ='';
	$query_string = '';
	$pagination = '';
	
	if(isset($_REQUEST['search_String'])){
	    $key = $_REQUEST['search_String'];
		$query_string = '&search_String='.$key.'&search=search';
	}		
	if($user_name != ''){
	   if(in_array($user_id,$config['admin'])){
	    if($key != ''){
			$cond = "  (LastName LIKE '%".$key."%' OR Firstname LIKE '%".$key."%' OR URN LIKE '%".$key."%'  OR PostCode LIKE '%".$key."%' OR DoB LIKE '%".$key."%') AND";
		}
	    $query = "SELECT COUNT(*) as count_item FROM tblmasterpoddata WHERE ".$cond." Firstname != '' AND LastName != ''"; 			
	   }else{
	     if($key != '')
			$cond = " AND (LastName LIKE '%".$key."%' OR Firstname LIKE '%".$key."%' OR URN LIKE '%".$key."%'  OR PostCode LIKE '%".$key."%' OR DoB LIKE '%".$key."%')";			
	    $query = "SELECT COUNT(*) as count_item FROM tblmasterpoddata WHERE UserName = '".$user_name."'".$cond; 		
		}
		$records = $db->query_first($query);
		$total_pages = $records['count_item'];
		
		$content = '<div class="bottom_container">';
		if($total_pages > 1){
		  $pagination = '<div class="dataTables_paginate paging_bootstrap pagination"> <ul>';
		if($current_page != 1 )	  
		  $pagination .='<li class="prev"><a href="dashboard.php?item='.($current_page).$query_string.'">← Previous</a></li>';
		
			
		$pagination .='<li class="active"><a href="dashboard.php?item='.($current_page + 1).$query_string.'">'.($current_page).'</a></li>';
		if(($current_page + 1)  <= $total_pages) 	
			$pagination .=	'<li><a href="dashboard.php?item='.($current_page + 1).$query_string.'">'.($current_page + 1).'</a></li>';
		
		if( ($current_page + 2) <= $total_pages )	
			$pagination .=	'<li><a href="dashboard.php?item='.($current_page + 2).$query_string.'">'.($current_page + 2).'</a></li>';
		
		if($current_page != $total_pages)  
			$pagination .= '<li class="next"><a href="dashboard.php?item='.($current_page + 1).$query_string.'">Next → </a></li>';
		  
			  
		  $pagination .= '</ul> </div> 
		  
		  <div class="gotosection">		  
		  <span class="gotoform"> <span class="mylab">Goto : </span><span class="toper"><form action="" method="GET"><input size="10" style="width:100px; padding:5px;" type="number" id="mygo" name="item" min="1" max="'.$total_pages.'" value="'.$current_page.'" /> <span class="total"> of '. $total_pages.'</span> <input type="submit" name="go" value="Go" id="goto" /></form></span></div>';
		  
		  
		  $searchform = '<div class="Search_container">'.search_elements().'</div>';
		}
	} 
	
	if(!isset($_REQUEST['show_record'])){		    
	  $content .= $pagination.$searchform;
	}else{
	   $content .= $searchform;
	}
	
	echo $content.'&nbsp;</div>';
  }  
   function get_user_saved_one_records($record = 0){
    global $db,$config;	
	$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	if($user_name != '' && $record != 0){
		if(in_array($user_id,$config['admin']))
		   $query = "SELECT * FROM tblmasterpoddata WHERE ID = ".$record;
		else
		   $query = "SELECT * FROM tblmasterpoddata WHERE user_id = '".$user_id."' AND ID = ".$record;
		

		$records = $db->query_first($query);
		
		return $records;
	}
  }  
  function search_Action($key = '',$limit_interval ){   
   global $db,$config;	 
   $limit = $limit_interval - 1;   
   $user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';	   
   $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';	   
   if($user_name != ''){
	 if(in_array($user_id,$config['admin']))
	   $query = "SELECT * FROM tblmasterpoddata WHERE (LastName LIKE '%".$key."%' OR Firstname LIKE '%".$key."%' OR URN LIKE '%".$key."%'  OR PostCode LIKE '%".$key."%' OR DoB LIKE '%".$key."%') LIMIT $limit,1";
	 else
		$query = "SELECT * FROM tblmasterpoddata WHERE (LastName LIKE '%".$key."%' OR Firstname LIKE '%".$key."%' OR URN LIKE '%".$key."%'  OR PostCode LIKE '%".$key."%' OR DoB LIKE '%".$key."%') AND UserName = '".$user_name."'  LIMIT $limit,1";	
		
		return $results = $db->query_first($query);
	   }
  }
  function search_elements(){
    
    $content = '';
	$content .= '<form name="serarch_form" method="GET" action="">
				<div class="search">
				    <div data-rel="tooltip" title="Separation Date" class="input-prepend">
						<label class="control-label" for="typeahead">Search:</label><span>
						<input type="text" name="search_String" value=""> <input type="submit" name="search" value="search" /></span>
								</div>           
							</div>';
	$content .= '</form>';
	return $content;
  } 
  
  
  
  function display_values($table = '',$val1 = '',$val2 = '',$selected = ''){
	global $db;  
	$table_name = $table;
	$query ='SELECT '.$val2.' FROM '.$table_name." WHERE ".$val1." = ".$selected; 
	$mem_info = $db->query_first($query);
	return $mem_info[$val2];
  }   
  
 function get_user_records($user_name = '',$type = ''){
  global $db,$config;
  if($user_name == 'all'){

	    $query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 WHERE  tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' 
		ORDER BY tblmasterpoddata.ID desc";
		return $db->fetch_all_array($query);
  
	}elseif($user_name != ''){
			
	  switch($type){
		case 'incomplete':	 
	 	 	$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_name."' AND tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' AND (tblmasterpoddata.PDx = '' OR tblmasterpoddata.EstDischargeTime = 0) ORDER BY tblmasterpoddata.ID desc";
			break;
	    case 'non':	 	
			$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_name."' AND tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' AND tblmasterpoddata.Validated = 0 ORDER BY tblmasterpoddata.ID desc";
			break;
		 case 'valid':	 	
			$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_name."' AND tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' AND tblmasterpoddata.Validated = 1 ORDER BY tblmasterpoddata.ID desc";
			break;
	   case 'empty':	 	
			$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_name."' AND tblmasterpoddata.LastName = '' AND tblmasterpoddata.Firstname = '' AND tblmasterpoddata.Validated = 0 ORDER BY tblmasterpoddata.ID desc";
			break;
		 default:  		
			$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_name."' AND tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' ORDER BY tblmasterpoddata.ID desc";
		break;
		
	  }
	  
	  
		return $db->fetch_all_array($query);
	}
 }
 
 
 function delete_user_record($user_id,$record_id){	 
	 global $db,$config;
	 if($user_id != '' && $record_id != ''){  
	   $query_record = "Select user_id FROM  tblmasterpoddata WHERE ID = " . $record_id;
	   $records_info =  $db->query_first($query_record);
	   $user = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	   $query = '';
	   
	      if(in_array($user,$config['admin']))		  
		    $query = "DELETE FROM tblmasterpoddata WHERE ID = ".$record_id;
		  elseif($user == $records_info['user_id'])
			$query = "DELETE FROM tblmasterpoddata WHERE ID = $record_id AND UserName = '".$user_name."'";
			
		  	if($query != ''){
			   $array_tabs = array('mktbcomorbidities','mktblproccodes_forrpt08','mktbsdxcodes','mktbcomplications','mktblpdxcodes','mktblproccodes');	
			   foreach($array_tabs as $tabs){
				 $query_in = "DELETE FROM ".$tabs." WHERE pod_id = ".$record_id;
				 $db->query($query_in);
			   }
			  $db->query($query);
		   }
	   
	 }
	 return true;
 }
 
 function get_count($attr = '',$user = ''){
	 global $db,$config;
	 switch($attr){
	  case 'incomplete':	 
	 	$sql = 'SELECT COUNT(ID) as total FROM tblmasterpoddata WHERE (PDx = "" OR EstDischargeTime = 0) AND  LastName != "" AND Firstname != "" AND user_id = '.$user;
		break;
	 case 'non':	 	
	    $sql = 'SELECT COUNT(ID) as total FROM tblmasterpoddata WHERE Validated = 0  AND LastName != "" AND Firstname != "" AND user_id = '.$user;
		break;
	 case 'valid':	 	
	    $sql = 'SELECT COUNT(ID) as total FROM tblmasterpoddata WHERE Validated = 1   AND LastName != "" AND Firstname != "" AND user_id = '.$user;
		break;	
	case 'empty':	 	
	     $sql = 'SELECT COUNT(ID) as total FROM tblmasterpoddata WHERE Validated = 0  AND LastName = "" AND Firstname = ""  AND user_id = '.$user;
	
	break;	
	 default:	 	
	    $sql = 'SELECT COUNT(ID) as total FROM tblmasterpoddata WHERE  LastName != "" AND Firstname != ""  AND  user_id = '.$user;
		break;	
	 }
	$total = $db->query_first($sql);
	return $total['total'];
 }

 function get_username($user_id=''){
	  global $db;
	  if(!empty($user_id)) :
	     $user_id= $user_id;
	   else:
	    $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	  endif;
	  
	  $query = 'SELECT txtUserName FROM tblusers WHERE user_id = '.$user_id;
	  $userinfo=$db->query_first($query);
	  return $userinfo["txtUserName"]; 
 }

 function exportusers_info(){
 global $db;
 $sql = 'SELECT * FROM tblusers  order by user_id asc;';
 $exportusers_info=$db->fetch_all_array($sql);
 return $exportusers_info;
 }

function get_masterdata($record_user_id,$limit = 1000,$offset = 0,$field) {
global $db;
$where_sql='';
if($record_user_id=='' && $field['start_surgerydate']!='' && $field['end_surgerydate']!=''){
	
	$start_surgerydate = str_replace('/', '-', $field['start_surgerydate']);
    $start_surgerydate=date('Y-m-d', strtotime($start_surgerydate));
	
	$end_surgerydate = str_replace('/', '-', $field['end_surgerydate']);
    $end_surgerydate=date('Y-m-d', strtotime($end_surgerydate));

	$where_sql=" tblmasterpoddata.SurgeryDate BETWEEN ('".$start_surgerydate."') AND ('".$end_surgerydate."') order by tblmasterpoddata.ID asc ";
}else{
	$where_sql=" tblmasterpoddata.user_id=".$record_user_id." order by tblmasterpoddata.ID asc LIMIT ".$offset.",".$limit;
}

$sql_first="
SELECT  tblmasterpoddata.ID,user_id,UserName,UserState,LastName,Firstname,
r_sex.Dsecription as Sex,DoB,PostCode,URN,	
r_facility.FacilityDescription  as FacilityCode,
r_surgeontype.SurgeonTypeDesc  as SurgeonType,
r_asacategory.ASADescription  as ASACategory,
EstDischargeTime,IF(ComorbiditiesYesNo=1,'Yes','No') as ComorbiditiesYesNo,
rc1.ComorbidityDesc as Comorbidity01,rc2.ComorbidityDesc as Comorbidity02,
rc3.ComorbidityDesc as Comorbidity03,rc4.ComorbidityDesc as Comorbidity04,
rc5.ComorbidityDesc as Comorbidity05,rc6.ComorbidityDesc as Comorbidity06,
rc7.ComorbidityDesc as Comorbidity07,rc8.ComorbidityDesc as Comorbidity08,
rc9.ComorbidityDesc as Comorbidity09,rc10.ComorbidityDesc as Comorbidity10,
pdx.DiagnosisDesc as PDx,
sd1.ICD_Diag_Code as  SDx01,sd2.ICD_Diag_Code as  SDx02,
sd3.ICD_Diag_Code as  SDx03,sd4.ICD_Diag_Code as  SDx04,
sd5.ICD_Diag_Code as  SDx05,sd6.ICD_Diag_Code as  SDx06,
sd7.ICD_Diag_Code as  SDx07,sd8.ICD_Diag_Code as  SDx08,
sd9.ICD_Diag_Code as  SDx09,sd10.ICD_Diag_Code as  SDx10,

sd11.ICD_Diag_Code as  SDx11,sd12.ICD_Diag_Code as  SDx12,
sd13.ICD_Diag_Code as  SDx13,sd14.ICD_Diag_Code as  SDx14,
sd15.ICD_Diag_Code as  SDx15,sd16.ICD_Diag_Code as  SDx16,
sd17.ICD_Diag_Code as  SDx17,sd18.ICD_Diag_Code as  SDx18,
sd19.ICD_Diag_Code as  SDx19,sd20.ICD_Diag_Code as  SDx20,

sd21.ICD_Diag_Code as  SDx21,sd22.ICD_Diag_Code as  SDx22,
sd23.ICD_Diag_Code as  SDx23,sd24.ICD_Diag_Code as  SDx24,
sd25.ICD_Diag_Code as  SDx25,sd26.ICD_Diag_Code as  SDx26,
sd27.ICD_Diag_Code as  SDx27,sd28.ICD_Diag_Code as  SDx28,
sd29.ICD_Diag_Code as  SDx29,sd30.ICD_Diag_Code as  SDx30


   FROM tblmasterpoddata 

LEFT JOIN r_sex ON r_sex.SexCode=tblmasterpoddata.Sex 
LEFT JOIN  r_facility ON r_facility.FacilityCode=tblmasterpoddata.FacilityCode
LEFT JOIN  r_surgeontype ON r_surgeontype.SurgeonTypeCode=tblmasterpoddata.SurgeonType
LEFT JOIN  r_asacategory ON r_asacategory.ASACategory=tblmasterpoddata.ASACategory
LEFT JOIN  r_comorbidity rc1 ON rc1.ComorbidityCode=tblmasterpoddata.Comorbidity01
LEFT JOIN  r_comorbidity rc2 ON rc2.ComorbidityCode=tblmasterpoddata.Comorbidity02
LEFT JOIN  r_comorbidity rc3 ON rc3.ComorbidityCode=tblmasterpoddata.Comorbidity03
LEFT JOIN  r_comorbidity rc4 ON rc4.ComorbidityCode=tblmasterpoddata.Comorbidity04
LEFT JOIN  r_comorbidity rc5 ON rc5.ComorbidityCode=tblmasterpoddata.Comorbidity05
LEFT JOIN  r_comorbidity rc6 ON rc6.ComorbidityCode=tblmasterpoddata.Comorbidity06
LEFT JOIN  r_comorbidity rc7 ON rc7.ComorbidityCode=tblmasterpoddata.Comorbidity07
LEFT JOIN  r_comorbidity rc8 ON rc8.ComorbidityCode=tblmasterpoddata.Comorbidity08
LEFT JOIN  r_comorbidity rc9 ON rc9.ComorbidityCode=tblmasterpoddata.Comorbidity09
LEFT JOIN  r_comorbidity rc10 ON rc10.ComorbidityCode=tblmasterpoddata.Comorbidity10
LEFT JOIN  r_icd10am_diagnosis_codes pdx ON pdx.ICD_Diag_Code=tblmasterpoddata.PDx
LEFT JOIN  r_icd10am_diagnosis_codes sd1 ON sd1.ICD_Diag_Code=tblmasterpoddata.SDx01
LEFT JOIN  r_icd10am_diagnosis_codes sd2 ON sd2.ICD_Diag_Code=tblmasterpoddata.SDx02
LEFT JOIN  r_icd10am_diagnosis_codes sd3 ON sd3.ICD_Diag_Code=tblmasterpoddata.SDx03
LEFT JOIN  r_icd10am_diagnosis_codes sd4 ON sd4.ICD_Diag_Code=tblmasterpoddata.SDx04
LEFT JOIN  r_icd10am_diagnosis_codes sd5 ON sd5.ICD_Diag_Code=tblmasterpoddata.SDx05
LEFT JOIN  r_icd10am_diagnosis_codes sd6 ON sd6.ICD_Diag_Code=tblmasterpoddata.SDx06
LEFT JOIN  r_icd10am_diagnosis_codes sd7 ON sd7.ICD_Diag_Code=tblmasterpoddata.SDx07
LEFT JOIN  r_icd10am_diagnosis_codes sd8 ON sd8.ICD_Diag_Code=tblmasterpoddata.SDx08
LEFT JOIN  r_icd10am_diagnosis_codes sd9 ON sd9.ICD_Diag_Code=tblmasterpoddata.SDx09
LEFT JOIN  r_icd10am_diagnosis_codes sd10 ON sd10.ICD_Diag_Code=tblmasterpoddata.SDx10
LEFT JOIN  r_icd10am_diagnosis_codes sd11 ON sd11.ICD_Diag_Code=tblmasterpoddata.SDx11
LEFT JOIN  r_icd10am_diagnosis_codes sd12 ON sd12.ICD_Diag_Code=tblmasterpoddata.SDx12
LEFT JOIN  r_icd10am_diagnosis_codes sd13 ON sd13.ICD_Diag_Code=tblmasterpoddata.SDx13
LEFT JOIN  r_icd10am_diagnosis_codes sd14 ON sd14.ICD_Diag_Code=tblmasterpoddata.SDx14
LEFT JOIN  r_icd10am_diagnosis_codes sd15 ON sd15.ICD_Diag_Code=tblmasterpoddata.SDx15
LEFT JOIN  r_icd10am_diagnosis_codes sd16 ON sd16.ICD_Diag_Code=tblmasterpoddata.SDx16
LEFT JOIN  r_icd10am_diagnosis_codes sd17 ON sd17.ICD_Diag_Code=tblmasterpoddata.SDx17
LEFT JOIN  r_icd10am_diagnosis_codes sd18 ON sd18.ICD_Diag_Code=tblmasterpoddata.SDx18
LEFT JOIN  r_icd10am_diagnosis_codes sd19 ON sd19.ICD_Diag_Code=tblmasterpoddata.SDx19
LEFT JOIN  r_icd10am_diagnosis_codes sd20 ON sd20.ICD_Diag_Code=tblmasterpoddata.SDx20
LEFT JOIN  r_icd10am_diagnosis_codes sd21 ON sd21.ICD_Diag_Code=tblmasterpoddata.SDx21
LEFT JOIN  r_icd10am_diagnosis_codes sd22 ON sd22.ICD_Diag_Code=tblmasterpoddata.SDx22
LEFT JOIN  r_icd10am_diagnosis_codes sd23 ON sd23.ICD_Diag_Code=tblmasterpoddata.SDx23
LEFT JOIN  r_icd10am_diagnosis_codes sd24 ON sd24.ICD_Diag_Code=tblmasterpoddata.SDx24
LEFT JOIN  r_icd10am_diagnosis_codes sd25 ON sd25.ICD_Diag_Code=tblmasterpoddata.SDx25
LEFT JOIN  r_icd10am_diagnosis_codes sd26 ON sd26.ICD_Diag_Code=tblmasterpoddata.SDx26
LEFT JOIN  r_icd10am_diagnosis_codes sd27 ON sd27.ICD_Diag_Code=tblmasterpoddata.SDx27
LEFT JOIN  r_icd10am_diagnosis_codes sd28 ON sd28.ICD_Diag_Code=tblmasterpoddata.SDx28
LEFT JOIN  r_icd10am_diagnosis_codes sd29 ON sd29.ICD_Diag_Code=tblmasterpoddata.SDx29
LEFT JOIN  r_icd10am_diagnosis_codes sd30 ON sd30.ICD_Diag_Code=tblmasterpoddata.SDx30 
where ".$where_sql;

$masterdata1=$db->fetch_all_arrayIndex($sql_first);

$sql_second = "SELECT tblmasterpoddata.ID,tblmasterpoddata.user_id, rc1.Complication_description as ComplicationCode1,rc2.Complication_description as ComplicationCode2,rc3.Complication_description as ComplicationCode3,rc4.Complication_description as ComplicationCode4,rc5.Complication_description as ComplicationCode5, 
p1.ICD_10 as Proc01,p2.ICD_10 as Proc02, p3.ICD_10 as Proc03,p4.ICD_10 as Proc04, p5.ICD_10 as Proc05,p6.ICD_10 as Proc06, p7.ICD_10 as Proc07,p8.ICD_10 as Proc08, p9.ICD_10 as Proc09,p10.ICD_10 as Proc10, p11.ICD_10 as Proc11,p12.ICD_10 as Proc12, p13.ICD_10 as Proc13,p14.ICD_10 as Proc14, p15.ICD_10 as Proc15,p16.ICD_10 as Proc16, p17.ICD_10 as Proc17,p18.ICD_10 as Proc18, p19.ICD_10 as Proc19,p20.ICD_10 as Proc20, p21.ICD_10 as Proc21,p22.ICD_10 as Proc22, p23.ICD_10 as Proc23,p24.ICD_10 as Proc24, p25.ICD_10 as Proc25,p26.ICD_10 as Proc26, p27.ICD_10 as Proc27, IF(Tourniquet1_Used=1,'Yes','No') as Tourniquet1_Used, t1.TrnqtOrderDescr as Tourniquet1_OrderOfApplic,Tourniquet1_TimeOfApplic,Tourniquet1_TimeOfRemoval,l1.Tourniquet_Location_Descr as Tourniquet1_Location, IF(Tourniquet2_Used=1,'Yes','No') as Tourniquet2_Used, t2.TrnqtOrderDescr as Tourniquet2_OrderOfApplic,Tourniquet2_TimeOfApplic,Tourniquet2_TimeOfRemoval,l2.Tourniquet_Location_Descr as Tourniquet2_Location, IF(Tourniquet3_Used=1,'Yes','No') as Tourniquet3_Used, t3.TrnqtOrderDescr as Tourniquet3_OrderOfApplic,Tourniquet3_TimeOfApplic,Tourniquet3_TimeOfRemoval,l3.Tourniquet_Location_Descr as Tourniquet3_Location, IF(Tourniquet4_Used=1,'Yes','No') as Tourniquet4_Used, t4.TrnqtOrderDescr as Tourniquet4_OrderOfApplic,Tourniquet4_TimeOfApplic,Tourniquet4_TimeOfRemoval,l4.Tourniquet_Location_Descr as Tourniquet4_Location, rt.IntraoperativeCodeDescr as IntraOpProphylaxis_Thrombo,ra.IntraoperativeCodeDescr as IntraOpProphylaxis_Antibiotic, rpt.PostOperativeCodeDescr as PostOpProphylaxis_Thrombo,rpt.PostOperativeCodeDescr as PostOpProphylaxis_Thrombo,rps.PreviousSurgeryCDescr as PrevSurgery,InitConsDate,AdmissionDate,SeparationDate, IF(DaySurgOutcome1_1_UnvntflDisch=1,'Uneventful Discharge','') as DaySurgOutcome1_1_UnvntflDisch, IF(DaySurgOutcome1_2_RetToOR=1,'Return to OR (during same admission)','') as DaySurgOutcome1_2_RetToOR, IF(DaySurgOutcome1_2_RetToOR_Time=1,'Return to OR (during same admission) Discharge','') as DaySurgOutcome1_2_RetToOR_Time, IF(DaySurgOutcome1_3_TransferOvernight=1,'Transfer Overnight','') as DaySurgOutcome1_3_TransferOvernight, IF(DaySurgOutcome1_4_TransferOtherFacility=1,'Transfer to Other Facility','') as DaySurgOutcome1_4_TransferOtherFacility, IF(DaySurgOutcome1_5_Cancel_FailArrive=1,'Cancellation - Failed to Arrive','') as DaySurgOutcome1_5_Cancel_FailArrive, IF(DaySurgOutcome1_6_CancelPreExistCond=1,'Cancellation -Pre-Existing Condition','') as DaySurgOutcome1_6_CancelPreExistCond, IF(DaySurgOutcome1_7_CancelAcuteMedCond=1,'Cancellation -Acute Medical Condition','') as DaySurgOutcome1_7_CancelAcuteMedCond, IF(DaySurgOutcome1_8_CancelAdminOrg=1,'Cancellation -Admin /Org','') as DaySurgOutcome1_8_CancelAdminOrg, IF(DaySurgOutcome1_9_UnplDelayDisch=1,'Unplanned Delay on Discharge','') as DaySurgOutcome1_9_UnplDelayDisch, r_inpatientoutcome.InpatientOutcomeDesc as InpatientOutcome,
r_contamination_degree.Contamination_Degree_Desc as ComplicationDegreeCode,BackslabCast, an1.AnaesthesiaType as AnaesthesiaType1,an2.AnaesthesiaType as AnaesthesiaType2,an3.AnaesthesiaType as AnaesthesiaType3, IF(IntraOp_2ndDose=1,'Yes','No') as IntraOp_2ndDose ,SurgeryDate,IF(Validated=1,'Yes','No') as Validated FROM tblmasterpoddata LEFT JOIN r_icd10am_procedure_codes p1 ON p1.ICD_10=tblmasterpoddata.Proc01 LEFT JOIN r_icd10am_procedure_codes p2 ON p2.ICD_10=tblmasterpoddata.Proc02 LEFT JOIN r_icd10am_procedure_codes p3 ON p3.ICD_10=tblmasterpoddata.Proc03 LEFT JOIN r_icd10am_procedure_codes p4 ON p4.ICD_10=tblmasterpoddata.Proc04 LEFT JOIN r_icd10am_procedure_codes p5 ON p5.ICD_10=tblmasterpoddata.Proc05 LEFT JOIN r_icd10am_procedure_codes p6 ON p6.ICD_10=tblmasterpoddata.Proc06 LEFT JOIN r_icd10am_procedure_codes p7 ON p7.ICD_10=tblmasterpoddata.Proc07 LEFT JOIN r_icd10am_procedure_codes p8 ON p8.ICD_10=tblmasterpoddata.Proc08 LEFT JOIN r_icd10am_procedure_codes p9 ON p9.ICD_10=tblmasterpoddata.Proc09 LEFT JOIN r_icd10am_procedure_codes p10 ON p10.ICD_10=tblmasterpoddata.Proc10 LEFT JOIN r_icd10am_procedure_codes p11 ON p11.ICD_10=tblmasterpoddata.Proc11 LEFT JOIN r_icd10am_procedure_codes p12 ON p12.ICD_10=tblmasterpoddata.Proc12 LEFT JOIN r_icd10am_procedure_codes p13 ON p13.ICD_10=tblmasterpoddata.Proc13 LEFT JOIN r_icd10am_procedure_codes p14 ON p14.ICD_10=tblmasterpoddata.Proc14 LEFT JOIN r_icd10am_procedure_codes p15 ON p15.ICD_10=tblmasterpoddata.Proc15 LEFT JOIN r_icd10am_procedure_codes p16 ON p16.ICD_10=tblmasterpoddata.Proc16 LEFT JOIN r_icd10am_procedure_codes p17 ON p17.ICD_10=tblmasterpoddata.Proc17 LEFT JOIN r_icd10am_procedure_codes p18 ON p18.ICD_10=tblmasterpoddata.Proc18 LEFT JOIN r_icd10am_procedure_codes p19 ON p19.ICD_10=tblmasterpoddata.Proc19 LEFT JOIN r_icd10am_procedure_codes p20 ON p20.ICD_10=tblmasterpoddata.Proc20 LEFT JOIN r_icd10am_procedure_codes p21 ON p21.ICD_10=tblmasterpoddata.Proc21 LEFT JOIN r_icd10am_procedure_codes p22 ON p22.ICD_10=tblmasterpoddata.Proc22 LEFT JOIN r_icd10am_procedure_codes p23 ON p23.ICD_10=tblmasterpoddata.Proc23 LEFT JOIN r_icd10am_procedure_codes p24 ON p24.ICD_10=tblmasterpoddata.Proc24 LEFT JOIN r_icd10am_procedure_codes p25 ON p25.ICD_10=tblmasterpoddata.Proc25 LEFT JOIN r_icd10am_procedure_codes p26 ON p26.ICD_10=tblmasterpoddata.Proc26 LEFT JOIN r_icd10am_procedure_codes p27 ON p27.ICD_10=tblmasterpoddata.Proc27 LEFT JOIN r_tourniquet_order_of_applic t1 ON t1.TrnqtOrderCode=tblmasterpoddata.Tourniquet1_OrderOfApplic LEFT JOIN r_tourniquet_location l1 ON l1.Tourniquet_Location_Code=tblmasterpoddata.Tourniquet1_Location LEFT JOIN r_tourniquet_order_of_applic t2 ON t2.TrnqtOrderCode=tblmasterpoddata.Tourniquet2_OrderOfApplic LEFT JOIN r_tourniquet_location l2 ON l2.Tourniquet_Location_Code=tblmasterpoddata.Tourniquet2_Location LEFT JOIN r_tourniquet_order_of_applic t3 ON t1.TrnqtOrderCode=tblmasterpoddata.Tourniquet3_OrderOfApplic LEFT JOIN r_tourniquet_location l3 ON l3.Tourniquet_Location_Code=tblmasterpoddata.Tourniquet3_Location LEFT JOIN r_tourniquet_order_of_applic t4 ON t4.TrnqtOrderCode=tblmasterpoddata.Tourniquet4_OrderOfApplic LEFT JOIN r_tourniquet_location l4 ON l4.Tourniquet_Location_Code=tblmasterpoddata.Tourniquet4_Location LEFT JOIN r_prophylaxis_intraop_thrombo rt ON rt.IntraoperativeCode=tblmasterpoddata.IntraOpProphylaxis_Thrombo LEFT JOIN r_prophylaxis_intraop_thrombo ra ON ra.IntraoperativeCode=tblmasterpoddata.IntraOpProphylaxis_Antibiotic LEFT JOIN r_prophylaxis_postop_thrombo rpt ON rpt.PostOperativeCode=tblmasterpoddata.PostOpProphylaxis_Thrombo LEFT JOIN r_prophylaxis_postop_antibiotic rpa ON rpa.PostOperativeCode=tblmasterpoddata.PostOpProphylaxis_Antibiotic LEFT JOIN r_previous_surgery rps ON rps.PreviousSurgeryCode=tblmasterpoddata.PrevSurgery LEFT JOIN r_inpatientoutcome ON r_inpatientoutcome.InpatientOutcomeCode=tblmasterpoddata.InpatientOutcome 
LEFT JOIN   r_complications rc1 ON 
cast(rc1.Complication_code as decimal(4,2))=cast(tblmasterpoddata.ComplicationCode1  as decimal(4,2)) LEFT JOIN  r_complications rc2 ON 
cast(rc2.Complication_code as decimal(4,2))=cast(tblmasterpoddata.ComplicationCode2  as decimal(4,2)) LEFT JOIN  r_complications rc3 ON 
cast(rc3.Complication_code as decimal(4,2))=cast(tblmasterpoddata.ComplicationCode3  as decimal(4,2)) LEFT JOIN  r_complications rc4 ON 
cast(rc4.Complication_code as decimal(4,2))=cast(tblmasterpoddata.ComplicationCode4  as decimal(4,2)) LEFT JOIN  r_complications rc5 ON 
cast(rc5.Complication_code as decimal(4,2))=cast(tblmasterpoddata.ComplicationCode5  as decimal(4,2)) LEFT JOIN  
r_contamination_degree ON r_contamination_degree.Contamination_Degree_Code=tblmasterpoddata.ComplicationDegreeCode LEFT JOIN r_anaesthesiatype an1 ON an1.AnaesthesiaCode=tblmasterpoddata.AnaesthesiaType1 LEFT JOIN r_anaesthesiatype an2 ON an2.AnaesthesiaCode=tblmasterpoddata.AnaesthesiaType2 LEFT JOIN r_anaesthesiatype an3 ON an3.AnaesthesiaCode=tblmasterpoddata.AnaesthesiaType3 where ".$where_sql;

$masterdata2=$db->fetch_all_arrayIndex($sql_second);

/*$table_count1 = count($masterdata1);

$table_count2 = count($masterdata2)-1;

 for($t1=0;$t1<$table_count1;$t1++) {

    $master_data2=$masterdata2[$t1];

    foreach($master_data2 as $key=>$val) {

      $masterdata1[$t1][$key]=$val;

    }

    $table_count2++;

 }*/
foreach($masterdata1 as $key_1=>$val_1):
		  $masterdata1[$key_1] = array_merge($masterdata1[$key_1],$masterdata2[$key_1]);
endforeach;
return $masterdata1;
}
function paginationreport($query,$per_page=10,$page=1,$url='?'){   
    global $conDB; 
    $query = "SELECT COUNT(*) as `num` FROM {$query}";
    $row = mysqli_fetch_array(mysqli_query($conDB,$query));
    $total = $row['num'];
    $adjacents = "2"; 
      
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
      
    $prev = $page - 1;                          
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination'>";
        $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
              
            if ($page > 1) $pagination.= "<li><a href='{$url}page={$prev}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='{$url}page={$lpm1}'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='{$url}page={$lastpage}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
                $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='{$url}page={$counter}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<li><a href='{$url}page={$next}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
      
    return $pagination;
}