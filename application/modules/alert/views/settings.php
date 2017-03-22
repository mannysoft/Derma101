<script type="text/javascript">
    $(window).load(function(){
		$('.email_alert').change(function() {	
			if($(this).prop("checked")){
				$(this).parent().parent().siblings().prop('checked', true);
				$(this).parent().parent().parent().parent().siblings().prop('checked', true);
			}
		});
		$('.sms_alert').change(function() {	
			if($(this).prop("checked")){
				$(this).parent().parent().siblings().prop('checked', true);
				$(this).parent().parent().parent().parent().siblings().prop('checked', true);
			}
		});
	});
</script>
<?php
	//print_r($enabled_alerts);
	function is_enabled($is_enabled){
		if($is_enabled == 1){
			return "checked='checked'";	
		}else{
			return "";
		}
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6">
			<div class="panel panel-primary" >
				<div class="panel-heading" >
					<?php echo $this->lang->line('settings');?>
				</div>
				<div class="panel-body" >
					<?php echo form_open('alert/save_settings'); ?>    	
						<div class="form-group">
							<?php 
								foreach($alerts as $alert_level1){
								if(!isset($alert_level1['parent_alert']) || $alert_level1['parent_alert'] == ''){
								?>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="<?=$alert_level1['alert_type'];?>_alert[]" class="<?=$alert_level1['alert_type'];?>_alert" value="<?=$alert_level1['alert_name'];?>" <?=is_enabled($alert_level1['is_enabled']);?>> <?=$alert_level1['alert_label'];?> 
											<?php //Level 2
												foreach($alerts as $alert_level2){
													if($alert_level2['parent_alert'] == $alert_level1['alert_name']){
														?><div class="checkbox">
															<label>
																<input type="checkbox" name="<?=$alert_level2['alert_type'];?>_alert[]" class="<?=$alert_level1['alert_type'];?>_alert" value="<?=$alert_level2['alert_name'];?>" <?=is_enabled($alert_level2['is_enabled']);?>> <?=$alert_level2['alert_label'];?> 
																<?php //Level 3
																	foreach($alerts as $alert_level3){
																		if($alert_level3['parent_alert'] == $alert_level2['alert_name']){
																			$required_module = $alert_level3['required_module'];
																			if(in_array($required_module, $active_modules) || $required_module == '') { 
																			?><div class="checkbox">
																				<label>
																					<input type="checkbox" name="<?=$alert_level3['alert_type'];?>_alert[]" class="<?=$alert_level1['alert_type'];?>_alert" value="<?=$alert_level3['alert_name'];?>" <?=is_enabled($alert_level3['is_enabled']);?>> <?=$alert_level3['alert_label'];?>
																					<a href="<?=site_url('alert/'.$alert_level3['alert_type'].'_format/'.$alert_level3['alert_format_name']);?>" class="btn btn-info btn-xs square-btn-adjust">Edit Format</a>
																					<?php 
																					if($alert_level3['alert_occur'] != "EVENT"){?>
																						<a href="<?=site_url('alert/'.$alert_level3['alert_type'].'_alert_time/'.$alert_level3['alert_format_name'].'/'.$alert_level3['alert_occur']);?>" class="btn btn-warning btn-xs square-btn-adjust">Set Alert Time</a>
																					<?php }?>
																					
																				</label>
																				
																			  </div><?php
																			}
																		}
																	}?>
															</label>
														</div><?php	
													}
												}
											?>
										</label>
									</div>
									<?php
								}
							} ?>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit" name="submit" />Save</button>
						</div>
					<?php echo form_close(); ?>    	
				</div>
			</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						SMS Settings
					</div>
					<div class="panel-body" >
						<?php echo form_open('alert/sms_settings'); ?>    	
							<div class="form-group">
								<label for="username">Username</label> <small>Enter the username provided by the SMS API Provider</small>
								<input type="text" name="username" value="<?=$sms_api_username;?>"  class="form-control"/>
								<?php echo form_error('username','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="password">Password</label> <small>Enter the password provided by the SMS API Provider</small>
								<input type="password" name="password" value="<?=$sms_api_password;?>"  class="form-control"/>
								<?php echo form_error('password','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="senderid">Sender ID</label> <small>Enter the sender ID provided by the SMS API Provider</small>
								<input type="text" name="senderid" value="<?=$senderid;?>"  class="form-control"/>
								<?php echo form_error('senderid','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="send_sms_url">URL to send SMS</label> <small>Enter the URL provided by the SMS API Provider</small>
								<textarea name="send_sms_url"  class="form-control"><?=$send_sms_url;?></textarea>
								<?php echo form_error('send_sms_url','<div class="alert alert-danger">','</div>'); ?>
								<label>Shortcodes you need to use:</label>
								<ul>
									<li>[username] - Will be replaced by Username</li>
									<li>[password] - Will be replaced by Password</li>
									<li>[senderid] - Will be replaced by Sender ID</li>
									<li>[mobileno] - Will be replaced by Receipient Mobile Number</li>
									<li>[message] - Will be replaced by Message</li>
									<li>[template_id] - Will be replaced by Template ID</li>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit" />Save</button>
							</div>
						<?php echo form_close(); ?>    	
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						Email Settings
					</div>
					<div class="panel-body" >
						<?php echo form_open('alert/email_settings'); ?>    	
							<div class="form-group">
								<label for="from_email">Email From</label> 
								<input type="text" name="from_email" value="<?=$from_email;?>"  class="form-control"/>
								<?php echo form_error('from_email','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="email_password">Email Password</label> 
								<input type="password" name="email_password" value="<?=$email_password;?>"  class="form-control"/>
								<?php echo form_error('email_password','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="from_name">Email From Name</label> 
								<input type="text" name="from_name" value="<?=$from_name;?>"  class="form-control"/>
								<?php echo form_error('from_name','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<label for="smtp_host">SMTP Host</label> 
								<input type="text" name="smtp_host" value="<?=$smtp_host;?>"  class="form-control"/>
								<?php echo form_error('smtp_host','<div class="alert alert-danger">','</div>'); ?>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit" />Save</button>
							</div>
						<?php echo form_close(); ?>    	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>