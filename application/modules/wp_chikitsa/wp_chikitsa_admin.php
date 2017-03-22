<?php

add_action('admin_menu', 'wp_chikitsa_admin_menu');

function wp_chikitsa_admin_menu() 
{
	add_menu_page( 'Chikitsa Settings Page', 'Chikitsa Settings Page', 'manage_options','wp_chikitsa_option','wp_chikitsa_option_page', '',null);
}	
if (isset($_REQUEST['save_data'])) { 
	$hostname = $_REQUEST["hostname"];
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	$database = $_REQUEST["database"]; 
	$db_prefix = $_REQUEST["db_prefix"]; 
	
	update_option( 'wp_chikitsa_hostname', $hostname );
	update_option( 'wp_chikitsa_username', $username );
	update_option( 'wp_chikitsa_password', $password );
	update_option( 'wp_chikitsa_database', $database );
	update_option( 'wp_chikitsa_db_prefix', $db_prefix );
}
function wp_chikitsa_option_page() {
	$hostname = get_option( 'wp_chikitsa_hostname');
	$username = get_option( 'wp_chikitsa_username');
	$password = get_option( 'wp_chikitsa_password');
	$database = get_option( 'wp_chikitsa_database');
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	?><div class="wrap">  
		<h2>Chikitsa Settings Page</h2>
		<p>Please provide database details for Chikitsa Database</p>
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
			<div class="form-field">
				<label>Hostname</label>
				<input type='text' value='<?=$hostname;?>' name='hostname'/>
			</div>
			<div class="form-field">
				<label>Username</label>
				<input type='text' value='<?=$username;?>' name='username'/>
			</div>
			<div class="form-field">
				<label>Password</label>
				<input type='text' value='<?=$password;?>' name='password'/>
			</div>
			<div class="form-field">
				<label>Database</label>
				<input type='text' value='<?=$database;?>' name='database'/>
			</div>
			<div class="form-field">
				<label>DB Prefix</label>
				<input type='text' value='<?=$db_prefix;?>' name='db_prefix'/>
			</div>
			<div class='form-field'>
				<input class="button-primary" type="submit" name="save_data" value="Save" />
			</div>
		</form>
	  </div>
	<?php
}

?>