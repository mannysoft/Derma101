<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('#medicine_table').dataTable();
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})
} )
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
					<?php echo 'Treatment Assignments';?>
			</div>
			<div class="panel-body">
			</div>
			</div>
		</div>
	</div>
<div class="panel panel-primary">	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="visit_table">			
			<thead>
				<tr>
					<th style="width:150px;">Date</th>
					<th style="width:150px;">Staff</th>
					<th>Patient Name</th>
					<th>Treatment</th>
					<th>Total Amount</th>
				</tr>
			</thead>
			<?php $i = 1; ?>     
			<tbody>
			<?php if ($bills) { ?>
			<?php foreach ($bills as $bill) { ?>
				<tr>
					<td><?php echo $bill['bill_date'];?></td>
					<td><?php echo $this->staff_model->get_staffname($bill['staff_id']);?></td>
					<td>
					<?php $patient = $this->patient_model->get_patient_detail($bill['patient_id']);?>
					<?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name']; ?></td>
					<td>
					<?php
					$details = $this->staff_model->bill_details($bill['bill_id']); 
					foreach($details as $row){
						//$medicine_array[$row['medicine_id']] = $row['medicine_name'];
						echo $row['particular'] . ', ';
					}
					?>
					<td style="text-align: right;"><?= number_format($bill['total_amount'], 2); ?>
				</tr>
				<?php $i++; ?>
				<?php } ?>
				<script>
					$(window).load(function() {
						$.fn.dataTable.moment( '<? //=$morris_date_format;?> <? //=$morris_time_format;?>' );// for sort date from our date formate
						$('#visit_table').dataTable({
							 "order": [[ 0, "desc" ]] 
						});
					});
				</script>
				
				<?php }else{ ?>
					<tr>
						<td colspan="10"><?php echo $this->lang->line('no_visits');?></td>	
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
			</table>
		</div>		
	</div>
</div>