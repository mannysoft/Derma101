<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-body">
			<?php echo form_open('staff/edit/'.$staff['id']) ?>
					<div class="form-group">
						<input type="hidden" name="id" value="<?=$staff['id']?>"/>
						<label for="staff_name"><?php echo $this->lang->line('staff_name');?></label> 
						<input type="input" name="staff_name" value="<?=$staff['staff_name']?>" class="form-control"/>		
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
</div>