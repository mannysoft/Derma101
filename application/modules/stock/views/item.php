<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('#item_table').dataTable();
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
					<?php echo $this->lang->line('items');?>
			</div>
			<div class="panel-body">
			<?php echo form_open('stock/item') ?>
					<div class="form-group">
						<label for="item_name"><?php echo $this->lang->line('item_name');?></label>
						<input type="input" name="item_name" class="form-control" />												
						<?php echo form_error('item_name','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="desired_stock"><?php echo $this->lang->line('desired_stock');?></label>
						<input type="input" name="desired_stock" class="form-control"/>																	
						<?php echo form_error('desired_stock','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="form-group">
						<label for="mrp"><?php echo $this->lang->line('mrp');?></label>
						<input type="input" name="mrp" class="form-control"/>																	
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
<div class="panel panel-primary">	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="item_table">
			<thead>
				<tr>
					<th>Sr. No.</th>
					<th><?php echo $this->lang->line('item');?></th>
					<th><?php echo $this->lang->line('desired_stock');?></th>
					<th><?php echo $this->lang->line('mrp');?></th>
					<th><?php echo $this->lang->line('edit');?></th>
					<th><?php echo $this->lang->line('delete');?></th>
				</tr>									
			</thead>
			<tbody>
			<?php $i=1; ?>
			<?php foreach ($items as $item): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $item['item_name'] ?></td>
				<td><?php echo $item['desired_stock'] ?></td>
				<td><?php echo $item['mrp'] ?></td>
				<td><a class="btn btn-primary" title="Edit" href="<?php echo site_url("stock/edit_item/" . $item['item_id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
				<td><a class="btn btn-danger confirmDelete" title="<?php echo  $this->lang->line('delete_item')." :" . $item['item_name']?>" href="<?php echo site_url("stock/delete_item/" . $item['item_id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
			</tr>
			 <?php $i++; ?>
			<?php endforeach ?>
			</tbody>
			
			</table>
		</div>		
	</div>
</div>
