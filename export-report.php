<?php
/** EXCEL RECORD **/
set_time_limit(0);
require_once  'functions.php';
$show_record = $_REQUEST["show_record"];
$limit = 150;
$offset = 0;
$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';


if(isset($_REQUEST['part'])){
	$offset = ($limit * ($_REQUEST["part"]-1)) + 1; 
}
	
	

if($show_record!=''){
	
	if($show_record != $current_user && !in_array($current_user,$config['admin'])){
 		header('location:dashboard.php'); exit; 
	}
	$db_master_data=get_masterdata($show_record);
	if(!empty($db_master_data)) {
		error_reporting(E_ALL);
		ini_set('display_errors', FALSE);
		ini_set('display_startup_errors', FALSE);
		date_default_timezone_set('Europe/London');
		
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		
		require_once  'class/PHPExcel.php';
		
		$objPHPExcel = new PHPExcel();
		
		
		
		
		/*$phpExcel = new \PHPExcel();
		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array( ' memoryCacheSize ' => '16MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);*/
		
		$objPHPExcel->getProperties()->setCreator("The Australasian College of Podiatric Surgeons Surgical Audit Tool")							 
									 ->setTitle("ACPS")
									 ->setSubject("Audit Tool")
									 ->setDescription("The Australasian College of Podiatric Surgeons Surgical Audit Tool.")
									 ->setKeywords("ACPS Audit Tool")
									 ->setCategory("Reposrt for the user");
		
		$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1',"ID")
						->setCellValue('B1', "UserID")
						->setCellValue('C1',"UserName")
						->setCellValue('D1',"UserState")
						->setCellValue('E1',"LastName")
						->setCellValue('F1',"Firstname")
						->setCellValue('G1', "Sex")
						->setCellValue('H1',"DoB")
						->setCellValue('I1',"PostCode")
						->setCellValue('J1',"URN")
						->setCellValue('K1',"FacilityCode")
						->setCellValue('L1',"SurgeonType")
						->setCellValue('M1',"ASACategory")
						->setCellValue('N1',"EstDischargeTime")
						->setCellValue('O1',"ComorbiditiesYesNo")
						->setCellValue('P1',"Comorbidity01")
						->setCellValue('Q1',"Comorbidity02")
						->setCellValue('R1',"Comorbidity03")
						->setCellValue('S1',"Comorbidity04")
						->setCellValue('T1',"Comorbidity05")
						->setCellValue('U1',"Comorbidity06")
						->setCellValue('V1',"Comorbidity07")
						->setCellValue('W1',"Comorbidity08")
						->setCellValue('X1',"Comorbidity09")
						->setCellValue('Y1',"Comorbidity10")
						->setCellValue('Z1',"PDx")
						->setCellValue('AA1',"SDx01")
						->setCellValue('AB1',"SDx02")
						->setCellValue('AC1',"SDx03")
						->setCellValue('AD1',"SDx04")
						->setCellValue('AE1',"SDx05")
						->setCellValue('AF1',"SDx06")
						->setCellValue('AG1',"SDx07")
						->setCellValue('AH1',"SDx08")
						->setCellValue('AI1',"SDx09")
						->setCellValue('AJ1',"SDx10")
						->setCellValue('AK1',"SDx11")
						->setCellValue('AL1',"SDx12")
						->setCellValue('AM1',"SDx13")
						->setCellValue('AN1',"SDx14")
						->setCellValue('AO1',"SDx15")
						->setCellValue('AP1',"SDx16")
						->setCellValue('AQ1',"SDx17")
						->setCellValue('AR1',"SDx18")
						->setCellValue('AS1',"SDx19")
						->setCellValue('AT1',"SDx20")
						->setCellValue('AU1',"SDx21")
						->setCellValue('AV1',"SDx22")
						->setCellValue('AW1',"SDx23")
						->setCellValue('AX1',"SDx24")
						->setCellValue('AY1',"SDx25")
						->setCellValue('AZ1',"SDx26")
						->setCellValue('BA1',"SDx27")
						->setCellValue('BB1',"SDx28")
						->setCellValue('BC1',"SDx29")
						->setCellValue('BD1',"SDx30")
						->setCellValue('BE1', "Proc01")
						->setCellValue('BF1',"Proc02")
						->setCellValue('BG1',"Proc03")
						->setCellValue('BH1',"Proc04")
						->setCellValue('BI1',"Proc05")
						->setCellValue('BJ1',"Proc06")
						->setCellValue('BK1',"Proc07")
						->setCellValue('BL1',"Proc08")
						->setCellValue('BM1',"Proc09")
						->setCellValue('BN1',"Proc10")
						->setCellValue('BO1',"Proc11")
						->setCellValue('BP1',"Proc12")
						->setCellValue('BQ1',"Proc13")
						->setCellValue('BR1',"Proc14")
						->setCellValue('BS1',"Proc15")
						->setCellValue('BT1',"Proc16")
						->setCellValue('BU1',"Proc17")
						->setCellValue('BV1',"Proc18")
						->setCellValue('BW1',"Proc19")
						->setCellValue('BX1',"Proc20")
						->setCellValue('BY1',"Proc21")
						->setCellValue('BZ1',"Proc22")
						->setCellValue('CA1',"Proc23")
						->setCellValue('CB1',"Proc24")
						->setCellValue('CC1',"Proc25")
						->setCellValue('CD1',"Proc26")
						->setCellValue('CE1',"Proc27")
						->setCellValue('CF1',"Tourniquet1_Used")
						->setCellValue('CG1',"Tourniquet1_OrderOfApplic")
						->setCellValue('CH1',"Tourniquet1_TimeOfApplic")
						->setCellValue('CI1',"Tourniquet1_TimeOfRemoval")
						->setCellValue('CJ1',"Tourniquet1_Location")
						->setCellValue('CK1',"Tourniquet2_Used")
						->setCellValue('CL1',"Tourniquet2_OrderOfApplic")
						->setCellValue('CM1',"Tourniquet2_TimeOfApplic")
						->setCellValue('CN1',"Tourniquet2_TimeOfRemoval")
						->setCellValue('CO1',"Tourniquet2_Location")
						->setCellValue('CP1',"Tourniquet3_Used")
						->setCellValue('CQ1',"Tourniquet3_OrderOfApplic")
						->setCellValue('CR1',"Tourniquet3_TimeOfApplic")
						->setCellValue('CS1',"Tourniquet3_TimeOfRemoval")
						->setCellValue('CT1',"Tourniquet3_Location")
						->setCellValue('CU1',"Tourniquet4_Used")
						->setCellValue('CV1',"Tourniquet4_OrderOfApplic")
						->setCellValue('CW1',"Tourniquet4_TimeOfApplic")
						->setCellValue('CX1',"Tourniquet4_TimeOfRemoval")
						->setCellValue('CY1',"Tourniquet4_Location")
						->setCellValue('CZ1',"IntraOpProphylaxis_Thrombo")
						->setCellValue('DA1',"IntraOpProphylaxis_Antibiotic")
						->setCellValue('DB1',"PostOpProphylaxis_Thrombo")
						->setCellValue('DC1',"PrevSurgery")
						->setCellValue('DD1',"InitConsDate")
						->setCellValue('DE1',"AdmissionDate")
						->setCellValue('DF1',"SeparationDate")
						->setCellValue('DG1',"DaySurgOutcome1_1_UnvntflDisch")
						->setCellValue('DH1',"DaySurgOutcome1_2_RetToOR")
						->setCellValue('DI1',"DaySurgOutcome1_2_RetToOR_Time")
						->setCellValue('DJ1',"DaySurgOutcome1_3_TransferOvernight")
						->setCellValue('DK1',"DaySurgOutcome1_4_TransferOtherFacility")
						->setCellValue('DL1',"DaySurgOutcome1_5_Cancel_FailArrive")
						->setCellValue('DM1',"DaySurgOutcome1_6_CancelPreExistCond")
						->setCellValue('DN1',"DaySurgOutcome1_7_CancelAcuteMedCond")
						->setCellValue('DO1',"DaySurgOutcome1_8_CancelAdminOrg")
						->setCellValue('DP1',"DaySurgOutcome1_9_UnplDelayDisch")
						->setCellValue('DQ1',"InpatientOutcome")
						->setCellValue('DR1',"ComplicationCode1")
						->setCellValue('DS1',"ComplicationCode2")
						->setCellValue('DT1',"ComplicationCode3")
						->setCellValue('DU1',"ComplicationCode4")
						->setCellValue('DV1',"ComplicationCode5")
						->setCellValue('DW1',"ComplicationDegreeCode")
						->setCellValue('DX1',"BackslabCast")
						->setCellValue('DY1',"AnaesthesiaType1")
						->setCellValue('DZ1',"AnaesthesiaType2")
						->setCellValue('EA1',"AnaesthesiaType3")
						->setCellValue('EB1',"IntraOp_2ndDose")
						->setCellValue('EC1',"SurgeryDate")
						->setCellValue('ED1',"Validated");
		
		
		// ADD DATA FROM MYSQL  
			 $i=1;
			 $total_rows = count($db_master_data);
			 
			 foreach($db_master_data as $m_data) {
				// if($i <= 150){
					  $i++;
					 $objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i, $m_data["ID"])
						->setCellValue('B'.$i, $m_data["user_id"])
						->setCellValue('C'.$i,$m_data["UserName"])
						->setCellValue('D'.$i,$m_data["UserState"])
						->setCellValue('E'.$i,$m_data["LastName"])
						->setCellValue('F'.$i,$m_data["Firstname"])
						->setCellValue('G'.$i, $m_data["Sex"])
						->setCellValue('H'.$i,date('d-m-Y',strtotime($m_data["DoB"])))
						->setCellValue('I'.$i,$m_data["PostCode"])
						->setCellValue('J'.$i,$m_data["URN"])
						->setCellValue('K'.$i,$m_data["FacilityCode"])
						->setCellValue('L'.$i,$m_data["SurgeonType"])
						->setCellValue('M'.$i,$m_data["ASACategory"])
						->setCellValue('N'.$i,$m_data["EstDischargeTime"])
						->setCellValue('O'.$i,$m_data["ComorbiditiesYesNo"])
						->setCellValue('P'.$i,$m_data["Comorbidity01"])
						->setCellValue('Q'.$i,$m_data["Comorbidity02"])
						->setCellValue('R'.$i,$m_data["Comorbidity03"])
						->setCellValue('S'.$i,$m_data["Comorbidity04"])
						->setCellValue('T'.$i,$m_data["Comorbidity05"])
						->setCellValue('U'.$i,$m_data["Comorbidity06"])
						->setCellValue('V'.$i,$m_data["Comorbidity07"])
						->setCellValue('W'.$i,$m_data["Comorbidity08"])
						->setCellValue('X'.$i,$m_data["Comorbidity09"])
						->setCellValue('Y'.$i,$m_data["Comorbidity10"])
						->setCellValue('Z'.$i,$m_data["PDx"])
						->setCellValue('AA'.$i,$m_data["SDx01"])
						->setCellValue('AB'.$i,$m_data["SDx02"])
						->setCellValue('AC'.$i,$m_data["SDx03"])
						->setCellValue('AD'.$i,$m_data["SDx04"])
						->setCellValue('AE'.$i,$m_data["SDx05"])
						->setCellValue('AF'.$i,$m_data["SDx06"])
						->setCellValue('AG'.$i,$m_data["SDx07"])
						->setCellValue('AH'.$i,$m_data["SDx08"])
						->setCellValue('AI'.$i,$m_data["SDx09"])
						->setCellValue('AJ'.$i,$m_data["SDx10"])
						->setCellValue('AK'.$i,$m_data["SDx11"])
						->setCellValue('AL'.$i,$m_data["SDx12"])
						->setCellValue('AM'.$i,$m_data["SDx13"])
						->setCellValue('AN'.$i,$m_data["SDx14"])
						->setCellValue('AO'.$i,$m_data["SDx15"])
						->setCellValue('AP'.$i,$m_data["SDx16"])
						->setCellValue('AQ'.$i,$m_data["SDx17"])
						->setCellValue('AR'.$i,$m_data["SDx18"])
						->setCellValue('AS'.$i,$m_data["SDx19"])
						->setCellValue('AT'.$i,$m_data["SDx20"])
						->setCellValue('AU'.$i,$m_data["SDx21"])
						->setCellValue('AV'.$i,$m_data["SDx22"])
						->setCellValue('AW'.$i,$m_data["SDx23"])
						->setCellValue('AX'.$i,$m_data["SDx24"])
						->setCellValue('AY'.$i,$m_data["SDx25"])
						->setCellValue('AZ'.$i,$m_data["SDx26"])
						->setCellValue('BA'.$i,$m_data["SDx27"])
						->setCellValue('BB'.$i,$m_data["SDx28"])
						->setCellValue('BC'.$i,$m_data["SDx29"])
						->setCellValue('BD'.$i,$m_data["SDx30"])
						->setCellValue('BE'.$i, $m_data["Proc01"])
						->setCellValue('BF'.$i,$m_data["Proc02"])
						->setCellValue('BG'.$i,$m_data["Proc03"])
						->setCellValue('BH'.$i,$m_data["Proc04"])
						->setCellValue('BI'.$i,$m_data["Proc05"])
						->setCellValue('BJ'.$i,$m_data["Proc06"])
						->setCellValue('BK'.$i,$m_data["Proc07"])
						->setCellValue('BL'.$i,$m_data["Proc08"])
						->setCellValue('BM'.$i,$m_data["Proc09"])
						->setCellValue('BN'.$i,$m_data["Proc10"])
						->setCellValue('BO'.$i,$m_data["Proc11"])
						->setCellValue('BP'.$i,$m_data["Proc12"])
						->setCellValue('BQ'.$i,$m_data["Proc13"])
						->setCellValue('BR'.$i,$m_data["Proc14"])
						->setCellValue('BS'.$i,$m_data["Proc15"])
						->setCellValue('BT'.$i,$m_data["Proc16"])
						->setCellValue('BU'.$i,$m_data["Proc17"])
						->setCellValue('BV'.$i,$m_data["Proc18"])
						->setCellValue('BW'.$i,$m_data["Proc19"])
						->setCellValue('BX'.$i,$m_data["Proc20"])
						->setCellValue('BY'.$i,$m_data["Proc21"])
						->setCellValue('BZ'.$i,$m_data["Proc22"])
						->setCellValue('CA'.$i,$m_data["Proc23"])
						->setCellValue('CB'.$i,$m_data["Proc24"])
						->setCellValue('CC'.$i,$m_data["Proc25"])
						->setCellValue('CD'.$i,$m_data["Proc26"])
						->setCellValue('CE'.$i,$m_data["Proc27"])
						->setCellValue('CF'.$i,$m_data["Tourniquet1_Used"])
						->setCellValue('CG'.$i,$m_data["Tourniquet1_OrderOfApplic"])
						->setCellValue('CH'.$i,$m_data["Tourniquet1_TimeOfApplic"])
						->setCellValue('CI'.$i,$m_data["Tourniquet1_TimeOfRemoval"])
						->setCellValue('CJ'.$i,$m_data["Tourniquet1_Location"])
						->setCellValue('CK'.$i,$m_data["Tourniquet2_Used"])
						->setCellValue('CL'.$i,$m_data["Tourniquet2_OrderOfApplic"])
						->setCellValue('CM'.$i,$m_data["Tourniquet2_TimeOfApplic"])
						->setCellValue('CN'.$i,$m_data["Tourniquet2_TimeOfRemoval"])
						->setCellValue('CO'.$i,$m_data["Tourniquet2_Location"])
						->setCellValue('CP'.$i,$m_data["Tourniquet3_Used"])
						->setCellValue('CQ'.$i,$m_data["Tourniquet3_OrderOfApplic"])
						->setCellValue('CR'.$i,$m_data["Tourniquet3_TimeOfApplic"])
						->setCellValue('CS'.$i,$m_data["Tourniquet3_TimeOfRemoval"])
						->setCellValue('CT'.$i,$m_data["Tourniquet3_Location"])
						->setCellValue('CU'.$i,$m_data["Tourniquet4_Used"])
						->setCellValue('CV'.$i,$m_data["Tourniquet4_OrderOfApplic"])
						->setCellValue('CW'.$i,$m_data["Tourniquet4_TimeOfApplic"])
						->setCellValue('CX'.$i,$m_data["Tourniquet4_TimeOfRemoval"])
						->setCellValue('CY'.$i,$m_data["Tourniquet4_Location"])
						->setCellValue('CZ'.$i,$m_data["IntraOpProphylaxis_Thrombo"])
						->setCellValue('DA'.$i,$m_data["IntraOpProphylaxis_Antibiotic"])
						->setCellValue('DB'.$i,$m_data["PostOpProphylaxis_Thrombo"])
						->setCellValue('DC'.$i,$m_data["PrevSurgery"])
						->setCellValue('DD'.$i,date('d-m-Y',strtotime($m_data["InitConsDate"])))
						->setCellValue('DE'.$i,date('d-m-Y',strtotime($m_data["AdmissionDate"])))
						->setCellValue('DF'.$i,date('d-m-Y',strtotime($m_data["SeparationDate"])))
						->setCellValue('DG'.$i,$m_data["DaySurgOutcome1_1_UnvntflDisch"])
						->setCellValue('DH'.$i,$m_data["DaySurgOutcome1_2_RetToOR"])
						->setCellValue('DI'.$i,$m_data["DaySurgOutcome1_2_RetToOR_Time"])
						->setCellValue('DJ'.$i,$m_data["DaySurgOutcome1_3_TransferOvernight"])
						->setCellValue('DK'.$i,$m_data["DaySurgOutcome1_4_TransferOtherFacility"])
						->setCellValue('DL'.$i,$m_data["DaySurgOutcome1_5_Cancel_FailArrive"])
						->setCellValue('DM'.$i,$m_data["DaySurgOutcome1_6_CancelPreExistCond"])
						->setCellValue('DN'.$i,$m_data["DaySurgOutcome1_7_CancelAcuteMedCond"])
						->setCellValue('DO'.$i,$m_data["DaySurgOutcome1_8_CancelAdminOrg"])
						->setCellValue('DP'.$i,$m_data["DaySurgOutcome1_9_UnplDelayDisch"])
						->setCellValue('DQ'.$i,$m_data["InpatientOutcome"])
						->setCellValue('DR'.$i,$m_data["ComplicationCode1"])
						->setCellValue('DS'.$i,$m_data["ComplicationCode2"])
						->setCellValue('DT'.$i,$m_data["ComplicationCode3"])
						->setCellValue('DU'.$i,$m_data["ComplicationCode4"])
						->setCellValue('DV'.$i,$m_data["ComplicationCode5"])
						->setCellValue('DW'.$i,$m_data["ComplicationDegreeCode"])
						->setCellValue('DX'.$i,$m_data["BackslabCast"])
						->setCellValue('DY'.$i,$m_data["AnaesthesiaType1"])
						->setCellValue('DZ'.$i,$m_data["AnaesthesiaType2"])
						->setCellValue('EA'.$i,$m_data["AnaesthesiaType3"])
						->setCellValue('EB'.$i,$m_data["IntraOp_2ndDose"])
						->setCellValue('EC'.$i,date('d-m-Y',strtotime($m_data["SurgeryDate"])))
						->setCellValue('ED'.$i,$m_data["Validated"]);
					 
				  //  } 
			 }
		
		
		
		if(isset($_REQUEST['file']))
			$filename = "acps-".strtolower($_REQUEST['file']);
		else	
			$filename="acps-".$show_record;
		$part = 1;
		if(isset($_REQUEST['part'])){
			$part = $_REQUEST['part'];
			$filename = $filename.'-part'.$_REQUEST['part'];
		}
		
		$part = $part + 1;
			
		$filename = $filename.'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$filename);
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
		header ('Cache-Control: cache, must-revalidate'); 
		header ('Pragma: public'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
			}  

}

 include('header.php'); ?>
