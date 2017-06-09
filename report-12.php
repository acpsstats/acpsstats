<?php 
include('header.php'); 
if(!isset($_SESSION['user_id']) || intval($_SESSION['user_id']) == 0) { header("location:login.php");}
global $db;

$type =  isset($_REQUEST['type']) ? trim($_REQUEST['type']) : "";
$from = isset($_REQUEST['from']) ? $_REQUEST['from'] : "";
$to = isset($_REQUEST['to']) ? $_REQUEST['to'] : "";
$user = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
if(!($from && $to)) { die("Please choose the duration");}
$fromdate_r = explode("/", $from);
$fromdate_r = array_reverse($fromdate_r);
$fromdate_r = implode("-", $fromdate_r);
$todate_r = explode("/", $to);
$todate_r = array_reverse($todate_r);
$todate_r = implode("-", $todate_r);
$procode =  isset($_REQUEST['codepro']) ? trim($_REQUEST['codepro']) : "";

$exclude_user=$config["exclude"];
if(!empty($exclude_user))  $query='  AND tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';


switch($type){
	  case 'user'  :
	  	 
			$sql  = "SELECT 
						Count(tblmasterpoddata.ID) AS CountOfID, 
						ROUND (Avg(If(SeparationDate=AdmissionDate,1,SeparationDate-AdmissionDate)),2) AS ALOS_Unvntfl, 
						tblmasterpoddata.Proc01,  
						r_icd10am_procedure_codes.Description					
						FROM tblmasterpoddata 
						LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
					    WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 1  AND 
						  (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 
						  tblmasterpoddata.user_id='$user_id'  AND 
						  tblmasterpoddata.Validated= 1  AND tblmasterpoddata.Proc01 != '' 
					 GROUP BY tblmasterpoddata.Proc01"; 
					 
					 
			break;

		case 'all':		
				$sql  = "SELECT 
						Count(tblmasterpoddata.ID) AS CountOfID, 
						ROUND (Avg(If(SeparationDate=AdmissionDate,1,SeparationDate-AdmissionDate)),2) AS ALOS_Unvntfl, 
						tblmasterpoddata.Proc01,  
						r_icd10am_procedure_codes.Description					
						FROM tblmasterpoddata 
						LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
					    WHERE
						  (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 						
						  tblmasterpoddata.Validated= 1  AND tblmasterpoddata.Proc01 != ''   AND tblmasterpoddata.PDx!=''   {$query} {$query_condition}   
					 GROUP BY tblmasterpoddata.Proc01"; 
				
					
			break;

		default: 
			$sql  = "SELECT 
						Count(tblmasterpoddata.ID) AS CountOfID, 
						ROUND (Avg(If(SeparationDate=AdmissionDate,1,SeparationDate-AdmissionDate)),2) AS ALOS_Unvntfl, 
						tblmasterpoddata.Proc01,  
						r_icd10am_procedure_codes.Description					
						FROM tblmasterpoddata 
						LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
					    WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 1  AND 
						  (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 						
						  tblmasterpoddata.Validated= 1  AND tblmasterpoddata.Proc01 != ''   AND tblmasterpoddata.PDx!=''    {$query} {$query_condition}
					 GROUP BY tblmasterpoddata.Proc01"; 
		break;
		
	}
	
$result_data = $db->fetch_all_array($sql);
?>
<div class="row-fluid">
	<div class="report-wrapper report-gen">
   		<div class="r-heading">	
			<h2>Reports 12 - Day Surgery Outcomes</h2>
			<?php if($type != "all"): ?>
				<h3>UserName <?php echo $user;?></h3>
				<?php else: ?>
				<h3>TOTAL PRACTICE</h3>	
			<?php endif;?>	
		</div>
		<div class="r-sub-heading">		
			<h5>Validated Records Only</h5>
			<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>
		</div>	
		<div class="span12 report-section">
			<table style="width:100%; vertical-align:middle; text-align:center; ">
				<tr><th>Count</th><!--<th>ALOS(Days)</th>--><th>Procedure Code</th><th>Description</th></tr> 
				<?php if(!empty($result_data)): ?>
             	 
				<?php foreach($result_data as $item) :
				 if($item['ALOS_Unvntfl'] > 0 ){ ?>
					<tr>
							<td><?php echo $item['CountOfID'];?></td>							
							<!--<td><?php  echo round($item['ALOS_Unvntfl']);?></td>-->
                            <td><?php echo $item['Proc01'];?></td>
                            <td><?php echo $item['Description'];?></td>
					</tr>
                  <?php }  ?>  
				<?php endforeach;?>
				<?php endif;?>
			</table>
	   </div>
    
	</div>
</div>
<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<?php include('footer.php'); ?>