<?php
  if(!isset($_REQUEST['type']) || $_REQUEST['type'] == 'live' ){
	  header('location:http://www.portaleducation.com/dfcon2014_preview/?type=day1'); exit;	
	}
?>

<!doctype html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" dir="ltr"> <![endif]-->

<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en" dir="ltr"> <![endif]-->

<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" dir="ltr"> <![endif]-->

<!--[if gt IE 8]><!-->

<html class="no-js" lang="en" dir="ltr">

<!--<![endif]-->



<!-- Mirrored from dfcon.com/Default.aspx by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 31 Oct 2013 12:06:07 GMT -->

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head><title>

	Diabetic Foot Global Conference 2014 - Portal Education - Online, Live & Interactive

</title>

<meta charset="UTF-8" />

<meta name="description" content="Diabetic Foot Global Conference 2014" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="apple-mobile-web-app-capable" content="yes" />



<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/css/bootstrap.min.css" type="text/css" />

  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->

<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.html" />

<!-- For first- and second-generation iPad: -->

<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.html" />

<!-- For iPhone with high-resolution Retina display: -->

<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.html" />

<!-- For third-generation iPad with high-resolution Retina display: -->

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.html" />

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/css/style.css" type="text/css" />

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/css/header-1.css" type="text/css" />

<link rel="shortcut icon" href="favicon.html" />



<!-- for Facebook -->      

<?php

  $ip = getenv("REMOTE_ADDR");

  $share_title = 'Diabetic Foot Global Conference 2014 - Portal Education - Online, Live & Interactive';

  $msg_title = "I have just registered to attend DFCON 2014 Online.  Full CME/CPD -  100% FREE in Australia, New Zealand, Asia, UK and other parts of the world - Have you registered yet?"; 

?>

    

<meta property="og:title" content="Diabetic Foot Global Conference 2014 - Portal Education - Online, Live & Interactive"/>

<meta property="og:type" content="article"/>

<meta property="og:image" content="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/tall-logo-desktop1.jpg" />

<meta property="og:url" content="http://www.portaleducation.com/features/dfcon/dfcon-2014" />

<meta property="og:description" content="<?php echo $msg_title ?>" />



<!-- for Twitter -->          

<meta name="twitter:card" content="I have just registered to attend DFCON 2014 Online - Have you registered yet?" />

<meta name="twitter:title" content="Diabetic Foot Global Conference 2014 - Portal Education - Online, Live & Interactive" />

<meta name="twitter:description" content="<?php echo $msg_title ?>" />

<meta name="twitter:image" content="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/tall-logo-desktop1.jpg" />



<style type="text/css">

  #dialog .close{ background:none !important; top:0px !important; width:43px !important; opacity:1; }

  .saic-wrap-form img,.saic-comment-avatar img{ border-radius:50% !important; }

  .saic-wrapper{ width:95% !important; }

  

  div.mr_social_sharing_wrapper{ 

          float: left;

          width: 53% !important;

          margin-top: 15px !important;

          margin-left: 20px !important;

	}

  .mr_social_sharing_wrapper .mr_social_sharing:first-child{ width:30px !important;  }

  .mr_social_sharing{float:left; width:88px !important;  }

  

    .widget ul.blogposts div

    {

      margin: 0px 0px 0px 80px;

      font-size: 85%;

    }

	.content2014{ display:none; padding:10px 20px; float:left; overflow-y:scroll; max-height:600px; min-width:94%; }

	.cmecmpd{ cursor:pointer; }

	.overlayOnHtml img{ display: block;

      float: left;

      max-height: 70px !important;

      margin: 5%;

      max-width: 23%

    }

	.btn {

    box-shadow: none !important;

    text-decoration: none !important;

    text-shadow: none !important;

}



.btn-primary {

    background: none repeat scroll 0 0 #F27896 !important;

    border-color: #F27896 !important;

    color: #FFFFFF !important;

}

.panels div{ display:none; } 

.panels div#tab-day1{ display:block; }

#response{ width:100%; height:100%; position:fixed; float:left; background:url(dfcon2014/pe-logo-small.gif) no-repeat center center #FFF; opacity:0.9; z-index:999999999; display:none; }

.primary_menu li a{ padding:0 70px !important; }

#txtFilter{ width:85% !important; }

#orderConfirmation .order-table{ margin-left: -44px !important;     width: 98% !important; }

