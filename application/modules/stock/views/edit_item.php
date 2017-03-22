<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-body">
			<?php echo form_open('stock/edit_item/'.$item['item_id']) ?>
					<div class="form-group">
						<input type="hidden" name="item_id" value="<?=$item['item_id']?>"/>
						<label for="item_name"><?php echo $this->lang->line('item_name');?></label> 
						<input type="input" name="item_name" value="<?=$item['item_name']?>" class="form-control"/>		
						<?php echo form_error('item_name','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="desired_stock"><?php echo $this->lang->line('desired_stock');?></label> 
						<input type="input" name="desired_stock" value="<?=$item['desired_stock']?>" class="form-control"/>
						<?php echo form_error('desired_stock','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="mrp"><?php echo $this->lang->line('mrp');?></label> 
						<input type="input" name="mrp" value="<?=$item['mrp']?>" class="form-control"/>
						<?php echo form_error('mrp','<div class="alert alert-danger">','</div>'); ?>
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