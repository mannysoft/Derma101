<link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/jquery-te-1.4.0.css">

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-1.11.3.js" charset="utf-8"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$(document).ready(function() { 
		$('.jqte').jqte();
	});
</script>
<?php 
	if(isset($template)){
		$template_id = $template['template_id'];	
		$template_name = $template['template_name'];
		$template_content = $template['template'];
		$template_type = $template['type'];
	}else{
		$template_id = "";
		$template_name = "";
		$template_content = "";
		$template_type = "bill";
	}
?>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo $this->lang->line('file_content');?>					
				</div>
				<div class="panel-body">
					<?php echo form_open('template/form/' . $template_id) ?>
						<input type="hidden" name="template_id" value="<?=$template_id;?>" />
						<?php if (in_array("stock", $active_modules) || in_array("prescription", $active_modules)) { ?>
						<label>Bill Type</label>
						<select name="type" class="form-control">
							
							<option value="bill" <?php if($template_type == "bill"){echo "selected='selected'";}?>>Bill</option>
							
							<?php if (in_array("stock", $active_modules)) { ?>
							<option value="sell" <?php if($template_type == "sell"){echo "selected='selected'";}?>>Medicine Store Bill</option>
							<?php } ?>
							
							<?php if (in_array("prescription", $active_modules)) { ?>
							<option value="prescription" <?php if($template_type == "prescription"){echo "selected='selected'";}?>>Prescription</option>
							<?php } ?>
						</select>
						<?php }else{ ?>
							<input type="hidden" name="type" value="bill" />	
						<?php } ?>
						<label>Template Name</label>
						<input type="text" name="template_name" value="<?=$template_name;?>" class="form-control"> 
						<?php echo form_error('template_name','<div class="alert alert-danger">','</div>'); ?>
						<textarea name="template" class="form-control jqte"><?=$template_content;?></textarea>
						<?php echo form_error('template','<div class="alert alert-danger">','</div>'); ?>
						<p>
							<h4>Shortcodes you can use:</h4>
							<table>
							<tr><td>[clinic_name]</td><td>Clinic Name - Can be set in Clinic Detail</td></tr>
							<tr><td>[tag_line]</td><td>Tag Line - Can be set in Clinic Detail</td></tr>
							<tr><td>[clinic_address]</td><td>Clinic Address - Can be set in Clinic Detail</td></tr>
							<tr><td>[landline]</td><td>Landline - Can be set in Clinic Detail</td></tr>
							<tr><td>[mobile]</td><td>Mobile - Can be set in Clinic Detail</td></tr>
							<tr><td>[email]</td><td>Email - Can be set in Clinic Detail</td></tr>
							<tr><td>[bill_date]</td><td>Date of Bill</td></tr>
							<tr><td>[bill_time]</td><td>Time of Bill</td></tr>
							<tr><td>[bill_id]</td><td>ID of Bill</td></tr>
							<tr><td>[visit_date]</td><td>Date of Visit</td></tr>
							<tr><td>[patient_id]</td><td>Patient ID</td></tr>
							<tr><td>[patient_name]</td><td>Patient Name</td></tr>
							<tr><td>[age]</td><td>Patient Age</td></tr>
							<tr><td>[sex]</td><td>Patient Sex</td></tr>
							<tr><td>[col:particular|quantity|mrp|amount]&nbsp;&nbsp;&nbsp;</td><td>Columns to display in table For Bill</td></tr>
							<tr><td>[col:medicine_name|dosage|quantity|instructions]&nbsp;&nbsp;&nbsp;</td><td>Columns to display in table For Prescription</td></tr>
							<tr><td>[doctor_name]</td><td>Doctor Name</td></tr>
							<tr><td>[previous_due]</td><td>Previous Dues</td></tr>
							<tr><td>[total]</td><td>Total of this Bill</td></tr>
							<tr><td>[paid_amount]</td><td>Paid Amount</td></tr>
							</table>
						</p>
						<button class="btn btn-primary" type="submit" name="submit" /><?php echo $this->lang->line('save');?></button>
						<a class="btn btn-primary" href="<?=base_url('index.php/template/index') ;?>" ><?php echo $this->lang->line('cancel');?></a>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

