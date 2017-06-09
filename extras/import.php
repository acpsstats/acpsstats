<?php ob_start(); include_once('config.php');
include_once('functions.php');
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'class/');
global $db;
/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$inputFileName = 'wo-new.xlsx';  // File to read
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
echo "<pre>";print_r($sheetData);echo "</pre>";
$sql = '';
 foreach($sheetData as $keycell => $rec)
{
	//print_r($rec);
	if($keycell > 1)
	{
		foreach($rec as $titlecell =>$valuecell)
		{
			
			//echo $titlecell."====".$valuecell."<br/>";
			if($titlecell == "A" && $valuecell!= '')
				$val['wordordernumber'][] = $valuecell;
			elseif($titlecell == "B" && $valuecell!= '')
				$val['department'][] = $valuecell;
			elseif($titlecell == "C" && $valuecell!= '')
				$val['status'][] = $valuecell;
			elseif($titlecell == "D" && $valuecell!= '')
				$val['priority'][] = $valuecell;
			elseif($titlecell == "E" && $valuecell!= '')
				$val['wodate'][] = $valuecell;
			elseif($titlecell == "F" && $valuecell!= '')
				$val['agreeddate'][] = $valuecell;
			elseif($titlecell == "G" && $valuecell!= '')
				$val['description'][] = $valuecell;
			elseif($titlecell == "H" && $valuecell!= '')
				$val['supervisor'][] = $valuecell;
			elseif($titlecell == "I" && $valuecell!= '')
				$val['skills'][] = $valuecell;
			elseif($titlecell == "J" && $valuecell!= '')
				$val['assignedto'][] = $valuecell;
			elseif($titlecell == "K" && $valuecell!= '')
				$val['assigneddate'][] = $valuecell;
			elseif($titlecell == "L" && $valuecell!= '')
				$val['completeddate'][] = $valuecell;
			else
				$val['notes'][] = $valuecell;
				
		}
	}
}
$dept_array = get_department_list();
$supervisor_list = get_user_by_type();
print_r($val['wordordernumber']);
$array_fields =array("0"=>'wordordernumber',"1"=>'department',"2"=>'status',"3"=>'priority',"4"=>'wodate',"5"=>'agreeddate',"6"=>'description',"7"=>'supervisor',"8"=>'skills',"9"=>'assignedto',"10"=>'assigneddate',"11"=>'completeddate',"12"=>'notes');
foreach($val as $keyreal=>$valuereal)
{

	for($iter=0;$iter<=count($val['wordordernumber']); $iter++)
	{
		//$sql .='(';
		$sql ="insert into wa_workorder (id, department, status,  priority_status, work_order_date,  agreed_date, description, supervisor, skill_level, assigned_to, assigned_date, completion_date,notes) values (";
		foreach($array_fields  as  $keyins=>$valueins)
		{  
			if(isset($val[$valueins][$iter]) && trim($val[$valueins][$iter]) != '')
			{  //echo "===>".$val[$valueins][$iter]."<br/>";
				if($array_fields['1'] == $valueins)
				{
					foreach($dept_array as $index => $dept){
						if($val[$valueins][$iter]== $dept_array[$index]['departmentname'])
						{
							$value_fieldre = $dept_array[$index]['dept_id'];
						}
					}
				}
				else if($array_fields['4'] == $valueins )
				{
					$value_fieldre = date('Y-m-d  H:i:s', strtotime($val[$valueins][$iter])); 
					
				}
				else if($array_fields['5'] == $valueins )
				{
					$value_fieldre = date('Y-m-d  H:i:s', strtotime($val[$valueins][$iter])); 
				}
				else if($array_fields['10'] == $valueins )
				{
					$value_fieldre = date('Y-m-d  H:i:s', strtotime($val[$valueins][$iter])); 
				}
				else if($array_fields['11'] == $valueins )
				{
					$value_fieldre = date('Y-m-d  H:i:s', strtotime($val[$valueins][$iter])); 
				}
				elseif($array_fields['7'] == $valueins)
				{
					foreach($supervisor_list as $index => $sup_user){
						if($val[$valueins][$iter]== $sup_user['username'])
						{
							$value_fieldre = $sup_user['userid'];
						}
					}
				}
				else
				{ 
					$value_fieldre =$val[$valueins][$iter];
				}
				$sql .=' "'.$value_fieldre.'" ';
			}
			else{
				$sql .=' "" ';
				echo "===> <br/>";
			}
			if((($keyins+1) < count($array_fields)) )
			{
				$sql .= ', ';
			}
		}
		$sql .=')';
		echo "==>".$sql."<br/>";
		//$suc_ins=$db->query($sql);
	}
}
?>