#orderConfirmation h3 { float: left; font-size: 20px !important;  margin: 15px 0 15px -44px !important; padding: 0px !important;  width: 100%; }

.nss-load,.nss-stream{ display: block !important; background:none !important;  }

#nss-ad{ display:none !important; }

.ondemand{ margin-right:20px !important;  text-align:center !important; line-height:10px !important; position:relative; font-size:20px !important;   }

.day.ondemand{ top:10px; }

.ondemand span{ float: left;

    font-size: 13px !important;

    left: -28px;    

    padding-bottom: 0 !important;

    position: absolute;

    text-transform: uppercase;

    top: -8px;

    width: 100px;

 }

.ondemand.last{ margin-right:0px !important; }

#dialog .close.innersection{ display:block !important; right:-11px !important; top:-16px !important; }

.sectionOndemad{ float:left; padding:15px !important; display:none; margin-left:6%; margin-top:3%; position:relative;  }

#primary_menu li:hover > span.btn-primary,li.active span.btn-primary{ font-size:30px !important; background:#EE2C75 !important;  }

#primary_menu li span{ line-height:25px !important; }

/*.mobile-menu-holder .primary_menu  li a{ padding: 10px 20px !important; }

.mobile-menu-holder .primary_menu  li a .ondemand span{ width:122px !important; float:left !important; margin:0px !important;  }

*/body{ overflow:scroll !important; }

.container{ width:980px !important; }
#headerMenu,#footer{ min-width:1050px !important; }

</style>

  



   <script src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/js/jquery-1.9.1.min.js" type="text/javascript"></script>



  <script src="http://code.jquery.com/ui/jquery-ui-git.js" type="text/javascript"></script>

  

  <script src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/js/modernizr.js"></script>

  <!-- js multiple backgrounds svg background size -->



 

 

 <script type="text/javascript">

   jQuery(document).ready(function($){

	   $(window).bind('orientationchange', function(event) {

    if (window.orientation == 90 || window.orientation == -90 || window.orientation == 270) {

        $('meta[name="viewport"]').attr('content', 'height=device-width,width=device-height,initial-scale=1.0,maximum-scale=1.0');

        $(window).resize();

    } else {

        $('meta[name="viewport"]').attr('content', 'height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0');

        $(window).resize();

    }

    }).trigger('orientationchange');

   });

 

 </script>

 

</head>

