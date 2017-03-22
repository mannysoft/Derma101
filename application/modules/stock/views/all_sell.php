<script type="text/javascript" charset="utf-8">
$(window).load(function() {
    $('#sell_table').dataTable( {
        "order": [[ 1, "desc" ]],
		"columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false
            }
        ]
    } );
});

</script>
<div class="panel panel-default">	
	<div class="panel-body">
		<div class="table-responsive">
			<p><a class="btn btn-success" title="" href="<?php echo site_url("stock/sell/"); ?>">New Bill</a></p>
			<table class="table table-striped table-bordered table-hover" id="sell_table">
			<thead>
				<tr>
					<th>Sell No</th>
					<th>Hidden Sell Date</th>
					<th><?php echo $this->lang->line('sell_date');?></th>
					<th><?php echo $this->lang->line('patient');?></th>
					<th><?php echo $this->lang->line('sell_amount');?></th>
					<th><?php echo $this->lang->line('edit');?></th>
				</tr>									
			</thead>
			<tbody>
				<?php $i=1; ?>
				<?php foreach ($sells as $sell):  ?>
				<tr class="<?php if($i%2==0){echo 'even';}else{echo 'odd';}?>">
					<td><?php echo $sell['sell_no'] ?></td>
					<td><?php echo date('Y-m-d',strtotime($sell['sell_date'])); ?></td>
					<td><?php echo date($def_dateformate,strtotime($sell['sell_date'])); ?></td>
					<td><?=$sell['first_name'] ?> <?=$sell['middle_name'] ?> <?=$sell['last_name'] ?></td>
					<td><?php echo currency_format($sell['sell_amount']); ?></td>
					<td><a class="btn btn-primary" title="Edit" href="<?php echo site_url("stock/sell/" . $sell['sell_id']); ?>"><?php echo $this->lang->line('edit');?></a></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach ?>
			</tbody>
			</table>
		</div>		
	</div>
</div>