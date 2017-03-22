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
					<?php echo 'Staff'; // echo $this->lang->line('medicines');?>
			</div>
			<div class="panel-body">
			<?php echo form_open('staff/index') ?>
					<div class="form-group">
						<label for="medicine_name">Staff Name<?php //echo $this->lang->line('medicine_name');?></label>
						<input type="input" name="staff_name" class="form-control" />											
						<?php echo form_error('staff_name','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
					<?php echo form_close(); ?>
			</div>
			</div>
		</div>
	</div>
<div class="panel panel-primary">	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="medicine_table">
			<thead>
				<tr>
					<th>ID.</th>
					<th>Staff Name<?php //echo $this->lang->line('medicine');?></th>
					<th><?php echo $this->lang->line('edit');?></th>
					<th><?php echo $this->lang->line('delete');?></th>
				</tr>									
			</thead>
			<tbody>
			<?php $i=1; ?>
			<?php foreach ($staffs as $staff): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $staff['staff_name'] ?></td>
				<td><a class="btn btn-primary" title="Edit" href="<?php echo site_url("staff/edit/" . $staff['id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
				<td><a class="btn btn-danger confirmDelete" title="<?php echo  $this->lang->line('delete_item')." :" . $staff['staff_name']?>" href="<?php echo site_url("staff/delete/" . $staff['id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
			</tr>
			 <?php $i++; ?>
			<?php endforeach ?>
			</tbody>
			
			</table>
		</div>		
	</div>
</div>