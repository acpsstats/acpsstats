<?php include('header.php');?>
<?php
if(!$com->isLogged()){
		header("location:login.php");
}else{
  header("location:workorders.php");
}
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<?php 
				$total_member = 0;
				$member_cnt_array = total_members();
				foreach($member_cnt_array as $type => $mem_cnt){
				   $total_member = $total_member + $mem_cnt;
				}
			?>
			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="<?php echo $total_member;?> members." class="well span3 top-block" href="#">
					<span class="icon32 icon-red icon-user"></span>
					<div>Members</div>
					<div><?php echo $total_member;?></div>
					
				</a>
				<?php $supervisor_cnt = 0; if(isset($member_cnt_array['Supervisor'])) $supervisor_cnt = $member_cnt_array['Supervisor'];?>
				<a data-rel="tooltip" title="<?php echo $supervisor_cnt;?> Supervisors." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-star-on"></span>
					<div>Supervisors</div>
					<div><?php echo $supervisor_cnt;?></div>
					
				</a>
				<?php $total_work_order = count(get_work_order_list());?>
				<a data-rel="tooltip" title="<?php echo $total_work_order;?> Work Orders" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-note"></span>
					<div>Work Orders</div>
					
					<div><?php echo $total_work_order;?></div>
					
				</a>
				
				<a data-rel="tooltip" title="15 new messages." class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-envelope-closed"></span>
					<div>Messages</div>
					<div>15</div>
					
				</a>
			</div>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Introduction</h2>
						
					</div>
					<div class="box-content">
						
						<p>Work Order Management System helps you track all action.</p>
						<p>Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content   </p>
						
						<p>Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content  Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content Lorem Ipsum content   </p>
						
					
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
					
			

			
				  

		  
       
<?php include('footer.php'); ?>
