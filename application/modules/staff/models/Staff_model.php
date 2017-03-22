<?php
class Staff_model extends CI_Model {

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
    
    public function get_staffname($id) {
        if ($id == null) {
        	return '';
        }
        
        $query = $this->db->get_where('staff', array('id' => $id));
        $row =  $query->row_array();
	return $row['staff_name'];
        
        // $query = $this->db->get_where('staff', array('id' => $id));
        // return $query->row_array();
    }
    
    public function bills()
    {
    		//$this->db->order_by("id", "desc");
          	//$this->db->order_by("total_amount", "<>", 0);
          	$query = $this->db->get("bill");
          	return $query->result_array();
    }
    
    public function bill_details($bill_id)
    {
  
          	$this->db->where("bill_id", $bill_id);
          	$query = $this->db->get("bill_detail");
          	return $query->result_array();
    }
    
     public function total_commission($input, $staff_id)
    {
    		$period = $input->get('period');
    		$date_from = $input->get('week_from');
    		$date_to = $input->get('week_to');
    		$month = $input->get('month');
    		$year = $input->get('year');
    		
    		$data = array();
		$data['period'] = date('Y-m-d');
		$data['assignments'] = 0;
		$data['total_sales'] = 0;
	      $data['total_commission']  = 0;
	      $data['status'] = 'Unpaid';
    		
    		if($period == 'today'  or $period == '') {
    			$this->db->where("staff_id", $staff_id);
    			$this->db->where("bill_date", date('Y-m-d'));
    			$query = $this->db->get("bill");
    			$result = $query->result_array();
    		}
    		
    		if($period == 'weekly') {
    			$data['period'] = $date_from . ' to ' . $date_to;
    			$this->db->where("staff_id", $staff_id);
    			$this->db->where("bill_date BETWEEN  '$date_from' AND '$date_to'");
    			$query = $this->db->get("bill");
    			$result = $query->result_array();
    			//echo $this->db->last_query();
    		}
    		
    		if($period == 'monthly') {
    			$date_from = $year . '-' . $month . '-01';
    			$date_to = $year . '-' . $month . '-31';
    			$data['period'] = $date_from . ' to ' . $date_to;
    			$this->db->where("staff_id", $staff_id);
    			$this->db->where("bill_date BETWEEN  '$date_from' AND '$date_to'");
    			$query = $this->db->get("bill");
    			$result = $query->result_array();
    			//echo $this->db->last_query();
    		}
    		
    		foreach($result as $row) {
			$this->db->select_sum('quantity');
			$this->db->where("bill_id", $row['bill_id']);
	          	$query = $this->db->get("bill_detail");
	          	$details = $query->result_array();
	          	$data['assignments'] += $details[0]['quantity'];
	    		$data['total_sales'] += $row['total_amount'];
		}
		
		if ($data['total_sales'] > 3000) {
			$percentage = 5;
			$data['total_commission'] = ($percentage / 100) * $data['total_sales'];
		}
		
		if ($data['total_commission']  == 0) {
			$data['status'] = 'N/A';
		}
		
		
		return $data;
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
