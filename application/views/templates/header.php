<!DOCTYPE html>
<?php
	$level = $this->session->userdata('category');
?>
<html>
    <head>
        <title>Derma 101 Clinic</title>
        
		<link rel="shortcut icon" type="image/png" href="<?= base_url() ?>/favicon.png"/>
		
        <!-- BOOTSTRAP STYLES-->
		<link href="<?= base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
		<!-- JQUERY UI STYLES-->
		<link href="<?= base_url() ?>assets/css/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" />
		<!-- FONTAWESOME STYLES-->
		<link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
		<link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet" />
		<!-- CHIKITSA STYLES-->
		<link href="<?= base_url() ?>assets/css/chikitsa.css" rel="stylesheet" />
		<!-- TABLE STYLES-->
		<link href="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
		

		<!-- JQUERY SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/jquery-1.11.3.js"></script>
		<!-- JQUERY UI SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>
		<!-- BOOTSTRAP SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
		<!-- METISMENU SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/jquery.metisMenu.js"></script>
		 <!-- DATA TABLE SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?= base_url() ?>assets/js/dataTables/dataTables.bootstrap.js"></script>
		<script src="<?= base_url() ?>/assets/js/dataTables/moment.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/dataTables/datetime-moment.js"></script>
		


		<!-- TimePicker SCRIPTS-->
		<script src="<?= base_url() ?>assets/js/jquery.datetimepicker.js"></script>
		<link href="<?= base_url() ?>assets/js/jquery.datetimepicker.css" rel="stylesheet" />
		<!-- CHOSEN SCRIPTS-->
		<script src="<?= base_url() ?>assets/js/chosen.jquery.min.js"></script>
		<link href="<?= base_url() ?>assets/css/chosen.min.css" rel="stylesheet" />
		<!-- Lightbox SCRIPTS-->
		<script src="<?= base_url() ?>assets/js/lightbox.min.js"></script>
		<link href="<?= base_url() ?>assets/css/lightbox.css" rel="stylesheet" />
		<!-- Sketch SCRIPTS-->
		<script src="<?= base_url() ?>assets/js/sketch.js"></script>	
		<!-- CUSTOM SCRIPTS -->
		<script src="<?= base_url() ?>assets/js/custom.js"></script>
		<script src="<?= base_url() ?>/assets/js/morris/morris.js"></script>
		<script src="<?= base_url() ?>/assets/js/morris/raphael-2.1.0.min.js"></script>
    </head>
    <body>
        <?php
			
			
            $query = $this->db->get('clinic');
            $clinic = $query->row_array();
            
            $user_id = $_SESSION['id'];
            $this->db->where('userid', $user_id);
            $query = $this->db->get('users');
            $user = $query->row_array();
			
			$login_page = "appointment/index";
			$parent_name="";
			$result_top_menu = $this->menu_model->find_menu($parent_name);
			foreach ($result_top_menu as $top_menu){
				$id = $top_menu['id'];
				$parent_name = $top_menu['menu_name'];
				if($this->menu_model->has_access($top_menu['menu_name'],$level)){ 
					if($this->menu_model->is_module_active($top_menu['required_module'])){
						$result_sub_menu = $this->menu_model->find_menu($parent_name);
						$rowcount= count($result_sub_menu);	
						if($rowcount != 0){
							foreach ($result_sub_menu as $sub_menu){	
								if($this->menu_model->has_access($sub_menu['menu_name'],$level)){ 
									if($this->menu_model->is_module_active($sub_menu['required_module'])){
										$login_page = $sub_menu['menu_url'];
									}
								}
							}
						}else{
							$login_page = $top_menu['menu_url'];
						}
					}
				}
			}

        ?>
        <div id="wrapper">
		<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<div id="logo_container">		
					<img src="<?php echo base_url().$clinic['clinic_logo']; ?>" alt="Logo"  height="52" width="50" />
					<h3 class="app_title">Patient Record and Dispensary System</h3>
				</div>
				<div id="user_welcome">
				Welcome, <a href="<?=site_url("admin/change_profile"); ?>" class="header-btn"><?=$user['name']; ?></a>&nbsp;
				<a href="<?= site_url("login/logout"); ?>" class="btn btn-danger header-btn" style="margin-left: 10px;"><?php echo $this->lang->line('log_out');?></a> 
			</div>
            </div>

        </nav> 
