<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('#medicine_table').dataTable();
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	})
	
	$('#week_from').datetimepicker({
		timepicker:false,
		format: 'Y-m-d',
		scrollInput:false, 
		scrollMonth:false,
		scrollTime:false,
	}); 
	
	$('#week_to').datetimepicker({
		timepicker:false,
		format: 'Y-m-d',
		scrollInput:false, 
		scrollMonth:false,
		scrollTime:false,
	});
	
	$('#weekly').click(function(){
		$('#week_from').prop('disabled', false);
		$('#week_to').prop('disabled', false);
	})
} )
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">Commissions</div>
			<div class="panel-body">
			</div>
			</div>
		</div>
	</div>
<div class="panel panel-primary">	
	<div class="panel-body">
		<div class="table-responsive">
			<form action="">
			<div class="row">
			  <div class="col-md-2"><input id="today" type="radio" name="period" value="today" <?php echo ($this->input->get('period') == 'today' or $this->input->get('period') == 't') ? 'checked': '';?>><label for="today"> Today</label></div>
			  <div class="col-md-4"></div>
			</div>
			<div class="row">
			  <div class="col-md-2"><input id="weekly" type="radio" name="period" value="weekly" <?php echo ($this->input->get('period') == 'weekly') ? 'checked': '';?>><label for="weekly"> Weekly</label></div>
			  <div class="col-md-4">From: <input type="text" name="week_from" id="week_from" class="form-control" value="<?php echo $this->input->get('week_from'); ?>" <?php echo ($this->input->get('period') == 'today' or $this->input->get('period') == 'monthly') ? 'disabled': '';?>/> To: <input type="text" name="week_to" id="week_to" class="form-control" value="<?php echo $this->input->get('week_to'); ?>" <?php echo ($this->input->get('period') == 'today' or $this->input->get('period') == 'monthly') ? 'disabled': '';?>/></div>
			</div>
			<div class="row">
			  <div class="col-md-2"><input id="monthly" type="radio" name="period" value="monthly" <?php echo ($this->input->get('period') == 'monthly') ? 'checked': '';?>><label for="monthly"> Monthly</label></div>
			  <div class="col-md-4">
			  	<select name="month">
			  		<?php for($i = 1; $i < 13; $i ++):?>
			  			<option value="<?php echo $i;?>" <?php echo ($this->input->get('month') == $i) ? 'selected': '';?>>
			  			<?php
			  			$monthNum = sprintf("%02s", $i);
						$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
			  			 echo $monthName;?></option>
			  		<?php endfor;?>
			  	</select>
			  	<select name="year">
			  		<?php for($i = 2017; $i < date('Y') + 3; $i ++):?>
			  			<option value="<?php echo $i;?>" <?php echo ($this->input->get('year') == $i) ? 'selected': '';?>><?php echo $i;?></option>
			  		<?php endfor;?>
			  	</select>
			  </div>
			</div>
			<input class="btn btn-primary" type="submit" name="submit" value="View">
			</form>
			
			<table class="table table-striped table-bordered table-hover" id="visit_table">			
			<thead>
				<tr>
					<th style="width:200px;">Period</th>
					<th style="width:150px;">Staff</th>
					<th>Number of Assignments</th>
					<th>Total Sales</th>
					<th>Commission Amount</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>	
			<?php $i = 1; ?>     
			<tbody>
			<?php if ($staffs) { ?>
			<?php foreach ($staffs as $staff) { ?>
				<?php $commission = $this->staff_model->total_commission($this->input, $staff['id']); ?>
				<tr>
					<td><?php echo $commission['period'];?></td>
					<td><?php echo $staff['staff_name']; ?></td>
					<td><?php echo $commission['assignments'];?></td>
					<td style="text-align: right;"><?php echo number_format($commission['total_sales'], 2);?></td>
					<td style="text-align: right;"><?php echo number_format($commission['total_commission'], 2);?></td>
					<td><?php echo $commission['status'];?></td>
					<td>
						
						<?php if ($commission['status'] == 'Unpaid'):?>
							<a class="btn btn-primary" href="#">Set as Paid</a>
						<?php endif;?>
					</td>
				</tr>
				<?php $i++; ?>
				<?php } ?>
				
				<?php }else{ ?>
					<tr>
						<td colspan="10"><?php //echo $this->lang->line('no_visits');?></td>	
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
			</table>
		</div>		
	</div>
</div>