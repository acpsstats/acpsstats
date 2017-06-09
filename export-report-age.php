<?php
/** EXCEL RECORD **/
require_once  'functions.php';

$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$user_id = $_REQUEST['user'];

if($user_id != $current_user && !in_array($current_user,$config['admin'])){ 
 header('location:dashboard.php'); exit; 
}


if(isset($_REQUEST["get_report"]) || $_REQUEST["ft"]=='Excel') { 

$start_age=$_REQUEST["start_age"];
$end_age=$_REQUEST["end_age"];
$year=$_REQUEST["year"];
if(!in_array($current_user,$config['admin'])){ 
	$sql="SELECT ID,user_id,CONCAT(Firstname,' ',LastName) as Full_name,UserState,Proc01,Proc02,Proc03,Proc04,Proc05,Proc06,Proc07,Proc08,Proc09,Proc10,Proc11,Proc12,
Proc13,Proc14,Proc15,Proc16,Proc17,Proc18,Proc19,Proc20,Proc21,Proc22,Proc22,Proc23,Proc24,Proc25,Proc26,Proc27,DoB,CURDATE(),TIMESTAMPDIFF(YEAR,DoB,CURDATE()) AS age,SurgeryDate 
 FROM tblmasterpoddata where TIMESTAMPDIFF(YEAR,DoB,CURDATE()) >='".$start_age."' and TIMESTAMPDIFF(YEAR,DoB,CURDATE()) <='".$end_age."' 
   and YEAR(SurgeryDate)='".$year."' and Validated=1 AND user_id = ".$user_id." order by age asc" ;
}else{
$sql="SELECT ID,user_id,CONCAT(Firstname,' ',LastName) as Full_name,UserState,Proc01,Proc02,Proc03,Proc04,Proc05,Proc06,Proc07,Proc08,Proc09,Proc10,Proc11,Proc12,
Proc13,Proc14,Proc15,Proc16,Proc17,Proc18,Proc19,Proc20,Proc21,Proc22,Proc22,Proc23,Proc24,Proc25,Proc26,Proc27,DoB,CURDATE(),TIMESTAMPDIFF(YEAR,DoB,CURDATE()) AS age,SurgeryDate 
 FROM tblmasterpoddata where TIMESTAMPDIFF(YEAR,DoB,CURDATE()) >='".$start_age."' and TIMESTAMPDIFF(YEAR,DoB,CURDATE()) <='".$end_age."' 
   and YEAR(SurgeryDate)='".$year."' and Validated=1 order by age asc" ;
}
   
$results= $db->fetch_all_array($sql);

}

