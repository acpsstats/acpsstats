<?php 
include('header.php'); 
if(!isset($_SESSION['user_id']) || intval($_SESSION['user_id']) == 0) { header("location:login.php");}
global $db;

$type =  isset($_REQUEST['type']) ? trim($_REQUEST['type']) : "";

$from = isset($_REQUEST['from']) ? $_REQUEST['from'] : "";

$to = isset($_REQUEST['to']) ? $_REQUEST['to'] : "";

$procode =  isset($_REQUEST['codepro']) ? trim($_REQUEST['codepro']) : "";

$username = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';


if(!($from && $to)) { die("Please choose the duration");}

$fromdate_r = explode("/", $from);
$fromdate_r = array_reverse($fromdate_r);
$fromdate_r = implode("-", $fromdate_r);

$todate_r = explode("/", $to);
$todate_r = array_reverse($todate_r);
$todate_r = implode("-", $todate_r);

$exclude_user=$config["exclude"];
if(!empty($exclude_user))  $query='  AND tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';


switch($type){
	case 'all' :
		$sql = "SELECT Count(tblmasterpoddata.ID) AS RecordCount, 
		Avg(If(tblmasterpoddata.AdmissionDate=tblmasterpoddata.SeparationDate,1,(tblmasterpoddata.SeparationDate-tblmasterpoddata.AdmissionDate))) AS ALOS, 
		tblmasterpoddata.Proc01, r_icd10am_procedure_codes.Description,tblmasterpoddata.UserName
		FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
		WHERE (((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((tblmasterpoddata.Validated)=True)) {$query} {$query_condition}
		GROUP BY tblmasterpoddata.Proc01, r_icd10am_procedure_codes.Description
		HAVING (((tblmasterpoddata.Proc01)='$procode'))";
		break;
	case 'user'  :
		$sql = "SELECT tblmasterpoddata.UserName, tblmasterpoddata.UserState, Count(tblmasterpoddata.ID) AS RecordCount, 
				Avg(If(tblmasterpoddata.AdmissionDate=tblmasterpoddata.SeparationDate,1,(tblmasterpoddata.SeparationDate-tblmasterpoddata.AdmissionDate))) AS ALOS,
				tblmasterpoddata.Proc01, 
				r_icd10am_procedure_codes.Description
				FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
				WHERE (((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((tblmasterpoddata.Validated)=True))
				GROUP BY tblmasterpoddata.UserName, tblmasterpoddata.UserState, tblmasterpoddata.Proc01, r_icd10am_procedure_codes.Description
				HAVING (((tblmasterpoddata.UserName)='$username') AND ((tblmasterpoddata.Proc01)='$procode'))";
		break;
	case 'admin' :
	
	    break;
	default: 
		$sql = "SELECT tblmasterpoddata.UserName, tblmasterpoddata.UserState, Count(tblmasterpoddata.ID) AS RecordCount, 
				Avg(If(tblmasterpoddata.AdmissionDate=tblmasterpoddata.SeparationDate,1,(tblmasterpoddata.SeparationDate-tblmasterpoddata.AdmissionDate))) AS ALOS,
				tblmasterpoddata.Proc01, 
				r_icd10am_procedure_codes.Description
				FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10
				WHERE (((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((tblmasterpoddata.Validated)=True)) {$query} {$query_condition}
				GROUP BY tblmasterpoddata.UserName, tblmasterpoddata.UserState, tblmasterpoddata.Proc01, r_icd10am_procedure_codes.Description
				HAVING (((tblmasterpoddata.UserName)='$username') AND ((tblmasterpoddata.Proc01)='$procode'))";
		break;
}
//echo $sql;
$result_data = $db->fetch_all_array($sql);
//echo "<pre>";print_r($result_data);echo "</pre>";
?>

<div class="row-fluid">
	<div class="report-wrapper report-gen">
	<div class="r-heading">	
		<h2>Reports 11</h2>
		<?php if($type != "all"): ?>
			<h3>UserName <?php echo $username;?></h3>
			<?php if(isset($result_data[0]['UserState'])): ?>
			<h3>State <?php echo $result_data[0]['UserState']; ?></h3>
			<?php endif; else: ?>
			<h3>TOTAL PRACTICE</h3>	
		<?php endif;?>
	</div>
	<div class="r-sub-heading">
		<?php if($type != "all"): ?>
			<h2>Average Length of Stay for Selected Principal Procedure by Date Range</h2>
		<?php else: ?>
			<h3>Average Length of Stay for Selected Principal Procedure by Date Range</h3>	
		<?php endif;?>
		<h5>Validated Records Only</h5>
		<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>
		<div class="date-range"><span>Principal Procedure:</span> <?php echo $procode;?><div>Removal of plantar want</div></div>
	</div>	
	<div class="span12 report-section">
		<table>
			<?php if(!empty($result_data)): ?>
			<tr><th>Record Count</th><th>Average Lenght of Stay (days)</th></tr>
			<?php foreach($result_data as $item) : ?>
				<tr><td><?php echo $item['RecordCount'];?></td><td><?php echo $item['ALOS'];?></td></tr>
			<?php endforeach;?>
			<?php endif;?>
		</table>
	</div>
	</div>
</div>
<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<?php include('footer.php'); ?>