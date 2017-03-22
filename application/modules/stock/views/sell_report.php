<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
		//$('#stock_report_table').dataTable();
		
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
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Total Sell Report
				</div>
				<div class="panel-body">
					<?php echo form_open('stock/sell_report'); ?>
					<div class="col-md-3">
						<?php echo $this->lang->line('from_date');?>
						<input type="text" name="from_date" id="from_date" class="form-control" value="<?=date($def_dateformate,strtotime($from_date));?>" />
					</div>
					<div class="col-md-3">
						<?php echo $this->lang->line('to_date');?>
						<input type="text" name="to_date" id="to_date" class="form-control" value="<?=date($def_dateformate,strtotime($to_date));?>" />
					</div>
					
					
					<div class="col-md-3">
						<?php echo $this->lang->line('item');?>
						<select id="item" class="form-control" multiple="multiple" style="width:350px;" tabindex="4" name="item[]">
							<?php foreach ($items as $item) { 
								echo "<option value='".$item['item_id']."'";
								foreach ($selected_items as $selected_item){
									if($item['item_id'] == $selected_item){
										echo " selected ";
									}
								}
								echo ">".$item['item_name']."</option>";
							} ?>
						</select>
						<script>jQuery('#item').chosen();</script>
					</div>
					<div class="col-md-12">
						<div class="col-md-12">Group By</div>
						<div class="col-md-2"><input type="radio" name="group_by" value="none" <?php if($group_by == 'none'){echo "checked='checked'";}?>>None</div>
						<div class="col-md-2"><input type="radio" name="group_by" value="sell_no" <?php if($group_by == 'sell_no'){echo "checked='checked'";}?>>Sell No</div>
						<div class="col-md-2"><input type="radio" name="group_by" value="sell_date" <?php if($group_by == 'sell_date'){echo "checked='checked'";}?>>Date</div>
						<div class="col-md-2"><input type="radio" name="group_by" value="item_id" <?php if($group_by == 'item_id'){echo "checked='checked'";}?>>Item</div>
					</div>
					
					<div class="col-md-12">
						<input type="submit" name="submit" class="btn btn-primary" value="<?php echo $this->lang->line('go');?>"></input>
					</div>
					<?php echo form_close(); ?>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="stock_report_table">
						<thead>
							<tr>
								<th>Sell No</th>
								<th>Date</th>
								<th>Item</th>
								<th style="text-align:right;">Quantity</th>
								<th style="text-align:right;">Cost</th>
								<th style="text-align:right;">Total</th>
							</tr>									
						</thead> 
						
								<tbody>
								<?php 
									$sell_quantity=0;
									$sell_cost=0; 
									$sell_total=0; 
									$current_sell_no=0; 
									$current_sell_date = '1970-01-01';
									$current_item_id=0; 
									$group_total=0;
								?>
								<?php foreach ($sell_report as $sell){
									
									if($group_by == "sell_no"){
										if($current_sell_no != $sell['sell_no']){
											if($current_sell_no != 0){?>
												<tr>
													<td colspan="5"></td>
													<th style="text-align:right;"><? echo currency_format($group_total);?></th>
												</tr>
											<?php $group_total = 0;	
											}
										}
										$current_sell_no = $sell['sell_no'];  
									}elseif($group_by == "sell_date"){
										if($current_sell_date != $sell['sell_date']){
											if($current_sell_date != '1970-01-01'){?>
												<tr>
													<td colspan="5"></td>
													<th style="text-align:right;"><? echo currency_format($group_total);?></th>
												</tr>
											<?php $group_total = 0;	
											}
										} 
										$current_sell_date = $sell['sell_date'];  
									}elseif($group_by == "item_id"){
										if($current_item_id != $sell['item_id']){
											if($current_item_id != 0){?>
												<tr>
													<td colspan="5"></td>
													<th style="text-align:right;"><? echo currency_format($group_total);?></th>
												</tr>
											<?php $group_total = 0;	
											}
										} $current_item_id = $sell['item_id']; 
									} 
										$group_total = $group_total + $sell['sell_amount'];
									?>
									<tr>
										<td><?=$sell['sell_no']; ?></td>
										<td><?=date($def_dateformate,strtotime($sell['sell_date'])); ?></td>
										<td><?=$sell['item_name']; ?></td>
										<td style="text-align:right;"><?=$sell['quantity']; $sell_quantity=$sell_quantity+$sell['quantity'];?></td>
										
										<td style="text-align:right;"><?php 
											echo currency_format($sell['sell_price']);
											if($currency_postfix) echo $currency_postfix['currency_postfix'];
											
											$sell_cost=$sell_cost+$sell['sell_price'];
										?></td>
										<td style="text-align:right;"><?php 
											echo currency_format($sell['sell_amount']);
											if($currency_postfix) echo $currency_postfix['currency_postfix'];
											
											$sell_total=$sell_total+$sell['sell_amount'];
										?></td>
									</tr>
								<?php } 
									if($group_by != "none"){?>	
									<tr>
										<td colspan="5"></td>
										<th style="text-align:right;"><? echo currency_format($group_total);?></th>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
								<tr>
									<th></th>									
									<th></th>
									<th></th>
									<th style="text-align:right;"><?php echo $sell_quantity; ?></th>
									<th style="text-align:right;"><?php echo currency_format($sell_cost); if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
									<th style="text-align:right;"><?php echo currency_format($sell_total); if($currency_postfix) echo $currency_postfix['currency_postfix']; ?></th>
								</tr>
							</tfoot>
						
						</table>
					</div>		
				</div>
			</div>
		</div>
	</div>
</div>