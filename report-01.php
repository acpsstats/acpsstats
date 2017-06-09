<?php include('header.php'); 
if(!isset($_SESSION['user_id']) || intval($_SESSION['user_id']) == 0) { header("location:login.php"); exit() ;}
global $db;
$type =  isset($_REQUEST['type']) ? trim($_REQUEST['type']) : "";
$from = isset($_REQUEST['from']) ? $_REQUEST['from'] : "";
$to = isset($_REQUEST['to']) ? $_REQUEST['to'] : "";
if(!($from && $to)) { die("Please choose the duration");}
$fromdate_r = explode("/", $from);
$fromdate_r = array_reverse($fromdate_r);
$fromdate_r = implode("-", $fromdate_r);
$todate_r = explode("/", $to);
$todate_r = array_reverse($todate_r);
$todate_r = implode("-", $todate_r);
$user_name = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
$page=(isset($_REQUEST['page'])) ?  $_REQUEST['page'] : '0';
$exclude_user=$config["exclude"];
if(!empty($exclude_user))  $query=' and  tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';


switch($type){
	case 'all' :
			 $sql = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10, tblmasterpoddata.SurgeryDate
					FROM ((((((((((((((
					(tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) 
					LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) 
                    LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) 
                    LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) 
                    LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) 
                    LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode)
                    LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) 
                    LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) 
                    LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode)
                    LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode)
                    LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode)
                    LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) 
                    LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) 
                    LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) 
                    LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) 
					LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
					WHERE (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND tblmasterpoddata.Proc01 != '' AND  tblmasterpoddata.PDx!=''   AND tblmasterpoddata.Validated=1 {$query} {$query_condition}
					ORDER BY tblmasterpoddata.LastName, tblmasterpoddata.Firstname ";
		  break;
	case 'user'  :
					$sql ="SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
					FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
					WHERE (((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((tblmasterpoddata.user_id )= '$user_id')) AND (tblmasterpoddata.Validated=1)
					ORDER BY  tblmasterpoddata.LastName, tblmasterpoddata.Firstname ";
		 break;
	case 'admin' :
					$sql = "SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
							FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
							WHERE (((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((tblmasterpoddata.user_id)='$user_id'))
							ORDER BY tblmasterpoddata.LastName, tblmasterpoddata.Firstname ";
		break;

	default:   

					$sql ="SELECT tblmasterpoddata.*, r_sex.Dsecription, r_facility.FacilityDescription, r_surgeontype.SurgeonTypeDesc, r_asacategory.ASADescription, r_icd10am_diagnosis_codes.DiagnosisDesc, r_icd10am_procedure_codes.Description AS PProcDesc, r_comorbidity.ComorbidityDesc AS Comorb01, r_comorbidity_1.ComorbidityDesc AS Comorb02, r_comorbidity_2.ComorbidityDesc AS Comorb03, r_comorbidity_3.ComorbidityDesc AS Comorb04, r_comorbidity_4.ComorbidityDesc AS Comorb05, r_comorbidity_5.ComorbidityDesc AS Comorb06, r_comorbidity_6.ComorbidityDesc AS Comorb07, r_comorbidity_7.ComorbidityDesc AS Comorb08, r_comorbidity_8.ComorbidityDesc AS Comorb09, r_comorbidity_9.ComorbidityDesc AS Comorb10
						   FROM (((((((((((((((tblmasterpoddata LEFT JOIN r_sex ON tblmasterpoddata.Sex = r_sex.SexCode) LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_surgeontype ON tblmasterpoddata.SurgeonType = r_surgeontype.SurgeonTypeCode) LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_comorbidity ON tblmasterpoddata.Comorbidity01 = r_comorbidity.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_1 ON tblmasterpoddata.Comorbidity02 = r_comorbidity_1.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_2 ON tblmasterpoddata.Comorbidity03 = r_comorbidity_2.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_3 ON tblmasterpoddata.Comorbidity04 = r_comorbidity_3.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_4 ON tblmasterpoddata.Comorbidity05 = r_comorbidity_4.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_5 ON tblmasterpoddata.Comorbidity06 = r_comorbidity_5.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_6 ON tblmasterpoddata.Comorbidity07 = r_comorbidity_6.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_7 ON tblmasterpoddata.Comorbidity08 = r_comorbidity_7.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_8 ON tblmasterpoddata.Comorbidity09 = r_comorbidity_8.ComorbidityCode) LEFT JOIN r_comorbidity AS r_comorbidity_9 ON tblmasterpoddata.Comorbidity10 = r_comorbidity_9.ComorbidityCode) LEFT JOIN r_icd10am_diagnosis_codes ON tblmasterpoddata.PDx = r_icd10am_diagnosis_codes.ICD_Diag_Code) LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
						   WHERE (((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((tblmasterpoddata.user_id )= '$user_id'))
						   ORDER BY tblmasterpoddata.LastName, tblmasterpoddata.Firstname ";
		break;
}

$start=0;
$end=50;

if(isset($_GET['page']))
{
$id=$_GET['page'];
$start=($id-1)*$end;
}


$get_total_records= $db->fetch_all_array($sql);





$limit_sql=$sql.' limit '.$start.','.$end;
$result_data = $db->fetch_all_array($limit_sql);
$total_pages=ceil(count($get_total_records) /50);


$content_body = '';
if(empty($result_data)){
			$content_body .= '<div class="row-fluid">
					<div class="report-wrapper report-gen">
						<div class="r-heading">	
							<h2>Reports 01</h2>';
						if($type != "all"):
							$content_body .= '<h3>TOTAL PRACTICE</h3>';
						else: 
							$content_body .= '<h3>ALL USERS</h3>';
						endif;
			$content_body .= '</div>
						<h3>No Report Found</h3>
					</div>
				  </div>';
		echo $content_body;
}				  
else{ 
	
	
 if($page==0 || $page==1) { 
 $i=1;
 }else {
 $i=(($page*50)+1)-50;
 }
	foreach($result_data as $key_rd=>$value_rd){
		  $content_body = '';
		  $ID=$value_rd['ID'];
		  $value_username=$value_rd['UserName'];
		  $value_userstate=$value_rd['UserState'];
		  $value_from=date('d-m-Y',strtotime($fromdate_r));
		  $value_to=date('d-m-Y',strtotime($todate_r));
		  $value_urn=$value_rd['URN'];
		  $value_lastName_firstname = ucfirst($value_rd['LastName']." ".$value_rd['Firstname']);
		  if($value_rd['Sex'] == 1){
		 	$value_sex = 'Male';
		  }else{
		 	$value_sex = 'Female';
		  }
		  $value_dob=date('d/m/Y',strtotime($value_rd['DoB']));
		  $value_postcode=$value_rd['PostCode'];
		  $value_surgerydate=date('d/m/Y',strtotime($value_rd['SurgeryDate']));
		  $value_facilitydescription=$value_rd['FacilityDescription'];
		  $value_surgeontypedesc=$value_rd['SurgeonTypeDesc'];
		  $value_asadescription=$value_rd['ASADescription'];
		  $estimated_discharge_time=$value_rd['ASADescription'];
		  $value_comorb01=$value_rd['Comorb01'];
	      $value_comorb02=$value_rd['Comorb02'];
	      $value_comorb03=$value_rd['Comorb03'];
	      $value_comorb04=$value_rd['Comorb04'];
	      $value_comorb05=$value_rd['Comorb05'];
	      $value_comorb06=$value_rd['Comorb06'];
	      $value_comorb07=$value_rd['Comorb07'];
	      $value_comorb08=$value_rd['Comorb08'];
	      $value_comorb09=$value_rd['Comorb09'];
	      $value_comorb10=$value_rd['Comorb10'];
		  $value_pdx_diagnosisdesc=$value_rd['PDx']." ".$value_rd['DiagnosisDesc'];
		  $value_proc01_pprocdesc=$value_rd['Proc01']." ".$value_rd['PProcDesc'];
		 if($value_rd['EstDischargeTime'])  $EstDischargeTime=$value_rd['EstDischargeTime']; else  $EstDischargeTime="  ------";
		  
		  if($value_rd['Validated'] == 0){
		  	$value_validated = 'not';
		  }else{
		  	$value_validated = '';
		  }
		  $content_body .= '<div class="row-fluid">
					<div class="report-wrapper report-gen">';
		 $content_subbody ='';			
		 if($key_rd == 0 && $type != "all"){
		   $content_subbody='<div class="r-heading"><h2>Reports 01</h2>Total <b>'.count($get_total_records).' </b> Records</div>';
		 } 
		 if($key_rd == 0 && $type == "all"){
		   $content_subbody='<div class="r-heading"><h2>Reports 01</h2><h3>ALL USERS</h3>Total <b>'.count($get_total_records).'</b> Records</div>';
		 } 
         
		 if($key_rd > 0){
		 	$content_subbody ='';
		 }
 //$content_subbody='<div> <b>'.count($result_data).' </b> Records Found </div>';
		 $content_body .= $content_subbody.'
		
		 <div class="span12 report-section">';
		  if($type != "all"):
		  $content_body .='<table>
							<tr><td>User Name</td><td>'.$value_username.'</td></tr>
							<tr><td>State</td><td>'.$value_userstate.'</td></tr>
						</table>';
		 Endif;
		 $content_body .='<table>
							<tr><td colspan="2">VALIDATION STATUS - All RECORDS BY DATE RANGE</td></tr>
							<tr><td colspan="2">Date Range - from '.$value_from.' to '.$value_to.' </td></tr>
							<tr><td colspan="2" style="height:20px"></td></tr>
							<tr><td>URN</td><td>'.$value_urn.'</td></tr>';
                            
							if($type=='user' || $type=='admin'){
							    $content_body .='<tr><td>Name</td><td>'.$value_lastName_firstname.'</td><td>Sex</td><td>'.$value_sex.'</td></tr>';
							 }
						
				$content_body .='<tr><td>DOB</td><td>'.$value_dob.'</td><td>PostCode</td><td>'.$value_postcode.'</td></tr>
							<tr><td>SurgeryDate</td><td>'.$value_surgerydate.'</td></tr>
							<tr><td>Facility</td><td>'.$value_facilitydescription.'</td></tr>
							<tr><td>Surgeon Type</td><td>'.$value_surgeontypedesc.'</td></tr>
							<tr><td>ASA Category</td><td>'.$value_asadescription.'</td></tr>
							<tr><td colspan="2">Estimated Discharge Time (minutes):'.$EstDischargeTime.'</td></tr>
							<tr><td>Comorbidities</td><td>01 '.$value_comorb01.'</td></tr>							
							<tr><td>&nbsp;</td><td>02 '.$value_comorb02.'</td></tr>
							<tr><td>&nbsp;</td><td>03 '.$value_comorb03.'</td></tr>
							<tr><td>&nbsp;</td><td>04 '.$value_comorb04.'</td></tr>
							<tr><td>&nbsp;</td><td>05 '.$value_comorb05.'</td></tr>
							<tr><td>&nbsp;</td><td>06 '.$value_comorb06.'</td></tr>
							<tr><td>&nbsp;</td><td>07 '.$value_comorb07.'</td></tr>
							<tr><td>&nbsp;</td><td>08 '.$value_comorb08.'</td></tr>
							<tr><td>&nbsp;</td><td>09 '.$value_comorb09.'</td></tr>
							<tr><td>&nbsp;</td><td>10 '.$value_comorb10.'</td></tr>
							<tr><td>Principal Diag:</td><td>'.$value_pdx_diagnosisdesc.'</td></tr>
							<tr><td>Principal Proc:</td><td>'.$value_proc01_pprocdesc.'</td></tr>
							<tr><td>This record has '.$value_validated.' been validated.</td></tr>
						</table></div>
						</div>
					</div>';
					
					
					
			$content_body .= '<span class="date-notifier">Date Range - from '.$value_from.' to '.$value_to.'</span>';		
			$content_body .= '<span class="notifier"> Page - '.$i.'/'.count($get_total_records).'</span>';
			if(count($result_data) != ($key_rd+1)){
					
				$content_body .= '<div style="width:100%; border-bottom:5px solid #333;">&nbsp;</div>';
			}
			echo $content_body;
			$i++;
	}
}
?>
<div class="report-pagination">
	<?php
  $query_string="http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

if(!empty($_REQUEST['type'])) { 
   $query_string.='?type='.$_REQUEST['type'];
}

if(!empty($_REQUEST['from'])) { 
   $query_string.='&from='.$_REQUEST['from'];
}

if(!empty($_REQUEST['to'])) { 
   $query_string.='&to='.$_REQUEST['to'];
}

	for ($k=1; $k<=$total_pages;$k++) { 
		$url=$query_string."&page=".$k;
	    echo "<a href='".$url."'>".$k."</a> "; 
	}
	
	$url=$query_string."&page=".$total_pages;
	echo "<a href='".$url."'>".'>|'."</a> "; // Goto last page?>
</div>
<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<?php include('footer.php'); ?>