( function( $ ) {

  setTimeout("$('.fullWrapper').removeClass('loading')",1000);	
  $(".chosen-select").chosen();
  $('.datepicker').datepicker({	
					dateFormat: 'dd/mm/yy',
					autoclose: false,
					changeMonth: true,
					changeYear: true,
					defaultDate:'',
					showOn: 'both', 
					buttonImage: 'img/calendar.gif',
                    buttonImageOnly: true,
                    beforeShow: function (textbox, instance) {
			            instance.dpDiv.css({
			                    marginTop: (-textbox.offsetHeight) + 'px',
			                    marginLeft: textbox.offsetWidth + 'px'
			            });
    				},
					onSelect:function(dateText, inst) { 
						var dateAsString = dateText; //the first parameter of this function
						var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
						
						if($(this).hasClass('alos-date')){
						  
							  if($(this).attr('id')=='AdmissionDate'){
								$('.surgery-box label').html('Date of Admission-Surgery confirmed');
								$('#surgery-check').val(0).prop('checked',false).removeAttr('disabled'); $('.surgery-box').show(); 
							     
							     if($(this).val()!=''){
							     	$('.ass-condition').show();
							     	
							     	$('#ass_no').trigger('click');

							     }else{ $('.ass-condition').hide(); }

							  } else if($(this).attr('id')=='SeparationDate'){
								  
                                    $('.separation-box label').html('Date of Surgery-Separation confirmed');
									$('#separation-check').val(0).prop('checked',false).removeAttr('disabled');  $('.separation-box').show(); 
							  }
							  else if($(this).attr('id')=='SurgeryDate') {
									
									$('#surgery-check').val(0).prop('checked',false);
									$('.separation-box label').html('Date of Surgery-Separation confirmed');
									$('#separation-check').val(0).prop('checked',false).removeAttr('disabled');  $('.separation-box').show(); 
							   }
							   
								  admission_check();
							}
						
					},
					onClose: function(dateText, inst){ 
						var dateAsString = dateText; //the first parameter of this function
						var dateAsObject = $(this).datepicker( 'getDate' ); 
						console.log("outer"+dateAsObject);
						if(dateAsObject!=null){
							console.log("inner"+dateAsObject);
						var newDate = new Date(dateAsObject.getFullYear(),(dateAsObject.getMonth()),dateAsObject.getDate());
						var up_date = $.datepicker.formatDate('dd/mm/yy',newDate);
						 $(this).val(up_date);	
					   }
					   else{
					    	$(this).val('');
					    }	
							/*if($(this).hasClass('alos-date') && $(this).attr('id')=='SeparationDate' && $('#surgery-check').prop('checked')==false){
								$(this).val('');
							}else{
						      $(this).val(up_date);
							}*/
					}
					
				}); 
				
				
	$('#surgery-check').click(function(){
		
        if( $(this).prop('checked')==true){
	        var message='';		  
			var AdmissionDate = $('#AdmissionDate').val();
			var SurgeryDate = $('#SurgeryDate').val();
	        if(AdmissionDate==''){ message+="+ AdmissionDate field is required\n";  } 
	        if(SurgeryDate==''){ message+="+ SurgeryDate field is required\n";}
	        if(message!='') { showdialog(message); } else { $('#surgery-check').prop('checked',false); admission_check();}
        }
          
	  //$('#surgery-check').prop('checked',true);
	  //admission_check();
	});
	
	

  $('#separation-check').click(function(){
		var message='';
		if( $(this).prop('checked')==true){
			var SeparationDate = $('#SeparationDate').val();
			var SurgeryDate = $('#SurgeryDate').val();
	        if(SeparationDate==''){	message+="+ SeparationDate field is required\n"; } 
	        if(SurgeryDate==''){ message+="+ SurgeryDate field is required\n";}
	        if(message!=''  ) { showdialog(message);  } else {  $('#separation-check').prop('checked',false);  admission_check();}
       }

	  /*$('#separation-check').prop('checked',false);
		  admission_check();*/
	});
	
	$('.ass_cond').click(function(){
		if( $(this).val()==1){
			 var AdmissionDate = $('#AdmissionDate').val();
			 $('#SeparationDate').val(AdmissionDate);
			 $('#SurgeryDate').val(AdmissionDate);
			 $('#surgery-check,#separation-check').prop('checked',true);
			 $('.surgery-box,.separation-box').show();
       }else{
       	     $('#SeparationDate').val('');
			 $('#SurgeryDate').val('');
			 $('#surgery-check,#separation-check').prop('checked',false);
			 $('.surgery-box,.separation-box').hide();
       }
	  
	});

/*	console.log($.navigator.userAgent);
	console.log($.browser);
	 if ( $.browser.msie ) {
		if($.browser.version > 9)
    $('.modal').removeClass('fade');
	 }*/
		var browser_type='';
		var isSafari = (navigator.userAgent.indexOf('Safari') != -1
		&& navigator.userAgent.indexOf('Chrome') == -1)
		if(isSafari){browser_type='keyup'; } else { browser_type='change';}
    	$(".dateVariation .alos-date").on(browser_type,function() {  if($(this).hasClass('alos-date')){
						  
							  if($(this).attr('id')=='AdmissionDate'){
								$('.surgery-box label').html('Date of Admission-Surgery confirmed');
								$('#surgery-check').val(0).prop('checked',false).removeAttr('disabled'); $('.surgery-box').hide(); 
								     if($(this).val()!=''){
							     	$('.ass-condition').show();
							     	
							     	$('#ass_no').trigger('click');

							     }else{ $('.ass-condition').hide(); }
							  } else if($(this).attr('id')=='SeparationDate'){
								  
                                    $('.separation-box label').html('Date of Surgery-Separation confirmed');
									$('#separation-check').val(0).prop('checked',false).removeAttr('disabled');  $('.separation-box').show(); 

								  /*if($("#surgery-check").prop('checked')==false){
									  showdialog("Please confirm Date of Admission-Surgery  checked box");
									  return false;
								  }else{
									  $("#separation-check").prop('checked',false);
								  }*/

							  }
							  else if($(this).attr('id')=='SurgeryDate') {
									
									$('#surgery-check').val(0).prop('checked',false);
									$('.separation-box label').html('Date of Surgery-Separation confirmed');
									$('#separation-check').val(0).prop('checked',false).removeAttr('disabled');  $('.separation-box').show(); 
							   }
							   
								  admission_check();
							}  });	
							
   $(".dateVariation .alos-date").keypress(function(event) {  $(this).val(''); event.preventDefault(); });
				
		
		
		
/*				
	$('#horizontalTab li').on('click','a.r-tabs-anchor',function(){
		var EstDischargeTime = $('#EstDischargeTime').val();	
		
		if($(this).attr('href') == '#tab-3'){
			if(EstDischargeTime == '' || EstDischargeTime == 0){
				
				$("#horizontalTab li:nth-child(2)" ).addClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(3)" ).removeClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(3)" ).addClass('r-tabs-state-default');
				$("#horizontalTab li:nth-child(2)" ).removeClass('r-tabs-state-default');
				$('#tab-3').removeClass('r-tabs-state-active').hide();
				$('#tab-2').addClass('r-tabs-state-active').show();
				$('#EstDischargeTime').css('border','1px solid #fe000');
				$('#EstDischargeTime').focus();
			}else{
				$("#horizontalTab li:nth-child(3)" ).addClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(2)" ).removeClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(2)" ).addClass('r-tabs-state-default');
				$("#horizontalTab li:nth-child(3)" ).removeClass('r-tabs-state-default');
				$('#tab-2').removeClass('r-tabs-state-active').hide();
				$('#tab-3').addClass('r-tabs-state-active').show(); 
			}		
		}
	});*/
		
  $('#Tourniquet_Location1').change(function(){
		var order_app = $('#Order_App1').val();
		var time_app = $('#Time_App1').val();
		var time_rem = $('#Time_rem1').val();
		var location = $('#Tourniquet_Location1').val();
		if(order_app == '' || time_app == '' || time_rem == '' || location == ''){
		
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Select all field values of TOURNIQUET 1 to continue with TOURNIQUET 2');
		}else{
			BootstrapDialog.show({
           	 	title: 'Error : TOURNIQUET 1',
		    	message:'Select all field values of TOURNIQUET 1 to continue with TOURNIQUET 2',
    		});
		}
		}else{
		  $('#hidden_2 .hideme_from').remove();
		}
	});
	$('#Time_App1,#Time_rem1').blur(function(){
		var order_app = $('#Order_App1').val();
		var time_app = $('#Time_App1').val();
		var time_rem = $('#Time_rem1').val();
		var location = $('#Tourniquet_Location1').val();
		if(order_app == '' || time_app == '' || time_rem == '' || location == ''){
		}else{
			 $('#hidden_2 .hideme_from').remove();
		}
	});
	
	$('#Time_App2,#Time_rem2').blur(function(){
		var order_app = $('#Order_App2').val();
		var time_app = $('#Time_App2').val();
		var time_rem = $('#Time_rem2').val();
		var location = $('#Tourniquet_Location2').val();
		if(order_app == '' || time_app == '' || time_rem == '' || location == ''){
		}else{
			 $('#hidden_3 .hideme_from').remove();
		}
	});
	
	$('#Time_App3,#Time_rem3').blur(function(){
		var order_app = $('#Order_App3').val();
		var time_app = $('#Time_App3').val();
		var time_rem = $('#Time_rem3').val();
		var location = $('#Tourniquet_Location3').val();
		if(order_app == '' || time_app == '' || time_rem == '' || location == ''){
		}else{
			 $('#hidden_4 .hideme_from').remove();
		}
	});
	$('#Tourniquet_Location2').change(function(){
		var order_app = $('#Order_App2').val();
		var time_app = $('#Time_App2').val();
		var time_rem = $('#Time_rem2').val();
		var location = $('#Tourniquet_Location2').val();
		if(order_app == '' || time_app == '' || time_rem == '' || location == ''){
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Select all field values of TOURNIQUET 2 to continue with TOURNIQUET 3');
		}else{
			BootstrapDialog.show({
           	 	title: 'Error : TOURNIQUET 2',
		    	message:'Select all field values of TOURNIQUET 2 to continue with TOURNIQUET 3',
    		});
		}	
		}else{
		  $('#hidden_3 .hideme_from').remove();
		}
	});
	
	$('#Tourniquet_Location3').change(function(){
		var order_app = $('#Order_App3').val();
		var time_app = $('#Time_App3').val();
		var time_rem = $('#Time_rem3').val();
		var location = $('#Tourniquet_Location3').val();
		if(order_app == '' || time_app == '' || time_rem == '' || location == ''){
		 if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Select all field values of TOURNIQUET 2 to continue with TOURNIQUET 4');
		}else{	
			BootstrapDialog.show({
           	 	title: 'Error : TOURNIQUET 3',
		    	message:'Select all field values of TOURNIQUET 3 to continue with TOURNIQUET 4',
    		});
		}
		}else{
		  $('#hidden_4 .hideme_from').remove();
		}
	});
	
	  
	  
	  
	  $('.cmorbidities-in').click(function(){
	     if($('#no_com').is(':checked')){ 
			$('.commadites_select').hide();
		 }else if($('#yes_com').is(':checked')){
			$('.commadites_select').show();
		}	 
	  
	  });
	  
	$('select').change(function(){
	   var my_id = '#'+$(this).attr('id')+'_chzn'; 	   
	   jQuery(my_id+' a.chzn-single span').html($(this).val());
	});
	  
	setTimeout('changeSelect();',1000);
	
	$('.checker_Parent').click(function(){
	   if($(this).is(':checked')){
	     $('.checker_Parent_child').each(function(){
		    $(this).hide();
			$(this).find('input[type="checkbox"]').removeAttr('checked');
		 });
		 $('.section-second.hidden_section').attr('style','visibility:hidden');
		 $('#InpatientOutcome').val(0);
	   }else{
	     $('.checker_Parent_child').each(function(){
		    $(this).show();
			$('#section-toper,#section-toper2').show();
			
		 });
		 $('.section-second.hidden_section').attr('style','visibility:visible');
	   }
	});
	
	
	
	$('.parent_section').click(function(){
	   if($(this).is(':checked')){
		   $('.root-element').hide();
		   $('.root-element').find('input[type="checkbox"]').removeAttr('checked');
		   $('#section-toper2').hide();
		   $('section-toper2 [type="checkbox"]').each(function(){
				$(this).hide();
				$(this).removeAttr('checked');
			 });
		   
		   $('.section-third .checker_Parent_child').hide();
		   $('#InpatientOutcome').val(0);
	   }else{
		   $('.root-element').show();		   
		   $('#section-toper2').show();		   
		   $('.section-third .checker_Parent_child').show();
		   $('.inner_check').each(function(){
		    $(this).removeAttr('checked');
		   });
		  $('.section-second.hidden_section').attr('style','visibility:visible'); 
	   }
	});
	
	$('.inner_check').click(function(){
	  if($(this).is(':checked')){	  
		if($(this).attr('id') == 'TransferOvernight'){
			$('#OtherFacility').removeAttr('checked');
		}else if($(this).attr('id') == 'OtherFacility'){
		    $('#TransferOvernight').removeAttr('checked');
		}
	  }
	});
	
	$('.cancel_check').click(function(){
		var v_id = $(this).attr('id');	
		 if($(this).is(':checked')){
		   $('.root-element').hide();
		   $('.root-element').find('input[type="checkbox"]').removeAttr('checked');
		   $('#section-toper').hide();
		   $('section-toper [type="checkbox"]').each(function(){				
				$(this).removeAttr('checked');
			 });
		   $('.section-third .checker_Parent_child').hide();
		   $('.section-second.hidden_section').attr('style','visibility:hidden');
		   $('#section-toper2 [type="checkbox"]').each(function(){
		      if($(this).attr('id') != v_id){				
				$(this).removeAttr('checked');
			  }
			});
		$('#InpatientOutcome').val(0);
		}else{
		  $('.root-element').show();		   
		   $('#section-toper').show();
		   $('section-toper [type="checkbox"]').each(function(){				
				$(this).removeAttr('checked');
			 });
		   $('.section-third .checker_Parent_child').show();
		   $('.section-second.hidden_section').attr('style','visibility:visible');
		
		}
	});
	
	
