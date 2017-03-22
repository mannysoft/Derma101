<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-body">
			<?php echo form_open('prescription/edit_medicine/'.$medicine['medicine_id']) ?>
					<div class="form-group">
						<input type="hidden" name="medicine_id" value="<?=$medicine['medicine_id']?>"/>
						<label for="medicine_name"><?php echo $this->lang->line('medicine_name');?></label> 
						<input type="input" name="medicine_name" value="<?=$medicine['medicine_name']?>" class="form-control"/>		
						<?php echo form_error('medicine_name','<div class="alert alert-danger">','</div>'); ?>
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