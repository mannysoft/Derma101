<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('#supplier_table').dataTable();
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
					<?php echo $this->lang->line('suppliers');?>
			</div>
			<div class="panel-body">
			<?php echo form_open('stock/supplier') ?>
					<div class="form-group">
						<label for="supplier_name"><?php echo $this->lang->line('supplier_name');?></label> 
						<input type="input" name="supplier_name"  class="form-control"/>											
						<?php echo form_error('supplier_name','<div class="alert alert-danger">','</div>'); ?>
					</div><div class="form-group">
						<label for="contact_number"><?php echo $this->lang->line('contact_number');?></label> 
						<input type="input" name="contact_number" class="form-control"/>											
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
<div class="panel panel-default">	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="supplier_table">
			<thead>
				<tr>
					<th>Sr. No.</th>
					<th><?php echo $this->lang->line('supplier_name');?></th>
					<th><?php echo $this->lang->line('contact_number');?></th>
					<th><?php echo $this->lang->line('edit');?></th>
					<th><?php echo $this->lang->line('delete');?></th>
				</tr>									
			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($suppliers as $supplier):  ?>
				<tr class="<?php if($i%2==0){echo 'even';}else{echo 'odd';}?>">
					<td><?php echo $i; ?></td>
					<td><?php echo $supplier['supplier_name'] ?></td>
					<td><?php echo $supplier['contact_number'] ?></td>
					<td><a class="btn btn-primary" title="<?php echo $this->lang->line('edit');?>" href="<?php echo site_url("stock/edit_supplier/" . $supplier['supplier_id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
					<td><a class="btn btn-danger confirmDelete" title="<?php echo  $this->lang->line('delete_supplier')." :" . $supplier['supplier_name']?>" href="<?php echo site_url("stock/delete_supplier/" . $supplier['supplier_id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach ?>
			</tbody>
			</table>
		</div>		
	</div>
</div>