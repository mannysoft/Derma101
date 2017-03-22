<?php
class Stock_model extends CI_Model {

    public function __construct() {
		$this->load->database();
	}
    //Items
    public function get_items() {
		$query = $this->db->get('view_available_stock');
		return $query->result_array();
	}
	public function get_available_items() {
		$query = $this->db->get('view_available_stock');
		return $query->result_array();
	}
	public function get_item($item_id) {
        $query = $this->db->get_where('view_available_stock', array('item_id' => $item_id));
        return $query->row_array();
    }
	public function get_item_detail($item_name) {
    	$query = $this->db->get_where('item', array('item_name' => $item_name));
        return $query->row_array();
    }
    public function get_available_quantity($item_id){
		$query = $this->db->get_where('view_available_stock', array('item_id' => $item_id));
		$row = $query->row_array();
		$available_quantity = $row['available_quantity'];
		return $available_quantity;
	}
    public function save_items() {
        $data['item_name'] = $this->input->post('item_name');
        $data['desired_stock'] = $this->input->post('desired_stock');
        $data['mrp'] = $this->input->post('mrp');
        $this->db->insert('item', $data);
    }
    public function delete_item($item_id) {
        $this->db->delete('item', array('item_id' => $item_id)); 
    }
    public function update_item() {
		$item_id = $this->input->post('item_id');
		$data['item_id'] = $this->input->post('item_id');
		$data['item_name'] = $this->input->post('item_name');
		$data['desired_stock'] = $this->input->post('desired_stock');
		$data['mrp'] = $this->input->post('mrp');
		$this->db->update('item', $data, array('item_id' =>  $item_id));
	}
    //Suppliers
    public function get_suppliers() {
		$query = $this->db->get('supplier');
		return $query->result_array();
	}
    public function get_supplier($supplier_id) {
		$query = $this->db->get_where('supplier', array('supplier_id' => $supplier_id));
		return $query->row_array();
	}
    public function save_supplier() {
		$data['supplier_name'] = $this->input->post('supplier_name');
		$data['contact_number'] = $this->input->post('contact_number');
		$this->db->insert('supplier', $data);
	}
    public function delete_supplier($supplier_id) {
		$this->db->delete('supplier', array('supplier_id' => $supplier_id)); 
	}
    public function update_supplier() {
		$supplier_id = $this->input->post('supplier_id');
		$data['supplier_id'] = $this->input->post('supplier_id');
		$data['supplier_name'] = $this->input->post('supplier_name');
		$data['contact_number'] = $this->input->post('contact_number');
		$this->db->update('supplier', $data, array('supplier_id' =>  $supplier_id));
	}
	//Purchase
    public function get_purchases($from_date = NULL,$to_date = NULL) {
		if($from_date != NULL){
			$this->db->where("purchase_date >= ",$from_date);	
		}
		if($to_date != NULL){
			$this->db->where("purchase_date <= ",$to_date);	
		}
        $this->db->order_by("purchase_date","asc");
        $query = $this->db->get('view_purchase');
		//echo $this->db->last_query();
		return $query->result_array();
	}
    public function get_purchase($purchase_id) {
        $query = $this->db->get_where('view_purchase', array('purchase_id' => $purchase_id));
		return $query->row_array();
	}
	public function get_remain_quantity($item_id){
		$query = $this->db->get_where('view_purchase', array('item_id' => $item_id));
		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('view_purchase') ." WHERE remain_quantity > 0 and item_id =".$item_id);
		$row = $query->row_array();
		return $query->result_array();
	}
	public function get_purchase_total($from_date = NULL,$to_date = NULL) {
		if($from_date != NULL){
			$this->db->where("purchase_date >= ",$from_date);	
		}
		if($to_date != NULL){
			$this->db->where("purchase_date <= ",$to_date);	
		}
		$this->db->select('purchase_date, bill_no, SUM(total) as total');
		$this->db->group_by('purchase_date,bill_no'); 
        $query = $this->db->get('view_purchase_total');
		//echo $this->db->last_query();
        return $query->result_array();
    }

    public function save_purchase() {
        $data['purchase_date'] = date("Y-m-d",strtotime($this->input->post('purchase_date')));
        $data['bill_no'] = $this->input->post('bill_no');
		$data['item_id'] = $this->input->post('item_id');
		$data['quantity'] = $this->input->post('quantity');
		$data['remain_quantity'] = $this->input->post('quantity');
		$data['supplier_id'] = $this->input->post('supplier_id');
		$data['cost_price'] = $this->input->post('cost_price');
		$this->db->insert('purchase', $data);
	}

    public function update_purchase() {
        $purchase_id = $this->input->post('purchase_id');
            
        $data['purchase_id'] = $this->input->post('purchase_id');
        $data['purchase_date'] = date("Y-m-d", strtotime($this->input->post('purchase_date')));
        $data['bill_no'] = $this->input->post('bill_no');
		$data['item_id'] = $this->input->post('item_id');
		$data['quantity'] = $this->input->post('quantity');
		$data['supplier_id'] = $this->input->post('supplier_id');
		$data['cost_price'] = $this->input->post('cost_price');
		$this->db->update('purchase', $data, array('purchase_id' =>  $purchase_id));
     }

    public function delete_purchase($purchase_id) {
            $this->db->delete('purchase', array('purchase_id' => $purchase_id)); 
        }

    public function insert_sell() {
		$data['sell_no'] = $this->input->post('sell_no');
		$data['sell_date'] = date("Y-m-d",strtotime($this->input->post('sell_date')));
		$data['patient_id'] = $this->input->post('patient_id');
		$this->db->insert('sell', $data);
		$sell_id = $this->db->insert_id();
		return $sell_id;
	}
	public function update_sell($sell_id) {
		$data['sell_no'] = $this->input->post('sell_no');
		$data['sell_date'] = date("Y-m-d",strtotime($this->input->post('sell_date')));
		$data['patient_id'] = $this->input->post('patient_id');
		$this->db->update('sell', $data,array('sell_id'=>$sell_id));
	}

    public function update_sell_amount($sell_id, $amount) {
        $query = $this->db->get_where('sell', array('sell_id' => $sell_id));
        $row = $query->row();
        if ($row)
            $sell_amount = $row->sell_amount;
        else
            $sell_amount = 0;
        
        $data['sell_amount'] = $amount + $sell_amount;
        $this->db->update('sell', $data, array('sell_id' =>  $sell_id));
        
    }

    public function insert_sell_detail($sell_id) {
		//Check if this item is already added in this Sell or not.
		$data['item_id'] = $this->input->post('item_id');
		$data['sell_id'] = $sell_id;
		$quantity = $this->input->post('quantity');
		$data['sell_price'] = $this->input->post('sell_price');
		
		$query = $this->db->get_where('sell_detail', array('sell_id' => $sell_id,'item_id'=>$data['item_id']));
		$row = $query->row();
		if ($row){
			//Update the existing row
			$data['quantity'] = $quantity + $row->quantity;
			$data['sell_amount'] = $data['sell_price'] * $data['quantity'];
			$amount = $data['sell_price'] * $quantity;
			$this->db->update('sell_detail', $data, array('sell_id' => $sell_id,'item_id'=>$data['item_id']));
		}else{
			$data['quantity'] = $quantity ;
			$data['sell_amount'] = $data['sell_price'] * $data['quantity'];
			$amount = $data['sell_amount'];
			$this->db->insert('sell_detail', $data);
		}
        $this->update_sell_amount($sell_id,$amount);
    }

    public function get_sell_details($sell_id) {
        $sql = 'SELECT a.sell_detail_id,b.item_name,a.quantity,a.sell_price,a.sell_amount FROM '. $this->db->dbprefix('sell_detail') . ' as a,'. $this->db->dbprefix('item') . ' as b WHERE a.item_id = b.item_id AND a.sell_id = ?';
        $query = $this->db->query($sql,$sell_id);
		//echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_sells() {
        $sql = 'Select a.sell_no,a.sell_id,a.sell_date,a.patient_id,a.sell_amount,c.first_name,c.middle_name,c.last_name
                  from ' . $this->db->dbprefix('sell') . ' as a 
                       LEFT OUTER JOIN ' . $this->db->dbprefix('patient') . ' as b ON a.patient_id = b.patient_id
                       LEFT OUTER JOIN ' . $this->db->dbprefix('contacts') . ' as c ON c.contact_id = b.contact_id';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_sell($sell_id) {
        $sql = 'Select a.sell_no,a.sell_id,a.sell_date,a.patient_id,a.sell_amount,c.first_name,c.middle_name,c.last_name
                  from ' . $this->db->dbprefix('sell') . ' as a 
                       LEFT OUTER JOIN ' . $this->db->dbprefix('patient') . ' as b ON a.patient_id = b.patient_id
                       LEFT OUTER JOIN ' . $this->db->dbprefix('contacts') . ' as c ON c.contact_id = b.contact_id
                 where a.sell_id=' . $sell_id;
        $query = $this->db->query($sql);
		//echo $this->db->last_query();
        return $query->row_array();
    }
	public function get_new_sell_no(){
		$this->db->select_max('sell_no');
		$query = $this->db->get('sell');
		$row = $query->row();
		$last_sell_no= $row->sell_no;
		return $last_sell_no + 1;
	}

    public function delete_sell_detail($sell_detail_id) {
		$query = $this->db->get_where('sell_detail', array('sell_detail_id' => $sell_detail_id));
		$row = $query->row();
		$sell_id = $row->sell_id;
		$amount = (-1)* $row->sell_amount;
		$this->update_sell_amount($sell_id,$amount);
		
        $this->db->delete('sell_detail', array('sell_detail_id' => $sell_detail_id)); 
    }

    public function get_stock_report() {
        $query = $this->db->get('view_stock');
        return $query->result_array();
    }
	public function get_sell_receipt_template(){
		$query = $this->db->get_where('receipt_template', array('is_default' => 1,'type'=>'sell'));
        $row = $query->row_array();
		return $row;
	}
	public function get_sell_report($from_date,$to_date,$selected_items,$group_by){
		$this->db->where('sell_date >=' , $from_date);
		$this->db->where('sell_date <=' , $to_date);
		if(!empty($selected_items)){
			$this->db->where_in('item_id',$selected_items);
		}
		if($group_by != "none"){
			$this->db->order_by($group_by); 
		}
		$query = $this->db->get('view_sell_report');
		//echo $this->db->last_query();
        return $query->result_array();
	}
}
?>
