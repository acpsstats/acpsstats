<?php
global $config;
//localdatabase details
$config['server'] ="localhost";
$config['user'] = "acpsstat_audit";
$config['pass'] = "5i(6mpZ;7HtP";
$config['database'] = "acpsstat_auditdb"; 


	
// table prefix
$config['tablePrefix'] = "";

// root path
$config['rootPath'] = "";

// base path
$config['basePath'] = "http://acpsstats.com";

//Site Name
$config['siteName'] = "The Australasian College of Podiatric Surgeons Surgical Audit Tool";

//Site From mail id
$config['administrator'] = "";

//Corporate Email ID
$config['corporateMail'] = "paul@portaleducation.com.au";

//secondary administrator mail id Email ID
$config['secondary_administrator'] = "";

$config['salt'] = 'ACPS@%USER~~';

$config['admin'] = array('2','18','21');

$config['exclude'] = '21,2';
$config['exclude_condition'] = ' AND  (LastName NOT LIKE "Reli" OR Firstname NOT LIKE  "Ability")';

?>