<script>
	$(window).load(function() {    
		var medicine_array = [<?php
					$i=0;
					foreach ($medicines as $medicine){
						if ($i>0) {echo ",";}
						echo '{value:"' . $medicine['medicine_name'] . '",id:"' . $medicine['medicine_id'] . '"}';
						$i++;
					}
				?>];
		
		$( "#add_medicine" ).click(function() {
			
			var medicine_count = parseInt( $( "#medicine_count" ).val());
			medicine_count = medicine_count + 1;
			$( "#medicine_count" ).val(medicine_count);
			
			var medicine = "<div><div class='col-md-2'><label for='medicine' style='display:block;text-align:left;'>Medicine</label><input type='text' name='medicine_name[]' id='medicine_name"+medicine_count+"' class='form-control'/><input type='hidden' name='medicine_id[]' id='medicine_id"+medicine_count+"' class='form-control'/></div>";
			medicine += "<div class='col-md-6'><label for='frequency' style='display:block;text-align:left;'>Frequency</label><div class='col-md-1'>M</div><div class='col-md-3'><input type='text' name='freq_morning[]' id='freq_morning' class='form-control'/></div><div class='col-md-1'>A</div><div class='col-md-3'><input type='text' name='freq_afternoon[]' id='freq_afternoon' class='form-control'/></div><div class='col-md-1'>N</div><div class='col-md-3'><input type='text' name='freq_evening[]' id='freq_evening' class='form-control'/></div></div>";
			medicine += "<div class='col-md-1'><label for='days' style='display:block;text-align:left;'>Days</label><input type='text' name='days[]' id='days' class='form-control'/></div>";
			medicine += "<div class='col-md-2'><label for='prescription_notes' style='display:block;text-align:left;'>Instructions</label><input type='text' name='prescription_notes[]' id='prescription_notes' class='form-control'/></div>";
			medicine += "<div class='col-md-1'><label></label><a href='#' id='delete_medicine"+medicine_count+"' class='btn btn-danger btn-sm square-btn-adjust'>Delete</a></div></div>";
			$( "#prescription_list" ).append(medicine);
			
			$("#delete_medicine"+medicine_count).click(function() {			
				$(this).parent().parent().remove();
			});
			$("#medicine_name"+medicine_count).autocomplete({
				source: medicine_array,
				minLength: 1,//search after one characters
				select: function(event,ui){
					//do something
					$("#medicine_id"+medicine_count).val(ui.item ? ui.item.id : '');

				},
				change: function(event, ui) {
					 if (ui.item == null) {
						$("#medicine_name"+medicine_count).val('');
						}
				},
			});
		});
	});
</script>
<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
						<?php echo $this->lang->line('edit'). ' ' . $this->lang->line('prescription');?>
				</div>
				<div class="panel-body">
					<?php echo form_open('prescription/edit_prescription/' . $visit_id); ?>
					<div id="prescription_list">
						<div class="col-md-12">
							<a href="#" id="add_medicine" class="btn btn-primary square-btn-adjust">Add another medicine</a>
							<input type="hidden" id="medicine_count" value="0"/>
						</div>
						<?php foreach($prescriptions as $medicine){
								if($medicine['medicine_id'] == 0){
									$medicine_id = "";
									$medicine_name = "";
								}else{
									$medicine_id = $medicine['medicine_id'];
									$medicine_name = $medicine_array[$medicine['medicine_id']];
								}
								
							?>
							<div class="col-md-2">	
								<label for="medicine" style="display:block;text-align:left;">Medicine</label>
								<input type="text" name="medicine_name[]" id="medicine_name" value="<?=$medicine_name;?>" class="form-control medicine_name"/>
								<input type="hidden" name="medicine_id[]" id="medicine_id" value="<?=$medicine_id;?>" class="form-control"/>
							</div>
							<div class="col-md-6">
								<label for="frequency" style="display:block;text-align:left;">Frequency</label>
								<div class="col-md-1">
									M
								</div>
								<div class="col-md-3">
									<input type="text" name="freq_morning[]" id="freq_morning"  value="<?=$medicine['freq_morning'];?>" class="form-control"/>
								</div>
								<div class="col-md-1">
									A
								</div>
								<div class="col-md-3">
									<input type="text" name="freq_afternoon[]" id="freq_afternoon" value="<?=$medicine['freq_afternoon'];?>" class="form-control"/>
								</div>
								<div class="col-md-1">
									N
								</div>
								<div class="col-md-3">
								<input type="text" name="freq_evening[]" id="freq_evening" value="<?=$medicine['freq_night'];?>" class="form-control"/>
								</div>
							</div>
							<div class="col-md-1">
								<label for="days" style="display:block;text-align:left;">Days</label>
								<input type="text" name="days[]" id="days" value="<?=$medicine['for_days'];?>" class="form-control"/>
							</div>
							<div class="col-md-2">
								<label for="prescription_notes" style="display:block;text-align:left;">Instructions</label>
								<input type="text" name="prescription_notes[]" value="<?=$medicine['instructions'];?>" id="prescription_notes" class="form-control"/>
							</div>
							<div class="col-md-1">	
								<label></label>
								<a href="<?= site_url('prescription/delete_prescription_medicine/'.$visit_id.'/'.$medicine['medicine_id']);?>" class="btn btn-danger btn-sm square-btn-adjust" >Delete</a>
							</div>
						<?php }?>
					</div>
					<div class="col-md-12">
					<button class="btn btn-primary square-btn-adjust" type="submit" name="submit" /><?php echo $this->lang->line('save');?></button>
					<a class="btn btn-primary square-btn-adjust" href="<?=site_url('patient/visit/' . $patient_id);?>">Back</a>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>	