<?php
class Commissions_model extends CI_Model {

    public function __construct() {
		$this->load->database();
	}
	
	public function get_staffs() {
		$query = $this->db->get('staff');
		return $query->result_array();
	}
	
	public function save() {
        $data['staff_name'] = $this->input->post('staff_name');
        $this->db->insert('staff', $data);
    }
    
    public function get_total_sales($date, $staff_id) {
		$this->db->where('staff_id', $staff_id)->where('date', $date)->select_sum('total_amount');
		$query = $this->db->get('members');
		// $query = $this->db->where('staff_id', $staff_id)->where('date', $date)->get();
        	return $query->row_array();
		// $query = $this->db->get('staff');
		// return $query->result_array();
	}
		
	
    //Items
    public function get_medicines() {
		$query = $this->db->get('medicines');
		return $query->result_array();
	}
	public function get_medicine_array(){
		$query = $this->db->get('medicines');
		$result = $query->result_array();
		$medicine_array = array();
		foreach($result as $row){
			$medicine_array[$row['medicine_id']] = $row['medicine_name'];
		}
		return $medicine_array;
	}
	public function get_staff($id) {
        $query = $this->db->get_where('staff', array('id' => $id));
        return $query->row_array();
    }
	public function save_medicine() {
        $data['medicine_name'] = $this->input->post('medicine_name');
        $this->db->insert('medicines', $data);
    }
    public function delete($id) {
        $this->db->delete('staff', array('id' => $id));
    }
    public function update() {
		$id = $this->input->post('id');
		$data['staff_name'] = $this->input->post('staff_name');
		$this->db->update('staff', $data, array('id' =>  $id));
	}
	public function get_medicine_name($medicine_id){
		$query = $this->db->get_where('medicines', array('medicine_id' => $medicine_id));
        $row =  $query->row_array();
		return $row['medicine_name'];
	}
	
	public function is_prescription($visit_id){
		$query = $this->db->get_where('prescription', array('visit_id' => $visit_id));
		$result = $query->result_array();
		return (!empty ($result));
		
	}
	
	public function get_all_medicines($visit_id){
		$query = $this->db->get_where('prescription', array('visit_id' => $visit_id));
		$result = $query->result_array();
		return $result;
	}
	public function delete_prescription_medicine($visit_id,$medicine_id){
		$this->db->delete('prescription', array('visit_id' => $visit_id,'medicine_id' => $medicine_id)); 
	}
}
?>