$(document).delegate('.r-tabs-tab','click',function(){
	 var user = $('.record-validate-user .val').text();
	 var text_id = $(this).find('a:first').attr('href');
	 var action = 'insert'; 
	 var action_id = '';
	 var lastname = $('#lastname').val();
	 var firstname = $('#fname').val();
	 var sex = $('#sex').val();	
	 var PostCode = $('#PostCode').val();
	 var URN = $('#URN').val();
	 var dob = $('#dob').val();
	 var AdmissionDate = $('#AdmissionDate').val();
	 var SeparationDate = $('#SeparationDate').val();
	 var Initial_Cons_Date = $('#Initial_Cons_Date').val();
	 var SurgeryDate = $('#SurgeryDate').val();
	 var FacilityCode = $('#FacilityCode').val();
	 var SurgeonType = $('#SurgeonType').val();
	 var ComorbiditiesYesNo = $('.cmorbidities-in:radio:checked').val();
	 
	 var Comorbidity01 = $('#Comorbidity1').val();
	 var Comorbidity02 = $('#Comorbidity2').val();
	 var Comorbidity03 = $('#Comorbidity3').val();
	 var Comorbidity04 = $('#Comorbidity4').val();
	 var Comorbidity05 = $('#Comorbidity5').val();
	 var Comorbidity06 = $('#Comorbidity6').val();
	 var Comorbidity07 = $('#Comorbidity7').val();
	 var Comorbidity08 = $('#Comorbidity8').val();
	 var Comorbidity09 = $('#Comorbidity9').val();
	 var Comorbidity10 = $('#Comorbidity10').val();
	 
	 var EstDischargeTime = $('#EstDischargeTime').val();
	 var PDx = $('#PDx').val();
	 var SD1 = $('#SDx01').val();
	 var SD2 = $('#SDx02').val();
	 var SD3 = $('#SDx03').val();
	 var SD4 = $('#SDx04').val();
	 var SD5 = $('#SDx05').val();
	 var SD6 = $('#SDx06').val();
	 var SD7 = $('#SDx07').val();
	 var SD8 = $('#SDx08').val();
	 var SD9 = $('#SDx09').val();
	 var SD10 = $('#SDx10').val();
	 var SD11 = $('#SDx11').val();
	 var SD12 = $('#SDx12').val();
	 var SD13 = $('#SDx13').val();
	 var SD14 = $('#SDx14').val();
	 var SD15 = $('#SDx15').val();
	 var SD16 = $('#SDx16').val();
	 var SD17 = $('#SDx17').val();
	 var SD18 = $('#SDx18').val();
	 var SD19 = $('#SDx19').val();
	 var SD20 = $('#SDx20').val();
	 var SD21 = $('#SDx21').val();
	 var SD22 = $('#SDx22').val();
	 var SD23 = $('#SDx23').val();
	 var SD24 = $('#SDx24').val();
	 
	 var Proc1 = $('#Proc01').val();
	 var Proc2 = $('#Proc02').val();
	 var Proc3 = $('#Proc03').val();
	 var Proc4 = $('#Proc04').val();
	 var Proc5 = $('#Proc05').val();
	 var Proc6 = $('#Proc06').val();
	 var Proc7 = $('#Proc07').val();
	 var Proc8 = $('#Proc08').val();
	 var Proc9 = $('#Proc09').val();
	 var Proc10 = $('#Proc10').val();
	 var Proc11 = $('#Proc11').val();
	 var Proc12 = $('#Proc12').val();
	 var Proc13 = $('#Proc13').val();
	 var Proc14 = $('#Proc14').val();
	 var Proc15 = $('#Proc15').val();
	 var Proc16 = $('#Proc16').val();
	 var Proc17 = $('#Proc17').val();
	 var Proc18 = $('#Proc18').val();
	 var Proc19 = $('#Proc19').val();
	 var Proc20 = $('#Proc20').val();
	 var Proc21 = $('#Proc21').val();
	 var Proc22 = $('#Proc22').val();
	 var Proc23 = $('#Proc23').val();
	 var Proc24 = $('#Proc24').val();
	 
	 var Tourniquet1_Used 		   = $('#TOURNIQUET1').val();
	 var Tourniquet1_OrderOfApplic = $('#Order_App1').val();
	 var Tourniquet1_TimeOfApplic  = $('#Time_App1').val();
	 var Tourniquet1_TimeOfRemoval = $('#Time_rem1').val();
	 var Tourniquet_Location1 	   = $('#Tourniquet_Location1').val();
	 
	 var Tourniquet2_Used 		   = $('#TOURNIQUET2').val();
	 var Tourniquet2_OrderOfApplic = $('#Order_App2').val();
	 var Tourniquet2_TimeOfApplic  = $('#Time_App2').val();
	 var Tourniquet2_TimeOfRemoval = $('#Time_rem2').val();
	 var Tourniquet_Location2	   = $('#Tourniquet_Location2').val();
	 
	 var Tourniquet3_Used 		   = $('#TOURNIQUET3').val();
	 var Tourniquet3_OrderOfApplic = $('#Order_App3').val();
	 var Tourniquet3_TimeOfApplic  = $('#Time_App3').val();
	 var Tourniquet3_TimeOfRemoval = $('#Time_rem3').val();
	 var Tourniquet_Location3	   = $('#Tourniquet_Location3').val();
	 
	 var Tourniquet4_Used 		   = $('#TOURNIQUET4').val();
	 var Tourniquet4_OrderOfApplic = $('#Order_App4').val();
	 var Tourniquet4_TimeOfApplic  = $('#Time_App4').val();
	 var Tourniquet4_TimeOfRemoval = $('#Time_rem4').val();
	 var Tourniquet_Location4	   = $('#Tourniquet_Location4').val();
	 
	 
	 
	 var IntraOpProphylaxis_Thrombo	   	= $('#Thrombo1').val();
	 var IntraOpProphylaxis_Antibiotic	= $('#Antibiotic1').val();
	 var IntraOp_2ndDose	= $("#IntraOp_2ndDose:checkbox:checked").map(function(){
									return $(this).val();
								}).get();
	 var PostOpProphylaxis_Thrombo	    = $('#Thrombo2').val();
	 var PostOpProphylaxis_Antibiotic	= $('#Antibiotic2').val();
	 
	 var ASACategory	= $('#ASACategory').val();
	 var AnaesthesiaType1	= $('#Anaesthesia1').val();
	 var AnaesthesiaType2	= $('#Anaesthesia2').val();
	 var AnaesthesiaType3	= $('#Anaesthesia3').val();
	 
	 var ComplicationCode1		= $('#ComplicationCode1').val();
	 var ComplicationCode2		= $('#ComplicationCode2').val();
	 var ComplicationCode3		= $('#ComplicationCode3').val();
	 var ComplicationCode4		= $('#ComplicationCode4').val();
	 var ComplicationCode5		= $('#ComplicationCode5').val();
	 var ComplicationDegreeCode	= $('#ComplicationDegreeCode').val();
	
	 var error = '';
	 var message = '';
	 action_id = $('#record_id').val();

	 if(action_id != 0){ action = 'update';}

     	if(lastname == '' || (/^[a-zA-Z0-9- ]*$/.test(lastname) == false)) {
				  add_error_message('#lastname','Enter the Valid Last Name');
				  error += '+ Enter the Valid Last Name\n';
			  }else{	
				  remove_error('#lastname');
			  }
			  if(firstname == '' || (/^[a-zA-Z0-9- ]*$/.test(firstname) == false)) {
				  add_error_message('#fname','Enter the Valid First Name');
				  error += '+ Enter the Valid First Name \n';
			  }else{
				  remove_error('#fname');
			  }
			  if(PostCode == '' || (/^[a-zA-Z0-9- ]*$/.test(PostCode) == false)) {
				  add_error_message('#PostCode','Enter the Valid Post Code');
				  error += '+ Enter the Valid Post Code\n';
			  }else{
				  remove_error('#PostCode');
			  }
		  
			  if(URN == '' || (/^[a-zA-Z0-9- ]*$/.test(URN) == false)) {
				  add_error_message('#URN','Enter the Valid URN');
				  error += '+ Enter the Valid URN\n';
			  }else{
				  remove_error('#URN');
			  }
			  if(sex == '') {
				  add_error_message('#sex','Select the Sex field value');
				  error += '+ Select the Sex field value\n';		  
			  }else{
				  remove_error('#sex');
			  }
			  
			  if(FacilityCode == '') {
				  add_error_message('#FacilityCode','Enter Valid Facility Code');
				  error += '+ Enter Valid Facility Code\n';
			  }else{
				  remove_error('#FacilityCode');
			  }
		  
			  if(SurgeonType == '') {
				  add_error_message('#SurgeonType','Select the valid  Surgeon Type');
				  error += '+ Select the valid  Surgeon Type\n';
			  }else{
				  remove_error('#SurgeonType');
			  }
			  c_date = new Date();		  
			  dob_date = date_creator(dob);			  
			  dob_year = get_year(dob);
			  current_year = new Date().getFullYear();
			  AdmissionDate_date = date_creator(AdmissionDate);	
			  AdmissionDate_year = get_year(AdmissionDate);	
			  SeparationDate_date = date_creator(SeparationDate);
			  SeparationDate_year = get_year(SeparationDate);
			  Initial_Cons_Date_date = date_creator(Initial_Cons_Date);	
			  Initial_Cons_Date_year = get_year(Initial_Cons_Date);
			  SurgeryDate_date = date_creator(SurgeryDate);
			  SurgeryDate_year = get_year(SurgeryDate);
			  if(dob_date >= c_date || dob == ''){
				message = 'DOB Missing or In the future';
			  }else if(dob_year <= 1901){
				  message = 'Patient too old (born before 1900)';
			  }
			  if(message != ''){
				 add_error_message('#dob',message);	
				 error = '+ '+message+'\n';
			  }else{
				  remove_error('#dob');
			  }
		  
			  message = '';
			  if(AdmissionDate == '' ){
				message = 'Admission Date Missing or In the future';
			  }else if(AdmissionDate_year <= 1970){
				  message = 'Patient Admission Date too far behind';	
			  }
			  
			  
			  
			  if(message != ''){
				 add_error_message('#AdmissionDate',message);	
				 error += '+ '+message+'\n';
			  }else{
				  remove_error('#AdmissionDate');
			  }
			  
			  message = '';
			  if(Initial_Cons_Date_date >= c_date || Initial_Cons_Date == '' ){
				message = 'Initial Cons Date Missing or In the future';
			  }
			  if(message != ''){
				 add_error_message('#Initial_Cons_Date',message);	
				 error += '+ '+message+'\n';
			  }else{
				  remove_error('#Initial_Cons_Date');
			  }
			  message = '';
			  if( SeparationDate == ''){
				message = 'Separation Date Missing or In the future';
			  }
			 
			  if(message != ''){
				 add_error_message('#SeparationDate',message);	
				 error += '+ '+message+'\n';
			  }else{
				  remove_error('#SeparationDate');
			  }
			  message = '';
			  if( SurgeryDate == ''){
				message = 'Surgery Date  Missing or In the future';
			  }
			  if(message != ''){
				 add_error_message('#SurgeryDate',message);	
				 error += '+ '+message+'\n';
			  }else{
				  remove_error('#SurgeryDate');
			  }
			  
			
			if(AdmissionDate!='' && SurgeryDate!='' && SeparationDate!='' && $('#surgery-check').prop('checked')==false && $('#separation-check').prop('checked')==false ){
				 error += '+ Please confirm Date of Admission/Surgery/separation  by selecting check box \n';
			}else{
					if(AdmissionDate!='' && SurgeryDate!=''){
						 if($('#surgery-check').prop('checked')==false){
							 error += '+ Please confirm Date of Admission/Surgery  by selecting check box \n';
						 }
					}
					
					if(SeparationDate!='' && SurgeryDate!=''){
						 if($('#separation-check').prop('checked')==false){
							 error += '+ Please confirm Date of Surgery/separation by selecting check box\n';
						 }
					}
			}

	      if(text_id != '#tab-1' &&  text_id != '#tab-2'){
			
				if(EstDischargeTime == 0 || EstDischargeTime == '') {
					add_error_message('#EstDischargeTime','Enter Valid Estimated Time To Discharge From Recovery');
					error += '+ Enter Valid Estimated Time To Discharge From Recovery\n';
				}else{
					remove_error('#PostCode');
				}
				if(PDx == 0 || PDx == '') {
					add_error_message('#PDx','Select the valid PRINCIPAL DIAGNOSIS method');
					error += '+ Select the valid PRINCIPAL DIAGNOSIS method\n';
				}else{
					remove_error('#PDx');
				}
				  
		  }
				  
			  if(error != ''){
					  BootstrapDialog.show({
						title: 'Validation Error',
						message:error
					  });
			  
				/*$("#horizontalTab li:nth-child(1)" ).removeClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(2)" ).addClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(1)" ).addClass('r-tabs-state-default');
				$("#horizontalTab li:nth-child(2)" ).removeClass('r-tabs-state-default');
				$('#tab-2').removeClass('r-tabs-state-active').hide();
				$('#tab-1').addClass('r-tabs-state-active').show();*/
				return false;
      }
	  
      var error_count=0;
	  var steps = 0;
      if(text_id == '#tab-2'){
				steps = 1; 
				/*$('#tab-2').addClass('r-tabs-state-active').show();
				$('#tab-1').removeClass('r-tabs-state-active').hide();*/		
			 
	 		}else if(text_id == '#tab-3'){
				 steps = 2; 
		 }else if(text_id == '#tab-4'){	
				/*$("#horizontalTab li:nth-child(2)" ).removeClass('r-tabs-state-active');
				$("#horizontalTab li:nth-child(2)" ).addClass('r-tabs-state-default');
				$('#tab-2').removeClass('r-tabs-state-active').hide();
				$('#tab-24').addClass('r-tabs-state-active').show();*/
				 steps = 3; 	
		 
		 }else if(text_id == '#tab-5'){	
		    steps = 4; 
		 }else if(text_id == '#tab-6'){	
		      steps = 5; 
		 }
	var record = $('#Dataentryfrm').serialize();
	Ajax_send(action,action_id,user,record,steps);
		
 });

