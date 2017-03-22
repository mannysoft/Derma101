<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
		$('#stock_report_table').dataTable();
		});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('stock') . " " .$this->lang->line('report');?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="stock_report_table">
						<thead>
							<tr>
								<th><?php echo $this->lang->line('item_name');?></th>
								<th><?php echo $this->lang->line('desired_stock');?></th>
								<th><?php echo $this->lang->line('available_stock');?></th>
								<th><?php echo $this->lang->line('bought_quantity');?></th>
								<th><?php echo $this->lang->line('sold_quantity');?></th>
								<th><?php echo $this->lang->line('bought_avg');?></th>
								<th><?php echo $this->lang->line('sold_avg');?></th>
							</tr>									
						</thead> 
						
								<tbody>
								<?php foreach ($stock_report as $stock){ ?>
									<tr>
										<td><?php echo $stock['item_name']; ?></td>
										<td style='text-align:right'><?php echo $stock['desired_stock']; ?></td>
										<?php if (($stock['purchase_quantity']-$stock['sell_quantity'])< $stock['desired_stock'])
										{   
											echo "<td class='red-bg' style='text-align:right'>";
										}
										else
										{
											echo "<td style='text-align:right'>";
										} 
										echo $stock['purchase_quantity']-$stock['sell_quantity']."</td>"; ?>
										<td style='text-align:right'><?php echo $stock['purchase_quantity'];?></td>
										<td style='text-align:right'><?php echo $stock['sell_quantity']; ?></td>
										<td style='text-align:right'><?php echo currency_format(sprintf("%01.2f", $stock['avg_purchase_price']));if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
										<?php $profit=$stock['avg_sell_price']-$stock['avg_purchase_price']; ?>
										<td style='text-align:right'><?php echo currency_format(sprintf("%01.2f", $stock['avg_sell_price']));if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></td>
									</tr>
								<?php } ?>	
								</tbody>
						
						</table>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>