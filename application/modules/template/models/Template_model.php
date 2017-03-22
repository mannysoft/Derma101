<?php

class Template_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
	
    public function get() {
		$query = $this->db->get("receipt_template");
		//echo $this->db->last_query()."<br/>";
        $result = $query->result_array();
		
		return $result;
    }
    public function get_template_from_id($template_id){
		$this->db->where("template_id", $template_id);
        $query = $this->db->get("receipt_template");
        return $query->row_array();    
	}
	public function delete($template_id){
		$this->db->delete('receipt_template', array('template_id' => $template_id)); 
	}
	public function set_as_default($template_id){
		//Get Template Type
		$template = $this->get_template_from_id($template_id);
		$template_type = $template['type'];
		
		$data['is_default'] = 0;
		$this->db->update('receipt_template', $data,array('type'=> $template_type));
		
		$data['is_default'] = 1;
		$this->db->update('receipt_template', $data,array('template_id' => $template_id));
		
	}
	public function save(){
		$template_id = $this->input->post('template_id');
		$data['template_name'] = $this->input->post('template_name');
		$data['template'] = $this->input->post('template');
		$data['type'] = $this->input->post('type');
		if(isset($template_id) && $template_id != NULL){
			$this->db->update('receipt_template', $data, array('template_id' => $template_id));
		}else{
			$this->db->insert('receipt_template', $data);
		}
	}
}

?>