if(!empty($results) && $_REQUEST["ft"]=='Excel') {
	
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once  'class/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");

$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A1',"ID")
	            ->setCellValue('B1',"UserID")
	            ->setCellValue('C1',"Full Name")
	            ->setCellValue('D1',"UserState")
	            ->setCellValue('E1',"DoB")
				->setCellValue('F1',"SurgeryDate")
	            ->setCellValue('G1',"Age")
	            ->setCellValue('H1',"Proc01")
	            ->setCellValue('I1',"Proc02")
	            ->setCellValue('J1',"Proc03")
	            ->setCellValue('K1',"Proc04")
	            ->setCellValue('L1',"Proc05")
	            ->setCellValue('M1',"Proc06")
	            ->setCellValue('N1',"Proc07")
	            ->setCellValue('O1',"Proc08")
	            ->setCellValue('P1',"Proc09")
	            ->setCellValue('Q1',"Proc10")
	            ->setCellValue('R1',"Proc11")
	            ->setCellValue('S1',"Proc12")
	            ->setCellValue('T1',"Proc13")
	            ->setCellValue('U1',"Proc14")
	            ->setCellValue('V1',"Proc15")
	            ->setCellValue('W1',"Proc16")
	            ->setCellValue('X1',"Proc17")
	            ->setCellValue('Y1',"Proc18")
	            ->setCellValue('Z1',"Proc19")
	            ->setCellValue('AA1',"Proc20")
	            ->setCellValue('AB1',"Proc21")
	            ->setCellValue('AC1',"Proc22")
	            ->setCellValue('AD1',"Proc23")
	            ->setCellValue('AE1',"Proc24")
	            ->setCellValue('AF1',"Proc25")
	            ->setCellValue('AG1',"Proc26")
	            ->setCellValue('AH1',"Proc27")
				->setCellValue('AI1',"Number of procedures");
	          


// ADD DATA FROM MYSQL  
     $i=1;
	 $total_procedures_count=array();
	 
     foreach($results as $m_data) {

                  $Proc_codes=array();
                  for($p=1;$p<=27;$p++){ 
                  	 if($p<=9) { $p1="0".$p;  }else { $p1=$p; }
                    
                    if(!empty($m_data["Proc".$p1])) {
                    	 $Proc[$p1][]=$m_data["Proc".$p1];
						  $Proc_codes[]=$m_data["Proc".$p1];
						  $total_procedures_count[]=$m_data["Proc".$p1];
                    }
                  }

             $i++;
			$proc_total=0;
			if(!empty($Proc_codes)) {
				$proc_total=count($Proc_codes);
			}
			
			
             $objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('A'.$i, $m_data["ID"])
	            ->setCellValue('B'.$i, $m_data["user_id"])
	            ->setCellValue('C'.$i,$m_data["Full_name"])
	            ->setCellValue('D'.$i,$m_data["UserState"])
	            ->setCellValue('E'.$i,$m_data["DoB"])
			    ->setCellValue('F'.$i,$m_data["SurgeryDate"])
	            ->setCellValue('G'.$i,$m_data["age"])
	            ->setCellValue('H'.$i, $m_data["Proc01"])
	            ->setCellValue('I'.$i,$m_data["Proc02"])
	            ->setCellValue('J'.$i,$m_data["Proc03"])
	            ->setCellValue('K'.$i,$m_data["Proc04"])
	            ->setCellValue('L'.$i,$m_data["Proc05"])
	            ->setCellValue('M'.$i,$m_data["Proc06"])
	            ->setCellValue('N'.$i,$m_data["Proc07"])
	            ->setCellValue('O'.$i,$m_data["Proc08"])
	            ->setCellValue('P'.$i,$m_data["Proc09"])
	            ->setCellValue('Q'.$i,$m_data["Proc10"])
	            ->setCellValue('R'.$i,$m_data["Proc11"])
	            ->setCellValue('S'.$i,$m_data["Proc12"])
	            ->setCellValue('T'.$i,$m_data["Proc13"])
	            ->setCellValue('U'.$i,$m_data["Proc14"])
	            ->setCellValue('V'.$i,$m_data["Proc15"])
	            ->setCellValue('W'.$i,$m_data["Proc16"])
	            ->setCellValue('X'.$i,$m_data["Proc17"])
	            ->setCellValue('Y'.$i,$m_data["Proc18"])
	            ->setCellValue('Z'.$i,$m_data["Proc19"])
	            ->setCellValue('AA'.$i,$m_data["Proc20"])
	            ->setCellValue('AB'.$i,$m_data["Proc21"])
	            ->setCellValue('AC'.$i,$m_data["Proc22"])
	            ->setCellValue('AD'.$i,$m_data["Proc23"])
	            ->setCellValue('AE'.$i,$m_data["Proc24"])
	            ->setCellValue('AF'.$i,$m_data["Proc25"])
	            ->setCellValue('AG'.$i,$m_data["Proc26"])
	            ->setCellValue('AH'.$i,$m_data["Proc27"])
				->setCellValue('AI'.$i,$proc_total);
	         
            } 
			

$index=$i+2;
$cell_position='AC'.$index.':AH'.$index;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells($cell_position);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$index,"Total Number of procedures");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.$index,count($total_procedures_count));


$cell_index=$i+3;
$cell_position='E'.$cell_index.':H'.$cell_index;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells($cell_position);
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$cell_index,'CALCULATION'); 
$cell_index=$cell_index+1;
$cell_position='E'.$cell_index.':H'.$cell_index;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells($cell_position);
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$cell_index,'Number of patients');
$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$cell_index,count($results));

/*$total_procedures=0;
for($p22=1;$p22<=1;$p22++){ 

  	 if($p22<=9) { $p2="0".$p22;  }else { $p2=$p22; }
		$cell_index=$cell_index+1;
		$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$cell_index,'Number of Proc'.$p2);
		if(!empty($Proc[$p2])){
			$total_procedures+=count($Proc[$p2]);
		$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$cell_index,count($Proc[$p2]));
     }else {
     	$objPHPExcel->getActiveSheet(0)->setCellValue('F'.$cell_index,'0');
     }
  }
*/
$cell_index=$cell_index+1;
$cell_position='E'.$cell_index.':H'.$cell_index;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells($cell_position);
$objPHPExcel->getActiveSheet(0)->setCellValue('E'.$cell_index,'Total Number of Procedures');
$objPHPExcel->getActiveSheet(0)->setCellValue('I'.$cell_index,count($total_procedures_count));
$objPHPExcel->getActiveSheet()->freezePane('A2');