<body class="tall-logo">



 <div id="response">&nbsp;</div>

 

  <div class="wrapper" style="width:100%; min-width:980px;">

  <span id="tacking_level" style="display:none">1000</span>

 

  <!-- begin accesibility skip to nav skip content -->

  <ul class="visuallyhidden" id="top">

    <li><a href="#nav" title="Skip to navigation" accesskey="n">Skip to navigation</a></li>

    <li><a href="#page" title="Skip to content" accesskey="c">Skip to content</a></li>

  </ul>

  <!-- end /.visuallyhidden accesibility-->

  <!-- mobile navigation trigger-->



  <!--end mobile navigation trigger-->

  <section id="sectionTopHeader" class="container preheader">



    <div class="brochure">

      

     <a href="javascript:void(0);" class="memeber_login"><i class="icon-user"></i>&nbsp;&nbsp;Member Login</a>

      

      

    </div>

    <div class="phone">

      <a href="mailto:support@portaleducation.com"><i class="icon-envelope"></i>&nbsp;&nbsp;support@portaleducation.com </a></div>

    <ul class="social">

      <li><a class="icon-facebook" target="_blank" href="http://www.facebook.com/pages/Portal-Education/107251242687857/"

        data-placement="bottom" title="Follow us on Facebook"></a></li>

      <li><a class="icon-twitter" target="_blank" href="https://twitter.com/portaleducation" data-placement="bottom"

        title="Follow us on Twitter"></a></li>

    </ul>

  </section>

  <div class="container" style="padding: 0px 0px 20px 0px; position:relative;">

    <table class="table-condensed">

      <tr>

        <td>

          <img src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/images/tall-logo-desktop.png" />

          <h2 style="bottom: 7px;color: #003A79;font-size: 30px;left: 227px;position: absolute; "> Online </h2>

          

        </td>

        <td style="padding-left: 40px;">

          <h2>

            Diabetic Foot Global Conference 2014<br />

            March 20-22, 2014<br />

            Online,Live & Interactive </h2>

            

        </td>

      </tr>

    </table>

  </div>

  <!-- begin .header-->

  <header id="headerMenu" class="header clearfix">

    <div class="container">

      <div class="mobile-menu-holder">

        <!--clone menu here for mobile-->

      </div>

      <!-- begin #main_menu -->

      <nav id="main_menu" style="dsiplay:block !important;">

      <ul class="primary_menu" style="display:block !important; ">

          <li class='<?php echo ($_REQUEST['type'] == 'day1')?'active' : '';  ?>'><a href="?type=day1"><span class='day ondemand'><span>On demand</span>Day 1</span></a></li>

          <li class='<?php echo ($_REQUEST['type'] == 'day2')?'active' : '';  ?>'><a href="?type=day2"><span class='day ondemand'><span>On demand</span>Day 2</span></a></li>

          <li class='<?php echo ($_REQUEST['type'] == 'day3')?'active' : '';  ?>'><a href="?type=day3"><span class='day ondemand'><span>On demand</span>Day 3</span></a></li>

          <li style="margin:12px 0 0 7px"><span style="color:#D8DFE5; float:left; font-size:12px;">Powered By :</span> &nbsp;&nbsp; <span style="margin:0px;">

          <img style="margin:0px;" src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/images/pe-logo-small.png"></span></li>

       </ul>

      </nav>

      <!-- close / #main_menu -->

    </div>

    <!-- close / .container-->

  </header>

  <!-- close /.header -->

  <!-- begin #page - the container for everything but header -->

  

  <div id="page">

    <div class="hero-unit no-border hidden-desktop hidden-tablet">

      <div class="container">

        <div class="row-fluid" style="display:none !important;">

          <table style="width: 100%;">

            <tr>

              <td class="text-center">

                <img src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/bc3_2013/tall-logo-desktop.png" style="margin: auto;" />

              </td>

            </tr>

            <tr>

              <td class="text-center">

                <h6 class="text-center">

                  Breast Cancer Coordinated Care 2014<br />

                  <strong>February 20-22, 2014</strong><br />

                  Mandarin Oriental Washington, DC

                  Online,Live & Interactive</h6>

                  <br />

                  <div class="" style="position:absolute; right:-10px; bottom:-20px; width:261px;"><h3 style="font-size:15px; float:left; width:103px">Powered By</h3>&nbsp;&nbsp;<img style="float:left" src="/images/pe-logo-small.png" /></div>

              </td>

            </tr>

          </table>

        </div>

      </div>

      <!--close container-->

    </div>

    <!--close hero-unit-->

   </div> 

   

  <div class="container clearfix" id="main-content">

  

        <div class="row-fluid">

           <div class="platinumSponcers"> 

                 <span class="content"><h2 style="width:100%; text-align:center;">Platinum Sponsor:</h2></span>

                 <span style="margin:0px;" class="image"><img src="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/cadcam-600.jpg"></span>

            </div>

      </div>    

   

    <div class="row-fluid">

    <script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

    

   

     

				  <div class="on_container" style="width:980px !important; overflow:auto; float:left; ">

                  <?php 

				  if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'day1'){ ?> 

            

                  <object id="myExperience" class="BrightcoveExperience">                    

                    <param name="bgcolor" value="#FFFFFF" />

                    <param name="width" value="966" />

                    <param name="height" value="546" />

                    <param name="playerID" value="3336361031001" />

                    <param name="playerKey" value="AQ~~,AAAADiNHqOk~,99u-1Vi9SXKRClJexxvmIo6ptLF25MXv" />

                    <param name="isVid" value="true" />

                    <param name="isUI" value="true" />

                    <param name="dynamicStreaming" value="true" />                    

                    <!-- smart player api params  

                    <param name="includeAPI" value="true" />

                    <param name="templateLoadHandler" value="BCL.onTemplateLoad" />

                    <param name="templateReadyHandler" value="BCL.onTemplateReady" />-->

                    

                  </object>

            <?php }elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'day2'){ ?> 

                  <object id="myExperience" class="BrightcoveExperience">

                        <param name="bgcolor" value="#FFFFFF" />

                        <param name="width" value="966" />

                        <param name="height" value="546" />

                        <param name="playerID" value="3336361032001" />

                        <param name="playerKey" value="AQ~~,AAAADiNHqOk~,99u-1Vi9SXIDSEaqI679lPIcCjhAGD87" />

                        <param name="isVid" value="true" />

                        <param name="isUI" value="true" />

                        <param name="dynamicStreaming" value="true" />

                   </object>

              <?php }elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'day3'){ ?> 

             

                   <object id="myExperience" class="BrightcoveExperience">

                        <param name="bgcolor" value="#FFFFFF" />

                        <param name="width" value="966" />

                        <param name="height" value="546" />

                        <param name="playerID" value="3336361033001" />

                        <param name="playerKey" value="AQ~~,AAAADiNHqOk~,99u-1Vi9SXIe_ChD41MZKKd1zyK8jIzv" />

                        <param name="isVid" value="true" />

                        <param name="isUI" value="true" />

                        <param name="dynamicStreaming" value="true" />

                    </object>

              <?php } ?> 	

              </div>
   

    <script type="text/javascript">brightcove.createExperiences();</script>

   </div>

   

    

     

    <div class="row-fluid gold_sponsors">  

    <span class="content"><h2 style="width:100%; text-align:center;">Also Proudly Sponsored by:</h2></p></span>   

      <span class="images"><img style="width:90%; margin:40px 0 0 70px;" src="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/s_and_n.png"></span> 

      <span class="images"><img style=" height:70%; margin-left: 130px; width: 55%; margin-top:10px;" src="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/images/Algeos-Aus-Logo-Web.png"></span>      

      <span class="images"><img style="width:90%; height:70%; margin-left: 100px; margin-top:18px;" src="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/gfc.jpg"></span>

      <span class="images"><img style="width: 63%; height: 90%; margin-left: 100px;" src="http://www.portaleducation.com/wp-content/themes/rt_affinity_wp/dfcon2014/MD-Solutions-Australasia.png"></span>

    </div>  

  

  </div> 



   

    <!--begin footer -->

    <footer id="footer" class="clearfix">

      <div class="container">

        <!--footer container-->

        <div class="row-fluid">

          <div class="span4">

            <section>

              <h4>

                Contact Us</h4>

              <p>

                  <span class="icon-phone">&nbsp;</span> <strong> U.S. Office: </strong> <a href="tel:424 253-0025" class="tele">(424) 253-0025</a> <br />

                  <span class="icon-phone">&nbsp;</span> <strong> Australia Office: </strong> <a href="tel:02 8003 6997" class="tele">(02) 8003 6997</a> <br />

                  <span class="icon-skype">&nbsp;</span> <strong>Skype:</strong><a href="skype:portal.education" class="tele">portal.education</a>  <br />

                  <strong>Email:</strong> <span class="icon-envelope">&nbsp;</span><a href="mailto:support@portaleducation.com" class="tele">support@portaleducation.com</a> <br />

              </p>

            </section>

            <!--close section-->

          </div>

          <!-- close .span4 -->

          <!--section containing newsletter signup and recent images-->

          <div class="span4">

          <section>

             </section>     

            <!--close section-->

          </div>

          <!-- close .span4 -->

          <!--section containing blog posts-->

          <div class="span4">

            <section>

              <h4>

                Follow Us</h4>

              <ul class="social">

                <li><a class="icon-facebook big" target="_blank" href="http://www.facebook.com/pages/Portal-Education/107251242687857/"

                  title="Follow us on Facebook"></a></li>

                <li><a class="icon-twitter big" target="_blank" href="https://twitter.com/portaleducation" title="Follow us on Twitter">

                </a></li>                

              </ul>

            </section>

            <!--close section-->



          </div>

          <!-- close .span4 -->

        </div>

        <!-- close .row-fluid-->

      </div>

      <!-- close footer .container-->

      <!--change this to your stuff-->

      <section class="footerCredits">

        <div class="container">

          <ul class="clearfix">

            <li>© Copyright 2013,PORTAL Education All Rights Reserved .</li>           

          </ul>

        </div>

        <!--footerCredits container-->

      </section>

      <!--close section-->

    </footer>

    <!--/.footer-->

    <span id="backToTop" class="backToTop"><a href="#top">

      back to top</a></span>

  </div>

</div>  

  <!-- close #page-->

  <script src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/js/bootstrap.min.js"></script>

  <script src="<?php echo get_stylesheet_directory_uri() ?>/dfcon2014/js/main.js"></script>

</body>

</html>