$(document).delegate('#alos-check','click',function(){
 var AdmissionDate,SeparationDate;
 AdmissionDate=$('#AdmissionDate').val();SeparationDate=$('#SeparationDate').val();
 if(jQuery(this).prop('checked') == true && AdmissionDate!='' && SeparationDate!=''){
   var days=daydiff(parseDate(AdmissionDate),parseDate(SeparationDate));
			if(days>1 || days<0){ 
			BootstrapDialog.show({
				title: 'WARNING',
				message:"The ALOS is longer than 1 day.Please confirm this is correct",
				type: BootstrapDialog.TYPE_WARNING,
				closable: true,
				closeByBackdrop: false,
				closeByKeyboard: false,
				buttons: [{
		                label: 'Yes',
		                cssClass: 'btn-success',
		                action: function(dialogRef){
		                	$('#alos-check').prop('checked',true); 
		                	$('#AdmissionDate,#SeparationDate').attr('readonly','readonly');
		                	$('#AdmissionDate,#SeparationDate').datepicker('disable');
		                    $('#un_check').show();
		                    dialogRef.close();
		                }
		            }, {
		                label: 'No',
		                cssClass: 'btn-warning',
		                action: function(dialogRef){
		                    dialogRef.close();
		                	$('#alos-check').prop('checked',false); 
		                    $("#SeparationDate").focus();
		                }
		            }]
			});
			
		  } else {     
						BootstrapDialog.show({
						title: 'ALOS',
						message:"The ALOS is 1 day",
						type: BootstrapDialog.TYPE_SUCCESS,
						closable: true,
						closeByBackdrop: false,
						closeByKeyboard: false
						});

						$('#AdmissionDate,#SeparationDate').attr('readonly','readonly');
						$('#AdmissionDate,#SeparationDate').datepicker('disable');
						$('#un_check').show();
		  }
 }else {  
$('#alos-check').prop('checked',false);
$('#AdmissionDate,#SeparationDate').removeAttr('readonly','readonly');
$('#AdmissionDate,#SeparationDate').datepicker('enable'); $('#un_check').hide();  }
});


