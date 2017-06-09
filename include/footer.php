   </div>
    <!--Main container end  here-->
	
    <!--Footer start here-->
	<div class="footerContainer">
      <footer id="footer" class="source-org vcard copyright">
		<small>Footer Text</small>
       </footer>
	</div>
   <!--Footer end here-->  
   </div>
   <script>
    
	$('.fbbutton').click(function(){
	   $('#calandermonth').val(this.id);	  
	});
	
	$('.inputDate').DatePicker({
		format:'m/d/Y',
		date: $('#inputDate').val(),
		current: $('#inputDate').val(),
		starts: 1,
		position: 'right',
		onBeforeShow: function(){
			$('#inputDate').DatePickerSetDate($('#inputDate').val(), true);
		},
		onChange: function(formated, dates){
			$('#inputDate').val(formated);
			if ($('#closeOnSelect input').attr('checked')) {
				$('#inputDate').DatePickerHide();
			}
		}
	});
	
	$('.templatedynamicbox').each(function(){	
	   $(this).children().click(function(){
	       $getId = $(this).attr('id');
		   $('.templatedynamicbox img').css('border','0px solid #8b8b8b')
		   $(this).css('border','1px solid #8b8b8b');
		   $('#templateid').val($getId);
		   
	   });	   
	});
	
	
</script>
 </div>
</body>
</html>
