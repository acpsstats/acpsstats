<?php

include_once('functions.php');

$com->page_authentication();

$current_page = basename($_SERVER['SCRIPT_NAME']);



if($current_page=='dashboard.php') {

	$error = $success =  '';

	 if(isset($_POST['update_record']) && $_POST['update_record'] != ''){

		if(update_pod_data($_POST)) 

		  $success = 'Record updated Successfully';	

		else

	      $error = "There is some error with you request plesae try again";

	 }elseif(isset($_POST['add_new_record']) && $_POST['add_new_record'] != ''){

	   if(add_new_entry($_POST))

		  $success = 'Record Added Successfully';	

		else

	      $error = "There is some error with you request plesae try again";

	 }

 }

?>

<!DOCTYPE html>

<html lang="en">

<head>

	

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>The Australasian College of Podiatric Surgeons Surgical Audit Tool</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">

	<meta name="author" content="">

	<!-- The styles -->

	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">

	<link href="css/bootstrap-responsive.css" rel="stylesheet">

	<link href="css/charisma-app.css" rel="stylesheet">

	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">

	<link href='css/fullcalendar.css' rel='stylesheet'>

	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>

	<link href='css/chosen.css' rel='stylesheet'>

	<link href='css/uniform.default.css' rel='stylesheet'>

	<link href='css/colorbox.css' rel='stylesheet'>

	<link href='css/jquery.cleditor.css' rel='stylesheet'>

	<link href='css/jquery.noty.css' rel='stylesheet'>

	<link href='css/noty_theme_default.css' rel='stylesheet'>

	<link href='css/elfinder.min.css' rel='stylesheet'>

	<link href='css/elfinder.theme.css' rel='stylesheet'>

	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>

	<link href='css/opa-icons.css' rel='stylesheet'>

	<link href='css/uploadify.css' rel='stylesheet'>

    <link href='css/bootstrap-dialog.min.css' rel='stylesheet'>

	<link  href="css/smooth-query.css"  rel="stylesheet">
    
    
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->

	<!--[if lt IE 9]>

	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->

	<!-- The fav icon -->

	<link rel="shortcut icon" href="img/favicon.png">

		

</head>