/** CONFIRM LOGOUT  **/
$('.confirm-logout').click(function(){

	var lastname = $('#lastname').val();
							var firstname = $('#fname').val();
							var sex = $('#sex').val();	
							var PostCode = $('#PostCode').val();
							var URN = $('#URN').val();
							var dob = $('#dob').val();
							var Initial_Cons_Date = $('#Initial_Cons_Date').val();
							$('#is_validate').val(0);
							c_date = new Date();
							dob_date = date_creator(dob);	
							dob_year = get_year(dob);
							current_year = new Date().getFullYear();
							var error='',error_count=0;

							if(lastname == '' || (/^[a-zA-Z0-9- ]*$/.test(lastname) == false)) {
								error += '+ Enter the Valid Last Name\n';
								error_count++;
							}
	
							if(firstname == '' || (/^[a-zA-Z0-9- ]*$/.test(firstname) == false)) {
							error += '+ Enter the Valid First Name \n';
							error_count++;
							}
							
							if(PostCode == '' || (/^[a-zA-Z0-9- ]*$/.test(PostCode) == false)) {
							error += '+ Enter the Valid Post Code \n';
							error_count++;
							}
							
							if(URN == '' || (/^[a-zA-Z0-9- ]*$/.test(URN) == false)) {
							error += '+ Enter the Valid URN \n';
							error_count++;
							}
							
							if(sex == '') {
							error += '+ Select the Sex field value \n';
							error_count++;
							}
							
							if(dob_date >= c_date || dob == ''){
							error += '+ DOB Missing or In the future \n';
							error_count++;
							}else if(dob_year <= 1901){
							error  += '+ Patient too old (born before 1900) \n';
							error_count++;	
							}
							
							if( Initial_Cons_Date == '' ){
							error += '+ Initial Cons Date Missing or In the future \n';
							error_count++;
							}
							
                       
                            if(error_count==7) { 

                              window.location.href='logout.php';
                              return false;
                            }


	   BootstrapDialog.show({
				title: 'WARNING',
				message:'Are you sure you want to save this entry before logout ?',
				type: BootstrapDialog.TYPE_WARNING,
				buttons: [{
		                label: 'Yes',
		                cssClass: 'btn-success',
		                action: function(dialogRef){
							dialogRef.close();
							
							
						   if(error!='') {
							if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
							 alert(error);
							}else{	
							BootstrapDialog.show({
							title: 'Validation Error',
							message:error,
							});
							}
							return false;
							}else { 
							   $('#Dataentryfrm').attr('action','add_record.php');
							   $('#submit_data').click(); 
							} 
		                }
		            }, {
		                label: 'No',
		                cssClass: 'btn-warning',
		                action: function(dialogRef){
							dialogRef.close();
							window.location.href='logout.php';
						    
		                }
		            }]
			});
});

   $('#validate_records').click(function(){
	  var get_error= validate('','');
      if(get_error!='') {
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
		   alert(get_error);
		}else{	
			BootstrapDialog.show({
			title: 'Validation Error',
			message:get_error,
		});
		}
		return false;
 	 }else { 
      $('#is_validate').val(1);	
	  $('#submit_data').click(); 
	 }
  });
  
  $('.add_new_record').click(function(){
       var get_error = validate(type="reload",'addnew');
        if(get_error!='') {
				if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
				   alert(get_error);
				}else{	
					BootstrapDialog.show({
					title: 'Validation Error',
					message:get_error,
				});
				}
		return false;
	  }else {
			$('#Dataentryfrm').attr('action','add_record.php');
			$('#submit_data').click(); 
	 }
	  
  });


  $('#InpatientOutcome').change(function(){
	 if($(this).val() != 0){
		$('.section-first div').hide(); 
		$('.section-first input[type="checkbox"]').each(function(){
			$(this).removeAttr('checked');
		});
		 }else{
		 $('.section-first div').show(); 
	 }
  });
  
  $(document).on('click','#delete_record',function(){
	var txt;
	var string_txt  = $(this).attr('data-id') + ' ('+ $(this).attr('data-name') +') ?';
	var r = confirm("Are you sure want to delete the records of "+string_txt);
	if (r == true) {
		window.location = 'user_records.php?user='+$(this).attr('data-user')+'&acrion=view&delete_record='+$(this).attr('data-id');
	} else {
		return false;
	} 
  });
	 
	  
  $(document).on('click','#delete_this',function(){
	 if($('.delete_this:checked').length > 0){
		var r = confirm("Are you sure want to delete Selected Items");
		if (r == true) {
			$('#delete_control').submit();
		} else {
		return false;
		}
	 }else{
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Nothing to delete');
		}else{	
			BootstrapDialog.show({
           	 	title: 'No item Selected',
		    	message:'Nothing to Delete',
    		});
		} 
	 }
	  
	
  });	  
  
  
  $('#delete_A_record').click(function(){
	var txt;
	var string_txt  = $('#fname').val() + ' '+$('#lastname').val() + ' ('+$('#record_id').val() +') ?';
	var r = confirm("Are you sure want to delete the records of "+string_txt);
	if (r == true) {
		window.location = 'dashboard.php?delete_record='+$('#record_id').val();
	} else {
		return false;
	}
  });
  
  $('#goto').click(function(){
   var query_string = getParameterByName('search_String');
   if(query_string != ''){
     window.location = 'dashboard.php?item='+$('#mygo').val()+'&search_String='+query_string+'&search=search'; 
	}else{
	 window.location = 'dashboard.php?item='+$('#mygo').val();  
	}
    
  });
  
  
  $('.cmorbiditiesselect').change(function(){
	  var this_value = $(this).val();
	  var my_id = $(this).attr('id');
	  var data_item = jQuery(this).attr('data-item');
	  var error_enable = '';
	  $('.cmorbiditiesselect').each(function(){
		if($(this).val() ==  this_value && $(this).attr('id') != my_id){
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){

					alert('This Comorbidity has already been selected Please select another one');
		}else{	
			BootstrapDialog.show({
           	 	title: 'Selected Comorbidity Error',
		    	message:'This Comorbidity has already been selected Please select another one',
    		});
		}
		
		 //  alert('This Comorbidity has already been selected Please select another one');
		  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  $('#'+my_id+'_chzn a span').text('');
		  $('#'+my_id).val('');
		}
	  });
	  for(i=1;i<data_item;i++){
		if(jQuery('#Comorbidity'+i).val() == '' && error_enable == ''){
			if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Please select the values in Order');
			}else{
				BootstrapDialog.show({
					title: 'Comorbidity Order Error',
					message:'Please select the values in Order',
				});
			}	
			
			$('#'+my_id+'_chzn a').addClass('chzn-default');
			$('#'+my_id+'_chzn a span').text('');
			$('#'+my_id).val('');
			error_enable = 'true';
		}
	  }
  });
  
  
  $('.sdx').change(function(){
	  var this_value = $(this).val();
	  var my_id = $(this).attr('id');
	  var data_item = jQuery(this).attr('data-item');
	  var error_enable = '';
	  /*$('.sdx').each(function(){
		if($(this).val() ==  this_value && $(this).attr('id') != my_id){
		  alert('This Comorbidity has already been selected Please select another one');
		  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  $('#'+my_id+'_chzn a span').text('');
		  $('#'+my_id).val('');
		}
	  });*/
	  for(i=1;i<data_item;i++){
		if(jQuery('#SD'+i).val() == '' && error_enable == ''){
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Please select the values in Order');
		}else{			
			BootstrapDialog.show({
           	 	title: 'SECONDARY DIAGNOSES Order Error',
		    	message:'Please select the values in Order',
    		});
			}
			
			$('#'+my_id+'_chzn a').addClass('chzn-default');
			$('#'+my_id+'_chzn a span').text('');
			$('#'+my_id).val('');
			error_enable = 'true';
		}
	  }
  });
  
 /* $('.sdx').change(function(){
	  var this_value = $(this).val();
	  var my_id = $(this).attr('id');
	  var data_item = jQuery(this).attr('data-item');
	  var error_enable = '';
	 $('.sdx').each(function(){
		if($(this).val() ==  this_value && $(this).attr('id') != my_id){
		  alert('This Comorbidity has already been selected Please select another one');
		  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  $('#'+my_id+'_chzn a span').text('');
		  $('#'+my_id).val('');
		}
	  });
	  for(i=1;i<data_item;i++){
		if(jQuery('#SD'+i).val() == '' && error_enable == ''){
			
			BootstrapDialog.show({
           	 	title: 'PROCEDURE CODES Order Error',
		    	message:'Please select the values in Order',
    		});
			
			//alert('Please select the values in Order');
			$('#'+my_id+'_chzn a').addClass('chzn-default');
			$('#'+my_id+'_chzn a span').text('');
			$('#'+my_id).val('');
			error_enable = 'true';
		}
	  }
  });*/
  
  $('.proc_select').change(function(){
	  var this_value = $(this).val();
	  var my_id = $(this).attr('id');
	  var data_item = jQuery(this).attr('data-item');
	  var error_enable = '';
	  /*$('.proc_select').each(function(){
		if($(this).val() ==  this_value && $(this).attr('id') != my_id){
		  alert('This Comorbidity has already been selected Please select another one');
		  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  $('#'+my_id+'_chzn a span').text('');
		  $('#'+my_id).val('');
		}
	  });*/
	  for(i=1;i<data_item;i++){
		if(jQuery('#Proc'+i).val() == '' && error_enable == ''){
			if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Please select the values in Order');
			}else{	
				BootstrapDialog.show({

					title: 'PROCEDURE CODES Order Error',
					message:'Please select the values in Order',
				});
			}
			//alert('Please select the values in Order');
			$('#'+my_id+'_chzn a').addClass('chzn-default');
			$('#'+my_id+'_chzn a span').text('');
			$('#'+my_id).val('');
			error_enable = 'true';
		}
	  }
  });
  
  
  
  
  
  $('.anaesthesia').change(function(){
	  var this_value = $(this).val();
	  var my_id = $(this).attr('id');
	  var error_enable = '';
	  var data_item = jQuery(this).attr('data-item');
	  
	  /*$('.anaesthesia').each(function(){
		if($(this).val() ==  this_value && $(this).attr('id') != my_id){
		 // alert('');
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('This Anaesthesia Type has already been selected. Please select another one');
		}else{	 
		  BootstrapDialog.show({
           	 	title: 'Anaesthesia Error',
		    	message:'This Anaesthesia Type has already been selected. Please select another one',
    		});
		}
		  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  $('#'+my_id+'_chzn a span').text('');
		  $('#'+my_id).val('');
		}
	  });*/
	  for(i=1;i<data_item;i++){
		if(jQuery('#Anaesthesia'+i).val() == '' && error_enable == ''){
			//alert('Please select the values in Order');
		 if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Please select the values in Order');
		}else{	
			BootstrapDialog.show({
           	 	title: 'Anaesthesia Order Error',
		    	message:'Please select the values in Order',
    		});
		}
			$('#'+my_id+'_chzn a').addClass('chzn-default');
			$('#'+my_id+'_chzn a span').text('');
			$('#'+my_id).val('');
			error_enable = 'true';
		}
	  }
  });
  
  $('.ComplicationCode').change(function(){
	  var this_value = $(this).val();
	  var my_id = $(this).attr('id');
	  var error_enable = '';
	  var error_check= '';
	  var class_exsit = '';
	  var data_item = jQuery(this).attr('data-item');
	  $('.ComplicationCode').each(function(){
		if($(this).val() ==  this_value && $(this).attr('id') != my_id && $(this).val() != '' ){
		  if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('A Complication Code with this Value ('+this_value+') has already been selected. You may Select only one instance of a Complication Code. Please select a diffrent Complication code');
		}else{
		  	BootstrapDialog.show({
           	 	title: 'Duplicate Complication Code',
		    	message:'A Complication Code with this Value ('+this_value+') has already been selected. You may Select only one instance of a Complication Code. Please select a diffrent Complication code',
    		});
			}
		  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  $('#'+my_id+'_chzn a span').text('');
		  $('#'+my_id).val('');
		  error_check = true;
		}
		if(parseFloat($(this).val()) >= 1.1 && parseFloat($(this).val()) <= 2.6){
			class_exsit += 'true';
	 	}
	  });
	  
	  if(class_exsit == ''){
		jQuery('.options_innner.Infection').removeClass('selected');
		jQuery('.wound_contamination').hide();
	  }else{
		  jQuery('.wound_contamination').show();
	  }
	  
	  for(i=1;i<data_item;i++){
		if(jQuery('#ComplicationCode'+i).val() == '' && error_enable == ''){
		if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
					alert('Please select the values in Order');
		}else{
			 BootstrapDialog.show({
           	 	title: 'Complication Code Order',
		    	message:'Please select the values in Order',
    		});
		}	
			
			//alert('Please select the values in Order');
			$('#'+my_id+'_chzn a').addClass('chzn-default');
			$('#'+my_id+'_chzn a span').text('');
			$('#'+my_id).val('');
			error_enable = 'true';
		}
	  }
	  
	  /*Start Here*/
		var infection_text = '';
		$('.options_innner').each(function(){
			min_val = $(this).attr('data-min');	
			max_val = $(this).attr('data-max');	
			if($('.options_innner.Infection').hasClass('selected') == true){
					jQuery('.wound_contamination').show();
			}else{
			 	jQuery('.wound_contamination').hide();
			}
			if(max_val != '' && error_enable == '' &&  error_check == ''){
				if(parseFloat(this_value) >= parseFloat(min_val) && parseFloat(this_value) <= parseFloat(max_val) && !jQuery(this).hasClass(my_id)){
					if(!jQuery(this).hasClass('selected')){
						jQuery(this).addClass('selected');
						jQuery(this).addClass(my_id);
					}else if(jQuery(this).hasClass('selected')){
					  var info_message = $(this).attr('data-message');
					  if($(this).hasClass('Infection')){
						error_info = 'An '+info_message+' Complication Code ( in the range '+min_val+' to '+max_val+') has already been selected. \n You may select only one instance of Infection Complication Code.\n\n Please select a diffreent code.';	  }else{
					    error_info = info_message+' Complication Code ( in the range '+min_val+' to '+max_val+') has already been selected. \n You may select only one instance of Infection Complication Code.\n\n Please select a diffreent code.'; 	
					   }
						if ( $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)){
							alert(error_info);
						}else{
							BootstrapDialog.show({
								title: 'Error: Complication Code Range',
								message:error_info,
							});
						}	
					  
					  $('#'+my_id+'_chzn a').addClass('chzn-default');
		  			  $('#'+my_id+'_chzn a span').text('');
			  		  $('#'+my_id).val('');
					}else{
						jQuery(this).removeClass('selected');
						jQuery(this).removeClass(my_id);
					}
				}
			}
		});
		
  }); 
  
  $('#ComplicationDegreeCode').change(function(){
	  var error_enable = '';
	  $('.ComplicationCode').each(function(){
		if($(this).val() != ''){
		  error_enable = 'false';	
		}
	  });
	  
	  if(error_enable == ''){
		$('#'+my_id+'_chzn a').addClass('chzn-default');
		$('#'+my_id+'_chzn a span').text('');  
		$(this).val('');
	  }
  });
  
  $("#registerfrm").validate({
		rules: {
			/*username: {
				required: true,
				minlength: 8,
				remote: {
					  url: "functions.php?chekuser=true",
					  datatype:'json',
					  type: "post",
					  data: {
					     username: function() {	
						 alert(username.data);		
					     $( "#username" ).val();
					    }
					 }
				}
			},*/
			password: {
				required: true,
				minlength: 8
			},
			repassword: {
				required: true,
				minlength: 8,
				equalTo: "#password"
			},
			
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 8 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 8 characters long"
			}
		}
	});
	
	$("#loginfrm").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			}
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			}
		}
	});
	
	$("#memberupdatefrm").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				minlength: 5
			},
			department:{
			   required: true
			},
			useremail: {
				required: true,
				email: true
			}
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				minlength: "Your password must be at least 5 characters long"
			},
			department:"Please select department",
			useremail: "Please enter a valid email address",
		}
	});
	
	$("#profilefrm").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				minlength: 5
			},
			confirm_password: {
				minlength: 5,
				equalTo: "#password"
			},
			useremail: {
				required: true,
				email: true
			}
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			useremail: "Please enter a valid email address",
		}
	});
	
	
	
	/**Validation for work order add start**/
	 $("#workeorderfrm").validate({
		rules: {
			department_wo: {
				required: true
			},
			workorderdate_wo: {
				required: true
			},
			description_wo: {
				required: true
			},
			supervisor_wo: {
				required: true
			},
			cancel_reason: {
				required: "#cancelled:checked"
			},
			another_email: {
				required: "#cc_email:checked",
				email: true
			},
			role:"required"
		},
		messages: {
			department_wo: {
				required: "Please enter a Department",
			},
			workorderdate_wo: {
				required: "Please enter a Work Order Date",
			},
			description_wo: {
				required: "Please enter a Description",
			},
			cancel_reason:{
				required: "Please enter a reason",
			},
			supervisor_wo: {
				required: "Please enter a Supervisor",
			},
			another_email:{
				required: "Please enter a email",
			}
		}
	});
	
	
	// Change Status Condition
	
	$('.statusaction').click(function(){
	var user_id,status,action='changestatus',status_no;
 	status=$(this);
	user_id=status.attr('attr-userid');
	status_no=status.attr('attr-status-n');
	if(user_id != ""){
	
			$.ajax({  type: "POST",
			url: "functions.php?action="+action+'&id='+user_id+'&status_no='+status_no,

			}).done(function( info ) {
              
					if(status_no==1)
					{
					status.addClass('btn-success');
					status.next().removeClass('btn-danger');
				
                    
					}else{
					
					status.addClass('btn-danger');
					status.prev().removeClass('btn-success');
					
					}


			});
		}
	
	});
	
	$("#submit_wo").click(function(){
		if($("#status_wo").val() == "CANCELLED" && ($("#old_status").val()!=$("#status_wo").val())){
			$('#cancel_model').modal('show');
			return false;
		}
	});
	
	$("#save_cancel").click(function(){
		if($("#cancel_reason").val()==""){
			//$("#cancelerr").show();
		}else{
			$('#cancel_model').modal('hide');
			$("#workeorderfrm").submit();
		}
	});
	
	$("#status_wo").change(function(){
		if($(this).val() == "CANCELLED"){
			$("#cancelled").attr("checked","checked");
		}else $("#cancelled").removeAttr("checked");
	});
	
	$("#cancel_reason").keypress(function(){
	  var max_length = $(this).attr("maxlength");
	  var char_length = $(this).val().length;
	  if(char_length <= max_length){
	    return true;
	  }
	  return false;
	});
	
	$("#send_email_bt").click(function(){
		$("#workeorderfrm").submit();
	});
} )( $ );

