<div id="page-inner"
	<div class="row">
		<div class="col-md-12">
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						SMS Log
					</div>
					<div class="panel-body" >
						<div class="col-md-12">
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" >
							<thead>
								<tr>
									<td>SMS Timestamp</td>
									<td>SMS URL</td>
									<td>SMS Response</td>
								</tr>
							</thead>
							<tbody>
						<?php 
							foreach($sms_log as $log){
								echo "<tr>";
								echo "<td>".date($def_dateformate . " ".$def_timeformate,strtotime($log['sms_timestamp']))."</td>";
								echo "<td>".$log['sms_url']."</td>";
								echo "<td>".$log['sms_response']."</td>";
								echo "</tr>";
							}
						?>
						</tbody>
						</table>
						</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>