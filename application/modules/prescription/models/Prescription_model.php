<?php
class Prescription_model extends CI_Model {

    public function __construct() {
		$this->load->database();
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
	public function get_medicine($medicine_id) {
        $query = $this->db->get_where('medicines', array('medicine_id' => $medicine_id));
        return $query->row_array();
    }
	public function save_medicine() {
        $data['medicine_name'] = $this->input->post('medicine_name');
        $this->db->insert('medicines', $data);
    }
    public function delete_medicine($medicine_id) {
        $this->db->delete('medicines', array('medicine_id' => $medicine_id)); 
    }
    public function update_medicine() {
		$medicine_id = $this->input->post('medicine_id');
		$data['medicine_name'] = $this->input->post('medicine_name');
		$this->db->update('medicines', $data, array('medicine_id' =>  $medicine_id));
	}
	public function get_medicine_name($medicine_id){
		$query = $this->db->get_where('medicines', array('medicine_id' => $medicine_id));
        $row =  $query->row_array();
		return $row['medicine_name'];
	}
	public function insert_prescription($visit_id,$patient_id){
		$medicine_ids = $this->input->post('medicine_id');
		$freq_mornings = $this->input->post('freq_morning');
		$freq_afternoons = $this->input->post('freq_afternoon');
		$freq_nights = $this->input->post('freq_evening');
		$days = $this->input->post('days');
		$instructions = $this->input->post('prescription_notes');
		$i = 0;
		foreach($medicine_ids as $medicine_id){
			if($medicine_id!=0){
				$data = array();
				$data['visit_id'] = $visit_id;
				$data['patient_id'] = $patient_id;
				$data['medicine_id'] = $medicine_id;
				$data['freq_morning'] = $freq_mornings[$i];
				$data['freq_afternoon'] = $freq_afternoons[$i];
				$data['freq_night'] = $freq_nights[$i];
				$data['for_days'] = $days[$i];
				$data['instructions'] = $instructions[$i];
				$this->db->insert('prescription', $data);	
				//echo $this->db->last_query()."<br/>";
				$i++;
			}
		}
	}
	public function update_prescription($visit_id,$patient_id){
		$medicine_ids = $this->input->post('medicine_id');
		$freq_mornings = $this->input->post('freq_morning');
		$freq_afternoons = $this->input->post('freq_afternoon');
		$freq_nights = $this->input->post('freq_evening');
		$days = $this->input->post('days');
		$instructions = $this->input->post('prescription_notes');
		$i = 0;
		foreach($medicine_ids as $medicine_id){
			//check if data exists, then update
			$query = $this->db->get_where('prescription', array('visit_id' => $visit_id,'medicine_id' => $medicine_id));
			$result = $query->result_array();
			if(!empty ($result)){
				//Update Data
				$data['freq_morning'] = $freq_mornings[$i];
				$data['freq_afternoon'] = $freq_afternoons[$i];
				$data['freq_night'] = $freq_nights[$i];
				$data['for_days'] = $days[$i];
				$data['instructions'] = $instructions[$i];
				$this->db->update('prescription', $data,array('visit_id' => $visit_id,'medicine_id' => $medicine_id));	
			}else{
				// Insert Data
				$data = array();
				$data['visit_id'] = $visit_id;
				$data['patient_id'] = $patient_id;
				$data['medicine_id'] = $medicine_id;
				$data['freq_morning'] = $freq_mornings[$i];
				$data['freq_afternoon'] = $freq_afternoons[$i];
				$data['freq_night'] = $freq_nights[$i];
				$data['for_days'] = $days[$i];
				$data['instructions'] = $instructions[$i];
				$this->db->insert('prescription', $data);	
			}
			//echo $this->db->last_query()."<br/>";
			$i++;
		}
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
