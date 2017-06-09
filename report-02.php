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

$exclude_user=$config["exclude"];
if(!empty($exclude_user))  $query=' and  tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';



switch($type){
	case 'all' :
		
	/*	$sql = "SELECT tblmasterpoddata.UserState, Count(tblmasterpoddata.Proc01) AS CountProcs,tblmasterpoddata.Proc01,tblmasterpoddata.SurgeryDate,r_icd10am_procedure_codes.ICD_10, r_icd10am_procedure_codes.Description
		FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
		WHERE tblmasterpoddata.Validated= 1 AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r')  {$query} {$query_condition} 
		GROUP BY tblmasterpoddata.Proc01  ORDER BY tblmasterpoddata.Proc01";*/
		
		$sql = "SELECT count(tblmasterpoddata.Proc01) as CountProcs,r_icd10am_procedure_codes.Description,tblmasterpoddata.Proc01 as Proc01
		FROM tblmasterpoddata 
		INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
		WHERE
		tblmasterpoddata.Validated= 1 AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r')  {$query} {$query_condition} 
		GROUP BY  tblmasterpoddata.Proc01
		ORDER BY  tblmasterpoddata.Proc01 asc";
		
		break;
		
		
		
	case 'user'  :
	 
		/*$sql ="SELECT tblmasterpoddata.UserState, Count(tblmasterpoddata.Proc01) AS CountProcs,tblmasterpoddata.Proc01,tblmasterpoddata.SurgeryDate,r_icd10am_procedure_codes.ICD_10, 
		r_icd10am_procedure_codes.Description
		FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
		WHERE tblmasterpoddata.Validated= 1 AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 
		tblmasterpoddata.user_id= '$user_id'  GROUP BY tblmasterpoddata.Proc01  ORDER BY tblmasterpoddata.Proc01";*/
		
		
		$sql = "SELECT count(tblmasterpoddata.Proc01) as CountProcs,r_icd10am_procedure_codes.Description,tblmasterpoddata.Proc01 as Proc01
		FROM  tblmasterpoddata 
		INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
		WHERE
		tblmasterpoddata.Validated= 1 AND tblmasterpoddata.user_id= '$user_id' AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') 
		GROUP BY  tblmasterpoddata.Proc01 ORDER BY  tblmasterpoddata.Proc01 asc";
		break;
		
	case 'admin' :

		/*$sql = "SELECT tblmasterpoddata.Proc01, Count(tblmasterpoddata.Proc01) AS CountProcs,r_icd10am_procedure_codes.Description, tblmasterpoddata.UserName FROM tblmasterpoddata
		INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10 
		WHERE (((tblmasterpoddata.Validated)=True) AND ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r')) 
		AND tblmasterpoddata.user_id='$user_id'  GROUP BY tblmasterpoddata.Proc01  ORDER BY tblmasterpoddata.Proc01";*/
		
		
		$sql = "SELECT count(tblmasterpoddata.Proc01) as CountProcs,r_icd10am_procedure_codes.Description,tblmasterpoddata.Proc01 as Proc01
		FROM  tblmasterpoddata 
		INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
		WHERE
		tblmasterpoddata.Validated= 1 AND tblmasterpoddata.user_id= '$user_id' AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') 
		GROUP BY  tblmasterpoddata.Proc01 ORDER BY  tblmasterpoddata.Proc01 asc";
		break;

	default: 

		/*$sql  = "SELECT tblmasterpoddata.Proc01,Count(tblmasterpoddata.Proc01) AS CountProcs, r_icd10am_procedure_codes.Description
		FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
		WHERE (((tblmasterpoddata.Validated)=True) AND ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r'))  {$query}   {$query_condition}
		GROUP BY tblmasterpoddata.Proc01  ORDER BY tblmasterpoddata.Proc01";*/
		
		$sql = "SELECT count(tblmasterpoddata.Proc01) as CountProcs,r_icd10am_procedure_codes.Description,tblmasterpoddata.Proc01 as Proc01
		FROM  tblmasterpoddata 
		INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
		WHERE
		tblmasterpoddata.Validated= 1 AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r')  {$query} {$query_condition} 
		GROUP BY  tblmasterpoddata.Proc01
		ORDER BY  tblmasterpoddata.Proc01 asc";
		
		break;
}

$result_data = $db->fetch_all_array($sql);
?>
<div class="row-fluid">
	<div class="report-wrapper report-gen">
	<div class="r-heading">	
		<h2>Reports 02</h2>
		<?php if($type != "all" && $type !=""): ?>
			<h3>UserName <?php echo $user;?></h3>
			<?php else: ?>
			<h3>TOTAL PRACTICE</h3>	
		<?php endif;?>	
	</div>
	<div class="r-sub-heading">
		<h2>Count of all procedures by Date Range</h2>
		<h5>Validated Records Only</h5>
		<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>
	</div>	
	<div class="span12 report-section">
	<table>
		<?php $total_no_of_procedure = 0;?>
		<tr><th>Procedure</th><th>Description</th><th>Count</th></tr>
		<?php if(!empty($result_data)): ?>
		<?php foreach($result_data as $item) : ?>
			<tr><td><?php echo $item['Proc01'];?></td><td><?php echo $item['Description'];?></td><td><?php echo $item['CountProcs'];?></td></tr>
			<?php $total_no_of_procedure = $total_no_of_procedure + $item['CountProcs']; ?>
		<?php endforeach;?>
		<?php endif;?>
		<tr><td>&nbsp;</td><td>Total number of Procedures </td><td><?php echo $total_no_of_procedure;?></td></tr>
	</table>
   </div>
	
	</div>
</div>
<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<?php include('footer.php'); ?>