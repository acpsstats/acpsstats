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
if(!empty($exclude_user))  $query=' where tblmasterpoddata.Validated=1 AND tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';



switch($type){

	case 'user'  :
	          $sql  = "SELECT mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description,

					mktbcomorbidities.Comorbidity, r_comorbidity.ComorbidityDesc, Count(mktbcomorbidities.ID) AS CountOfID,
					tblmasterpoddata.UserState, tblmasterpoddata.SurgeryDate 
					FROM ((((mktbcomorbidities INNER JOIN r_comorbidity ON mktbcomorbidities.Comorbidity = r_comorbidity.ComorbidityCode) 
					INNER JOIN mktblproccodes_forrpt08 ON mktbcomorbidities.ID = mktblproccodes_forrpt08.ID) 
					INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) 
                    INNER JOIN tblmasterpoddata ON tblmasterpoddata.ID=mktbcomorbidities.pod_id) WHERE tblmasterpoddata.Validated=1 AND tblmasterpoddata.user_id='$user_id' AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r')
					GROUP BY mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description, mktbcomorbidities.Comorbidity, 
					r_comorbidity.ComorbidityDesc ORDER BY mktblproccodes_forrpt08.Proc, mktbcomorbidities.Comorbidity";
		 break;

	case 'admin' :

		$sql = "SELECT mktblproccodes_forrpt08.Proc,r_icd10am_procedure_codes.Description, mktbcomorbidities.Comorbidity, 

		r_comorbidity.ComorbidityDesc, Count(mktbcomorbidities.ID) AS CountOfID,tblmasterpoddata.UserState, tblmasterpoddata.SurgeryDate 
	
		FROM ((((mktbcomorbidities INNER JOIN r_comorbidity ON mktbcomorbidities.Comorbidity = r_comorbidity.ComorbidityCode)

		 INNER JOIN mktblproccodes_forrpt08 ON mktbcomorbidities.ID = mktblproccodes_forrpt08.ID) 

		INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) 

		INNER JOIN tblmasterpoddata ON tblmasterpoddata.ID=mktbcomorbidities.pod_id)

		WHERE tblmasterpoddata.Validated=1 AND tblmasterpoddata.user_id='$user_id' AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') GROUP BY mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description, mktbcomorbidities.Comorbidity, r_comorbidity.ComorbidityDesc, 

		 tblmasterpoddata.UserState, tblmasterpoddata.SurgeryDate  ORDER BY mktblproccodes_forrpt08.Proc, mktbcomorbidities.Comorbidity";

		break;

	case 'all':	
	             
				 $sql  = "SELECT mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description,

					mktbcomorbidities.Comorbidity, r_comorbidity.ComorbidityDesc, Count(mktbcomorbidities.ID) AS CountOfID,
					tblmasterpoddata.UserState, tblmasterpoddata.SurgeryDate 
					FROM ((((mktbcomorbidities INNER JOIN r_comorbidity ON mktbcomorbidities.Comorbidity = r_comorbidity.ComorbidityCode) 
					INNER JOIN mktblproccodes_forrpt08 ON mktbcomorbidities.ID = mktblproccodes_forrpt08.ID) 
					INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) 
                    INNER JOIN tblmasterpoddata ON tblmasterpoddata.ID=mktbcomorbidities.pod_id) {$query}  {$query_condition} 
					GROUP BY mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description, mktbcomorbidities.Comorbidity, 
					r_comorbidity.ComorbidityDesc ORDER BY mktblproccodes_forrpt08.Proc, mktbcomorbidities.Comorbidity";
	
	break; 	

	default: 

					$sql  = "SELECT mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description,

					mktbcomorbidities.Comorbidity, r_comorbidity.ComorbidityDesc, Count(mktbcomorbidities.ID) AS CountOfID,
					tblmasterpoddata.UserState, tblmasterpoddata.SurgeryDate 
					FROM ((((mktbcomorbidities INNER JOIN r_comorbidity ON mktbcomorbidities.Comorbidity = r_comorbidity.ComorbidityCode) 
					INNER JOIN mktblproccodes_forrpt08 ON mktbcomorbidities.ID = mktblproccodes_forrpt08.ID) 
					INNER JOIN r_icd10am_procedure_codes ON mktblproccodes_forrpt08.Proc = r_icd10am_procedure_codes.ICD_10) 
                    INNER JOIN tblmasterpoddata ON tblmasterpoddata.ID=mktbcomorbidities.pod_id)  {$query}  {$query_condition} 
					GROUP BY mktblproccodes_forrpt08.Proc, r_icd10am_procedure_codes.Description, mktbcomorbidities.Comorbidity, 
					r_comorbidity.ComorbidityDesc ORDER BY mktblproccodes_forrpt08.Proc, mktbcomorbidities.Comorbidity";

		break;

}

$result_data = $db->fetch_all_array($sql);



?>

<div class="row-fluid">

	<div class="report-wrapper report-gen">

		<div class="r-heading">	

			<h2>Reports 08</h2>

			<?php if($type != "all" && $type !=""): ?>

				<h3>UserName <?php echo $user;?></h3>

				<h3>State <?php echo $user;?></h3>

				<?php else: ?>

				<h3>TOTAL PRACTICE</h3>	

			<?php endif;?>	

		</div>

		<div class="r-sub-heading">

			<h2>All Comorbidities by Procedure by Date Range</h2>

			<h5>Validated Records Only</h5>

			<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>

		</div>	

		<div class="span12 report-section">

			<table>

				<tr><th>Procedure Code</th><th style="text-align:right;">Comorbidity Code & Description</th><th>Count</th></tr>

				<?php if(!empty($result_data)):  ?>

				<?php $last_proc = ""; ?>

				<?php foreach($result_data as $item) : ?>

					<?php if($last_proc != $item['Proc']) : ?>

					<tr><td style="text-align:right;"><?php echo $item['Proc'];?></td><td style="text-align:right;"><?php echo $item['Description'];?></td><td><?php echo $item['CountOfID'];?></td></tr>

					<?php $last_proc = $item['Proc']; endif; ?>

					<tr><td>&nbsp;</td><td style="text-align:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $item['Comorbidity'];?>&nbsp;&nbsp;&nbsp;<?php echo $item['ComorbidityDesc'];?></td><td>&nbsp;</td></tr>

				<?php endforeach;?>

				<?php endif;?>

			</table>

	   </div>	

	</div>

</div>

<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>

<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>

<?php include('footer.php'); ?>