<script src='<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
    'advlist autolink lists link image charmap print anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
</script>
<div id="page-inner"
	<div class="row">
		<div class="col-md-12">
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						Email Format
					</div>
					<div class="panel-body" >
						<?php echo form_open('alert/save_email_format/'.$alert_name); ?>    	
							<div class="form-group">
								<label>Subject</label>
								<input type="text" class="form-control" name="email_subject" value="<?php echo $email_subject;?>" />
								<label>Content</label>
								<textarea name="email_format">
									<?php echo $email_format;?>
								</textarea>
								<label>Shortcodes you need to use:</label>
								<ul>
									<li>[patient_name] - Patient Full Name</li>
									<li>[patient_id] - Patient ID</li>
									<li>[clinic_name] - Clinic Name</li>
									<li>[doctor_name] - Doctor Name</li>
									<li>[dose_time] - Morning | Tuesday | Wednesday</li>
									<li>[medicine_details] - All Medicine Details in Table Format</li>
									<li>[appointment_time] - Appointment Time</li>
									<li>[appointment_date] - Appointment Date</li>
									<li>[appointment_status] - Appointment Status</li>
									<li>[bill] - Soft Copy of Bill</li>
									<li>[appointment_reason] - appointment reason</li>
									<li>[bill_id] - bill id</li>
									<li>[patient_email] - email ID</li>
									<li>[patient_phone_number] - Phone Number</li>
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