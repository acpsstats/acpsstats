<?php include('header.php');?>
<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'class/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$dept_array = get_department_list();
$user_dept = array();
foreach($dept_array as $index => $dept){
	$user_dept[$dept_array[$index]['dept_id']] = $dept_array[$index]['departmentname'];
}

$supervisor_list = get_user_by_type();
$supervisors = array();
foreach($supervisor_list as $index => $sup_values){
  $supervisors[$supervisor_list[$index]['userid']] = $supervisor_list[$index]['username'];
}

if(isset($_POST['uploadwo']) && $_POST['uploadwo']!=""){

		$inputFileName = $_FILES['filexport']['tmp_name'];  // File to read
		//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}


		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		array_shift($sheetData);  // the first element in array was heading so remove it


		foreach($sheetData as $index => $wo_details){
		   //$insert = $db->query_insert('workorder_history',$wo_history);
			$wo_info = array();
			foreach($wo_details as $column => $wo){
					if($column == 'A'){ 
						$wo_info['id']  =  $wo;
					}
					if($column == 'B'){ 
						$wo_info['department']  =  array_search($wo, $user_dept);
					}
					if($column == 'C'){ 
						$wo_info['status']  =  $wo;
					}
					if($column == 'D'){ 
						$wo_info['priority_status']  =  $wo;
					}
					if($column == 'E'){ // || $column == 'F' || $column == 'K' || $column == 'L'
						$wo_date = '';
						if($wo!=''){
						   $wo = str_replace("/","-",$wo);
						   $wo_date = changedtformat('Y-m-d',$wo);
						}
						$wo_info['work_order_date']  = $wo_date;
					}
					if($column == 'F'){
						$agreed_date = '';
						if($wo!=''){
						   $wo = str_replace("/","-",$wo);
						   $agreed_date = changedtformat('Y-m-d',$wo);
						}
						$wo_info['agreed_date']  =  $agreed_date ;
					}
					if($column == 'G'){ 
						$wo_info['description']  =  $wo;
					}
					if($column == 'H'){ 
						$wo_info['supervisor']  =  array_search($wo,$supervisors);
					}
					if($column == 'I'){ 
						$wo_info['skill_level']  =  $wo;
					}
					if($column == 'M'){ 
						$wo_info['notes']  =  $wo;
					}
					if($column == 'J'){ 
						$wo_info['assigned_to']  =  $wo;
					}
					if($column == 'K'){
						$assigned_date = '';
						if($wo!=''){
						   $wo = str_replace("/","-",$wo);
						   $assigned_date = changedtformat('Y-m-d',$wo);
						}
						$wo_info['assigned_date']  =  $assigned_date ;
					}
					if($column == 'L'){
						$completed_date = '';
						if($wo!=''){
						   $wo = str_replace("/","-",$wo);
						   $completed_date = changedtformat('Y-m-d',$wo);
						}
						$wo_info['completion_date']  =  $completed_date ;
					}
					
					
			}
			$db->query_insert('workorder',$wo_info);
		   
		  
		}
	}
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">WO Importer</a>
					</li>
				</ul>
			</div>
			
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Please upload only xls to import work order</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="importworkorder" name="importworkorder" action="" method="post" enctype="multipart/form-data">
						    <div class="control-group">
								  <label class="control-label" for="cancel_reason">Select XLS :</label>
								  <div class="controls">
									 <input type="file" name="filexport" value=""/>
								  </div>
						    </div>
							<div class="form-actions">
								<input type="submit" class="btn btn-primary" value="Upload WO" name="uploadwo"/>
							</div>
						</form>   

					</div>
				</div><!--/span-->

            </div>
<?php include('footer.php'); ?>
