<script type="text/javascript" charset="utf-8">
	$( window ).load(function() {
		$("#from_date").datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			onShow:function( ct ){
				//var ToDate = $.datepicker.formatDate('yy/mm/dd', new Date($('#to_date').val()));
				var ToDate = $('#to_date').val();
				this.setOptions({
					maxDate:ToDate?ToDate:false,
					formatDate:'<?=$def_dateformate; ?>'
				})
			}
		});
		$("#to_date").datetimepicker({
			timepicker:false,
			format: '<?=$def_dateformate; ?>',
			scrollMonth:false,
			scrollTime:false,
			scrollInput:false,
			onShow:function( ct ){
				//var FromDate = $.datepicker.formatDate('yy/mm/dd', new Date($('#from_date').val()));
				var FromDate = $('#from_date').val();
				this.setOptions({
					minDate:FromDate?FromDate:false,
					formatDate:'<?=$def_dateformate; ?>'
				})
			}
		});

    });
</script>
<?php 
if($from_date =='1970-01-01'){ 
	$from_date = date('Y-m-d');
	$to_date = date('Y-m-d');
}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			<div class="panel-heading">
				<?php echo $this->lang->line('purchase') . ' ' . $this->lang->line('report');?>
			</div>
			<div class="panel-body">
				<?php echo form_open('stock/purchase_report'); ?>
				<div class="col-md-3">
					<?php echo $this->lang->line('from_date');?>
					<input type="text" name="from_date" id="from_date" class="form-control" value="<?=date($def_dateformate,strtotime($from_date));?>" />
				</div>
				<div class="col-md-3">
					<?php echo $this->lang->line('to_date');?>
					<input type="text" name="to_date" id="to_date" class="form-control" value="<?=date($def_dateformate,strtotime($to_date));?>" />
				</div>
				<div class="col-md-12">
					<input type="submit" name="submit" class="btn btn-primary" value="<?php echo $this->lang->line('go');?>"></input>
				</div>
				<?php echo form_close(); ?>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="purchase_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line('purchase_date');?></th>
								<th><?php echo $this->lang->line('bill_no');?></th>
								<th><?php echo $this->lang->line('supplier');?></th>
								<th><?php echo $this->lang->line('item');?></th>
								<th><?php echo $this->lang->line('quantity');?></th>
								<th><?php echo $this->lang->line('cost_price');?></th>
								<th><?php echo $this->lang->line('total');?></th>
							</tr>
						</thead>    
						<tbody>
						<?php
							foreach ($purchase_totals as $purchase_total) {
								$found = FALSE;
								$show_total = FALSE;
								foreach ($purchases as $purchase) {
									if ($purchase_total['bill_no'] == $purchase['bill_no']) {
										$date = $purchase['purchase_date'];
										$bill_no = $purchase['bill_no'];
										$supplier_name = $purchase['supplier_name'];
										$item_name = $purchase['item_name'];
										$qnt = $purchase['quantity'];
										$cost = $purchase['cost_price'];
										$amount = ($purchase['quantity'] * $purchase['cost_price']);
										$found = TRUE;
										$show_total = TRUE;
									}
									if ($found) {
										?>
										<tr>
											<td><?php echo date($def_dateformate,strtotime($date)); ?></td>
											<td><?php echo $bill_no ?></td>
											<td><?php echo $supplier_name; ?></td>
											<td><?php echo $item_name; ?></td>
											<td style="text-align: right;"><?php echo $qnt; ?></td>                    
											<td style="text-align: right;"><?php echo $cost; ?></td>
											<td style="text-align: right;"><?php echo currency_format($amount); if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
										</tr>
										<?php
										$found = FALSE;
									}
								}
								if ($show_total) {
							?>
								<tr>
									<td colspan="5"></td>
									<td style="text-align: right;"><strong><?php echo $this->lang->line('total');?></strong></td>
									<td style="text-align: right;"><strong><?php echo currency_format($purchase_total['total']); if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></strong></td>
								</tr>
								<?php 
								$show_total = FALSE;
								} ?>
                        <?php } ?>
                </tbody>

            </table>

        </div>

    </body>
</html>