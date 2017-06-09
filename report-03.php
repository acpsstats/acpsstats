<?php 
include('header.php'); 
if(!isset($_SESSION['user_id']) || intval($_SESSION['user_id']) == 0) { header("location:login.php");}
global $db;
$type =  isset($_REQUEST['type']) ? trim($_REQUEST['type']) : "";
$from = isset($_REQUEST['from']) ? $_REQUEST['from'] : "";
$to = isset($_REQUEST['to']) ? $_REQUEST['to'] : "";
$username = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
$user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : '';
if(!($from && $to)) { die("Please choose the duration");}
$fromdate_r = explode("/", $from);
$fromdate_r = array_reverse($fromdate_r);
$fromdate_r = implode("-", $fromdate_r);
$todate_r = explode("/", $to);
$todate_r = array_reverse($todate_r);
$todate_r = implode("-", $todate_r);
$procode = '';
if(!isset($_REQUEST['codepro']) || $_REQUEST['codepro'] == ''){
	$form = true;
}else{ $procode =  isset($_REQUEST['codepro']) ? trim($_REQUEST['codepro']) : "49848-00";
	$form = false; 
}	

$exclude_user=$config["exclude"];
if(!empty($exclude_user))  $query=' and  tblmasterpoddata.user_id NOT IN ('.$exclude_user.')'; else $query='';
if(!empty($config["exclude_condition"]))  $query_condition=$config["exclude_condition"]; else $query_condition='';