$objPHPExcel->getActiveSheet()->setTitle('The ACP SS Audit Tool');
$objPHPExcel->setActiveSheetIndex(0);
$show_record=$start_age."-".$end_age;
$filename="Acpage".$show_record.".xls";
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


 include('header.php'); ?>
<?php



$head = 'true';
if(in_array($current_user,$config['admin'])){
  $head = '';
}elseif($user_id != $current_user && !in_array($current_user,$config['admin'])){ 
 header('location:dashboard.php'); exit; 
}

	?>
     <div class="row-fluid age-report-form" style='float:left;padding:15px;'>
            <form name="age-report-form" method="post" >
                <div class="span3"> 
                	    <label> Start Age (min) : </label>
                        <select name="start_age" class="start_age input-large span12 chosen-select">
	                        <?php 
	                             
	                             for($i=1;$i<=100;$i++) {
	                             	 if($start_age==$i) { 
	                             	  echo "<option  selected value=".$i.">".$i."</option>";
	                                 }else {
	                                 	 echo "<option   value=".$i.">".$i."</option>";
	                                 } 
	                             }
	                        ?>
                        </select>
                     
                </div>

                 <div class="span3"> 
                 	     <label> End Age (max)  : </label>
                        <select name="end_age" class="end_age input-large span12 chosen-select">
	                        <?php 
	                             for($i=1;$i<=100;$i++) {
	                             	if($end_age==$i) { 
	                             	  echo "<option  selected value=".$i.">".$i."</option>";
	                                 }else {
	                                 	 echo "<option   value=".$i.">".$i."</option>";
	                                 } 
	                            }
	                        ?>
                        </select>
                     
                </div>
                <div class="span3"> 
                 	     <label> Year : </label>
                        <select name="year" class="end_age input-large span12 chosen-select">
	                        <?php 
	                             for($i=1800;$i<=date('Y');$i++) {
	                             	if($year==$i) { 
	                             	  echo "<option  selected value=".$i.">".$i."</option>";
	                                 }else {
	                                 	 echo "<option   value=".$i.">".$i."</option>";
	                                 } 
	                            }
	                        ?>
                        </select>
                     
                </div>


                     <div class="span3"> 
                 	     <label style='color:transparent;'> Report by Excel:</label>
                        <input type="submit" name="get_report"  value="Submit" class="btn btn-info span4" style='float:left;'/> 
                         <?php if(isset($_REQUEST["get_report"]) || isset($_REQUEST["ft"]) ) {   ?>  
                         <input type="submit" name="ft"  value="Excel" class="btn btn-info span4" style='float:left;margin-left:10px;'/> 
                         <?php } ?>
                     </div>
                    
                  

            </form>


     </div>

      <?php if(isset($_REQUEST["get_report"])) {  ?>
		<div class="row-fluid sortable" style="background:#f9f9f9;">		
				<div class="box span12">
						<div class="box-header well" data-original-title>
							<h2><i class="icon-user">User Report By Age</i></h2>
						</div>
     				<div class="box-content">
                         <form id="delete_control" action="<?php echo 'user_records.php?user='.$user_id.'&action=view' ?>" method="post">
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
							  <thead>
								  <tr>
									  <th>Full Name</th>
									  <th>User State</th>
									  <th>Proc01</th>
									  <th>DoB</th>
									  <th>Age</th>
								  </tr>
							  </thead>   
							  <tbody>
								<?php
									if(!empty($results)){
									foreach($results as $record){
									$status = ($record['is_active'] == 1) ? '1' : '0';
									 echo "<tr class='".$status."'>
										  <td><!--<input type='checkbox' value='".$record['ID']."' name='delete_control[]' class='delete_this' />-->".$record['Full_name']."</td>
										  <td>".$record["UserState"]."</td>
										  <td>".$record["Proc01"]."</td>
										  <td>".$record["DoB"]."</td>
										  <td class='center'>".$record["age"]."</td>
										 </tr>"; 
								  }
								
								}
								?>
							  </tbody>
						  </table>  
                          </form>         
						</div>
				</div><!--/span-->
			</div><!--/row-->
	
 <?php }  ?>		
<?php include('footer.php'); ?>