/**====================================================
/*** ADMISSION,SEPERATION,SURGERY DATE CHECKED 
/**====================================================*/


function admission_check(){
		var AdmissionDate = $('#AdmissionDate').val();
		var SeparationDate = $('#SeparationDate').val();
		var SurgeryDate = $('#SurgeryDate').val();
		
		var d1 = parseDate(AdmissionDate);
		var d2 = parseDate(SurgeryDate);
		var d3 = parseDate(SeparationDate);
		var message='';

		var error_count=0;
		   if(d1.getTime() == d2.getTime()){
				$('.surgery-box label').html('Date of Admission-Surgery confirmed');
				$('#surgery-check').val(1).prop('checked',true).removeAttr('disabled'); 
				$('.surgery-box').show(); 

			}
			
			
		   if(d2.getTime() == d3.getTime()){
				
				$('.separation-box label').html('Date of Surgery-Separation confirmed');
				$('#separation-check').val(1).prop('checked',true).removeAttr('disabled'); $('.separation-box').show();
			}
			
			
		if(AdmissionDate !='' && SurgeryDate!='' && SeparationDate!='' && (d1.getTime() > d2.getTime()) && (d1.getTime() > d3.getTime()) ) {
			
			error_count++;
			//showdialog("Error! Admission date entered is before the date of surgery and/or separation. 
			//Please correct date of admission and then select Date of admission checked box\n Expected Error\n
			//Error! Admission date entered is after the date of surgery and/or separation.
			// Please correct date of admission and then select Date of admission checked box",'#AdmissionDate');
			//'#AdmissionDate'
			showdialog("Error! Admission date entered is before the date of surgery and/or separation. Please correct date of admission and then select Date of admission checked box\n");
		}
		
		else if(AdmissionDate !='' && SurgeryDate!='' && $('#surgery-check').prop('checked')==false)
		{
		   if(d1.getTime() > d2.getTime()){
			error_count++;
			//'#SurgeryDate'
			showdialog("Error! Surgery date entered is before the date of admission.Please correct date of surgery and then select Date of surgery checked box");
			$('.alos-check-box').show();
			$('.surgery-box label').html('Date of Admission-Surgery confirmed');
		    $('#surgery-check').val(0).prop('checked',false).removeAttr('disabled');  $('.surgery-box').show(); 
			}else if(d1.getTime() == d2.getTime()){
				$('.surgery-box label').html('Date of Admission-Surgery confirmed');
				$('#surgery-check').val(1).prop('checked',true).removeAttr('disabled'); 
				$('.surgery-box').show(); 

			}else{
				
				warning_dialog("Entered date of surgery is after date of admission. Is this correct Yes/No?",'as');
				$("#separation-check").prop('checked',false).removeAttr('disabled');;
			}
		}
		
		else  if(SurgeryDate !='' && SeparationDate!='' && $('#separation-check').prop('checked')==false)
		{   
		   
		    if(d2.getTime() > d3.getTime()){
			error_count++;
			//'#SurgeryDate'
			showdialog("Error! Surgery date entered is after the date of separation. Please correct date of surgery and then select Date of surgery checked box");
			$('.alos-check-box').show();
			$('.separation-box label').html('Date of Surgery-Separation confirmed');
			$('#separation-check').val(0).prop('checked',false).removeAttr('disabled');  $('.separation-box').show(); 
			} else  if(d2.getTime() == d3.getTime()){
				
				$('.separation-box label').html('Date of Surgery-Separation confirmed');
				$('#separation-check').val(1).prop('checked',true).removeAttr('disabled'); $('.separation-box').show();
			}
			else{
				warning_dialog("Entered date of surgery is before date of separation is this correct Yes/No?",'ss');
			}
		}
		
		
		if(error_count>0){   
			return false;
		} 
		
}


