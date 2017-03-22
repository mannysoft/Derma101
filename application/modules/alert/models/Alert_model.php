<?php
class Alert_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function get_all_alerts(){
		$query=$this->db->get('alerts');
		$result=$query->result_array();
		return $result;
	}
	public function set_enabled_alerts(){
		$data['is_enabled'] = 0;
		$this->db->update('alerts', $data);
		$data['is_enabled'] = 1;
		$email_alert = $this->input->post('email_alert');
		foreach($email_alert as $alert){
			$this->db->update('alerts', $data,array('alert_name'=>$alert));
		}
		if($this->input->post('sms_alert')){
			$sms_alert = $this->input->post('sms_alert');
			foreach($sms_alert as $alert){
				$this->db->update('alerts', $data,array('alert_name'=>$alert));
			}
		}
		
	}
	public function get_enabled_alerts($alert_occur = NULL){
		$query=$this->db->get_where('alerts', array('alert_occur' => $alert_occur,'is_enabled'=>1));
		$result=$query->result_array();
		return $result;
	}
	public function is_alert_enabled($alert_name){
		$query=$this->db->get_where('alerts', array('alert_name' => $alert_name,'is_enabled' => 1));
		if ($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function sms_log($send_sms_url,$content,$current_time){
		$data['sms_url'] = $send_sms_url;
        $data['sms_response'] = $content;
		$data['sms_timestamp'] = $current_time;
        
        $this->db->insert('sms_log', $data);
		//echo $this->db->last_query();
	}
	public function email_log($alert_name,$email_id,$subject,$message,$response,$current_time){
		$data['email_alert_name'] = $alert_name;
		$data['email_email_id'] = $email_id;
		$data['email_subject'] = $subject;
		$data['email_message'] = $message;
        $data['email_response'] = $response;
		$data['email_timestamp'] = $current_time;
        
        $this->db->insert('email_log', $data);
		//echo $this->db->last_query();
	}
	public function get_sms_log(){
		$this->db->order_by('sms_timestamp','desc');
		$query = $this->db->get_where('sms_log');
		return $query->result_array();
	}
	public function get_email_log(){
		$this->db->order_by('email_timestamp','desc');
		$query = $this->db->get_where('email_log');
		return $query->result_array();
	}
}
?>
