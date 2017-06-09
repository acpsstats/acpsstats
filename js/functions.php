<?php
    include_once('config.php');
	include_once('pagination.php');
	error_reporting(E_ALL);	
	if(isset($_REQUEST['chekuser'])){
	    include_once('config.php');
		$user_name = $_REQUEST['username'];
		echo check_user_exsist($user_name);
		exit;
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
	   if($user_name != ''){
	      if(in_array($user_id,$config['admin']))		  
		    $query = "DELETE FROM tblmasterpoddata WHERE ID = ".$record_id;
		  else
			$query = "DELETE FROM tblmasterpoddata WHERE ID = $record_id AND UserName = '".$user_name."'";
			
		  $db->query($query);
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
				 $data['update_record'] = $_REQUEST['id']; 
				 $update_id = update_pod_data($data);
				 $id = $_REQUEST['id'];

			}elseif($_REQUEST['action'] == 'insert'){
				$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
				$data['user_id'] = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
				$data['UserName'] = $user_name; 
				$data['UserState'] = (isset($_SESSION['UserState'])) ? $_SESSION['UserState'] : '';
				$id = $db->query_insert('tblmasterpoddata',$data);
			}		
	}
	
	
	function update_pod_data($data){
	   global $db,$config;
	   $user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	   $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	   unset($data['submit']);
	   if($user_name != ''){
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
				$where = "ID = ".$record_id." AND UserName = '".$user_name."'"; 
				
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
						$qry = "select ID from mktbcomorbidities WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_comorbidities = array('Validated' => $data['Validated'],
											 'Comorbidity' => $data[$var],
											 'order_index'	=> $i,
											 'SurgeryDate' => $data['SurgeryDate']
											 );
											 
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktbcomorbidities',$upadate_comorbidities,$where);
						}else{
							$mktbcomorbidities  = array( 'Validated' => $data['Validated'],
													 'UserName' => $user_name,
													 'UserState' => $userstate,
													 'pod_id' => $record_id,
													 'user_id' => $user_id,
													 'Comorbidity' => $data[$var],
													 'order_index'	=> $i,
													 'SurgeryDate' => $data['SurgeryDate']);
							
							$add_new = $db->query_insert('mktbcomorbidities',$mktbcomorbidities);
						}							
					}elseif($data[$var] == '' || $data[$var] == 0 ){
						$qry = "select ID from mktbcomorbidities WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
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
						$qry = "select ID from mktblproccodes_forrpt08 WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_forrpt08 = array('Validated' => $data['Validated'],
											 'Proc' => $data[$var],
											 'order_index'	=> $i,
											 'SurgeryDate' => $data['SurgeryDate']
											 );
											 
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktblproccodes_forrpt08',$upadate_forrpt08,$where);
						}else{
							$mktblproccodes_forrpt08  = array( 'Validated' => $data['Validated'],
													 'UserName' => $user_name,
													 'UserState' => $userstate,
													 'pod_id' => $record_id,
													 'user_id' => $user_id,
													 'Proc' => $data[$var],
													 'order_index'	=> $i,
													 'SurgeryDate' => $data['SurgeryDate']);
													
							
							$add_new = $db->query_insert('mktblproccodes_forrpt08',$mktblproccodes_forrpt08);
						}							
					}else{
						$qry = "select ID from mktblproccodes_forrpt08 WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
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
						$qry = "select ID from mktbsdxcodes WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_mktbsdxcodes = array('Validated' => $data['Validated'],
											 'Comorbidity' => $data[$var],
											 'order_index'	=> $i,
											 'SurgeryDate' => $data['SurgeryDate']
											 );
											 
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktbsdxcodes',$upadate_mktbsdxcodes,$where);
						}else{
							$mktbsdxcodes  = array( 'Validated' => $data['Validated'],
													 'UserName' => $user_name,
													 'UserState' => $userstate,
													 'pod_id' => $record_id,
													 'user_id' => $user_id,
													 'Diags' => $data[$var],
													 'order_index'	=> $i,
													 'SurgeryDate' => $data['SurgeryDate']);
													
							
							$add_new = $db->query_insert('mktbsdxcodes',$mktbsdxcodes);
						}							
					}else{
						$qry = "select ID from mktbsdxcodes WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
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
						$qry = "select ID from mktbcomplications WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_ComplicationCode = array('Validated' => $data['Validated'],
											 'Complication' => $data[$var],
											 'order_index'	=> $i,
											 'SurgeryDate' => $data['SurgeryDate']
											 );
											 
							
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktbcomplications',$upadate_ComplicationCode,$where);
						}else{
							$ComplicationCode  = array( 'Validated' => $data['Validated'],
													 'UserName' => $user_name,
													 'UserState' => $userstate,
													 'pod_id' => $record_id,
													 'user_id' => $user_id,
													 'Complication' => $data[$var],
													 'order_index'	=> $i,
													 'SurgeryDate' => $data['SurgeryDate']);
												 
													
							
							$add_new = $db->query_insert('mktbcomplications',$ComplicationCode);
							
						}							
					}else{
						$qry = "select ID from mktbcomplications WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktbcomplications WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				} // ADDING ELEMENTS FOR ComplicationCode END HERE
				
				
				if(isset($data['PDx']) && $data['PDx'] != ''){	
						$qry = "select ID from mktblpdxcodes WHERE pod_id = ".$record_id." AND 	order_index = 1 AND UserName = '".$user_name."'";
						$data_db = $db->query_first($qry);
						if(isset($data_db['ID'])){
							$upadate_mktblpdxcodes = array('Validated' => $data['Validated'],
											 'Diags' => $data['PDx'],
											 'order_index'	=> 1,
											 'SurgeryDate' => $data['SurgeryDate']
											);
											 
							
							$where = "ID = ".$data_db['ID'];		
							$update = $db->query_update('mktblpdxcodes',$upadate_mktblpdxcodes,$where);
						}else{
							$mktblpdxcodes  = array( 'Validated' => $data['Validated'],
													 'UserName' => $user_name,
													 'UserState' => $userstate,
													 'pod_id' => $record_id,
													 'user_id' => $user_id,
													 'Diags' => $data['PDx'],
													 'order_index'	=> 1,
													 'SurgeryDate' => $data['SurgeryDate']);
													
							
							$add_new = $db->query_insert('mktblpdxcodes',$mktblpdxcodes);
							
						}							
					}else{
						$qry = "select ID from mktblpdxcodes WHERE pod_id = ".$record_id." AND 	order_index = ".$i." AND UserName = '".$user_name."'";
						$data_delete = $db->query_first($qry);
						if(isset($data_delete['ID'])){
							$query = "DELETE FROM mktblpdxcodes WHERE ID = ".$data_delete['ID'];
							$db->query($query);
						}
					}
				
				$qry = "select ID from mktblproccodes WHERE pod_id = ".$record_id." AND UserName = '".$user_name."'";
				$data_proccodes = $db->query_first($qry);
				if(isset($data_proccodes['ID'])){
					$mktblproccodes = array('Validated'=> $data['Validated'],																		
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
											'PrevSurgery' =>  $data['PrevSurgery']);
											
					$where = "ID = ".$data_proccodes['ID'];		
					$update = $db->query_update('mktblproccodes',$mktblproccodes,$where);
				
				
				}else{
					$data_mktblproccodes = array('pod_id' => $record_id,
										'Validated'=> $data['Validated'],
										'UserName' => $user_name,
										'UserState' => $userstate,
										'user_id' => $user_id,	
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
										'PrevSurgery' =>  $data['PrevSurgery']);
					$add_new = $db->query_insert('mktblproccodes',$data_mktblproccodes);
				} 						
			}
			return $update;
		}
	}
	function add_new_entry($data){
	  global $db,$config;
	  unset($data['submit']);
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
		   $data['UserName'] = $user_name;
		   $data['UserState'] =  (isset($_SESSION['UserState'])) ? $_SESSION['UserState'] : ''; 		   
		   $data['user_id'] = $user_id;
		   unset($data['add_new_record']);	
		   
		   $add_new = $db->query_insert('tblmasterpoddata',$data);
		   return $add_new;
		}
	}
	
	
	
	function extract_user_by_email($data){
		global $db,$config;
		$login_qry = "select * from tblusers where txtUserName = '".$data['username']."' AND user_email = '".$data['user_email']."'";
		$loggedin_user = $db->query_first($login_qry);
		return $loggedin_user;
	}
	
	function forget_password_authenticate($data = null){
		global $db,$config;		
		$password = array('txtPassword' => $data['txtPassword']);
		return $db->query_update("tblusers",$password,"user_id  = ".$data['user_id']);
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
				  return $db->query_update("tblusers",$data,"user_id  = ".$id);
			}	
		}
	}
	function login_authenticate($user_info){
		global $db,$config;
		$login_qry = "select * from tblusers where txtUserName = '".mysql_real_escape_string($user_info['username'])."' and txtPassword = '".mysql_real_escape_string($user_info['password'])."' ";
		$loggedin_user = $db->query_first($login_qry);
		if($loggedin_user['is_active']==0) { return 'inactive';
		} else { 
		if(!empty($loggedin_user)){
			store_session($loggedin_user);
			return 1;
		}
		}
		return 0;
	}
	
	
	
	function store_session($session_var){
		foreach($session_var as $sess_key => $sess_values){
			$_SESSION[$sess_key] = $sess_values;
			$_SESSION['redirect_url'] = 'dashboard.php';
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
	
	
	
  
  function display_users(){
	 global $db;  
	$table_name = 'tblusers';
	$query ='SELECT txtUserName as username,user_id FROM '.$table_name;  
	$mem_info = $db->fetch_all_array($query);
	$options = '';
	foreach($mem_info as $users){
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
    echo $query;
	
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
  function get_user_saved_records($limit  = 1){
    global $db,$config;
	$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
	if($user_name != ''){
	 $limit_interval = $limit - 1;
	
	
	// echo in_array($user_id,$config['admin'],true)."asdasdasdasdasd";
	 
		if(in_array($user_id,$config['admin'])){
			$query = "SELECT * FROM tblmasterpoddata WHERE Firstname != '' AND LastName != ''  ORDER BY LastName,Firstname";
		}else{
			 $query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.UserName = '".$user_name."' ORDER BY tblmasterpoddata.LastName, tblmasterpoddata.Firstname LIMIT $limit_interval,1";
     }
	 
	/*if(in_array($user_id,$config['admin'])
	 	echo $query;
		*/
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
		   $query = "SELECT * FROM tblmasterpoddata WHERE UserName = '".$user_name."' AND ID = ".$record;
		
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
  
 function get_user_records($user_name = ''){
  global $db,$config;
  if($user_name == 'all'){
	$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 WHERE  tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' 
		ORDER BY tblmasterpoddata.LastName, tblmasterpoddata.Firstname";
		return $db->fetch_all_array($query);
  
	}elseif($user_name != ''){
	$query = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
		FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE tblmasterpoddata.user_id = '".$user_name."' AND tblmasterpoddata.LastName != '' AND tblmasterpoddata.Firstname != '' ORDER BY tblmasterpoddata.LastName, tblmasterpoddata.Firstname";
		return $db->fetch_all_array($query);
	}
 }