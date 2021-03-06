<?php 

include('header.php'); 

if(!isset($_SESSION['user_id']) || intval($_SESSION['user_id']) == 0) { header("location:login.php");}

global $db;

$type =  isset($_REQUEST['type']) ? trim($_REQUEST['type']) : "";

$from = isset($_REQUEST['from']) ? $_REQUEST['from'] : "";

$to = isset($_REQUEST['to']) ? $_REQUEST['to'] : "";

$procode =  isset($_REQUEST['codepro']) ? trim($_REQUEST['codepro']) : "";

$username = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';

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

		$sql = "SELECT Count(mktbsdxcodes.Diags) AS Occurrences, r_icd10am_diagnosis_codes.ICD_Diag_Code, mktbsdxcodes.Diags, r_icd10am_diagnosis_codes.DiagnosisDesc

				FROM ((mktbsdxcodes INNER JOIN r_icd10am_diagnosis_codes ON mktbsdxcodes.Diags = r_icd10am_diagnosis_codes.ICD_Diag_Code) INNER JOIN tblmasterpoddata ON tblmasterpoddata.ID=mktbsdxcodes.pod_id)

				WHERE (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND (tblmasterpoddata.Validated=1) {$query}  {$query_condition}

				GROUP BY r_icd10am_diagnosis_codes.ICD_Diag_Code, mktbsdxcodes.Diags, r_icd10am_diagnosis_codes.DiagnosisDesc

				ORDER BY r_icd10am_diagnosis_codes.ICD_Diag_Code";


		

		break;

	case 'user'  :

		$sql = "SELECT  Count(mktbsdxcodes.Diags) AS Occurrences, mktbsdxcodes.Diags, r_icd10am_diagnosis_codes.DiagnosisDesc,tblmasterpoddata.UserState

				FROM ((mktbsdxcodes INNER JOIN r_icd10am_diagnosis_codes ON mktbsdxcodes.Diags = r_icd10am_diagnosis_codes.ICD_Diag_Code) INNER JOIN  tblmasterpoddata ON tblmasterpoddata.ID=mktbsdxcodes.pod_id)

				WHERE (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND tblmasterpoddata.Validated=1 AND tblmasterpoddata.user_id='$user_id'

				GROUP BY mktbsdxcodes.Diags,r_icd10am_diagnosis_codes.DiagnosisDesc, tblmasterpoddata.UserState
		        
		        ORDER BY mktbsdxcodes.Diags";


		break;

	case 'admin' :
	
	 break;

	default: 

		$sql = "SELECT  Count(mktbsdxcodes.Diags) AS Occurrences, mktbsdxcodes.Diags, r_icd10am_diagnosis_codes.DiagnosisDesc,tblmasterpoddata.UserState

				FROM mktbsdxcodes INNER JOIN r_icd10am_diagnosis_codes ON mktbsdxcodes.Diags = r_icd10am_diagnosis_codes.ICD_Diag_Code

				WHERE ((tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND (tblmasterpoddata.Validated=1) AND (tblmasterpoddata.user_id='$user_id')

				GROUP BY mktbsdxcodes.Diags, r_icd10am_diagnosis_codes.DiagnosisDesc, tblmasterpoddata.UserState

				ORDER BY mktbsdxcodes.Diags";

		break;

}

$result_data = $db->fetch_all_array($sql);

?>

<div class="row-fluid">

	<div class="report-wrapper report-gen">

	<div class="r-heading">	

		<h2>Reports 06</h2>

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

			<h2>Current User - All Secondary Diagnosis Codes - by Date Range</h2>

		<?php else: ?>

			<h3>TOTAL PRACTICE -All Secondary Diagnosis Codes - by Date Range</h3>	

		<?php endif;?>

		<h5>Validated Records Only</h5>

		<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>

	</div>	

	<div class="span12 report-section" style="width:100%; max-width:760px;">

		<table>

			<?php $total_no_of_procedure = 0;?>

			<tr><th  style="width:150px; text-align:right;">Diagnosis Code</th><th>Description</th><th>Count</th> 

				 <?php if($type != "all"): ?><th>UserState</th> <?php endif; ?>

			</tr>

			<?php if(!empty($result_data)): ?>

			<?php foreach($result_data as $item) : ?>

				<tr><td  style="width:150px; text-align:right;"><?php echo $item['Diags'];?></td><td style="text-align:right;"><?php echo $item['DiagnosisDesc'];?></td><td><?php echo $item['Occurrences'];?></td>
               
               <?php if($type != "all"): ?>
					  <td><?php echo $item['UserState'];?></td>
				<?php endif; ?>

				</tr>

				<?php $total_no_of_procedure = $total_no_of_procedure + $item['Occurrences']; ?>

			<?php endforeach;?>

			<?php endif;?>

			<tr><td>&nbsp;</td><td>Total number of Unique Secondary Diagnoses: </td><td><?php echo count(($result_data));?></td></tr>

			<tr><td>&nbsp;</td><td>Total number of Secondary Diagnoses: </td><td><?php echo $total_no_of_procedure;?></td></tr>

		</table>

	</div>

	</div>

</div>

<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>

<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>

<?php include('footer.php'); ?>



