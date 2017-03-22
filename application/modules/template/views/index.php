<script type="text/javascript" charset="utf-8">   
$(window).load(function() {
    $('#visit_table').dataTable();
	
	$('.confirmDelete').click(function(){
		return confirm("Are you sure you want to delete?");
	});	
} )
</script>

<div class="panel panel-primary">	
	<div class="panel-heading">
		Templates
	</div>
	<div class="panel-body">
		<a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/template/form') . '/' ; ?>"><?php echo $this->lang->line('add');?></a>
		<br/>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="visit_table">
			<thead>
				<tr>
					<th width="70%;"><?php echo $this->lang->line('template_name');?></th>
					<th><?php echo $this->lang->line('type');?></th>
					<th><?php echo $this->lang->line('is_default');?></th>
					<th><?php echo $this->lang->line('edit');?></th>
					<th><?php echo $this->lang->line('delete');?></th>
				</tr>									
			</thead>
			<tbody>
            <?php foreach ($templates as $template) { ?>
                <tr>
                    <td><?php echo $template['template_name']; ?></td>
					<td><?php echo $template['type']; ?></td>
					<td><?php if($template['is_default'] == 1){ ?>
					<i class="fa fa-check fa-lg"></i>
					<?php }else{ ?>
					<a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/template/set_as_default') . '/' . $template['template_id']; ?>"><?php echo $this->lang->line('set_as_default');?></a>
					<?php } ?>
					</td>
                    <td><center><a class="btn btn-primary btn-sm" href="<?php echo base_url('index.php/template/form') . '/' . $template['template_id']; ?>"><?php echo $this->lang->line('edit');?></a></center></td>
            <td><center><a class="btn btn-danger btn-sm confirmDelete" title="<?php echo "Delete Template : " . $template['template_name'] ; ?>" href="<?php echo base_url('index.php/template/delete') . '/' . $template['template_id']; ?>"><?php echo $this->lang->line('delete');?></a></center></td>                
            </tr>
        <?php } ?>
        </tbody></div>		
	</div>
</div>

