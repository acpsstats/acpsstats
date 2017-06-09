<?php
include('config.php');
include('functions.php');	

	// Get User ID
	$user = $facebook->getUser();
	
	if ($user) {
	  try {		
		//header('location:store_user_data.php?struser=1');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}

	// Login or logout url will be needed depending on current user state.
	if ($user) {
	  $logoutUrl = $facebook->getLogoutUrl();
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}
 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="title" content="">
	<meta name="description" content="">
    <title>Fb Calender</title> 
	<link rel="stylesheet" href="style.css">  
	<link href="js/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="css/datepicker.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/datepicker.js"></script>
	<script type="text/javascript" src="js/uploadify/swfobject.js"></script>
	<script type="text/javascript" src="js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
</head>  
<body>
<div class="wraper">
  <div class="wraperInner">
   <!--Header start here-->
   <header id="header">
      <div class="logoContainer">
	    Company Logo
	  </div>	
	  <div class="advbanner">
	   &nbsp;
	  </div>	
	  
	  <div class="menu">
	     <ul>
		    <li><a href="index.php">Home</a></li>
			 <?php if(isset($_SESSION['userId']) && $_SESSION['userId']!='') { ?>
			 <li><a href="">Myaccount</a></li>
			 <li> <a href="index.php?action=logout">Logout</a></li>
			 <?php } ?>
		 </ul>
	  </div>
	    
   </header>
   <!--Header end here-->
   
   <!--Main container start here-->
   <div class="maincontainer"> 
