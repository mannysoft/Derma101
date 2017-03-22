<script type="text/javascript" charset="utf-8">
$( window ).load(function() {
	
	$('#purchase_date').datetimepicker({
		timepicker:false,
		format: '<?=$def_dateformate; ?>',
		scrollMonth:false,
		scrollTime:false,
		scrollInput:false,
	});
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	});
	
	$("#supplier_name").autocomplete({
        source: [<?php
                $i=0;
                foreach ($suppliers as $supplier){
    if ($i > 0) {
        echo ",";
    }
                    echo '{value:"' . $supplier['supplier_name'] . '",id:"' . $supplier['supplier_id'] . '"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#supplier_id").val(ui.item ? ui.item.id : '');

        }
    });  

	$("#item_name").autocomplete({
        source: [<?php
                $i=0;
                foreach ($items as $item){
    if ($i > 0) {
        echo ",";
    }
                    echo '{value:"' . $item['item_name'] . '",id:"' . $item['item_id'] . '"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#item_id").val(ui.item ? ui.item.id : '');
        }
    });	
	
	$('#purchase_table').dataTable();
	
});

</script>

<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('purchase');?>
			</div>
			<div class="panel-body">
			<?php echo form_open('stock/purchase') ?>
				<?php $today = date('Y-m-d'); ?>
				<div class="col-md-3">
					<div class="form-group">
						<label for="purchase_date"><?php echo $this->lang->line('purchase_date');?></label> 
						<input type="text" name="purchase_date" id="purchase_date" value="<?=date($def_dateformate);?>" class="form-control"/>					
						<?php echo form_error('purchase_date','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="bill_no"><?php echo $this->lang->line('bill_no');?></label> 
						<input type="input" name="bill_no" id="bill_no" class="form-control"/>
						<?php echo form_error('bill_no','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<input type="hidden" name="item_id" id="item_id"/>
				<div class="col-md-3">
					<div class="form-group">
						<label for="item_name"><?php echo $this->lang->line('item');?></label> 
						<input type="input" name="item_name" id="item_name" class="form-control"/>
						<?php echo form_error('item_id','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="quantity"><?php echo $this->lang->line('quantity');?></label> 
						<input type="input" name="quantity" class="form-control"/>
						<?php echo form_error('quantity','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="hidden" name="supplier_id" id="supplier_id"/>
						<label for="supplier_name"><?php echo $this->lang->line('supplier');?></label> 
						<input type="input" name="supplier_name" id="supplier_name" class="form-control"/>
						<?php echo form_error('supplier_id','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="cost_price"><?php echo $this->lang->line('cost_price');?></label> 
						<input type="input" name="cost_price" class="form-control"/>
						<?php echo form_error('cost_price','<div class="alert alert-danger">','</div>'); ?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary" /><?php echo $this->lang->line('save');?></button>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-primary">	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="purchase_table">
			<thead>
				<tr>
					<th><?php echo "Sr. No.";?></th>
					<th><?php echo $this->lang->line('purchase_date');?></th>
					<th><?php echo $this->lang->line('bill_no');?></th>
					<th><?php echo $this->lang->line('item');?></th>
					<th><?php echo $this->lang->line('quantity');?></th>
					<th><?php echo $this->lang->line('supplier');?></th>
					<th><?php echo $this->lang->line('cost_price');?></th>
					<th><?php echo $this->lang->line('edit');?></th>
					<th><?php echo $this->lang->line('delete');?></th>
				</tr>									
			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($purchases as $purchase):  ?>
				<tr class="<?php if($i%2==0){echo 'even';}else{echo 'odd';}?>">
					<td><?php echo $i; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($purchase['purchase_date']));?></td>
                    <td><?php echo $purchase['bill_no'] ?></td>
					<td><?php echo $purchase['item_name'] ?></td>
					<td><?php echo $purchase['quantity'] ?></td>
					<td><?php echo $purchase['supplier_name'] ?></td>
					<td class="right"><?php echo currency_format($purchase['cost_price']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
					<td><a class="btn btn-primary" title="Edit" href="<?php echo site_url("stock/edit_purchase/" . $purchase['purchase_id']); ?>">Edit</a></td>
					<td><a class="btn btn-danger confirmDelete" title="<?php echo "Delete Purchase";?>" href="<?php echo site_url("stock/delete_purchase/" . $purchase['purchase_id']); ?>"><?php echo $this->lang->line('delete');?></a></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach ?>
			</tbody>
			</table>
		</div>		
	</div>
</div>