function warning_dialog(message,check_box){
	var no_message='';  
      BootstrapDialog.show({
							title: 'WARNING',
							message:message,
							type: BootstrapDialog.TYPE_WARNING,
							onhide: function(dialogRef){
									
										$('.alos-check-box').show();
										if(check_box=='as'){
											$('.surgery-box label').html('Date of Admission-Surgery confirmed');
											$('#surgery-check').val(0).prop('checked',false).removeAttr('disabled'); $('.surgery-box').show(); 
										}else if(check_box=='ss') {
											$('.separation-box label').html('Date of Surgery-Separation confirmed');
											$('#separation-check').val(0).prop('checked',false).removeAttr('disabled'); $('.separation-box').show();
										}
                              },
							buttons: [{
					                label: 'Yes',
					                cssClass: 'btn-success',
					                action: function(dialogRef){
					                    dialogRef.close();
										$('.alos-check-box').show();
										if(check_box=='as'){
											//$('.surgery-box label').html('Admission-Surgery dates checked');
											$('.surgery-box label').html('Date of Admission-Surgery confirmed');
											$('#surgery-check').val(1).prop('checked',true).removeAttr('disabled','disabled'); $('.surgery-box').show();
										}else if(check_box=='ss') {
										   $('.separation-box label').html('Date of Surgery-Separation confirmed');
											$('#separation-check').val(1).prop('checked',true).removeAttr('disabled','disabled');  $('.separation-box').show(); 
										}
					                }
					            }, {
					                label: 'No',
					                cssClass: 'btn-warning',
					                action: function(dialogRef){
					                    dialogRef.close();
										if(check_box=="as") { no_message="Please correct the date of admission/surgery then select Date of Admission/Surgery check box"; }else {
										no_message="Please correct the date of surgery/separation then select Date of Surgery/Separation check box";}   
										showdialog(no_message,'#SurgeryDate');
										$('.alos-check-box').show();
										if(check_box=='as'){
											$('.surgery-box label').html('Date of Admission-Surgery confirmed');
											$('#surgery-check').val(0).prop('checked',false).removeAttr('disabled');  $('.surgery-box').show();;
										}else if(check_box=='ss') {
											$('.separation-box label').html('Date of Surgery-Separation confirmed');
											$('#separation-check').val(0).prop('checked',false).removeAttr('disabled');  $('.separation-box').show(); 
										}
										
					                }
					            }]
	});	
	
}

