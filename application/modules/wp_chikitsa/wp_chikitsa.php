<?php
/*
Plugin Name: WP Chikitsa
Plugin URI: #
Description: This WordPress Plugin will create a link between your Chikitsa and WordPress website. 
			A Patient will be able to book an appointment online. 
			The appointment will be shown in Chikitsa Calendar.
Version: 0.0.1
Author: Sanskruti Technologies
Author URI: http://sanskrutitech.in/
License: GPL
To Do:
1. 
*/

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'wp_chikitsa_install'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'wp_chikitsa_uninstall' );

add_shortcode( 'chikitsa_appointment_form', 'wp_chikitsa_appointment_form');

function wp_chikitsa_install(){
	/** Do Nothing */
}
function wp_chikitsa_uninstall () {
	/** Do Nothing */
} 
function wp_chikitsa_db_connect(){
	$hostname = get_option( 'wp_chikitsa_hostname');
	$username = get_option( 'wp_chikitsa_username');
	$password = get_option( 'wp_chikitsa_password');
	$database = get_option( 'wp_chikitsa_database');
	
	$con = mysqli_connect($hostname,$username,$password,$database);

	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	return $con;

}
function wp_chikitsa_get_doctors(){
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	$result = mysqli_query($con,"SELECT * FROM ".$db_prefix."users WHERE level ='Doctor' AND is_active=1");
	if(!is_array($result)){
		$doctors = array();
		$i = 0;
		while($row = mysqli_fetch_array($result) ){
			
			$doctors[$i]['userid'] = $row['userid'];
			$doctors[$i]['name'] = $row['name'];
			$i++;
		}
		return $doctors;
	}else{
		return array();
	}
	
}
function wp_chikitsa_get_clinic_start_time(){
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	$result = mysqli_query($con,"SELECT * FROM ".$db_prefix."clinic");
	if($result==""){
		return "10:00";
	}else{
		$row = mysqli_fetch_array($result);
		return $row['start_time'];
	}
	
	
}
function wp_chikitsa_get_clinic_end_time(){
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	$result=mysqli_query($con,"SELECT * FROM ".$db_prefix."clinic");
	if($result==""){
		return "18:00";
	}else{
		$row = mysqli_fetch_array($result);
		return $row['end_time'];
	}
}
function wp_chikitsa_get_clinic_time_interval(){
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	$result=mysqli_query($con,"SELECT * FROM ".$db_prefix."clinic");
	if($result==""){
		return "1.00";
	}else{
		$row = mysqli_fetch_array($result);
		return $row['time_interval'];
	}
	
}
function wp_chikitsa_get_appointments($doctor_id,$start_date,$end_date){
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	$start_date = date('Y-m-d',strtotime($start_date));
	$end_date = date('Y-m-d',strtotime($end_date));
	
	$appointments = array();
	$result=mysqli_query($con,"SELECT * FROM ".$db_prefix."appointments WHERE userid = $doctor_id AND appointment_date BETWEEN '$start_date' AND '$end_date'");
	if($result!=""){
		while($row = mysqli_fetch_assoc($result)){
			$appointments[] = $row;
		}
	}
	return $appointments;
}
function is_appointment_booked($appointments,$current_date,$i){
	foreach($appointments as $appointment){
		if(strtotime($appointment['appointment_date']) == strtotime($current_date)){
			if($i >= timetoint($appointment['start_time']) && $i <= timetoint($appointment['end_time'])){
				return TRUE;
			}
		}
	}
}
function wp_chikitsa_create_patient($user_first,$user_last,$user_email,$new_user_id,$phone_number){
	$patient_since = current_time('Y-m-d'); 
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	mysqli_query($con,"INSERT INTO ".$db_prefix."contacts (first_name,last_name,email,phone_number) VALUES ('$user_first','$user_last','$user_email','$phone_number');");
	$contact_id = mysqli_insert_id($con); 
	mysqli_query($con,"INSERT INTO ".$db_prefix."patient (contact_id,patient_since,wp_user_id) VALUES ($contact_id,'$patient_since',$new_user_id);");
	$contact_id = mysqli_insert_id($con); 
}

