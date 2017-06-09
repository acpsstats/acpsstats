<?php include('header.php'); ?>
<?php 

//if($_SESSION['type'] !="Admin") header("location:index.php");
//$member_array = get_member_list();
/* $error = $success =  '';
 if(isset($_POST['update_record']) && $_POST['update_record'] != ''){
    if(update_pod_data($_POST)) 
	  $success = 'Record updated Successfully';	
	else
      $error = "There is some error with you request plesae try again";
  }*/
?>
<link type="text/css" rel="stylesheet" href="css/responsive-tabs.css" />
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="javascript:void(0)">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="javascript:void(0)">Users</a>
					</li>
				</ul>
			</div>
				
				<?php 
				 $limit = isset($_REQUEST['item']) ? $_REQUEST['item'] : 1;
				 $show_record = isset($_REQUEST['show_record']) ? ($_REQUEST['show_record']) : '';
				  
					if(isset($_REQUEST['search']) && isset($_REQUEST['search_String'])){
					
						$results = search_Action($_REQUEST['search_String'],$limit);
						
					}elseif(isset($_REQUEST['show_record'])){
					 
						$results = get_user_saved_one_records($show_record);						
				    }else{	
				    			
						$results = get_user_saved_records($limit);						
					 }
					 if(empty($results)) { 
					  $error = "Sorry! No Records Found";
					  echo '<div class="box span12 messager"><p class="error message inner">'.$error.  	  '</p></div>
					        <div class="box span12 messager"><p class="success message inner"><a href="add_record.php">Add a New Entry</a></p></div>';
					 }else{				
				
					 $id = isset($results['ID'])? $results['ID'] : '';
					 $LastName = isset($results['LastName'])? $results['LastName'] : '';
					 $Firstname = isset($results['Firstname'])? $results['Firstname'] : '';
					 $Sex = isset($results['Sex'])? $results['Sex'] : '';
					 $DoB = isset($results['DoB'])? $results['DoB'] : '';
					 $PostCode = isset($results['PostCode'])? $results['PostCode'] : '';				 
					 $InitConsDate = isset($results['InitConsDate'])? $results['InitConsDate'] : '';
					
					 $AdmissionDate = isset($results['AdmissionDate'])? $results['AdmissionDate'] : '';
					 $SeparationDate = isset($results['SeparationDate'])? $results['SeparationDate'] : '';
					 $SurgeryDate = isset($results['SurgeryDate'])? $results['SurgeryDate'] : ''; 

					 $URN = isset($results['URN'])? $results['URN'] : '';
					 $FacilityCode = isset($results['FacilityCode'])? $results['FacilityCode'] : '';
					 $SurgeonType = isset($results['SurgeonType'])? $results['SurgeonType'] : '';
					 $ASACategory = isset($results['ASACategory'])? $results['ASACategory'] : '';	             
					 $ComorbiditiesYesNo = isset($results['ComorbiditiesYesNo'])? $results['ComorbiditiesYesNo'] : '';
					 
					 $Validated = isset($results['Validated'])? $results['Validated'] : '';
					 $PDx = isset($results['PDx'])? $results['PDx'] : '';
					 $ComplicationDegreeCode = isset($results['ComplicationDegreeCode'])? $results['ComplicationDegreeCode'] : '';
					 $PrevSurgery = isset($results['PrevSurgery'])? $results['PrevSurgery'] : '';

					 
					 $default_date=strtotime('01/01/1970');
					 $AdmissionDate_cond=strtotime(date_format_type($AdmissionDate));
					 $SeparationDate_cond=strtotime(date_format_type($SeparationDate));
					 $SurgeryDate_cond=strtotime(date_format_type($SurgeryDate));
					 $DoB_cond=strtotime(date_format_type($DoB));
					 $InitConsDate_cond=strtotime(date_format_type($InitConsDate));
                     

                     $AdmissionDate_disp=($default_date == $AdmissionDate_cond ? '': date_format_type($AdmissionDate));
                     $SeparationDate_disp=($default_date == $SeparationDate_cond ? '': date_format_type($SeparationDate));
                     $SurgeryDate_disp=($default_date == $SurgeryDate_cond ? '': date_format_type($SurgeryDate));
                     $DoB_disp=($default_date == $DoB_cond ? '': date_format_type($DoB));
                     $InitConsDate_disp=($default_date == $InitConsDate_cond ? '': date_format_type($InitConsDate));
                    
                    
       			
       			?>

		       <?php if($success != ''){ ?>
                	<div class="box span12 messager"><p class="success message inner"><?php echo $success ?></p></div>
                <?php } ?>
                    
				<?php if($error != ''){
				     echo '<div class="box span12 messager"><p class="error message inner">'.$error.'</p></div>';
		        } ?>


				</div>
				<form class="entryfrm" id="Dataentryfrm" name="entryfrm" action="" method="post">	
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>ACPS SURGICAL AUDIT TOOL <?php if(isset($_SESSION['user_id']) && in_array($_SESSION['user_id'],$config['admin'])) echo "- Admin" ?></h2>
						<span class="newuserlink"><label class="newuser" for="newuser"></label></span>
					</div>
					
					<div class="record-validate-user">
					  <h2>DATA ENTRY</h2>
					  <span class="user">Username :</span>  <span class="val"><?php  echo get_username(); ?></span>
					  
					  <?php
					    $disabled = '';
					    if(!in_array($_SESSION['user_id'],$config['admin'])){
							$disabled = 'disabled="true"';	
						}
											
					    if($Validated == 1){
						   $validation = 'checked=checked';
						   $s_messgae = '<span style="color:green">Record Validated:</span>';
						 }else{
						   $validation = '';
						   $s_messgae = '<span style="color:red">Record NOT Validated:</span>';
						 }
					  ?>
					  <span class="record"><?php echo $s_messgae ?></span>  
					  <span class="feild"><input id="validate_record" type="checkbox" <?php echo $validation ?> <?php echo $disabled ?> value="1" name="Validated" /></span>
					</div>
					<div class="box-feildfull"  style="padding-top:10px;">
						<div class="input-prepend" title="ID" data-rel="tooltip">
								<label for="typeahead" class="control-label">ID:</label><span class="input-large span100" name="id" id="id"><?php echo $id ?></span>
						</div>
					</div>
					
					<div class="box-feild" >
						<div class="input-prepend" title="Last Name" data-rel="tooltip">
								<label for="typeahead" class="control-label">Last Name:</label><input class="input-large span100" name="LastName" required id="lastname" type="text" value="<?php echo $LastName ?>" />
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="URN" data-rel="tooltip">
								<label for="typeahead" class="control-label">URN:</label><input class="input-large span100" name="urn" id="URN" required type="text" value="<?php echo $URN ?>" />
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="First Name" data-rel="tooltip">
								<label for="typeahead" class="control-label">First Name:</label><input class="input-large span100" name="Firstname" required id="fname" type="text" value="<?php echo $Firstname ?>" />
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="Initial Cons Date" data-rel="tooltip">
								<label for="typeahead" class="control-label">Initial Cons Date:</label><span><input class="input-large span100 datepicker" placeholder="dd/mm/yyyy" name="InitConsDate" id="Initial_Cons_Date" type="text" value="<?php echo $InitConsDate_disp; ?>" required /></span>
						</div>           
					</div>
				 
					<div class="box-feild" >
						<div class="input-prepend" title="Sex" data-rel="tooltip">
								<label for="typeahead" class="control-label">Sex:</label>
								<span><select style="width:150px;" class="input-large span10 chosen-select" name="Sex" id="sex">
                                    <option></option>
									<?php echo display_sel('r_sex','SexCode','Dsecription',$Sex);?>
                                </select></span>
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="Facility Code" data-rel="tooltip">
								<label for="typeahead" class="control-label">Facility Code:</label >
								<span><select style="width:150px;" class="input-large span10 chosen-select" name="FacilityCode" id="FacilityCode">
                                    <option></option>
									<?php echo display_sel('r_facility','FacilityCode','FacilityDescription',$FacilityCode);  ?>
                                </select></span>
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="Dob" data-rel="tooltip">
								<label for="typeahead" class="control-label">Dob:</label ><span><input class="input-large span100 datepicker" required name="DoB" placeholder="dd/mm/yyyy" id="dob" type="text" value="<?php echo $DoB_disp; ?>" /></span>
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="Surgeon Type" data-rel="tooltip">
								<label for="typeahead" class="control-label">Surgeon Type:</label >
								<span class="surgen_left"><select class="input-large span10 chosen-select" name="SurgeonType" id="SurgeonType">
                                    <option></option>
									<?php echo display_sel('r_surgeontype','SurgeonTypeCode','SurgeonTypeDesc',$SurgeonType);  ?>
                                </select></span>
						</div>           
					</div>
					<div class="box-feild" >
						<div class="input-prepend" title="Post Code" data-rel="tooltip">
								<label for="typeahead" class="control-label">Post Code:</label ><input class="input-large span100" name="PostCode" required id="PostCode" type="text" value="<?php echo $PostCode ?>" />
						</div>           
					</div>
					
					<div style="clear:both"></div>
					
					<div class="dateVariation"> <!-- Date Sturucture -->
					
							<div class="box-feild" >
										<label for="typeahead" class="control-label">Admission Date:</label ><span>
											<input class="input-large span100 datepicker alos-date" name="AdmissionDate" required id="AdmissionDate" type="text"  placeholder="dd/mm/yyyy" value="<?php echo  $AdmissionDate_disp; ?>" /><span class="abs"></span></span>
								<div class="input-prepend" title="Admission Date" data-rel="tooltip">
								</div>           
							</div>

							<?php 
									
									$admission_check=0;
									$seperation_check=0;
									$d1=strtotime($AdmissionDate);
									$d2=strtotime($SurgeryDate);
									$d3=strtotime($SeparationDate);
									

									if(($d1==$d2) || ($d1<$d2)) { $admission_check='checked="checked"'; $admission_disable='';} else { $admission_check='';  $admission_disable=''; } 
									if(($d2==$d3) || ($d2<$d3)) { $seperation_check='checked="checked"'; $seperation_disable=''; } else { $seperation_check=''; $seperation_disable='';} 
									 $AdmissionDate_year=date('Y',$d1);
									 $year_status=true;


									 if($d1!='' && $d2!='' && $d3 !=''){
									 if($d1==$d2 && $d3==$d3){
                                       $yes='checked="checked"';
                                       $no='';
									 }else{
									 	$yes='';
                                        $no='checked="checked"';
									 }
									 $class='show';
									}else{
										$class='hide';
									}
									 
							?>
							  

							   <div class="box-feild ass-condition <?php echo  $class;?>" >
                                                <label for="typeahead" class="control-label" style='width:340px;'>Are the Admission/Surgery/Separation dates the same ? </label ><span>  
                                                 <input type="radio" value="1"   class="ass_cond" id="ass_yes" name="ass_cond" <?php echo $yes;?>/> Yes
                                                 <input  type="radio"  class="ass_cond" value="0"  id="ass_no" name="ass_cond" <?php echo $no;?> /> No </span>
                                        <div class="input-prepend" title="Admission Date" data-rel="tooltip" ></div>   
                                                
                              </div>

							<div class="box-feild" >
								


									 <?php
									
									if($AdmissionDate_year <= 1970)  { $year_status=false; $admission_check='';$seperation_check='';  $seperation_disable=''; $seperation_disable='';} 
									?>
								<div class="input-prepend" title="Surgery Date" data-rel="tooltip">
										<label for="typeahead" class="control-label">Surgery Date:</label ><span><input class="input-large span100 datepicker alos-date" admission-check='<?php echo  $admission_check;?>'   seperation-check='<?php echo  $seperation_check;?>'  placeholder="dd/mm/yyyy" name="SurgeryDate" id="SurgeryDate" type="text" value="<?php echo $SurgeryDate_disp; ?>" /></span>
									
								</div>           
							</div>

							   <div class="box-feild "  style='float:left;width:35%;'>
                                        <div class="input-prepend alos-check-box" title="Separation Date" data-rel="tooltip" style='display:block;'>
                                          
                                            <div class="surgery-box">
                                                <label for="typeahead" class="control-label" style='width:235px;'>Date of Admission-Surgery confirmed:</label>
                                                <input class="alos-check"   id="surgery-check" type="checkbox" value="0" <?php echo  $admission_check;?>   <?php echo  $admission_disable;?>/>
                                            </div>
                                          
                                        </div>           
                               </div>

							<div class="box-feild" >
								<div class="input-prepend" title="Separation Date" data-rel="tooltip">
										<label for="typeahead" class="control-label">Separation Date:</label ><span><input class="input-large span100 datepicker alos-date"  placeholder="dd/mm/yyyy" name="SeparationDate" id="SeparationDate" type="text" value="<?php echo $SeparationDate_disp; ?>" required /></span>
								</div>           
							</div>
					

							  <div class="box-feild "  style='float:left;width:35%;'>
                                        <div class="input-prepend alos-check-box" title="Separation Date" data-rel="tooltip" style='display:block;'>
                                            <div class="separation-box">
                                                <label for="typeahead" class="control-label" style='width:235px;'>Date of Surgery-Separation confirmed:</label>
                                                <input class="alos-check"   id="separation-check" type="checkbox" value="0"  <?php echo  $seperation_check;?> <?php echo  $seperation_disable;?> />
                                            </div>
                                        </div>           
                               </div>

					</div> <!-- Date Sturucture -->
					
					<div id="horizontalTab">
						<ul class="ul-tabs r-tabs-nav">
							<li class="r-tabs-tab r-tabs-state-default"><a href="#tab-1" class="r-tabs-anchor">1 COMORBIDITIES</a></li>
							<li class="r-tabs-tab r-tabs-state-default"><a href="#tab-2" class="r-tabs-anchor">2 DIAGNOSES</a></li>
							<li class="r-tabs-tab r-tabs-state-default"><a href="#tab-3" class="r-tabs-anchor">3 PROCEDURES</a></li>
							<li class="r-tabs-tab r-tabs-state-default"><a href="#tab-4" class="r-tabs-anchor">4 TOURNIQUET</a></li>
							<li class="r-tabs-tab r-tabs-state-default"><a href="#tab-5" class="r-tabs-anchor">5 OTHER</a></li>
							<li class="r-tabs-tab r-tabs-state-default"><a href="#tab-6" class="r-tabs-anchor">6 SURG OUTCOMES</a></li>
						</ul>
						<div id="tab-1" class="tabs_sections">
							<p>COMORBIDITIES
								<div class="input-prepend cmorbidities" id="input-prepend" title="COMORBIDITIES" data-rel="tooltip">
								
								<?php
								if($ComorbiditiesYesNo == 1){
										$n_commadaties = '';
										$commadaties = 'checked="checked"';
										$style_com = '';
								}else{
								   $n_commadaties = 'checked="checked"';
								   $commadaties = '';
								   $style_com = 'style="display:none"';
								}
								?>
									<span>
										<input type="radio" <?php echo $n_commadaties ?> class="cmorbidities-in" id="no_com" name="ComorbiditiesYesNo" value="0">No Comorbidities present<br>
										<input type="radio" class="cmorbidities-in" <?php echo $commadaties; ?> id="yes_com" name="ComorbiditiesYesNo" value="1">Comorbidities present
									</span>
								</div>
								
								<div class="commadites_select" <?php echo $style_com ?>> <!-- Commadaties SELECT ENDS HERE -->
									
								<?php 
								    $value = '';
									for($i = 1; $i<=10;$i++){
									$val = $i;
										if($i < 10)
										  $val = '0'.$i;
									$variable = 'Comorbidity'.$val;	  
									if(isset($results[$variable]))
										  $value = $results[$variable];
								?>	
									<div class="box-feild" >
										<div class="input-prepend" title="Comorbidity <?php echo $val ?>" data-rel="tooltip">
										<label class="control-label" for="typeahead">Comorbidity <?php echo $val ?>:</label>
										<span><select style="width:150px;" class="input-large span10 chosen-select cmorbiditiesselect" name="Comorbidity<?php echo $val ?>" id="Comorbidity<?php echo $i ?>" data-item="<?php echo $i ?>">
										<option></option>
										<?php  echo display_sel('r_comorbidity','ComorbidityCode','ComorbidityDesc',$value); ?>
										</select></span>
										</div> 
								   </div>
								<?php } ?>   
								   
								   
							</div> <!-- Commadaties SELECT ENDS HERE -->
						</div>
						<div id="tab-2" class="tabs_sections">
						   <h4 style="margin:30px 0px 15px;">ICD- 10-AM DIAGNOSIS CODES</h4>
								<div class="box-feild" >
									<div class="input-prepend" title="PRINCIPAL DIAGNOSIS" data-rel="tooltip">
									<label class="control-label" for="typeahead">PRINCIPAL DIAGNOSIS:</label>
                                     <?php $PDx_count=(!empty($PDx) ? '1' : '0' ); ?>
									<span><select attr-pdx='<?php echo  $PDx_count; ?>' style="width:150px;" class="input-large span10 chosen-pdx chosen-select" name="PDx" id="PDx" >
									<option></option>
									<?php echo display_sel('r_icd10am_diagnosis_codes','ICD_Diag_Code','DiagnosisDesc',$PDx); ?>
									</select></span>
								    </div> 
					           </div><br/>
							  <div class="secondary_diagnosis"> <!-- SECONDARY DIAGNOSES --> 
							   <h4 style="margin:30px 0px 15px;"> SECONDARY DIAGNOSES</h4>
							   <?php $value = '';
									for($i = 1; $i<=24;$i++){
									$val = $i;
										if($i < 10)
										  $val = '0'.$i;
									$variable = 'SDx'.$val;	  
									if(isset($results[$variable]))
										  $value = $results[$variable];
							   
							   
								?>
								<div class="box-feild3" >
									<div class="input-prepend" title="SD*<?php echo $val; ?>" data-rel="tooltip">
									<label class="control-label" for="typeahead">SD*<?php echo $val; ?>:</label>
									<span><select style="width:150px;" class="input-large span10 chosen-select sdx" name="SDx<?php echo $val; ?>" id="SD<?php echo $i; ?>" data-item="<?php echo $i ?>">
									<option></option>
									<?php echo display_sel('r_icd10am_diagnosis_codes','ICD_Diag_Code','DiagnosisDesc',$value); ?>
									</select></span>
								    </div> 
					           </div>
							   <?php } ?>
                                <?php $EstDischargeTime = isset($results['EstDischargeTime'])? $results['EstDischargeTime'] : ''; ?>
							<div class="bottom_section" style="float:left; width:50%; margin:20px 0 -50px 100px;"><span class="inst">Estimated Time To Discharge From Recovery:</span><span class="field"><input type="text" id="EstDischargeTime" name="EstDischargeTime" value="<?php echo $EstDischargeTime ?>" /></span><span class="about">(mins)</span></div>	
							   
							</div><!-- SECONDARY DIAGNOSES --> 
						</div>
						<div id="tab-3" class="tabs_sections">
						    <h4 style="margin-top:35px">ICD- 10-AM PROCEDURE CODES</h4>
							
							<p style="padding-top:0px; font-size:12px;"> (Proc 01 is the pricipal procedure)</p>
							<div class="proceduralsection">	
							<?php   
							        $value = '';
									for($i = 1; $i<=24;$i++){
									$val = $i;
										if($i < 10)
										  $val = '0'.$i;
									$variable = 'Proc'.$val;	  
									if(isset($results[$variable]))
										  $value = $results[$variable];
								 
								?>
								<div class="box-feild3" >
									<div class="input-prepend" data-rel="tooltip">
									<label class="control-label" for="typeahead">Proc <?php echo $val ?>:</label>
									<span><select style="width:150px;" class="input-large span10 chosen-select proc_select" name="Proc<?php echo $val ?>" id="Proc<?php echo $i ?>" data-item="<?php echo $i ?>">
									<option></option>
									<?php echo display_sel('r_icd10am_procedure_codes','ICD_10','Description',$value); ?>
									</select></span>
								    </div> 
					           </div>
							   <?php }?>
							</div>
						</div>
						
						<div id="tab-4" class="tabs_sections">
						 <div class="tourniquet">
						 <?php 
							$tar1 = array('2' => '', '3' => '','4'=> '','5' => '');
							for($i=1;$i<=4;$i++){
								$val1 = isset($results['Tourniquet'.$i.'_Used']) ? $results['Tourniquet'.$i.'_Used'] : '';
								$val2 = isset($results['Tourniquet'.$i.'_OrderOfApplic']) ? $results['Tourniquet'.$i.'_OrderOfApplic'] : '';
								$val3 = isset($results['Tourniquet'.$i.'_TimeOfApplic']) ? $results['Tourniquet'.$i.'_TimeOfApplic'] : '';
								$val4 = isset($results['Tourniquet'.$i.'_TimeOfRemoval']) ? $results['Tourniquet'.$i.'_TimeOfRemoval'] : '';
								$val5 = isset($results['Tourniquet'.$i.'_Location']) ? $results['Tourniquet'.$i.'_Location'] : '';
							    //array_val = array('Yes','No');
								$array_val = array(0=>'No',1=>'Yes');
								
								
								if($val3 != '')
									$tar1[$i+1] = 'active';
								
						 ?>
								 <div class="section-tourniquet item<?php echo $i ?>" id="hidden_<?php echo $i ?>" data-element="<?php echo $i ?>">   
                                     <?php  if($val3 == '' && $i > 1 && $tar1[$i] == '') { ?>
                                        <div class="hideme_from"></div>
                                     <?php	
									 } ?>
										<div class="box-feild" >
											<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">TOURNIQUET <?php echo $i ?> ?:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select Used" name="Tourniquet<?php echo $i ?>_Used" id="TOURNIQUET<?php echo $i ?>">
											<?php
											   foreach($array_val as $key=>$option){
												 if($val1 == $key)
												    echo '<option selected="selected" value="'.$key.'"">'.$key." ".$option.'</option>';
												 else	
												 	echo '<option value="'.$key.'">'.$key." ".$option.'</option>';
												}
												
											?>
											</select></span>
											</div> 
									   </div>
									   <div class="box-feild" >
											<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">Order of Application:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select OrderOfApplic" name="Tourniquet<?php echo $i ?>_OrderOfApplic" id="Order_App<?php echo $i ?>">
											<option></option>
											<?php echo display_sel('r_tourniquet_order_of_applic','TrnqtOrderCode','TrnqtOrderDescr',$val2); ?>
											</select></span>
											</div> 
									   </div>
									   <div class="box-feild" >
											<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">Time of Application:</label>
											<span><input type="text" value="<?php echo $val3 ?>" id="Time_App<?php echo $i ?>" name="Tourniquet<?php echo $i ?>_TimeOfApplic" class="input-large span100 TimeOfApplic">(hrsmin 24-hr Time)</span>
											</div> 
									   </div>
									   <div class="box-feild" >
											<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">Time of Removal:</label>
											<span><input type="text" value="<?php echo $val4 ?>" id="Time_rem<?php echo $i ?>" name="Tourniquet<?php echo $i ?>_TimeOfRemoval" class="input-large span100 TimeOfRemoval">(hrsmin 24-hr Time)</span>
											</div> 
									   </div>
										<div class="box-feild" >
											<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">Tourniquet Location:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select TourniquetLocation" name="Tourniquet<?php echo $i ?>_Location" id="Tourniquet_Location<?php echo $i ?>">
											<option></option>
											<?php echo display_sel('r_tourniquet_location','Tourniquet_Location_Code','Tourniquet_Location_Descr',$val5); ?>
											</select></span>
											</div> 
									   </div>
									</div>   
								<?php }; ?>	
							  
							</div> <!-- TOURNIQUET -->   
						</div>
						<div id="tab-5" class="tabs_sections">
								<div class="other2">	
									<div class="divhead">
									 <div>
									 <div class="prophylaxis">
									  <h4>PROPHYLAXIS</h4>
									  <?php
								$IntraOpProphylaxis_Thrombo = isset($results['IntraOpProphylaxis_Thrombo'])? $results['IntraOpProphylaxis_Thrombo'] : '';
								$IntraOpProphylaxis_Antibiotic = isset($results['IntraOpProphylaxis_Antibiotic'])? $results['IntraOpProphylaxis_Antibiotic'] : '';
								$PostOpProphylaxis_Thrombo = isset($results['PostOpProphylaxis_Thrombo'])? $results['PostOpProphylaxis_Thrombo'] : '';
								$PostOpProphylaxis_Antibiotic = isset($results['PostOpProphylaxis_Antibiotic'])? $results['PostOpProphylaxis_Antibiotic'] : '';
								$IntraOp_2ndDose = ($results['IntraOp_2ndDose']==1)? 'checked="checked"' :'';
								
									  ?>
									  
									    <div class="top1">
											<div class="abs_head">IntraOP Prophylaxis:</div>
											<div class="rightmap">
												<div class="box-feild2 new-boxf2" >
													<div class="input-prepend" data-rel="tooltip">
													<span>Thrombo</span>   <br/>
														<span><select style="width:150px;" class="input-large span10 chosen-select" name="IntraOpProphylaxis_Thrombo" id="Thrombo1">
														<option></option>
														<?php echo display_sel('r_prophylaxis_intraop_thrombo','IntraoperativeCode','IntraoperativeCodeDescr',$IntraOpProphylaxis_Thrombo); ?>
														</select>
														</span>
														
													</div> 
												</div>
												<div class="box-feild2" >
													<div class="input-prepend" data-rel="tooltip">
														 <span>Antibiotic</span>  <br />
														<span><select style="width:150px;" class="input-large span10 chosen-select" name="IntraOpProphylaxis_Antibiotic" id="Antibiotic1">
														<option></option>
														<?php echo display_sel('r_prophylaxis_intraop_antibiotic','IntraoperativeCode','IntraoperativeCodeDescr',$IntraOpProphylaxis_Antibiotic); ?>
														</select>
														</span>
													</div> 
												</div>
												<div class="box-feild2 check">
													<div data-rel="tooltip" class="input-prepend">
													 <span>Antibiotic 2nd Dose</span>
                                                    <div style="clear:both"></div>
													<input type="checkbox" value="1" id="IntraOp_2ndDose" <?php echo $IntraOp_2ndDose ?> name="IntraOp_2ndDose" class="input-large span100">
													</div>           
												</div>
										    </div>	
										 </div> 
										 <div class="top2">
											    <div class="abs_head">PostOP Prophylaxis:</div>
												<div class="rightmap">
												<div class="box-feild2 new-boxf3" >
													<div class="input-prepend" data-rel="tooltip">												
														<span><select style="width:150px;" class="input-large span10 chosen-select" name="PostOpProphylaxis_Thrombo" id="Thrombo2">
														<option></option>
														<?php echo display_sel('r_prophylaxis_postop_thrombo','PostOperativeCode','PostOperativeCodeDescr',$PostOpProphylaxis_Thrombo); ?>
														</select>
														</span>
														
													</div> 
												</div>
												<div class="box-feild2" >
													<div class="input-prepend" data-rel="tooltip">												    
														<span><select style="width:150px;" class="input-large span10 chosen-select" name="PostOpProphylaxis_Antibiotic" id="Antibiotic2">
														<option></option>
														<?php echo display_sel('r_prophylaxis_postop_antibiotic','PostOperativeCode','PostOperativeCodeDescr',$PostOpProphylaxis_Antibiotic); ?>
														</select>
														</span>
													</div> 
												</div>												
											  </div>	
											 </div> 
										</div><!-- prophylaxis -->
									  </div>
									</div>	
									
									<div class="divhead1 border">
									     <h4>ANAESTHESIA</h4>
										 <?php
										    $ASACategory = isset($results['ASACategory'])? $results['ASACategory'] : '';
											$AnaesthesiaType1 = isset($results['AnaesthesiaType1'])? $results['AnaesthesiaType1'] : '';
											$AnaesthesiaType2 = isset($results['AnaesthesiaType2'])? $results['AnaesthesiaType2'] : '';
											$AnaesthesiaType3 = isset($results['AnaesthesiaType3'])? $results['AnaesthesiaType3'] : '';
										 ?>
									     <div class="box-feild1" >
												<div class="input-prepend" data-rel="tooltip">
													<label class="control-label" for="typeahead">ASA Category:</label>
													<span><select style="width:150px;" class="input-large span10 chosen-select" name="ASACategory" id="ASACategory">
													<option></option>
													<?php echo display_sel('r_asacategory','ASACategory','ASADescription',$ASACategory); ?>
													</select>
													</span>
													
												</div> 
											</div>
											<div class="box-feild1" >
												<div class="input-prepend" data-rel="tooltip">
													<label class="control-label" for="typeahead">Anaesthesia Type:1</label>
													<span><select style="width:150px;" class="input-large span10 chosen-select anaesthesia" name="AnaesthesiaType1" id="Anaesthesia1" data-item="1">
													<option></option>
													<?php echo display_sel('r_anaesthesiatype','AnaesthesiaCode','AnaesthesiaType',$AnaesthesiaType1); ?>
													</select>
													</span>
													
												</div> 
											</div>
											<div class="box-feild1" >
												<div class="input-prepend" data-rel="tooltip">
													<label class="control-label" for="typeahead">2:</label>
													<span><select style="width:150px;" class="input-large span10 chosen-select anaesthesia" name="AnaesthesiaType2" id="Anaesthesia2" data-item="2">
													<option></option>
													<?php echo display_sel('r_anaesthesiatype','AnaesthesiaCode','AnaesthesiaType',$AnaesthesiaType2); ?>
													</select>
													</span>
													
												</div> 
											</div>
											<div class="box-feild1" >
												<div class="input-prepend" data-rel="tooltip">
													<label class="control-label" for="typeahead">3:</label>
													<span><select style="width:150px;" class="input-large span10 chosen-select anaesthesia" name="AnaesthesiaType3" id="Anaesthesia3" data-item="3">
													<option></option>
													<?php echo display_sel('r_anaesthesiatype','AnaesthesiaCode','AnaesthesiaType',$AnaesthesiaType3); ?>
													</select>
													</span>
													
												</div> 
											</div>
											
									</div>	
									</div>
								<div class="other1 border">
								
								<h4>COMPLICATION</h4>
									
									
									<?php 
									$value = '';
									$new_st = '';
									for($i = 1; $i<=5;$i++){
											$val = $i;
											$variable = 'ComplicationCode'.$val;
									
											if(isset($results[$variable]))
												 $value = $results[$variable];?>
                                            <div class="box-feild4" >
                                                <div class="input-prepend" data-rel="tooltip">
                                                    <label class="control-label" for="typeahead">Complication Code <?php echo $i ?>:</label>
                                                    <span><select style="width:150px;" class="input-large span10 chosen-select ComplicationCode" name="ComplicationCode<?php echo $i ?>" id="ComplicationCode<?php echo $i ?>" data-item="<?php echo $i ?>">
                                                    <option></option>
                                                    <?php echo display_sel('r_complications','Complication_code','Complication_description',$value); ?>
                                                    </select>
                                                    </span>
                                                </div> 
                                                
                                            </div>
										<?php  if($value >= 1.1 && $value <= 2.6){ $new_st = 'style="display:block"';}elseif($new_st != ''){$new_st = $new_st;	} ?>
									<?php } ?>
                                    
                                    <?php echo get_options_value('r_complications','Complication_code','Complication_description');	 ?>
									<div class="box-feild4 wound_contamination " <?php echo $new_st ?>>
										<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">Wound Contamination Degree:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select" name="ComplicationDegreeCode" id="ComplicationDegreeCode">
											<option></option>
											<?php echo display_sel('r_contamination_degree','Contamination_Degree_Code','Contamination_Degree_Desc',$ComplicationDegreeCode); ?>
											</select>
											</span>
											
										</div> 
									</div>
									
								</div>						
						</div>
						<div id="tab-6" class="tabs_sections">
						 <p>
						   <div class="other4">
						      <?php
							      $UnvntflDisch = (isset($results['DaySurgOutcome1_1_UnvntflDisch']) && $results['DaySurgOutcome1_1_UnvntflDisch'] == 1 )? 'checked="checked"': '';
								  $RetToOR = (isset($results['DaySurgOutcome1_2_RetToOR']) && $results['DaySurgOutcome1_2_RetToOR'] == 1 )? 'checked="checked"': '';
								  $TransferOvernight = (isset($results['DaySurgOutcome1_3_TransferOvernight']) && $results['DaySurgOutcome1_3_TransferOvernight'] == 1 )? 'checked="checked"': '';
								  $TransferOtherFacility = (isset($results['DaySurgOutcome1_4_TransferOtherFacility']) && $results['DaySurgOutcome1_4_TransferOtherFacility'] == 0 )? 'checked="checked"': '';
								  $FailArrive = (isset($results['DaySurgOutcome1_5_Cancel_FailArrive']) && $results['DaySurgOutcome1_5_Cancel_FailArrive'] == 1 )? 'checked="checked"': '';
								  $CancelPreExistCond = (isset($results['DaySurgOutcome1_6_CancelPreExistCond']) && $results['DaySurgOutcome1_6_CancelPreExistCond'] == 1 )? 'checked="checked"': '';
								  $CancelAcuteMedCond = (isset($results['DaySurgOutcome1_7_CancelAcuteMedCond']) && $results['DaySurgOutcome1_7_CancelAcuteMedCond'] == 1 )? 'checked="checked"': '';
								  $CancelAdminOrg = (isset($results['DaySurgOutcome1_8_CancelAdminOrg']) && $results['DaySurgOutcome1_8_CancelAdminOrg'] == 1 )? 'checked="checked"': '';
								  $UnplDelayDisch = (isset($results['DaySurgOutcome1_9_UnplDelayDisch']) && $results['DaySurgOutcome1_9_UnplDelayDisch'] == 1 )? 'checked="checked"': '';
								  
								  $InpatientOutcome = isset($results['InpatientOutcome'])? $results['InpatientOutcome'] : '';
								  
								  
								 $style1 = $style2 = $style3 = $style4 = $visibilty = $style4 = '';
								 if($UnvntflDisch == 'checked="checked"' ){
								    $style1 = 'style="display:none;"';
									$visibilty ='style="visibility:hidden;"';
								 }elseif($RetToOR == 'checked="checked"' ){
								    $style2 = 'style="display:none;"';									
								 }elseif($FailArrive == 'checked="checked"' || $CancelPreExistCond == 'checked="checked"' || $CancelAcuteMedCond == 'checked="checked"' || $CancelAdminOrg == 'checked="checked"' ){
								    $style3 = 'style="display:none;"';
									$visibilty ='style="visibility:hidden;"';
								 }elseif($InpatientOutcome != 0){
										  $style4 = 'style="display:none;"';
								  }
							  ?>
						   
						      <div class="section-first">
								<h4>DAY SURGERY OUTCOMES</h4>
								<div class="fourhidden" <?php echo $style4 ?>>
									<div class="box-feild4 secondhidden root-element" <?php echo $style2.$style3 ?>>
										<div data-rel="tooltip" class="input-prepend">
										<input type="checkbox" <?php echo $UnvntflDisch ?> value="1" id="UneventfulDischarge" name="DaySurgOutcome1_1_UnvntflDisch" class="input-large span100 checker_Parent">Uneventful Discharge
										</div>           
									</div>
									<div class="section-finder" id="section-toper" <?php echo $style1.$style3 ?>>
										<div class="box-feild1 hideselffirst checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" value="1" <?php echo $RetToOR ?> id="Return" name="DaySurgOutcome1_2_RetToOR" class="input-large span100 parent_section">Return to OR (during same admission)
											</div>           
										</div>
										<div class="box-feild1 hideselffirst checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" value="1"  <?php echo $TransferOvernight ?> id="TransferOvernight" name="DaySurgOutcome1_3_TransferOvernight" class="input-large span100 inner_check">Transfer Overnight
											</div>           
										</div>
										<div class="box-feild1 hideselffirst checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" value="1" <?php echo $TransferOtherFacility ?> id="OtherFacility" name="DaySurgOutcome1_4_TransferOtherFacility" class="input-large span100 inner_check">Transfer to Other Facility
											</div>           
										</div>
								 </div>	<!-- Section finder -->
								 
								</div>
								<div class="section-finder" id="section-toper2" <?php echo $style1.$style2.$style4 ?> >
										<div class="box-feild1 hideselffirst secondhidden checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" value="0" id="Failed" <?php echo $FailArrive ?> name="DaySurgOutcome1_5_Cancel_FailArrive" class="input-large span100 cancel_check">Cancellation - Failed to  Arrive
											</div>           
										</div>
										<div class="box-feild1 hideselffirst secondhidden checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" value="1" id="PreExisting" <?php echo $CancelPreExistCond ?> name="DaySurgOutcome1_6_CancelPreExistCond" class="input-large span100 cancel_check">Cancellation -Pre-Existing Condition
											</div>           
										</div>
										<div class="box-feild1 hideselffirst secondhidden checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" value="1" <?php echo $CancelAcuteMedCond ?> id="DaySurgOutcome1_7_CancelAcuteMedCond" name="DaySurgOutcome1_7_CancelAcuteMedCond" class="input-large span100 cancel_check">Cancellation -Acute Medical Condition
											</div>           
										</div>
										<div class="box-feild1 hideselffirst secondhidden checker_Parent_child">
											<div data-rel="tooltip" class="input-prepend">
											<input type="checkbox" <?php echo $CancelAdminOrg ?> value="1" id="Admin" name="DaySurgOutcome1_8_CancelAdminOrg" class="input-large span100 cancel_check">Cancellation -Admin /Org
											</div>           
										</div>
									</div>	
							  </div>
							  <div class="section-second hidden_section" <?php echo $visibilty ?>>
							    <div class="box-feild4 hideselffirst fourhidden">
									<div data-rel="tooltip" class="input-prepend">
									<input type="checkbox" <?php echo $UnplDelayDisch ?> value="1" id="Unplanned-Delay" name="DaySurgOutcome1_9_UnplDelayDisch" class="input-large span100">Unplanned Delay on Discharge<br/>
									<em>Check this box only where stay in Recovery > 1 hr past pre-op estimate.</em>
									</div>           
								</div> 
							  </div>
							  <div class="section-third">
							    <div class="box-feild1">
									<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">PREVIOUS SURGERY:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select" name="PrevSurgery" id="PrevSurgery">
											<option></option>
											<?php echo display_sel('r_previous_surgery','PreviousSurgeryCode','PreviousSurgeryCDescr',$PrevSurgery);?>
											</select>
											</span>
											
										</div>          
								</div>
								<div class="box-feild1">
									<div class="input-prepend" data-rel="tooltip">
									<?php $BackslabCast = isset($results['BackslabCast'])? $results['BackslabCast'] : ''; ?>
									 <?php $array = array('','Dressing Only','Backslab','Cast'); ?>
									 
											<label class="control-label" for="typeahead">CAST / BACKSLAB:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select" name="BackslabCast" id="BackslabCast">
											  <?php 
											    foreach($array as $options){
												  if($options == $BackslabCast && $BackslabCast != '')
												   echo "<option val='".$options."' selected='selected'>$options</option>";
												  else
												   echo "<option val='".$options."'>$options</option>";
												}
											  
											  ?>
											</select>
											</span>
											
										</div>          
								</div>
								<div class="box-feild1 hideselffirst secondhidden thirdhidden fourhidden checker_Parent_child" <?php echo $style1.$style2.$style3 ?>>
									<div class="input-prepend" data-rel="tooltip">
											<label class="control-label" for="typeahead">INPATIENT OUTCOME:</label>
											<span><select style="width:150px;" class="input-large span10 chosen-select" name="InpatientOutcome" id="InpatientOutcome">
											<option></option>
											<?php echo display_sel('r_inpatientoutcome','InpatientOutcomeCode','InpatientOutcomeDesc',$InpatientOutcome); ?>
											</select>
											</span>
										</div>         
								</div>
							  </div> 
						   </div>
						   
						 </p>
						</div>
						<div class="box-button" >
						<input type="hidden" style="position:absolute;" name="is_validate" value="<?php echo $Validated?>" id="is_validate">
						<input type="button" value="Delete Record" id="delete_A_record" />
						<input type="button" value="New Record" id="add_new_record" class="add_new_record"/>
						<input type="button" value="Validate Record" id="validate_records" />
						<!--<input type="button" value="Close"/></div>-->
						
					</div>
				</div><!--/span-->
				<input type="hidden" name="update_record" value="<?php echo $id ?>" id="record_id" />	
				<input type="submit" name="submit" id="submit_data" style="visibility:hidden; position:absolute;" />
               </div> 		
			</form>
			
			<div style="clear:both">&nbsp;</div>
			
			 <?php 
			 $current = isset($_REQUEST['item']) ? $_REQUEST['item'] : 1;
				
			 echo pagination($current); 
				
			}	
			?>
			 
			
 <style>

 
  img.ui-datepicker-trigger{cursor:pointer;}
 .divhead > span {
    float: left;
    width: 24%;
}
.other3 {
    float: left;
    width: 100%;
}
.other3 > div {
    float: left;
}
.other4 {
    float: left;
    width: 100%;
}
.other4 > div {
    float: left;
	width:33%;
}
 .other2{width:60%;float:left;}
 .other1{width:40%; float:right;}
 .box-button{padding:10px;float:right;}
 .box-button input{padding:10px;}
 .r-tabs{float:left;width: 100%;}
 #horizontalTab p{padding-top:30px;}
 .ul-tabs {
    background-color: #ffffff;
    padding-left: 0;
    width: 100%;
	float:left;
}
.ul-tabs li {
    background-color: #e1e1e0;
    margin-right: 2px!important;
    float: left;
    list-style: none outside none;
    padding: 5px 10px;
    text-align: center;
    width: 14%;
}
.ul-tabs li a {
    color: #000000;
    display: inline-block;
    text-decoration: none;
    width: 100%;
}
.r-tabs-state-active a {
    font-weight: bold;
}
 .row-fluid .span100 {
    width: 33.906%;
}
 .box-feildfull{width:100%;float:left;}
 .box-feild{width:50%;float:left;}
 #input-prepend{padding-bottom:50px;}
 .span12 .control-label {
    float: left;
    padding-top: 5px;
    text-align: right;
    width: 140px;padding-right:10px;
}
.box-feild3{float: left;
    width: 33%;}
