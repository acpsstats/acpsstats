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



	case 'user'  :

		/*$sql  = "SELECT mktblproccodes.pod_id,mktblproccodes.UserState, r_facility.FacilityCode, r_facility.FacilityDescription,

		r_asacategory.ASADescription AS ASA_Category, mktblproccodes.AnaesthesiaType1, 

		mktblproccodes.AnaesthesiaType2, mktblproccodes.AnaesthesiaType3,

		Count(mktblproccodes.Proc01) AS CountProcs, mktblproccodes.Proc01 AS ProcCode, 

		r_icd10am_procedure_codes.Description AS Proc_Desc, r_previous_surgery.PreviousSurgeryCDescr,

		r_asacategory.ASACategory FROM 

		(((mktblproccodes LEFT JOIN r_icd10am_procedure_codes ON mktblproccodes.Proc01 = r_icd10am_procedure_codes.ICD_10)

		LEFT JOIN r_asacategory ON mktblproccodes.ASACategory = r_asacategory.ASACategory) 

		LEFT JOIN r_facility ON mktblproccodes.FacilityCode = r_facility.FacilityCode) 

		LEFT JOIN r_previous_surgery ON mktblproccodes.PrevSurgery = r_previous_surgery.PreviousSurgeryCode

		WHERE (mktblproccodes.Validated=1) AND  (mktblproccodes.user_id='$user_id') 

		AND (mktblproccodes.SurgeryDate Between '$fromdate_r' And '$todate_r')

		GROUP BY mktblproccodes.UserState, r_facility.FacilityCode, r_facility.FacilityDescription, 

		r_asacategory.ASADescription, mktblproccodes.AnaesthesiaType1, 

		mktblproccodes.AnaesthesiaType2, mktblproccodes.AnaesthesiaType3,

		mktblproccodes.Proc01, r_icd10am_procedure_codes.Description, 

		r_previous_surgery.PreviousSurgeryCDescr, r_asacategory.ASACategory

		ORDER BY r_facility.FacilityCode, r_asacategory.ASACategory, mktblproccodes.Proc01";*/



		$sql  = "SELECT tblmasterpoddata.ID,tblmasterpoddata.UserState, r_facility.FacilityCode, r_facility.FacilityDescription,

			r_asacategory.ASADescription AS ASA_Category, tblmasterpoddata.AnaesthesiaType1, 

			tblmasterpoddata.AnaesthesiaType2, tblmasterpoddata.AnaesthesiaType3,

			Count(tblmasterpoddata.Proc01) AS CountProcs, tblmasterpoddata.Proc01 AS ProcCode, 

			r_icd10am_procedure_codes.Description AS Proc_Desc, r_previous_surgery.PreviousSurgeryCDescr,

			r_asacategory.ASACategory FROM 

			(((tblmasterpoddata LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10)

			LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) 

			LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) 

			LEFT JOIN r_previous_surgery ON tblmasterpoddata.PrevSurgery = r_previous_surgery.PreviousSurgeryCode

			WHERE (tblmasterpoddata.Validated=1) AND  (tblmasterpoddata.user_id='$user_id') 

			AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r')

			GROUP BY tblmasterpoddata.UserState, r_facility.FacilityCode, r_facility.FacilityDescription, 

			r_asacategory.ASADescription, tblmasterpoddata.AnaesthesiaType1, 

			tblmasterpoddata.AnaesthesiaType2, tblmasterpoddata.AnaesthesiaType3,

			tblmasterpoddata.Proc01, r_icd10am_procedure_codes.Description, 

			r_previous_surgery.PreviousSurgeryCDescr, r_asacategory.ASACategory

			ORDER BY r_facility.FacilityCode, r_asacategory.ASACategory, tblmasterpoddata.Proc01";





		break;



	case 'admin' :



		$sql = " SELECT  tblmasterpoddata.UserState, r_facility.FacilityCode, r_facility.FacilityDescription, r_asacategory.ASADescription AS ASA_Category, 

		         tblmasterpoddata.AnaesthesiaType1, tblmasterpoddata.AnaesthesiaType2, tblmasterpoddata.UserName,.AnaesthesiaType3, 

		         Count(tblmasterpoddata.UserName,.Proc01) AS CountProcs, tblmasterpoddata.UserName,.Proc01 AS ProcCode, r_icd10am_procedure_codes.Description AS Proc_Desc, r_previous_surgery.PreviousSurgeryCDescr AS PreviousSurgery, 

		         r_asacategory.ASACategory FROM (((tblmasterpoddata.UserName, LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.UserName,.Proc01 = r_icd10am_procedure_codes.ICD_10) LEFT JOIN r_asacategory ON tblmasterpoddata.UserName,.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_facility ON tblmasterpoddata.UserName,.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_previous_surgery ON tblmasterpoddata.UserName,.PrevSurgery = r_previous_surgery.PreviousSurgeryCode WHERE (tblmasterpoddata.UserName,.Validated=1) AND tblmasterpoddata.UserName,.user_id='$user_id' AND (tblmasterpoddata.UserName,.SurgeryDate Between '$fromdate_r' And '$todate_r') 

                 GROUP BY  tblmasterpoddata.UserName,.UserState, r_facility.FacilityCode, r_facility.FacilityDescription, r_asacategory.ASADescription, tblmasterpoddata.UserName,.AnaesthesiaType1, 

                 tblmasterpoddata.UserName,.AnaesthesiaType2, tblmasterpoddata.UserName,.AnaesthesiaType3, tblmasterpoddata.UserName,.Proc01, r_icd10am_procedure_codes.Description, r_previous_surgery.PreviousSurgeryCDescr, r_asacategory.ASACategory  ORDER BY r_facility.FacilityCode, r_asacategory.ASACategory, tblmasterpoddata.UserName,.Proc01";



		break;



	case 'all':		



				$sql  = "SELECT tblmasterpoddata.ID,tblmasterpoddata.UserState, r_facility.FacilityCode, r_facility.FacilityDescription,

				r_asacategory.ASADescription AS ASA_Category, tblmasterpoddata.AnaesthesiaType1, tblmasterpoddata.AnaesthesiaType2, 

				tblmasterpoddata.AnaesthesiaType3, Count(tblmasterpoddata.Proc01) AS CountProcs, tblmasterpoddata.Proc01 AS ProcCode,

				r_icd10am_procedure_codes.Description AS Proc_Desc, r_previous_surgery.PreviousSurgeryCDescr,

				r_asacategory.ASACategory FROM (((tblmasterpoddata LEFT JOIN r_icd10am_procedure_codes ON 

				tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10) LEFT JOIN r_asacategory

				ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) LEFT JOIN r_facility

				ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode) LEFT JOIN r_previous_surgery

				ON tblmasterpoddata.PrevSurgery = r_previous_surgery.PreviousSurgeryCode

				WHERE (tblmasterpoddata.Validated=1) AND (tblmasterpoddata.SurgeryDate Between '$fromdate_r' And '$todate_r') {$query}  {$query_condition} 

				GROUP BY   r_facility.FacilityCode, r_facility.FacilityDescription, r_asacategory.ASADescription,

				tblmasterpoddata.Proc01, r_icd10am_procedure_codes.Description,  r_asacategory.ASACategory

				ORDER BY r_facility.FacilityCode, r_asacategory.ASACategory, tblmasterpoddata.Proc01";

break;



	default: 

		$sql  = "SELECT tblmasterpoddata.UserState, r_facility.FacilityCode, r_facility.FacilityDescription,

		r_asacategory.ASADescription AS ASA_Category, tblmasterpoddata.AnaesthesiaType1, tblmasterpoddata.AnaesthesiaType2,

		tblmasterpoddata.AnaesthesiaType3, Count(tblmasterpoddata.Proc01) AS CountProcs, 

		tblmasterpoddata.Proc01 AS ProcCode, r_icd10am_procedure_codes.Description AS Proc_Desc,

		r_previous_surgery.PreviousSurgeryCDescr, r_asacategory.ASACategory FROM

		(((tblmasterpoddata LEFT JOIN r_icd10am_procedure_codes ON tblmasterpoddata.Proc01 = r_icd10am_procedure_codes.ICD_10) 

		LEFT JOIN r_asacategory ON tblmasterpoddata.ASACategory = r_asacategory.ASACategory) 

		LEFT JOIN r_facility ON tblmasterpoddata.FacilityCode = r_facility.FacilityCode)

		LEFT JOIN r_previous_surgery ON tblmasterpoddata.PrevSurgery = r_previous_surgery.PreviousSurgeryCode

		WHERE (((tblmasterpoddata.Validated)=1) 

		AND ((tblmasterpoddata.SurgeryDate) Between '$fromdate_r' And '$todate_r')) {$query}  {$query_condition}   

		GROUP BY tblmasterpoddata.UserState, r_facility.FacilityCode, r_facility.FacilityDescription,

		r_asacategory.ASADescription, tblmasterpoddata.AnaesthesiaType1, tblmasterpoddata.AnaesthesiaType2, 

		tblmasterpoddata.AnaesthesiaType3, tblmasterpoddata.Proc01,

		r_icd10am_procedure_codes.Description,

		r_previous_surgery.PreviousSurgeryCDescr, r_asacategory.ASACategory

		ORDER BY r_facility.FacilityCode, r_asacategory.ASACategory, tblmasterpoddata.Proc01";



		break;



}



$result_data = $db->fetch_all_array($sql);



?>



<div class="row-fluid">



	<div class="report-wrapper report-gen">



	<div class="r-heading">	



		<h2>Reports 04</h2>



		<?php if($type != "all" && $type !=""): ?>



			<h3>UserName <?php echo $user;?></h3>



			<?php if(isset($result_data[0]['UserState'])): ?>



			<h3>State <?php echo $result_data[0]['UserState']; ?></h3>



			<?php endif; else: ?>



			<h3>TOTAL PRACTICE</h3>	



		<?php endif;?>



	</div>



	<div class="r-sub-heading">



		<h2> All Procedure Codes by Facility, ASA Category, Previous Surgery, by Date Range</h2>



		<h5>Validated Records Only</h5>



		<div class="date-range"><span>Date Range:</span> <?php echo $from;?> to <?php echo $to;?></div>



	</div>	



		<?php 



			$last_facility_code = 0;



			$last_asa_category = null;	



		?>



		<?php if(!empty($result_data)): 



		//echo count($result_data);

		

		//print_r($result_data);

		

		$total_ASA=0;



		?>



		<?php foreach($result_data as $item) : ?>



			<?php 

	      

				if($item['FacilityCode'] != $last_facility_code):



			?>



				<div class="level-1"><?php echo $item['FacilityDescription'];?></div>



			<?php			



				$last_facility_code = $item['FacilityCode'];



				endif;



			?>



			<?php 



			 //echo $last_asa_category."!=".$item['ASA_Category'].$item['FacilityCode'];



			   $ASA_Category_facility=$item['ASA_Category'].$item['FacilityCode'];



			 if($last_asa_category !=  $ASA_Category_facility) : ?>	



				<div class="level-2"><?php echo $item['ASA_Category'];?></div>



				<div class="level-3"><span>Previous Surgery</span> <?php echo empty($item['PreviousSurgeryCDescr']) ? "None/Not Stated" : $item['PreviousSurgeryCDescr'];?></div>



				<?php $last_asa_category = $ASA_Category_facility;  $total_ASA=0;?>



			<?php endif;?>



			<div class="level-4">



				<div class="level-4-1"><?php echo $item['CountProcs'];?></div>



				<div class="level-4-2"><?php echo $item['ProcCode'];?></div>



				<div class="level-4-3"><?php echo $item['Proc_Desc'];?></div>



			</div>



		<?php endforeach;?>



		<?php endif;?>



	</div>



</div>



<div class="back-to-report left-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>



<div class="back-to-report right-one"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php?from=<?php echo $from;?>&to=<?php echo $to;?>">Go To Report Menu</a></div>



<?php include('footer.php'); ?>