function wp_chikitsa_get_doctor($doctor_id){
	$db_prefix = get_option( 'wp_chikitsa_db_prefix');
	$con = wp_chikitsa_db_connect();
	$result=mysqli_query($con,"SELECT * FROM ".$db_prefix."users WHERE userid = $doctor_id");
	$row = mysqli_fetch_array($result);
	return $row;
}
//Convert Time to integer.e.g. 09:00 -> 9, 09:30 -> 9.5
function timetoint($time) {
    $hrcorrection = 0;
    if (strpos($time, 'PM') > 0){  $hrcorrection = 12;}
    list($hours, $mins) = explode(':', $time);
    $mins = str_replace('AM', '', $mins);
    $mins = str_replace('PM', '', $mins);
    return $hours + $hrcorrection + ($mins / 60);
}
//Converts Integer to Time. e.g. 9 -> 9:00 , 9.5 -> 9:30
function inttotime12($tm,$time_format) {
    //if ($tm >= 13) {  $tm = $tm - 12; }
    $hr = intval($tm);
    $min = ($tm - intval($tm)) * 60;
    $format = '%02d:%02d';
	$time = sprintf($format, $hr, $min); //H:i
	$time = date($time_format, strtotime($time));
    return $time;
}
function inttotime($tm) {
    $hr = intval($tm);
    $min = ($tm - intval($tm)) * 60;
    $format = '%02d:%02d';
    return sprintf($format, $hr, $min);
}
function wp_chikitsa_styles() {
  wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
add_action('wp_print_styles', 'wp_chikitsa_styles');
function wp_chikitsa_scripts() {
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'jquery-ui-core' );
  wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action('wp_enqueue_scripts', 'wp_chikitsa_scripts');
// register a new user
function wp_chikitsa_add_new_member() {
  	if (isset( $_POST["wp_chikitsa_user_login"] ) && wp_verify_nonce($_POST['wp_chikitsa_register_nonce'], 'wp-chikitsa-register-nonce')) {
		$user_login		= $_POST["wp_chikitsa_user_login"];	
		$user_email		= $_POST["wp_chikitsa_user_email"];
		$user_first 	= $_POST["wp_chikitsa_user_first"];
		$user_last	 	= $_POST["wp_chikitsa_user_last"];
		$phone_number 	= $_POST["wp_chikitsa_phone_number"];
		$user_pass		= $_POST["wp_chikitsa_user_pass"];
		$pass_confirm 	= $_POST["wp_chikitsa_user_pass_confirm"];
 
		if(username_exists($user_login)) {
			// Username already registered
			wp_chikitsa_errors()->add('username_unavailable', __('Username already taken'));
		}
		if(!validate_username($user_login)) {
			// invalid username
			wp_chikitsa_errors()->add('username_invalid', __('Invalid username'));
		}
		if($user_login == '') {
			// empty username
			wp_chikitsa_errors()->add('username_empty', __('Please enter a username'));
		}
		if($phone_number == '') {
			// empty username
			wp_chikitsa_errors()->add('phonenumber_empty', __('Please enter a Phone Number'));
		}
		if(!is_email($user_email)) {
			//invalid email
			wp_chikitsa_errors()->add('email_invalid', __('Invalid email'));
		}
		if(email_exists($user_email)) {
			//Email address already registered
			wp_chikitsa_errors()->add('email_used', __('Email already registered'));
		}
		if($user_pass == '') {
			// passwords do not match
			wp_chikitsa_errors()->add('password_empty', __('Please enter a password'));
		}
		if($user_pass != $pass_confirm) {
			// passwords do not match
			wp_chikitsa_errors()->add('password_mismatch', __('Passwords do not match'));
		}
 
		$errors = wp_chikitsa_errors()->get_error_messages();
 
		// only create the user in if there are no errors
		if(empty($errors)) {
			
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'first_name'		=> $user_first,
					'last_name'			=> $user_last,
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> 'subscriber'
				)
			);
			if($new_user_id) {
				//Create Patient for this user.
				wp_chikitsa_create_patient($user_first,$user_last,$user_email,$new_user_id,$phone_number);

				// send an email to the admin alerting them of the registration
				wp_new_user_notification($new_user_id);
				
				// log the new user in
				wp_set_auth_cookie($new_user_id, true);
				wp_set_current_user($new_user_id, $user_login);	
				do_action('wp_login', $user_login);
				
				global $wp;
				//$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
				$current_url = home_url(add_query_arg(array(),$wp->request)).$_SERVER['REQUEST_URI'];
				
				//echo $current_url;
				wp_redirect($current_url);
				exit;
			}
 
		}
 
	}
}
add_action('init', 'wp_chikitsa_add_new_member');
function wp_chikitsa_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}
function wp_chikitsa_show_error_messages() {
	if($codes = wp_chikitsa_errors()->get_error_codes()) {
		echo '<div class="wp_chikitsa_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = wp_chikitsa_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}
// registration form fields
function wp_chikitsa_registration_form_fields() {
 
	ob_start(); ?>	
		<h3>Register New Account</h3>
 
		<?php 
		// show any error messages after form submission
		wp_chikitsa_show_error_messages(); ?>
 
		<form id="wp_chikitsa_registration_form" class="wp_chikitsa_registration_form" action="" method="POST">
			<fieldset>
				<p>
					<label for="wp_chikitsa_user_login"><?php _e('Username'); ?></label>
					<input name="wp_chikitsa_user_login" id="wp_chikitsa_user_login" class="required" type="text"/>
				</p>
				<p>
					<label for="wp_chikitsa_user_email"><?php _e('Email'); ?></label>
					<input name="wp_chikitsa_user_email" id="wp_chikitsa_user_email" class="required" type="email"/>
				</p>
				<p>
					<label for="wp_chikitsa_user_first"><?php _e('First Name'); ?></label>
					<input name="wp_chikitsa_user_first" id="wp_chikitsa_user_first" type="text"/>
				</p>
				<p>
					<label for="wp_chikitsa_user_last"><?php _e('Last Name'); ?></label>
					<input name="wp_chikitsa_user_last" id="wp_chikitsa_user_last" type="text"/>
				</p>
				<p>
					<label for="wp_chikitsa_phone_number"><?php _e('Phone Number'); ?></label>
					<input name="wp_chikitsa_phone_number" id="phone_number" type="text"/>
				</p>
				<p>
					<label for="wp_chikitsa_user_pass"><?php _e('Password'); ?></label>
					<input name="wp_chikitsa_user_pass" id="wp_chikitsa_user_pass" class="required" type="password"/>
				</p>
				<p>
					<label for="wp_chikitsa_user_pass_confirm"><?php _e('Password Again'); ?></label>
					<input name="wp_chikitsa_user_pass_confirm" id="wp_chikitsa_user_pass_confirm" class="required" type="password"/>
				</p>
				<p>
					<input type="hidden" name="wp_chikitsa_register_nonce" value="<?php echo wp_create_nonce('wp-chikitsa-register-nonce'); ?>"/>
					<input type="submit" value="<?php _e('Register Your Account'); ?>"/>
				</p>
			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}
function wp_chikitsa_appointment_form(){
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	
	$form = "";
	//$base_url = "http://sanskrutitech.in/chikitsa_demo/";
	if (isset($_REQUEST['confirm_appointment']) && ($_REQUEST['confirm_appointment']=="confirm_appointment"))  {
		
		//Book the appointment
		$appointment_date = date('Y-m-d',strtotime($_POST['appointment_date']));
		$start_time = $_POST['start_time'];
		$end_time = $_POST['end_time'];
		$appointment_reason = $_REQUEST['appointment_reason'];
		$doctor_id = $_REQUEST['doctor_id'];
		
		$wp_user_id = get_current_user_id();
		
		$db_prefix = get_option( 'wp_chikitsa_db_prefix');
		$con = wp_chikitsa_db_connect();
		
		//Get Patient Details
		$result = mysqli_query($con,"SELECT * FROM ".$db_prefix."patient WHERE wp_user_id = $wp_user_id");
		$patient = mysqli_fetch_array($result);
		
		$contact_id = $patient['contact_id'];
		
		$result = mysqli_query($con,"SELECT * FROM ".$db_prefix."contacts WHERE contact_id = $contact_id");
		$contact = mysqli_fetch_array($result);  
		
		$result = mysqli_query($con,"SELECT * FROM ".$db_prefix."users WHERE userid = $doctor_id");
		$users = mysqli_fetch_array($result);
		
		$title = $contact['first_name'].' '.$contact['middle_name'].' '.$contact['last_name'];
		$patient_id = $patient['patient_id'];
		
		$userid = $users['userid'];
		
		mysqli_query($con,"INSERT INTO ".$db_prefix."appointments(appointment_date,start_time,end_time,title,patient_id,userid,status,appointment_reason,clinic_id) VALUES('$appointment_date','$start_time','$end_time','$title',$patient_id,$userid,'Pending','$appointment_reason',1)");
		$form .= "<h1>Appointment is booked!</h1>";
		
	
	}elseif (isset($_GET['step']) && $_GET['step']=="register") {
		$clinic_time_interval = wp_chikitsa_get_clinic_time_interval();
		$doctor_id = $_GET['doctor_id'];
		$appointment_reason = $_GET['appointment_reason'];
		$appointment_date = $_GET['appointment_date'];
		$appointment_time = inttotime($_GET['appointment_time']);
		$end_time = inttotime($_GET['appointment_time'] + $clinic_time_interval);
		$doctor = wp_chikitsa_get_doctor($doctor_id);
		//Display Appointment Details
		$form .= "<div>";
		$form .= "<label class='appointment_detail_label'>Doctor</label>";
		$form .= "<strong>".$doctor['name']."</strong>";
		$form .= "</div>";
		$form .= "<div>";
		$form .= "<label class='appointment_detail_label'>Appointment Date</label>";
		$form .= "<strong>$appointment_date</strong>";
		$form .= "</div>";
		$form .= "<div>";
		$form .= "<label class='appointment_detail_label'>Appointment Time</label>";
		$form .= "<strong>$appointment_time - $end_time</strong>";
		$form .= "</div>";
		$form .= "<div>";
		$form .= "<label class='appointment_detail_label'>Appointment Reason</label>";
		$form .= "<strong>$appointment_reason</strong>";
		$form .= "</div>";
		// only show the registration form to non-logged-in members
		if(!is_user_logged_in()) {
	 
			// check to make sure user registration is enabled
			$registration_enabled = get_option('users_can_register');
	 
			// only show the registration form if allowed
			$form .= "<div style='width:45%;float:left;'>";
			if($registration_enabled) {
				$form .= wp_chikitsa_registration_form_fields();
			} else {
				$form .= 'User registration is not enabled.';
			}
			$form .= "</div>";
			$args = array(
				'echo'           => false,
				'remember'       => true,
				'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
				'form_id'        => 'loginform',
				'id_username'    => 'user_login',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'label_username' => __( 'Username' ),
				'label_password' => __( 'Password' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in'   => __( 'Log In' ),
				'value_username' => '',
				'value_remember' => false
			);
			$form .= "<div style='width:45%;float:left;'>";
			$form .= "<h3>Login</h3>";
			$form .= wp_login_form( $args );
			$form .= "</div>";
		}else{
			$form .= "<form method='post'>";
			$form .= "<input type='hidden' name='appointment_reason' value='$appointment_reason'/>";
			$form .= "<input type='hidden' name='appointment_date' value='$appointment_date'/>";
			$form .= "<input type='hidden' name='start_time' value='$appointment_time'/>";
			$form .= "<input type='hidden' name='end_time' value='$end_time'/>";
			$form .= "<input type='hidden' name='confirm_appointment' value='confirm_appointment'/>";
			$form .= "<button type='submit' name='submit' class='make_appointment_button'>Book Appointment</button>";
			$form .= '</form>';
		}
	}elseif (isset($_POST['wp_chikitsa_appointment_form'])) {
		
		$doctor_id = $_POST['doctor_id'];
		$appointment_date = $_POST['appointment_date'];
		$appointment_reason = $_POST['appointment_reason'];
		$clinic_start_time = wp_chikitsa_get_clinic_start_time();
		$clinic_end_time = wp_chikitsa_get_clinic_end_time();
		$clinic_time_interval = wp_chikitsa_get_clinic_time_interval();
		
		//Show Calendar
		$form .= "<h1>Book Appointment</h1>";
		$form .= "<table>";
		$form .= "<tr>";
		$form .= "<td></td>";
		
		$todate = date('d-m-Y');
		$days_difference =  strtotime($todate) - strtotime($appointment_date);
		if($days_difference < 0){
			$days_difference = 0;
		}
		
		$start_date = date('d-m-Y',strtotime($appointment_date." -$days_difference days"));
		$end_date = date('d-m-Y',strtotime($appointment_date." -$days_difference days"));
		$end_date = date('d-m-Y',strtotime($end_date." +7 days"));
		$appointments = wp_chikitsa_get_appointments($doctor_id,$start_date,$end_date);
		
		$current_date = $start_date;
		while (strtotime($current_date) <= strtotime($end_date)){
			$form .= "<td>$current_date</td>";
			$current_date = date('d-m-Y',strtotime($current_date." +1 days"));
		}
		$form .= "</tr>";
		$start_time = timetoint($clinic_start_time);
		$end_time = timetoint($clinic_end_time);
		
		for ($i = $start_time; $i < $end_time; $i = $i + $clinic_time_interval) {
			$form .= "<tr>";
			$form .= "<td>".inttotime12( $i ,"H:i")."</td>";
			$current_date = $start_date;
			while (strtotime($current_date) <= strtotime($end_date)){
				$year = date('Y',strtotime($current_date));
				$month = date('m',strtotime($current_date));
				$day_date = date('d',strtotime($current_date));
				$time = explode(":",inttotime($i));
				if(is_appointment_booked($appointments,$current_date,$i)){
					$form .= "<td style='background-color:orange'></td>";
				}else{
					$form .= "<td><a href='$current_url&step=register&doctor_id=$doctor_id&appointment_reason=$appointment_reason&appointment_date=$current_date&appointment_time=$i' style='display:block;padding:.75em;'></a></td>";
				}
				
				$current_date = date('d-m-Y',strtotime($current_date." +1 days"));
			}
			$form .= "</tr>";
		}
		$form .= "<tr>";
		$current_date = $start_date;
		while (strtotime($current_date) <= strtotime($end_date)){
			$form .= "<td></td>";
			$current_date = date('d-m-Y',strtotime($current_date." +1 days"));
		}
		$form .= "</tr>";
		$form .= "</table>";
	}else{
		$doctors = wp_chikitsa_get_doctors();
		$form .= "<h1>Book Appointment</h1>";
		$form .= "<form method='post'>";
		$form .= "<input name='wp_chikitsa_appointment_form' type='hidden' value='1'>";
		$form .= "<div class='field_group'>";
		$form .= "<label>Select Doctor</label>";
		$form .= "<select name='doctor_id'>";
		foreach($doctors as $doctor){
			$form .= "<option value='".$doctor['userid']."'>".$doctor['name']."</option>";
		}
		$form .= "</select>";
		$form .= "</div>";
		$form .= "<div class='field_group'>";
		$form .= "<label>Select Date</label>";
		$form .= "<input type='text' id='appointment_date' name='appointment_date'/>";
		$form .= "</div>";
		$form .= "<div class='field_group'>";
		$form .= "<label>Reason for Visit</label>";
		$form .= "<input type='text' name='appointment_reason'/>";
		$form .= "</div>";
		$form .= "<div class='field_group'>";
		$form .= "<button type='submit' name='submit' class='make_appointment_button'>Make Appointment</button>";
		$form .= "</div>";
		$form .= "</form>";
		$form .= "<script>";
		$form .= "jQuery(document).ready(function(){";
		$form .= "jQuery('#appointment_date').datepicker({";
		$form .= "dateFormat: 'dd-mm-yy'";
		$form .= "});";
		$form .= "});";
		$form .= "</script>";
	}
	
	
	return $form;
}
require_once dirname( __FILE__ ) . '/wp_chikitsa_admin.php';
?>
