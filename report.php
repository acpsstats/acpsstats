<?php include('header.php'); ?>
<?php 


if(!isset($_SESSION['user_id']) || intval($_SESSION['user_id']) == 0) { header("location:login.php");} ?>
<div class="row-fluid">
	<div class="report-wrapper">
	<?php if(!(isset($_REQUEST['to']) && isset($_REQUEST['to']) && !empty($_REQUEST['to']) && !empty($_REQUEST['to']))) : ?>
			<div class="row-fluid">
				<div class="span12 center login-header"> 
					<h2>The Australasian College of Podiatric Surgeons <br /> Surgical Audit Tool - Report</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please enter from and to date to see report.
                        <?php if(isset($error) && $error!=""){?>
                        <p><label class="errormsg"><?php echo $error;?></label></p>
                        <?php }?>
					</div>
					<form class="form-horizontal" name="loginfrm" id="loginfrm" action="" method="post">
						<fieldset>
							<div class="input-prepend" title="From Date" data-rel="tooltip">
								<span class="add-on">FROM</span>
								<span class="login_pass"><input class="input-large span10 datepicker" type="text" name="from" placeholder="dd/mm/yyyy"></span>
							</div>
							
							<div class="clearfix"></div>
							
							<div class="input-prepend" title="To Date" data-rel="tooltip">
								<span class="add-on">TO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
								<span class="login_pass"><input class="input-large span10 datepicker" type="text" name="to" placeholder="dd/mm/yyyy"></span>
							</div>
							<div class="clearfix"></div>
							
							<div class="clearfix"></div>
							<p class="center" style="width:25%;">
							<input type="submit" class="btn btn-primary" value="Submit" name="reportgen" id="reportgen"/>
							</p>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
	<?php else:?>
	<?php 
	$report_heading[] = "All Validated Records by Date Range";
	$report_heading[] = "All Procedure Codes by Date Range";
	$report_heading[] = "Selected Proc Code by Date Range";
	$report_heading[] = "All Procedure Codes by Facility, ASA Category, Anaesthesia, Prophylaxis, Previous Surgery - by  Date Range";
	$report_heading[] = "All Principal Diagnosis Codes by Date Range";
	$report_heading[] = "All Secondary Diagnosis Codes by Date Range";
	$report_heading[] = "All Comorbidities by Date Range";
	$report_heading[] = "Procedure Codes mapped to Comorbidities";
	$report_heading[] = "Complication Rates";
	$report_heading[] = "---";
	$report_heading[] = "---";
	$report_heading[] = "Day Surgery Outcomes";
	$report_heading[] = "Average Length of Stay"; 
	$reportuser_heading[] = "Validation Status - All Records by Date Range";
	$reportuser_heading[] = "All Procedure Codes by Date Range";
	$reportuser_heading[] = "Selected Proc Code by Date Range";
	$reportuser_heading[] = "All Procedure Codes by Facility, ASA Category, Anaesthesia, Prophylaxis, Previous Surgery - by  Date Range";
	$reportuser_heading[] = "All Principal Diagnosis Codes by Date Range";
	$reportuser_heading[] = "All Secondary Diagnosis Codes by Date Range";
	$reportuser_heading[] = "All Comorbidities by Date Range";
	$reportuser_heading[] = "Procedure Codes mapped to Comorbidities";
	$reportuser_heading[] = "Complication Rates";
	$reportuser_heading[] = "---";
	$reportuser_heading[] = "---";
	$reportuser_heading[] = "Day Surgery Outcomes";
	$reportuser_heading[] = "Average Length of Stay"; 
	$username = (isset($_SESSION['txtUserName'])) ? $_SESSION['txtUserName'] : '';
	?>
	<h2>Reports Menu</h2>
	<h3>Date Range: from <?php echo isset($_REQUEST['from']) ? $_REQUEST['from'] : "";?> to <?php echo isset($_REQUEST['to']) ? $_REQUEST['to'] : "";?></h3>
	<div id="reportpage">
		<?php if(intval($_SESSION['user_id']) != $config['admin']) : ?>
			<div class="leftclass">
				<span><h4>Your reports:</h4></span>
				<table>
					<?php foreach($reportuser_heading as $num => $val):?>
						<?php $report_num = str_pad($num + 1 ,2,0,STR_PAD_LEFT);
							  $value_dis = '<a href='.$config['basePath'].'/report-'.$report_num.'.php?from='.$_REQUEST['from'].'&to='.$_REQUEST['to'].'&type=user>Report '.$report_num.'</a>';
							 if($val == '---'):
							  	$value_dis = '<span>Report '.$report_num.'</span>';
							  endif;
						?>
						<tr><td class="reportlab"><?php echo $value_dis; ?></td><td><?php echo $val; ?></td></tr>
					<?php endforeach;?>
				</table>		
			</div>
		<?php endif;?>
			<?php if(intval($_SESSION['user_id']) != $config['admin']) : ?>
			<div class="rightclass">
					<span><h4>National de-identified reports:</h4></span>
			<?php else: ?>
			<div class="singleclass">	
			<?php endif;?>
				<table>
					<?php foreach($report_heading as $num => $val):?>
						<?php $report_num = str_pad($num + 1 ,2,0,STR_PAD_LEFT);
							  $value_dis = '<a href='.$config['basePath'].'/report-'.$report_num.'.php?type=all&from='.$_REQUEST['from'].'&to='.$_REQUEST['to'].'>Report '.$report_num.'</a>';
							 if($val == '---'):
							  	$value_dis = '<span>Report '.$report_num.'</span>';
							  endif;
						?>
						<tr><td class="reportlab"><?php echo $value_dis; ?></td><td><?php echo $val; ?></td></tr>
					<?php endforeach;?>
				</table>
			</div>
	</div><!-- #reportpage-->
	<div class="center clear" style="padding-top:40px;"><a class="btn btn-primary" href="<?php echo $config['basePath'];?>/report.php">Back</a></div>
		
	<?php endif;?>
	</div><!-- #report-wrapper-->
</div>
<style>
.report-wrapper h2, h3 {text-align:center;}
.report-wrapper td {
    padding: 10px;
}
.report-wrapper  td a {
    background: none repeat scroll 0 0 #d5e2f6;
    border: 1px solid #d8e4f6;
    border-radius: 5px;
    color: #59597d;
    padding: 7px 15px;
    text-decoration: none;
}
</style>
<?php include('footer.php'); ?>