<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						SMS Format
					</div>
					<div class="panel-body" >
						<?php echo form_open('alert/save_sms_format/'.$alert_name); ?>    	
							<div class="form-group">
								<label>SMS Template ID</label>
								<input type="text" class="form-control" name="sms_template_id" value="<?php echo $sms_template_id;?>" />
								<label>SMS Format</label>
								<textarea class="form-control" name="sms_format"><?=$sms_format;?></textarea>
								<label>Shortcodes you need to use:</label>
								<ul>
									<li>[patient_name] - Patient Full Name</li>
									<li>[patient_id] - Patient ID</li>
									<li>[clinic_name] - Clinic Name</li>
									<li>[doctor_name] - Doctor Name</li>
									<li>[dose_time] - Morning | Tuesday | Wednesday</li>
									<li>[sms_medicine_details] - All Medicine Details in Table Format</li>
									<li>[appointment_time] - Appointment Time</li>
									<li>[appointment_date] - Appointment Date</li>
									<li>[appointment_status] - Appointment Status</li>
									<li>[bill] - Soft Copy of Bill</li>
								</ul>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit" />Save</button>
								<a class="btn btn-primary" href="<?=site_url('alert/settings');?>"  />Back</a>
							</div>
						<?php echo form_close(); ?>    	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>