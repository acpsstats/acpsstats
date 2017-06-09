<?php

/** EXCEL RECORD **/

require_once  'functions.php';

$current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

$user_id = $_REQUEST['user'];



include('header.php'); 

	if(!empty($_REQUEST["get_report"]) && isset($_REQUEST["get_report"])):

	         $proc_code=$_REQUEST['proc'];   

			 $and = ''; 

			if(!in_array($current_user,$config['admin'])){ 

			

				$and = ' AND tblmasterpoddata.user_id = '.$user_id; 

			}

			 

		  if(!empty($proc_code)):

			$chck_sql="SELECT ID,UserState,SurgeryDate,Proc01,Proc02,Proc03,Proc04,Proc05,Proc06,Proc07,Proc08,Proc09,Proc10,Proc11,Proc12,Proc13,Proc14,Proc15,Proc16,Proc17,Proc18,Proc19,Proc20,Proc21,Proc22,Proc23,Proc24,Proc25,Proc26,Proc27 FROM tblmasterpoddata WHERE (

			Proc01 LIKE  '%$proc_code%'

			OR Proc02  LIKE  '%$proc_code%'

			OR Proc03  LIKE  '%$proc_code%'

			OR Proc04 LIKE  '%$proc_code%'

			OR Proc05  LIKE  '%$proc_code%'

			OR Proc06 LIKE  '%$proc_code%'

			OR Proc07 LIKE  '%$proc_code%'

			OR Proc08 LIKE  '%$proc_code%'

			OR Proc09 LIKE  '%$proc_code%'

			OR Proc10 LIKE  '%$proc_code%'

			OR Proc11 LIKE  '%$proc_code%'

			OR Proc12 LIKE  '%$proc_code%'

			OR Proc13 LIKE  '%$proc_code%'

			OR Proc14 LIKE  '%$proc_code%'

			OR Proc15 LIKE  '%$proc_code%'

			OR Proc16 LIKE  '%$proc_code%'

			OR Proc15 LIKE  '%$proc_code%'

			OR Proc17 LIKE  '%$proc_code%'

			OR Proc18 LIKE  '%$proc_code%'

			OR Proc19 LIKE  '%$proc_code%'

			OR Proc20 LIKE  '%$proc_code%'

			OR Proc21 LIKE  '%$proc_code%'

			OR Proc22 LIKE  '%$proc_code%'

			OR Proc23 LIKE  '%$proc_code%'

			OR Proc24 LIKE  '%$proc_code%'

			OR Proc25 LIKE  '%$proc_code%'

			OR Proc26 LIKE  '%$proc_code%'

			OR Proc27 LIKE  '%$proc_code%')

			AND tblmasterpoddata.Validated=1

			AND tblmasterpoddata.user_id NOT IN (21,2)

			AND (LastName NOT LIKE 'Reli'

			OR Firstname NOT LIKE 'Ability') $and ";

			

			
//AND (tblmasterpoddata.SurgeryDate BETWEEN '2014-01-01' AND '2014-12-31')
			

			$results = $db->fetch_all_array($chck_sql);

			$total=count($results);

		endif;

	endif;

?>

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

                <div class="span7"> 

                	    <label> Procedure Codes: </label>

                         <input type="text" name="proc"  value="<?php echo $proc_code;?>" class="span8" style='float:left;width:100%;'/> 

                        <br>

                          <label> Total cases:  <b><?php  echo $total; ?></b></label>

                </div>

                 <div class="span3"> 

                     <label style='color:transparent;'> Search by Procedure:</label>

                    <input type="submit" name="get_report"  value="Search" class="btn btn-info span4" style='float:left;'/> 

                 </div>

            </form>





     </div>



      <?php if(isset($_REQUEST["get_report"])) {  ?>

		<div class="row-fluid sortable" style="background:#f9f9f9;">		

				<div class="box span12">

						<div class="box-header well" data-original-title>

							<h2><i class="icon-user">User Report By Procedure Code:</i></h2>

						</div>

     				<div class="box-content">

                         <form id="delete_control" action="<?php echo 'user_records.php?user='.$user_id.'&action=view' ?>" method="post">

							<table class="table table-striped table-bordered bootstrap-datatable datatable">

							  <thead>

								  <tr>

									   <th>ID</th>

                                       <th>Count</th>

                                       <th>UserState</th>

									  <th>SurgeryDate</th>

                                      <th>Action</th>

								  </tr>

							  </thead>   

							  <tbody>

								<?php

									if(!empty($results)){

                                     $html_mapping='';

									 $total_proc=0;

									foreach($results as $record){ 	$count=0;

									$status = ($record['is_active'] == 1) ? '1' : '0';

									 $html_mapping.="<tr class='".$status."'>

										  <td>".$record['ID']."</td> <td>";

									      

										  for($proc=0;$proc<=27;$proc++){

											     $index='Proc'.$proc;

												 if($proc<10)

												    $index='Proc0'.$proc;

                                               

											   //echo $index.":".$record[$index]."==".$proc_code."</br>";

											  if($record[$index]==$proc_code) $count++; 

											  

											 

										  }

									    $total_proc+=$count;    

									   $html_mapping .= $count;

								      $html_mapping .="</td><td>".$record["UserState"]."</td>

										  <td>".$record["SurgeryDate"]."</td>

										  <td><a class='btn' href='dashboard.php?show_record=".$record['ID']."&action=view#tab-3'>

												<i class='icon-list-alt'></i>   <span class='glyphicons glyphicons-list-alt'></span>

												View                                             

											</a></td>

										 </tr>"; 

										 

									

								  }

								  

								 $html_mapping.='<tr> <td>Total</td><td colspan="4">'.$total_proc.'</td></tr>';

								 echo $html_mapping;

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