<?php

$user_id = $_REQUEST['user'];

$head = 'true';
if(in_array($current_user,$config['admin'])){
  $head = '';
}elseif($user_id != $current_user && !in_array($current_user,$config['admin'])){
 
 		header('location:dashboard.php'); exit; 
}

	?>
		<div class="row-fluid sortable" style="background:#f9f9f9;">		
				<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-user">User Data Entry</i></h2>
						</div>
					<?php  $results = exportusers_info();  ?>
     				<div class="box-content">
                         <form id="delete_control" action="<?php echo 'user_records.php?user='.$user_id.'&action=view' ?>" method="post">
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							  <thead>
								  <tr>
									  <th>Full Name</th>
									  <th>User E-mail</th>
									  <th>User State</th>
									  <th>Contact No</th>
									  <th>Status</th>
									  <th>Export  (as excel) </th>
								  </tr>
							  </thead>   
							  <tbody>
								<?php
									if(!empty($results)){
									foreach($results as $record){
									$status = ($record['is_active'] == 1) ? '1' : '0';
									 echo "<tr class='".$status."'>
										  <td><!--<input type='checkbox' value='".$record['ID']."' name='delete_control[]' class='delete_this' />-->".$record['first_name']." ".$record['last_name']."</td>
										  <td>".$record["user_email"]."</td>
										  <td>".$record["UserState"]."</td>
										  <td>".$record["contact_no"]."</td>
										  <td class='center'>";


										  if($status) { 
											echo "<a class='btn btn-success' href='javascript:void'>
												<i class='icon-zoom-in icon-white'></i>  
												Active                                            
											</a>";
											}else { 											
										    echo "<a class='btn btn-danger'  href='javascript:void(0)' style='margin-top:5px;'>
												<i class='icon-trash icon-white'></i> 
												Inactive
											</a>";
										}
										echo "</td>
                                         <td> 	<a class='btn' href='export-report.php?show_record=".$record["user_id"]."&file=".$record['first_name']."-".$record['last_name']."'>
												<i class='icon-list-alt'></i>   <span class='glyphicons glyphicons-list-alt'></span>
												Export                                            
											</a>
                                         </td> 
										</tr>"; 
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
			
<?php include('footer.php'); ?>