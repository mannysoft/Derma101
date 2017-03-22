<script type="text/javascript" charset="utf-8">
$(window).load(function() {    
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	});
	$( "#sell_date" ).datetimepicker({
		timepicker:false,
		format: '<?=$def_dateformate; ?>',
		scrollMonth:false,
		scrollTime:false,
		scrollInput:false,
	});
	$("#patient_name").autocomplete({
		autoFocus: true,
        source: [<?php
                $i=0;
                foreach ($patients as $patient){
                    if ($i>0) {echo ",";}
                    echo '{value:"' . $patient['first_name'] . " " . $patient['middle_name'] . " " .$patient['last_name'] . '",id:"' . $patient['patient_id'] . '"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#patient_id").val(ui.item ? ui.item.id : '');
	
        },
		change: function(event, ui) {
			 if (ui.item == null) {
				$("#patient_name").val('');
				}
		},
    });
	$("#item_name").autocomplete({
        source: [<?php
                $i=0;
                foreach ($items as $item){
                    if ($i>0) {echo ",";}
                    echo '{value:"' . $item['item_name'] . '",id:"' . $item['item_id'] . '",mrp:"'.$item['mrp'].'",available_quantity:"'.$item['available_quantity'].'"}';
                    $i++;
                }
            ?>],
        minLength: 1,//search after one characters
        select: function(event,ui){
            //do something
            $("#item_id").val(ui.item ? ui.item.id : '');
			$("#available_quantity").val(ui.item ? ui.item.available_quantity : '');
			$("#sell_price").val(ui.item ? ui.item.mrp : '');

        },
		change: function(event, ui) {
			 if (ui.item == null) {
				$("#item_name").val('');
				}
		},
    });
    $('#sell_table').dataTable();
});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('sell');?>
				</div>
				<div class="panel-body">
					<a class="btn btn-success" title="" href="<?php echo site_url("stock/sell/"); ?>">New Bill</a>
					<br/>
					<?php 
						
						if (isset($sell))
						{
							$patient_name = $sell['first_name'] . " " . $sell['middle_name'] . " " .$sell['last_name'];
							$sell_date = date($def_dateformate,strtotime($sell['sell_date'])); 
							$patient_id = $sell['patient_id'];
							$sell_id = $sell['sell_id'];
							$sell_no = $sell['sell_no'];
							$edit = TRUE;
						}
						else
						{
							$patient_name = "";
							$patient_id = "";
							$sell_date = date($def_dateformate);
							$sell_id = "";
							$sell_no = $new_sell_no;
							$edit = FALSE;
						}
						?>
					<?php echo form_open('stock/sell/'.$sell_id) ?>
					<input type="hidden" name="sell_id" id="sell_id" value="<?=$sell_no;?>" readonly />					
					<div class="col-md-12">
					<div class="col-md-3">
						<label for="sell_id">Sell No</label>
						<input type="text" name="sell_no" id="sell_no" value="<?=$sell_no;?>" class="form-control"/>					
						<?php echo form_error('sell_no','<div class="alert alert-danger">','</div>'); ?>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="sell_date">Date</label> 
							<input type="text" name="sell_date" id="sell_date" value="<?=$sell_date; ?>" class="form-control"/>					
							<?php echo form_error('sell_date','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="patient">Patient</label>
							<input type="input" name="patient_name" id="patient_name" value="<?=$patient_name;?>" class="form-control" />					
							<input type="hidden" name="patient_id" id="patient_id" value="<?=$patient_id;?>" class="form-control"/>
							<?php echo form_error('patient_id','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					</div>
					<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label for="item_name">Item</label> 
							<input type="text" name="item_name" id="item_name" class="form-control"/>					
							<input type="hidden" name="item_id" id="item_id" class="form-control"/>					
							<?php echo form_error('item_id','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="available_quantity">Available Quantity</label>
							<input type="input" name="available_quantity" id="available_quantity" class="form-control" readonly/>				
							<?php echo form_error('available_quantity','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="quantity">Quantity</label>
							<input type="input" name="quantity" class="form-control"/>				
							<?php echo form_error('quantity','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="sell_price">Price</label>
							<input type="input" name="sell_price" id="sell_price" class="form-control"/>				
							<?php echo form_error('sell_price','<div class="alert alert-danger">','</div>'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" name="submit" class="btn btn-primary" />Add</button>
							<?php if($sell_id != NULL){ ?>
							<a class="btn btn-info" target="_blank" title="" href="<?php echo site_url("stock/print_receipt/" . $sell_id); ?>">Print</a>
							<?php } ?>
						</div>
					</div>
					<?php echo form_close(); ?>
					</div>
				</div>
				
			</div>

<div class="panel panel-default">	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="sell_table">
			<thead>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Sell Price</th>
					<th>Sell Amount</th>
					<th>Delete</th>
				</tr>									
			</thead>
			<tbody>
			<?php $i=1; ?>
			<?php $total=0; ?>
			<?php if (isset($sell_details)) { ?>
			<?php foreach ($sell_details as $sell_detail):  ?>
			<tr>
				<td><?=$sell_detail['item_name'] ?></td>
				<td style="text-align: right"><?=$sell_detail['quantity'] ?></td>
				<td style="text-align: right"><?php echo currency_format($sell_detail['sell_price']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
				<td style="text-align: right"><?php echo currency_format($sell_detail['sell_amount']);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
				<td><a class="btn btn-danger confirmDelete" title="<?php echo "Delete Sell Item";?>" href="<?php echo site_url("stock/delete_sell_detail/" . $sell_detail['sell_detail_id'] . "/" . $sell['sell_id']); ?>">Delete</a></td>
			</tr>
			<?php $i++; ?>
			<?php $total = $total + $sell_detail['sell_amount']; ?>
			<?php endforeach ?>
			<?php } ?>
			</tbody>
			<thead>
				<tr><th colspan="3">Total</th><th style="text-align: right"><?php echo currency_format($total);if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th><th></th></tr>
			</thead>
			</table>
		</div>
	</div>
</div>

	</div>
</div>