switch($type){
	case 'all' :
		/*$sql = "SELECT mktblproccodes.UserName, mktblproccodes.Proc01, Count(mktblproccodes.Proc01) AS CountProcs, r_icd10am_procedure_codes.Description
				FROM mktblproccodes INNER JOIN r_icd10am_procedure_codes ON mktblproccodes.Proc01 = r_icd10am_procedure_codes.ICD_10
				WHERE (((mktblproccodes.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((mktblproccodes.Validated)=True))
				GROUP BY mktblproccodes.UserName, mktblproccodes.Proc01, r_icd10am_procedure_codes.Description
				HAVING (((mktblproccodes.UserName)='$username') AND ((mktblproccodes.Proc01)='$procode'))
				ORDER BY mktblproccodes.Proc01";*/
		
		/*$sql = "SELECT mktblproccodes.UserState,
		        mktblproccodes.UserName,
		        mktblproccodes.pod_id, 
		        mktblproccodes.Proc01,  
		        r_icd10am_procedure_codes.Description
				FROM mktblproccodes 
				INNER JOIN 
				r_icd10am_procedure_codes 
				ON mktblproccodes.Proc01 = r_icd10am_procedure_codes.ICD_10
				WHERE (mktblproccodes.SurgeryDate Between '$fromdate_r' And '$todate_r') 
				AND (mktblproccodes.Validated=1) AND (mktblproccodes.Proc01='$procode')
				ORDER BY mktblproccodes.Proc01";
       */

	   $sql="SELECT tblmasterpoddata.UserState,count(tblmasterpoddata.UserState) as total_state,tblmasterpoddata.ID,tblmasterpoddata.Proc01,r_icd10am_procedure_codes.Description
	   FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
	   WHERE (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND  tblmasterpoddata.Validated=1  
	    AND tblmasterpoddata.Proc01='$procode'  {$query}  {$query_condition}  GROUP BY tblmasterpoddata.UserState,tblmasterpoddata.Proc01,r_icd10am_procedure_codes.Description  ORDER BY tblmasterpoddata.Proc01";
			
		break;
	case 'user'  :
		/*$sql = "SELECT mktblproccodes.UserName, mktblproccodes.Proc01, Count(mktblproccodes.Proc01) AS CountProcs, r_icd10am_procedure_codes.Description
				FROM mktblproccodes INNER JOIN r_icd10am_procedure_codes ON mktblproccodes.Proc01 = r_icd10am_procedure_codes.ICD_10
				WHERE (((mktblproccodes.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND ((mktblproccodes.Validated)=True))
				GROUP BY mktblproccodes.UserName, mktblproccodes.Proc01, r_icd10am_procedure_codes.Description
				HAVING (((mktblproccodes.UserName)='$username') AND ((mktblproccodes.Proc01)='$procode'))
				ORDER BY mktblproccodes.Proc01";*/
		
		
		/*$sql="SELECT mktblproccodes.UserState,mktblproccodes.UserName, mktblproccodes.Proc01, r_icd10am_procedure_codes.Description,r_icd10am_procedure_codes.Description
					  
					  FROM mktblproccodes INNER JOIN r_icd10am_procedure_codes ON mktblproccodes.Proc01 = r_icd10am_procedure_codes.ICD_10
					  WHERE (mktblproccodes.SurgeryDate Between '$fromdate_r' And '$todate_r') AND (mktblproccodes.Validated=1) AND 
 					  (mktblproccodes.user_id='$user_id') AND mktblproccodes.Proc01='$procode'  ORDER BY mktblproccodes.Proc01;";  */

       $sql="SELECT tblmasterpoddata.UserState,count(tblmasterpoddata.UserState) as total_state,tblmasterpoddata.ID,tblmasterpoddata.Proc01,r_icd10am_procedure_codes.Description
	   FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
	   WHERE (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND  tblmasterpoddata.user_id='$user_id' AND
	   tblmasterpoddata.Validated=1  AND tblmasterpoddata.Proc01='$procode' GROUP BY tblmasterpoddata.UserState,tblmasterpoddata.Proc01,r_icd10am_procedure_codes.Description  ORDER BY tblmasterpoddata.Proc01";

	   break;

	case 'admin' :

	    break;
	    
	default: 
			
		   /*$sql = "SELECT mktblproccodes.UserState,mktblproccodes.UserName, mktblproccodes.Proc01,  r_icd10am_procedure_codes.Description
			FROM mktblproccodes INNER JOIN r_icd10am_procedure_codes ON mktblproccodes.Proc01 = r_icd10am_procedure_codes.ICD_10
			WHERE (((mktblproccodes.SurgeryDate) Between '$fromdate_r' And '$todate_r') 
			AND (((mktblproccodes.user_id)='$user_id') AND ((mktblproccodes.Proc01)='$procode')) AND ((mktblproccodes.Validated)=True))
			ORDER BY mktblproccodes.Proc01";*/

	   $sql="SELECT tblmasterpoddata.UserState,count(tblmasterpoddata.UserState) as total_state,tblmasterpoddata.ID,tblmasterpoddata.Proc01,r_icd10am_procedure_codes.Description
	   FROM tblmasterpoddata INNER JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01=r_icd10am_procedure_codes.ICD_10 
	   WHERE (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND  tblmasterpoddata.user_id='$user_id' AND
	   tblmasterpoddata.Validated=1  AND tblmasterpoddata.Proc01='$procode'  GROUP BY tblmasterpoddata.UserState,tblmasterpoddata.Proc01,r_icd10am_procedure_codes.Description ORDER BY tblmasterpoddata.Proc01";
				
		break;
}

$result_data = $db->fetch_all_array($sql);
?>
<div class="row-fluid">
	<div class="report-wrapper report-gen">
	
	<?php if(!$form){ ?> 
	<div class="r-heading">	
		<h2>Reports 03</h2>
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
			<h2>TOTAL PRACTICE - Count of all procedures by Date Range</h2>
		<?php else: ?>
			<h3>Count of all procedures by Date Range</h3>	
		<?php endif;?>
		<h5>Validated Records Only</h5>
		<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>
	</div>	
	<div class="span12 report-section">
		<table>
			<tr><th>Procedure</th><th>Description</th> <th>Count</th> <th width="20%">Userstate</th></tr>
			<?php 
            $total_no_of_procedure=0;
			if(!empty($result_data)): ?>
			<?php foreach($result_data as $item) :
                    $total_no_of_procedure+=$item['total_state'];
			 ?>
				<tr><td><?php echo $item['Proc01'];?></td><td><?php echo $item['Description'];?></td>
					<td><?php echo $item['total_state'];?></td> <td style='text-align:center'><?php echo $item['UserState'];?></td>
				</tr>
			<?php endforeach;?>
			<?php endif;?>
           
         <tr><td>&nbsp;</td><td>Total number of Procedures </td><td><?php echo $total_no_of_procedure;?></td></tr>
		</table>
	</div>
	</div> <?php } else { ?>
	<div class="" style="width:500px; margin:auto;">		
			<div class="get_form" style="float:left">
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
					<p>Please enter the a Procedure code format (nnnn-nn)</p>
					<input type="hidden" name="type" value="<?php echo $_REQUEST['type'] ?>" />
					<input type="hidden" name="from" value="<?php echo $_REQUEST['from'] ?>" />
					<input type="hidden" name="to" value="<?php echo $_REQUEST['to'] ?>" />
					<input type="text" name="codepro" value="" />	
					<input type="submit" name="enter" value="Submit" />
				</form>			
			</div>		
		</div>
	
	<?php } ?>
</div>
<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<?php include('footer.php'); ?>