<body>
	<!-- topbar starts -->

	<div class="navbar">

		<div class="navbar-inner">

			<div class="container-fluid">

				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

				</a>

				<a class="brand" href="javascript:void(0)"> <img alt="ACPS" src="img/acps_logo.png" /> </a>

				

				<!-- theme selector starts -->

				

				<!-- theme selector ends -->

				

				<!-- user dropdown starts -->

				<?php if(isset($_SESSION['txtUserName']) && isset($_SESSION['user_id'])) {?>

				<div class="btn-group pull-right" >

					<a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">

					

						<i class="icon-user"></i><span class="hidden-phone"> <?php if(isset($_SESSION['txtUserName'])) echo $_SESSION['txtUserName'];?></span>

						<span class="caret"></span>

					</a>

                    



					<ul class="dropdown-menu">

						<li><a href="dashboard.php">Data Entry</a></li>	

						<?php if($current_page=='dashboard.php' || $current_page=='add_record.php') { ?>			 

						<li><a href="add_record.php" >New Entry</a></li>	

						<?php } else { ?>	

						<li><a href="add_record.php">New Entry</a></li>			

						<?php } ?>

                        <li><a href="report.php">Reports</a></li>		

                        

                        								

						<?php $current_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

						if(in_array($current_user,$config['admin'])){

								echo '<li><a href="dashboard.php?action=current_user">My Data Entry</a></li>';

								echo '<li><a href="users.php">Users</a></li>';

								echo '<li><a href="cases.php">All Cases </a></li>';

								echo '<li><a href="searchpro.php">Search Procedure</a></li>';

								echo '<li><a href="export-report.php">Export Reports</a></li>';

								echo '<li><a href="export-report-age.php">Export Reports by Age</a></li>';
								echo '<li><a href="export-report-date.php">Export Reports by Date</a></li>';

							}else{
								$url = '';
								echo '<li><a href="searchpro.php?user='.$current_user.'">Search Procedure</a></li>';
								echo '<li><a href="export-report.php?show_record='.$current_user.'&file=acps_report">Export Reports as Excel</a></li>';
								echo '<li><a href="export-report-age.php?user='.$current_user.'">Export Reports by Age</a></li>';
								
							}
						?>						
                        <li><a href="user_profile.php?action=edit&user=<?php echo $current_user ?>">Profile</a></li>						
                        <li><a href="user_records.php?action=view&user=<?php echo $current_user ?>">My List</a></li>																		
						<?php 
						  $uri=array();
						  if(isset($_SERVER["SCRIPT_NAME"])) {
							   $uri=explode('/',$_SERVER["SCRIPT_NAME"]);
						  }
						  if((end($uri)=='add_record.php') && isset($_SERVER["SCRIPT_NAME"])) {  echo "<li> <a class='confirm-logout' href='javascript:void(0)'>Logout</a></li>"; } else { echo "<li> <a href='logout.php'>Logout</a></li>"; }
						?>
					</ul>
				</div>
				<?php } ?>
				<!-- user dropdown ends -->
				<?php if(isset($_SESSION['user_id']) ){ ?>
				<!--/.nav-collapse -->
                <ul class="user_hint">
                  <li class="total_valid"><a href='<?php echo "user_records.php?user=".$current_user."&action=view"?>'>Total Records <span class="count"><?php echo get_count('total',$current_user) ?></span></a></li>
                  <li class="valid"><a href='<?php echo "user_records.php?user=".$current_user."&action=view&type=valid" ?>'>Validated <span class="count"><?php echo get_count('valid',$current_user)?></span></a></li>
                  <li class="non_valid"><a href='<?php echo "user_records.php?user=".$current_user."&action=view&type=non" ?>'>Non-validated <span class="count"><?php echo get_count('non',$current_user)?></span></a></li>

                  <?php 

				  	  $incomplete =	get_count('incomplete',$current_user);

					  if($incomplete > 0){ ?>

                  <li class="incomplete"><a title='Missing PRINCIPAL DIAGNOSIS OR EstDischargeTime' href='<?php echo "user_records.php?user=".$current_user."&action=view&type=incomplete" ?>'>Incomplete <span class="count"><?php echo  $incomplete; ?></span></a></li>          

                  <?php } ?>

                  

                </ul>

               <?php } ?> 

			</div>

		</div>

	</div>

	<!-- topbar ends -->

	<div class="fullWrapper loading">

	<div class="container-fluid">

		<div class="row-fluid">

		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>

			<!-- left menu starts -->

			<!--<div class="span2 main-menu-span">

				<div class="well nav-collapse sidebar-nav">

					<ul class="nav nav-tabs nav-stacked main-menu">

						<li class="nav-header hidden-tablet">Main</li>

						<?php if($_SESSION['type'] == "Admin") { ?><li <?php if($current_page == 'members.php') echo "class='active'";?>"><a class="ajax-link" href="members.php"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a></li> <?php } ?>

						<li <?php if($current_page == 'workorders-action.php') echo "class='active'";?>><a class="ajax-link" href="workorders-action.php"><i class="icon-edit"></i><span class="hidden-tablet"> Add Work Order </span></a></li>

						<li <?php if($current_page == 'workorders.php') echo "class='active'";?>><a class="ajax-link" href="workorders.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Work Order List</span></a></li>

						<li <?php if($current_page == 'workorders-history.php') echo "class='active'";?>><a class="ajax-link" href="workorders-history.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Work Order History</span></a></li>

					</ul>

				</div>

			</div>-->

			<!-- left menu ends -->

			

			<div id="content" class="span10">

			<!-- content starts -->

			<?php } ?>