function toggleemailbox(){
    if($('#cc_email').is(':checked')){
	   $("#another_email_div").show('slow');
	}else{
	   $("#another_email_div").hide('fast');
	}
}
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function changeSelect(){
	$('select').each(function(){
	   var my_id = '#'+$(this).attr('id')+'_chzn'; 	   
	   jQuery(my_id+' a.chzn-single span').html($(this).val());
	});
}
function date_creator(input_text){
	var date_split = input_text.split('/');
	return new_val = new Date(date_split[2],(date_split[1] - 1),date_split[0]);
}
function get_year(input_text){
  var date_split = input_text.split('/');
  return new_val = date_split[2];
}
function add_error_message(feild,message){
	/*if(!$(feild).hasClass('error)')){
	  $(feild).addClass('error');
	 }
	if($(feild).parent().find('.error_feild').html() == null){
		$(feild).parent().append('<span class="error_feild">'+message+'</span>');
	}else{
	  $(feild).parent().find('.error_feild').html(message);
	}*/
}
function remove_error(input_item){
	/*if($(input_item).val() != ''){
		$(input_item).removeClass('error');
		$(input_item).parent().find('span.error_feild').html('');
	}*/ 
}

function validate_beforelogout(){
	var lastname = $('#lastname').val();
	var firstname = $('#fname').val();
	var sex = $('#sex').val();	
	var PostCode = $('#PostCode').val();
	var URN = $('#URN').val();
	var dob = $('#dob').val();
	var Initial_Cons_Date = $('#Initial_Cons_Date').val();
	$('#is_validate').val(0);
	c_date = new Date();
	dob_date = date_creator(dob);	
	dob_year = get_year(dob);
	current_year = new Date().getFullYear();
	var error='';

	if(error != ''){ 
	  return error;
	}


}

function validate(type,btn_action){
	var lastname = $('#lastname').val();
	var firstname = $('#fname').val();
	var sex = $('#sex').val();	
	var PostCode = $('#PostCode').val();
	var URN = $('#URN').val();
	var dob = $('#dob').val();
	var AdmissionDate = $('#AdmissionDate').val();
	var SeparationDate = $('#SeparationDate').val();
	var Initial_Cons_Date = $('#Initial_Cons_Date').val();
	var SurgeryDate = $('#SurgeryDate').val();
	
	var error = '';
	var message = '';
	if(lastname == '' || (/^[a-zA-Z0-9- ]*$/.test(lastname) == false)) {
		add_error_message('#lastname','Enter the Valid Last Name');
		error += '+ Enter the Valid Last Name\n';
	}else{	
		remove_error('#lastname');
	}
	if(firstname == '' || (/^[a-zA-Z0-9- ]*$/.test(firstname) == false)) {
		add_error_message('#fname','Enter the Valid First Name');
		error += '+ Enter the Valid First Name \n';
	}else{
		remove_error('#fname');
	}
	if(PostCode == '' || (/^[a-zA-Z0-9- ]*$/.test(PostCode) == false)) {
		add_error_message('#PostCode','Enter the Valid Post Code');
		error += '+ Enter the Valid Post Code\n';
	}else{
		remove_error('#PostCode');
	}
	if(URN == '' || (/^[a-zA-Z0-9- ]*$/.test(URN) == false)) {
		add_error_message('#URN','Enter the Valid URN');
		error += '+ Enter the Valid URN\n';
	}else{
		remove_error('#URN');
	}
	if(sex == '') {
		add_error_message('#sex','Select the Sex field value');
		error += '+ Select the Sex field value\n';
	}else{
		remove_error('#sex');
	}
	
	if(FacilityCode == '') {
		add_error_message('#FacilityCode','Enter Valid Facility Code');
		error += '+ Enter Valid Facility Code\n';
	}else{
		remove_error('#FacilityCode');
	}
	if(SurgeonType == '') {
		add_error_message('#SurgeonType','Select the valid  Surgeon Type');
		error += '+ Select the valid  Surgeon Type\n';
	}else{
		remove_error('#SurgeonType');
	}
	
	if(btn_action != 'addnew'){
		var EstDischargeTime = $('#EstDischargeTime').val();
		var FacilityCode = $('#FacilityCode').val();
		var SurgeonType = $('#SurgeonType').val();
		var PDx = $('#PDx').val();
		
		if(EstDischargeTime == 0 || EstDischargeTime == '') {
			add_error_message('#EstDischargeTime','Enter Valid Estimated Time To Discharge From Recovery');
			error += '+ Enter Valid Estimated Time To Discharge From Recovery\n';
		}else{
			remove_error('#PostCode');
		}
		
		
		if(PDx == 0 || PDx == '') {
			add_error_message('#PDx','Select the valid PRINCIPAL DIAGNOSIS method');
			error += '+ Select the valid PRINCIPAL DIAGNOSIS method\n';
		}else{
			remove_error('#PDx');
		}
	}
	
	c_date = new Date();
	dob_date = date_creator(dob);	
	dob_year = get_year(dob);
	current_year = new Date().getFullYear();
	AdmissionDate_date = date_creator(AdmissionDate);	
	AdmissionDate_year = get_year(AdmissionDate);	
	
	SeparationDate_date = date_creator(SeparationDate);	
	SeparationDate_year = get_year(SeparationDate);
	
	Initial_Cons_Date_date = date_creator(Initial_Cons_Date);	
	Initial_Cons_Date_year = get_year(Initial_Cons_Date);
	
	SurgeryDate_date = date_creator(SurgeryDate);	
	SurgeryDate_year = get_year(SurgeryDate);
	
   message = '';
   /*if($('#alos-check').prop('checked')==false) {
          message = 'Please check the date of separation.Are you sure the length of stay is longer than 1 day?';
          error += ''+message+'\n';
    }*/

  	if(dob_date >= c_date || dob == ''){
	  message = 'DOB Missing or In the future';
	}else if(dob_year <= 1901){
		message = 'Patient too old (born before 1900)';	
	}
	if(message != ''){
	   add_error_message('#dob',message);	
	   error = '+ '+message+'\n';
	}else{
		remove_error('#dob');
	}

	message = '';
	//AdmissionDate_date > c_date ||
	if( AdmissionDate == '' ){
	  message = 'Admission Date Missing or In the future';
	}else if(AdmissionDate_year <= 1970){
		message = 'Patient Admission Date too far behid';	
	}

 	if(message != ''){
	   add_error_message('#AdmissionDate',message);	
	   error += '+ '+message+'\n';
	}else{
		remove_error('#AdmissionDate');
	}

	message = '';
	//Initial_Cons_Date_date >= c_date ||
	if( Initial_Cons_Date == '' ){
	  message = 'Initial Cons Date Missing or In the future';
	}/*else if(Initial_Cons_Date_year <= 2000){
		message = 'Initial Cons Date too far behid';	
	}*/
	if(message != ''){
	   add_error_message('#Initial_Cons_Date',message);	
	   error += '+ '+message+'\n';
	}else{
		remove_error('#Initial_Cons_Date');
	}
	
	
	message = '';
	//SeparationDate_date >= c_date ||
	if( SeparationDate == ''){
	  message = 'Separation Date Missing or In the future';
	}/*else if(SeparationDate_year <= 1970){
		message = 'Separation Date too far behid';	
	} */
	if(message != ''){
	   add_error_message('#SeparationDate',message);	
	   error += '+ '+message+'\n';
	}else{
		remove_error('#SeparationDate');
	}
	
	message = '';
	
	//SurgeryDate_date >= c_date || 
	
	if(SurgeryDate == ''){
	  message = 'Surgery Date  Missing or In the future';
	}/*else if(SurgeryDate_year <= 1970){
		message = 'Surgery Date too  far behid';	
	}*/
	if(message != ''){
	   add_error_message('#SurgeryDate',message);	
	   error += '+ '+message+'\n';
	}else{
		remove_error('#SurgeryDate');
	}
	
	
	
	if(AdmissionDate!='' && SurgeryDate!='' && SeparationDate!='' && $('#surgery-check').prop('checked')==false && $('#separation-check').prop('checked')==false ){
		 error += '+ Please confirm Date of Admission/Surgery/separation  by selecting check box \n';
	}else{
			if(AdmissionDate!='' && SurgeryDate!=''){
				 if($('#surgery-check').prop('checked')==false){
					 error += '+ Please confirm Date of Admission/Surgery  by selecting check box \n';
				 }
			}
			
			if(SeparationDate!='' && SurgeryDate!=''){
				 if($('#separation-check').prop('checked')==false){
					 error += '+ Please confirm Date of Surgery/separation by selecting check box\n';
				 }
			}
	}
	

	message = '';
	if(message != ''){
	   error += '+ '+message+'\n';
	}
	return error;
	
	
}

