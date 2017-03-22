<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-body">
			<?php echo form_open('stock/edit_supplier') ?>
					<div class="form-group">
						<input type="hidden" name="supplier_id" value="<?=$supplier['supplier_id']?>"/>
						<label for="supplier_name"><?php echo $this->lang->line('supplier_name');?></label>
						<input type="input" name="supplier_name" value="<?=$supplier['supplier_name']?>" class="form-control"/>	
						<?php echo form_error('supplier_name','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="contact_number"><?php echo $this->lang->line('contact_number');?></label> 
						<input type="input" name="contact_number" value="<?=$supplier['contact_number']?>" class="form-control"/>
						<?php echo form_error('contact_number','<div class="alert alert-danger">','</div>'); ?>
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