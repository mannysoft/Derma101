<div id="page-inner"
	<div class="row">
		<div class="col-md-12">
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						Email Log
					</div>
					<div class="panel-body" >
						<div class="col-md-12">
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" >
							<thead>
								<tr>
									<td>Email Timestamp</td>
									<td>Email Alert Name</td>
									<td>Email Email ID</td>
									<td>Email Subject</td>
									<td>Email Message</td>
									<td>Email Response</td>
								</tr>
							</thead>
							<tbody>
						<?php 
							foreach($email_log as $log){
								echo "<tr>";
								echo "<td>".date($def_dateformate . " ".$def_timeformate,strtotime($log['email_timestamp']))."</td>";
								echo "<td>".$log['email_alert_name']."</td>";
								echo "<td>".$log['email_email_id']."</td>";
								echo "<td>".$log['email_subject']."</td>";
								echo "<td>".$log['email_message']."</td>";
								echo "<td>".$log['email_response']."</td>";
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