function showdialog(message,focus) {
BootstrapDialog.show({
				title: 'Validation Error',
				message:message,
				type: BootstrapDialog.TYPE_DANGER,
				onhide:function(){
					if(focus!='')
						{ $(focus).focus();}
				}
		});
}

function setcount(validate,response){
	 var get_count = $('.non_valid span.count').text();
	 var incomplete = $('.incomplete span.count').text();
	 
	 //array('id' => $id,'total' => $total_records,'valid' => $valid,'non' => $non,'incomplete' => $incomplete);
	 if(get_count != 0) {
		$('.non_valid span.count').text(response.non);
	 }
	 
	 if(incomplete != 0)
	 	$('.incomplete span.count').text(response.incomplete);
	 
	 $('.valid span.count').text(response.valid);
	 $('.total_valid span.count').text(response.total); 
	// $('.record-validate-user span.record').show();
	  
		  
	 /*if(validate==1) {  
	 	$('.record-validate-user span.record').html('<span style="color:green">Record Validated:</span>');
		$('#validate_record').prop('checked',true);
	 }*/
}

function Ajax_send(action,action_id,user,record,step) {
	admission_check();
	var message = '';
	var is_validate = $('#is_validate').val();
    $.ajax({  
			url: "functions.php?action="+action+'&id='+action_id+'&user='+user+'&step='+step+"&isvalidate="+is_validate,
			type: "POST",
			dataType: "json",
			data:record,
			cache : false,
			processData: false,
		 	success: function(html){ 
				
				$('#record_id').val(html.id);
				$('span#id').text(html.id); 
				$('#add_xid').css('visibility','visible');
				if(action=="update"){
					
					var pdx_count=$('.chosen-pdx').attr('attr-pdx');
					if(pdx_count==0) {
					   //setcount(is_validate,html);
					   $('.chosen-pdx').attr('attr-pdx','1');
					  }
					   
					 $('li.total_valid span.count').text(html.total); 
					 $('li.valid span.count').text(html.valid);
					 
					 var get_count = $('.user_hint .non_valid span.count').text();
					 var incomplete = $('.incomplete span.count').text();
					 if(get_count != 0) {
							$('li.non_valid span.count').text(html.non);
					 }
					 if(incomplete != 0)
						$('li.incomplete span.count').text(html.incomplete);
					 
					// $('.record-validate-user span.record').show();
					 /*if(html.is_validate == 1) {  
						$('.record-validate-user span.record').html('<span style="color:green">Record Validated:</span>');
					    $('#validate_record').prop('checked',true);
					 }*/
				}
			}
   });
}



/*
function check_dates(){
var AdmissionDate = $('#AdmissionDate').val();
var SeparationDate = $('#SeparationDate').val();
var SurgeryDate = $('#SurgeryDate').val();
var seperation_check =$('#SurgeryDate').attr('seperation-check');
var admission_check = $('#SurgeryDate').attr('admission-check');

var d1 = parseDate(AdmissionDate);
var d2 = parseDate(SeparationDate);
var d3 = parseDate(SurgeryDate);


var error_message = '';warning_message='';
var error_count_dt=0;
if(SurgeryDate !='' && AdmissionDate!='' && admission_check==0) {
	 if(d3.getTime() < d1.getTime()) {
		 error_message +='* "The date of surgery is before the date of admission. Please correct this error and then select checked date of admission box"\n';
	     BootstrapDialog.show({
				title: 'Validation Error',
				message:error_message,
				closable: true,
				closeByBackdrop: false,
				closeByKeyboard: false,
			});
	        $('#SurgeryDate').focus();
			error_count_dt++;

	 }
	 
	if(d3.getTime() > d1.getTime()) {
		warning_message+='* The date of surgery is after the date of admission is this correct?\n';
		BootstrapDialog.show({
				title: 'WARNING',
				message:warning_message,
				type: BootstrapDialog.TYPE_WARNING,
				closable: true,
				closeByBackdrop: false,
				closeByKeyboard: false,
				buttons: [{
		                label: 'Yes',
		                cssClass: 'btn-success',
		                action: function(dialogRef){
		                    dialogRef.close();
		                    $('#SurgeryDate').attr('admission-check','1');
		                }
		            }, {
		                label: 'No',
		                cssClass: 'btn-warning',
		                action: function(dialogRef){
		                    dialogRef.close();
								$('#AdmissionDate').focus();
		                }
		            }]
			});
		error_count_dt++;
	}
	
 }


	if(SurgeryDate !='' && SeparationDate!='' && seperation_check==0 && error_count_dt==0) {
			  if(d2.getTime() < d3.getTime()){
				 error_message +='* The date of surgery is before the date of separation. Please correct this error and then select “checked date of Separation box”\n';
			     BootstrapDialog.show({
						title: 'Validation Error',
						message:error_message,
						closable: true,
						closeByBackdrop: false,
						closeByKeyboard: false,
					});
			        $('#SurgeryDate').focus();
					error_count_dt++;

			 }
	 
	 if(d2.getTime() > d3.getTime()){
		warning_message+='* The date of surgery is after the date of seperation is this correct?\n';
		BootstrapDialog.show({
				title: 'WARNING',
				message:warning_message,
				type: BootstrapDialog.TYPE_WARNING,
				closable: true,
				closeByBackdrop: false,
				closeByKeyboard: false,
				buttons: [{
		                label: 'Yes',
		                cssClass: 'btn-success',
		                action: function(dialogRef){
		                    dialogRef.close();
		                    $('#SurgeryDate').attr('seperation-check','1');
		                }
		            }, {
		                label: 'No',
		                cssClass: 'btn-warning',
		                action: function(dialogRef){
		                    dialogRef.close();
								$('#SeparationDate').focus();
		                }
		            }]
			});
		error_count_dt++;
	}
}	



 if(error_count_dt>0) { return false; } else { return true; }
}*/

 function parseDate(str) {
    var mdy = str.split('/');
    var new_date=new Date(mdy[2], mdy[1]-1, mdy[0]);
    return new_date;
}

function daydiff(first, second) {
    return (second-first)/(1000*60*60*24);
}

function getdate(){
var now = new Date();
var currentDate =strpad00(now.getDate())+"/"+strpad00(now.getMonth()+1)+"/"+now.getFullYear();
return;
}

function strpad00(s)
{
    s = s + '';
    if (s.length === 1) s = '0'+s;
    return s;
}

function checkbox_enable() {
		$('.alos-check-box').show(); 
		$('.alos-check-box label').html('Date of Surgery confirmed:'); 
		$('.alos-check-box input#alos-check').prop('checked',false).removeAttr('disabled');
}

function checkbox_disable() {
		$('.alos-check-box').show(); 
		$('.alos-check-box label').html('Dates checked'); 
		$('.alos-check-box input#alos-check').prop('checked',true).attr('disabled','disabled');
}
	

