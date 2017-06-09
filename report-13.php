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



if($procode != ''){
	
	switch($type){
	  case 'user'  :
	  	 if($procode != 'all') {
					/*$sql  = "SELECT 
					Count(tblmasterpoddata.ID) AS CountOfID, 
					ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 						
					tblusers.UserState AS Expr2				 
					FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 0  AND 
					((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 
					(tblmasterpoddata.UserName)='$user'  AND 
					(tblmasterpoddata.Validated)= 1 AND 
					tblmasterpoddata.Proc01  = '".$procode."'
					GROUP BY tblusers.UserState"; */
						 
						$sql  = "SELECT 
						Count(tblmasterpoddata.ID) AS CountOfID, 
						ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 						
						tblusers.UserState AS Expr2				 
						FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
						WHERE (tblmasterpoddata.UserState) != ''  AND 
						((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 
						tblmasterpoddata.user_id='$user_id'  AND 
						tblmasterpoddata.Validated= 1 AND 
						tblmasterpoddata.Proc01  = '".$procode."'
						GROUP BY tblmasterpoddata.UserState"; 
		 }
			 
		else {	 
					/*$sql  = "SELECT Count(tblmasterpoddata.ID) AS CountOfID, ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl
					tblusers.UserState AS Expr2				 
					FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 0  AND 
					((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 
					(tblmasterpoddata.UserName)='$user'  AND 
					(tblmasterpoddata.Validated)= 1
					GROUP BY tblusers.UserState";*/
					 
					$sql  = "SELECT Count(tblmasterpoddata.ID) AS CountOfID, ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl
					tblusers.UserState AS Expr2				 
					FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					WHERE tblmasterpoddata.UserState != ''  AND 
					(tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 
					tblmasterpoddata.user_id='$user_id'  AND 
					tblmasterpoddata.Validated= 1
					GROUP BY tblmasterpoddata.UserState";
	}
					 
			break;
		case 'all':		
				if($procode != 'all') {
			     /* $sql  = "SELECT 
						Count(tblmasterpoddata.ID) AS CountOfID, 
						ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 						
						tblusers.UserState AS Expr2				 
						FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					 WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 0  AND 
						  ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 						
						  (tblmasterpoddata.Validated)= 1 AND 
						  tblmasterpoddata.Proc01  = '".$procode."'
					 GROUP BY tblusers.UserState"; */
					 
					$sql  = "SELECT 
					Count(tblmasterpoddata.ID) AS CountOfID, 
					ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 						
					tblmasterpoddata.UserState AS Expr2				 
					FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					WHERE tblmasterpoddata.UserState != '' AND 
					(tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 						
					tblmasterpoddata.Validated= 1 AND 
					tblmasterpoddata.Proc01  = '".$procode."'
					GROUP BY tblmasterpoddata.UserState";  
			 
				}
				else {		
					/*$sql  = "SELECT Count(tblmasterpoddata.ID) AS CountOfID,
									SeparationDate,AdmissionDate,
									ROUND (Avg(If(SeparationDate=AdmissionDate,1,false)),2) AS ALOS_Unvntfl, 									
									tblusers.UserState AS Expr2				 
						FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
							WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 0  AND 
								  ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND
								  tblmasterpoddata.Validated=1
							GROUP BY tblusers.UserState";*/

					
					$sql  = "SELECT Count(tblmasterpoddata.ID) AS CountOfID,
					SeparationDate,AdmissionDate,
					ROUND (Avg(If(SeparationDate=AdmissionDate,1,false)),2) AS ALOS_Unvntfl, 									
					tblusers.UserState AS Expr2				 
					FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					WHERE tblmasterpoddata.UserState != ''  AND   
					(tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND
					tblmasterpoddata.Validated=1  {$query}   {$query_condition}  
					GROUP BY tblusers.UserState";	

				}
			break;
		
		default: 
			
			if($procode != 'all') {
			/*$sql  = "SELECT
						Count(tblmasterpoddata.ID) AS CountOfID, 
						ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 					
						tblusers.UserState AS Expr2				 
						FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					 WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 0  AND 
						  ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 
						  (tblmasterpoddata.UserName)='$user'  AND 
						  (tblmasterpoddata.Validated)= 1 AND 
						  tblmasterpoddata.Proc01  = '".$procode."'
					 GROUP BY tblusers.UserState"; */
					$sql  = "SELECT
					Count(tblmasterpoddata.ID) AS CountOfID, 
					ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 					
					tblusers.UserState AS Expr2				 
					FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					WHERE tblmasterpoddata.UserState != ''   AND 
					(tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') AND 
					tblmasterpoddata.user_id='$user_id'  AND 
					tblmasterpoddata.Validated= 1 AND 
					tblmasterpoddata.Proc01  = '".$procode."'
					GROUP BY tblmasterpoddata.UserState"; 
			 
			}
		else {	 
		  /*  $sql  = "SELECT 
						  Count(tblmasterpoddata.ID) AS CountOfID,  
						  ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 						 
						  tblusers.UserState AS Expr2				 
						FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					 WHERE (tblmasterpoddata.DaySurgOutcome1_1_UnvntflDisch) = 0  AND 
						   ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 
						   (tblmasterpoddata.UserName)='$user'  AND 
						   (tblmasterpoddata.Validated)= 1 
					 GROUP BY tblusers.UserState";*/
					 
			$sql  = "SELECT 
						  Count(tblmasterpoddata.ID) AS CountOfID,  
						  ROUND (Avg(If(SeparationDate=AdmissionDate,1,DATEDIFF(SeparationDate,AdmissionDate))),2) AS ALOS_Unvntfl, 						 
						  tblusers.UserState AS Expr2				 
						FROM tblmasterpoddata LEFT JOIN tblusers ON tblmasterpoddata.user_id = tblusers.user_id
					 WHERE   (tblmasterpoddata.UserState) != ''  AND 
						   ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r') AND 
						   (tblmasterpoddata.UserName)='$user'  AND 
						   (tblmasterpoddata.Validated)= 1 
					 GROUP BY tblmasterpoddata.UserState";
					 
		}
		break;
	}


	$result_data = $db->fetch_all_array($sql);
	
   /*	
	if($_SESSION['user_id']==2) :
	  echo $sql;
	  echo "<pre>"; print_r($result_data); echo "</pre>";
 	endif;*/
	
}

?>
<div class="row-fluid">
	<div class="report-wrapper report-gen">
     <?php if($procode == ''){ ?>     
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
	<?php } else {  ?>
    
		<div class="r-heading">	
			<h2>Reports 13 - Average Length of Stay 
					<?php  if($procode != 'all') echo ' - '.$procode; ?> 
            
            </h2>
			<?php if($type != "all"): ?>
				<h3>UserName <?php echo $user;?></h3>
				<?php else: ?>
				<h3>TOTAL PRACTICE</h3>	
			<?php endif;?>	
		</div>
		<div class="r-sub-heading">
			<h2>Average Length of Stay</h2>
			<h5>Validated Records Only</h5>
			<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>
		</div>	
		<div class="span12 report-section">
			<table style="width:100%; vertical-align:middle; text-align:center; ">
				<tr><th>Count</th><th>State</th><th>ALOS(Days)</th></tr>
				<?php if(!empty($result_data)): ?>
             	 
				<?php foreach($result_data as $item) : ?>
					<tr>
							<td><?php echo $item['CountOfID'];?></td>
							<td><?php echo $item['Expr2'];?></td>
                            
							<td><?php if($item['ALOS_Unvntfl'] > 0 && $item['ALOS_Unvntfl'] < 1 ) 	
										echo 1;
									else
										echo round($item['ALOS_Unvntfl']);?></td>
					</tr>
				<?php endforeach;?>
				<?php endif;?>
			</table>
	   </div>
       <?php }	 ?>
	</div>
</div>
<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>
<?php include('footer.php'); ?>