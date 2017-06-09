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
if(!empty($exclude_user))  $query='  AND tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';



switch($type){
	case 'all' :
		$sql = "SELECT mktbcomplications.Complication,mktbcomplications.pod_id, r_complications.Complication_description, mktblproccodes_forrpt08.Proc,
		        r_icd10am_procedure_codes.Description, mktbcomplications.ID,tblmasterpoddata.SurgeryDate,tblmasterpoddata.Validated
				FROM (((mktbcomplications INNER JOIN (mktblproccodes_forrpt08 INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) 
				ON mktbcomplications.pod_id = mktblproccodes_forrpt08.pod_id)INNER JOIN r_complications ON  cast(mktbcomplications.Complication as decimal(4,2)) =cast( r_complications.Complication_code as  decimal(4,2))) 
                INNER JOIN tblmasterpoddata ON tblmasterpoddata.ID=mktbcomplications.pod_id)
				WHERE (tblmasterpoddata.Validated=1) AND   mktblproccodes_forrpt08.order_index=1 AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r')  {$query} {$query_condition}
				   ORDER BY mktbcomplications.Complication, mktblproccodes_forrpt08.Proc";

		break;

	case 'user'  :
			$sql = "SELECT mktbcomplications.ID,mktbcomplications.pod_id, mktbcomplications.Complication, r_complications.Complication_description,
			mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description,tblmasterpoddata.SurgeryDate,tblmasterpoddata.Validated
			FROM (((mktbcomplications INNER JOIN (mktblproccodes_forrpt08 INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) ON mktbcomplications.pod_id = mktblproccodes_forrpt08.pod_id) 
			INNER JOIN r_complications ON cast(r_complications.Complication_code as decimal(4,2))=cast(mktbcomplications.Complication  as decimal(4,2))) INNER JOIN  tblmasterpoddata ON tblmasterpoddata.ID=mktbcomplications.pod_id)
			WHERE tblmasterpoddata.user_id='$user_id' AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND tblmasterpoddata.Validated=1
			 AND   mktblproccodes_forrpt08.order_index=1 GROUP BY r_complications.Complication_code ORDER BY mktbcomplications.ID";
  	/* $sql = "SELECT mktbcomplications.ID, mktbcomplications.Complication, r_complications.Complication_description, mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description, mktbcomplications.UserState, mktbcomplications.UserName, mktbcomplications.SurgeryDate

		FROM (mktbcomplications INNER JOIN (mktblproccodes_forrpt08 INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) ON mktbcomplications.ID = mktblproccodes_forrpt08.ID) INNER JOIN r_complications ON mktbcomplications.Complication = r_complications.Complication_code

		WHERE (((mktbcomplications.user_id)='$user_id') AND ((mktbcomplications.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((mktbcomplications.Validated)=True))

		ORDER BY mktbcomplications.ID, mktbcomplications.Complication, mktblproccodes_forrpt08.Proc";
		*/

		break;

	case 'admin' :
	
	
	   break;

	default: 

		 $sql = "SELECT mktbcomplications.ID,mktbcomplications.pod_id,mktbcomplications.Complication, r_complications.Complication_description, mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description, mktbcomplications.UserState, mktbcomplications.UserName,mktbcomplications.user_id, mktbcomplications.SurgeryDate

				FROM (mktbcomplications INNER JOIN (mktblproccodes_forrpt08 INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) ON mktbcomplications.ID = mktblproccodes_forrpt08.ID) INNER JOIN r_complications ON cast(mktbcomplications.Complication as decimal(4,2)) = cast(r_complications.Complication_code as decimal(4,2))

				WHERE (tblmasterpoddata.user_id='$userid') AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND (tblmasterpoddata.Validated=1) AND   mktblproccodes_forrpt08.order_index=1 

				ORDER BY mktbcomplications.ID, mktbcomplications.Complication, mktblproccodes_forrpt08.Proc";

		break;

}



$result_data = $db->fetch_all_array($sql);
/*if($_SERVER['REMOTE_ADDR']=='114.69.235.39'):

	print_r($sql);
	
	echo "<pre>";
	  print_r($result_data);
	echo "</pre>";

endif;*/

?>

<div class="row-fluid">

	<div class="report-wrapper report-gen">

	<div class="r-heading">	

		<h2>Reports 09</h2>

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

			<h2>All Procedures by Complication by Date Range</h2>

		<?php else: ?>

			<h3>TOTAL PRACTICE - All Procedures by comorbidities by Date Range</h3>	

		<?php endif;?>

		<h5>Validated Records Only</h5>

		<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>

	</div>	

	<div class="span12 report-section">

		<table>

			<?php $total_no_of_procedure = 0;

				  $liste = array(); ?>

			<?php if(!empty($result_data)):
			 ?>

			<tr><th>Complication Code</th><th>Description</th><th>Procedure Code & Description</th><th>Case ID</th></tr>

			<?php foreach($result_data as $item) : ?>

				<tr><td><?php echo $item['Complication'];?></td><td><?php echo $item['Complication_description'];?></td><td><?php echo $item['Proc']." ".$item['Description'];?></td><td><?php echo $item['pod_id']; ?></td></tr>

				<?php $total_no_of_procedure = $total_no_of_procedure + $item['Complication'];

				array_push($liste, $item['ID']); ?>

			<?php endforeach;?>

			<?php 

			$uni_ary=array_unique($liste);

           
			 ?>

			<?php if($type != "all"): ?>
			<tr><td>&nbsp;</td><td>Count of Procedures for Complication Code: </td><td><?php echo count($result_data);?></td><td>&nbsp;</td></tr>

			<tr><td>&nbsp;</td><td>Total number of Unique Complication Codes: </td><td><?php echo count($uni_ary);?></td><td>&nbsp;</td></tr>

			<tr><td>&nbsp;</td><td>Total number of Procedures: </td><td><?php echo $total_no_of_procedure;?></td><td>&nbsp;</td></tr>

			<?php else: ?>

			<tr><td>&nbsp;</td><td>Total number of Complication Codes: </td><td><?php echo count($result_data);?></td><td>&nbsp;</td></tr>

			<tr><td>&nbsp;</td><td>Total number of Cases: </td><td><?php echo count($uni_ary);?></td><td>&nbsp;</td></tr>
			<?php endif;endif;?>
		</table>

	</div>

	</div>

</div>

<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>

<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>

<?php include('footer.php'); ?>