.box-feild2 {
    float: left;
    width: 22%;
}
.box-feild4 {
    float: left;
    width: 100%;
}
.span1000{width:17%!important;}
.divhead1{float:left;}
.dateVariation .box-feild {width:100%;margin:0px 0px 7px;}
.dateVariation .box-feild .alos-date {width:17%;float:left;margin-right:10px;}
.ass-condition.show{display: block;}
.ass-condition.hide{display: block;}
 </style>      
<?php include('footer.php'); ?>
<!-- jQuery with fallback to the 1.* for old IE -->
    <!--[if lt IE 9]>
        <script src="js/jquery-1.11.0.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
       <script src="js/jquery-2.1.0.min.js"></script>
    <!--<![endif]-->
    <!-- Responsive Tabs JS -->
    <script src="js/jquery.responsiveTabs.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#horizontalTab').responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
                activate: function(e, tab) {
                    $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                }
            });
            $('#start-rotation').on('click', function() {
                $('#horizontalTab').responsiveTabs('active');
            });
            $('#stop-rotation').on('click', function() {
                $('#horizontalTab').responsiveTabs('stopRotation');
            });
            $('#start-rotation').on('click', function() {
                $('#horizontalTab').responsiveTabs('active');
            });
            $('.select-tab').on('click', function() {
                $('#horizontalTab').responsiveTabs('activate', $(this).val());
            });
           $('#EstDischargeTime').keydown(function (e) {
					if (e.shiftKey || e.ctrlKey || e.altKey) {
						e.preventDefault();
					} 
					else {
						var key = e.keyCode;
						if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
						e.preventDefault();
						}
					}
			});
        });
    </script>	