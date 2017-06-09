<?php
$no_visible_elements=true;
include('header.php');
$wo_id = "";
if(isset($_GET['s']) && $_GET['s']!=""){
	$u_name = base64_decode($_GET['s']);
}

if(isset($_GET['wo']) && $_GET['wo']!=""){
	$wo_id = base64_decode($_GET['wo']);
}

if(!isset($_SESSION['userid'])){
	$user_info['username'] = $u_name;
	login_maillink($user_info);
}
header("location:".$config['basePath']."workorders-action.php?action=edit&wid=".$wo_id);
?>