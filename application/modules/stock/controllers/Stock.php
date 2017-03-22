<?php

class Stock extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('currency_helper');
        $this->load->helper('form');
        
		$this->load->library('form_validation');
        $this->load->library('session');
		
		$this->load->model('stock_model');
		$this->load->model('menu_model');
        $this->load->model('patient/patient_model');
        $this->load->model('settings/settings_model');
		
		$this->lang->load('main');
    }
	/**Stock Item*/
    public function item() {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('item_name', 'Item Name', 'required');
			$this->form_validation->set_rules('desired_stock', 'Desired Stock', 'required|greater_than[0]');
			$this->form_validation->set_rules('mrp', 'M.R.P.', 'required|greater_than[0]');
            $data['items'] = $this->stock_model->get_items();

            if ($this->form_validation->run() === FALSE) {
                
            } else {
                $this->stock_model->save_items();
                $data['items'] = $this->stock_model->get_items();
            }
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('item', $data);
            $this->load->view('templates/footer');
        }
    }
    public function delete_item($item_id = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->stock_model->delete_item($item_id);
            $this->item();
        }
    }
    public function edit_item($item_id = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('item_name', 'Item Name', 'required');
			$this->form_validation->set_rules('desired_stock', 'Desired Stock', 'required|greater_than[0]');
			$this->form_validation->set_rules('mrp', 'M.R.P.', 'required|greater_than[0]');

            if ($this->form_validation->run() === FALSE) {
                $data['item'] = $this->stock_model->get_item($item_id);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('stock/edit_item', $data);
                $this->load->view('templates/footer');
            } else {
                $this->stock_model->update_item();
                $data['items'] = $this->stock_model->get_items();
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('stock/item', $data);
                $this->load->view('templates/footer');
            }
        }
    }
	/**Stock Supplier*/
    public function supplier() {

		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['suppliers'] = $this->stock_model->get_suppliers();
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('stock/supplier', $data);
                $this->load->view('templates/footer');
            } else {
                $this->stock_model->save_supplier();
                $data['suppliers'] = $this->stock_model->get_suppliers();
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('stock/supplier', $data);
                $this->load->view('templates/footer');
            }
        }
    }
    public function edit_supplier($supplier_id = NULL) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required|alpha');

            if ($this->form_validation->run() === FALSE) {
                $data['supplier'] = $this->stock_model->get_supplier($supplier_id);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('stock/edit_supplier', $data);
                $this->load->view('templates/footer');
            } else {
                $this->stock_model->update_supplier();
                $data['suppliers'] = $this->stock_model->get_suppliers();
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('stock/supplier', $data);
                $this->load->view('templates/footer');
            }
        }
    }
    public function delete_supplier($supplier_id = NULL) {
		//Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->stock_model->delete_supplier($supplier_id);
            $this->supplier();
        }
    }
	/**Purchase Register*/
    public function purchase() {
        
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
            $this->form_validation->set_rules('bill_no', 'Bill No', 'required');
            $this->form_validation->set_rules('item_id', 'Item Name', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
            $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
            $this->form_validation->set_rules('cost_price', 'Cost Price', 'required|numeric');

            $data['currency_postfix'] = $this->settings_model->get_currency_postfix();
            if ($this->form_validation->run() === FALSE) {
                
            } else {
                $this->stock_model->save_purchase();
            }
			
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['suppliers'] = $this->stock_model->get_suppliers();
			$data['items'] = $this->stock_model->get_items();
			$data['purchases'] = $this->stock_model->get_purchases();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('purchase', $data);
            $this->load->view('templates/footer');
			
        }
    }
    public function purchase_report() {
        /*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$timezone = $this->settings_model->get_time_zone();
			if (function_exists('date_default_timezone_set'))
				date_default_timezone_set($timezone);
			
			if($this->input->post('from_date')){
				$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
			}else{
				$data['from_date'] = date('Y-m-d');
			}
			if($this->input->post('to_date')){
				$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
			}else{
				$data['to_date'] = date('Y-m-d');
			}
			$from_date = $data['from_date'];
			$to_date = $data['to_date'];
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
            $data['purchases'] = $this->stock_model->get_purchases($from_date,$to_date);
			$data['purchase_totals'] = $this->stock_model->get_purchase_total($from_date,$to_date);
			$this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('purchase_report', $data);
			$this->load->view('templates/footer');
        }
    }
    public function edit_purchase($purchase_id = NULL) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
            $this->form_validation->set_rules('bill_no', 'Bill No', 'required');
            $this->form_validation->set_rules('item_id', 'Item Name', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
            $this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
            $this->form_validation->set_rules('cost_price', 'Cost Price', 'required|numeric');

            if ($this->form_validation->run() === FALSE) {
				$data['def_dateformate']=$this->settings_model->get_date_formate();
				$data['items'] = $this->stock_model->get_items();
				$data['purchase'] = $this->stock_model->get_purchase($purchase_id);
				$data['suppliers'] = $this->stock_model->get_suppliers();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('stock/edit_purchase', $data);
				$this->load->view('templates/footer');
            } else {
                $this->stock_model->update_purchase();
				$data['def_dateformate']=$this->settings_model->get_date_formate();
				$data['items'] = $this->stock_model->get_items();
				$data['suppliers'] = $this->stock_model->get_suppliers();
				$data['purchases'] = $this->stock_model->get_purchases();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('purchase', $data);
				$this->load->view('templates/footer');
            }
			
        }
    }
    public function delete_purchase($purchase_id = NULL) {
        /*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->stock_model->delete_purchase($purchase_id);
            $this->purchase();
        }
    }
	/**Sell*/
	public function check_available_stock($required_stock, $item_id) {
		$item_detail = $this->stock_model->get_item($item_id);	
		
		$available_quantity = $item_detail['available_quantity'];
		if ($available_quantity < $required_stock) {
			$this->form_validation->set_message('check_available_stock', 'Required Quantity ' . $required_stock . ' exceeds Available Stock (' . $available_quantity . ') for Item ' . $item_detail['item_name']);
			return FALSE;
		} else {
			return TRUE;
		}	
	}
    public function sell($sell_id = NULL) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$this->form_validation->set_rules('sell_date', 'Sell Date', 'required');
			$this->form_validation->set_rules('patient_id', 'Patient Name', 'required');
			$this->form_validation->set_rules('sell_no', 'Sell No', 'required');
			
			$this->form_validation->set_rules('item_id', 'Item', 'required');
			$item_id = $this->input->post('item_id');
			$this->form_validation->set_rules('quantity', 'Quantity', 'required|callback_check_available_stock['.$item_id.']');
			$this->form_validation->set_rules('sell_price', 'Price', 'required');
			
            if ($this->form_validation->run() === FALSE) {
						
            } else {
				if ($sell_id == NULL){
					$sell_id = $this->stock_model->insert_sell();
				}else{
					$this->stock_model->update_sell($sell_id);
				}
				$this->stock_model->insert_sell_detail($sell_id);
            }
			if ($sell_id != NULL){
				$data['sell'] = $this->stock_model->get_sell($sell_id);
				$data['sell_details'] = $this->stock_model->get_sell_details($sell_id);
			}
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['patients'] = $this->patient_model->get_patient();
			$data['items'] = $this->stock_model->get_items();
			$data['new_sell_no'] = $this->stock_model->get_new_sell_no();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('stock/sell', $data);
			$this->load->view('templates/footer');
        }
    }
	public function delete_sell_detail($sell_detail_id = NULL, $sell_id = NULL) {
        /*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->stock_model->delete_sell_detail($sell_detail_id);
            $this->sell($sell_id);
        }
    }
    public function stock_report() {
        /*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $data['stock_report'] = $this->stock_model->get_stock_report();
            $data['currency_postfix'] = $this->settings_model->get_currency_postfix();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('stock_report', $data);
            $this->load->view('templates/footer');
        }
    }
    public function all_sell() {
        //Check if user has logged in 
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $data['sells'] = $this->stock_model->get_sells();
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('stock/all_sell', $data);
            $this->load->view('templates/footer');
        }
    }
	public function print_receipt($sell_id) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index/');
        } else {
			$receipt_template = $this->stock_model->get_sell_receipt_template();
			$template = $receipt_template['template'];
			
			//Clinic Details
			$clinic = $this->settings_model->get_clinic_settings();
			$clinic_array = array('clinic_name','tag_line','clinic_address','landline','mobile','email');
			foreach($clinic_array as $clinic_detail){
				$template = str_replace("[$clinic_detail]", $clinic[$clinic_detail], $template);
			}
			//Sell Details
			$sell = $this->stock_model->get_sell($sell_id);
			$sell_details = $this->stock_model->get_sell_details($sell_id);
			
			//Bill ID
			$bill_id = $sell['sell_id'];
			$template = str_replace("[bill_id]", $bill_id, $template);
			//Bill Date
			$def_dateformate=$this->settings_model->get_date_formate();
			$def_timeformate=$this->settings_model->get_time_formate();
			$bill_date = date($def_dateformate.' '.$def_timeformate,strtotime($sell['sell_date']));
			$template = str_replace("[bill_date]", $bill_date, $template);
			
			//Patient Details
			$patient_id = $sell['patient_id'];
			$patient = $this->patient_model->get_patient_detail($patient_id);
			$patient_name = $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name'];
			$template = str_replace("[patient_name]", $patient_name, $template);
			
			//Bill Columns
			$start_pos = strpos($template, '[col:');
			if ($start_pos !== false) {
				$end_pos = strpos($template, ']',$start_pos);
				$length = abs($end_pos - $start_pos);
				$col_string = substr($template, $start_pos, $length+1);
				
				$columns = str_replace("[col:", "", $col_string);
				$columns = str_replace("]", "", $columns);
				$cols = explode("|",$columns);
				$table = "";
				foreach($sell_details as $sell_detail){

						$table .= "<tr>";
						foreach($cols as $col){
							if($col == "sell_price"||$col == "sell_amount"){
								$table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
								$table .= currency_format($sell_detail[$col])."</td>";
							}elseif($col == "quantity"){
								$table .= "<td style='text-align:right;padding:5px;border:1px solid black;'>";
								$table .= $sell_detail[$col]."</td>";
							}else{
								$table .= "<td style='text-align:left;padding:5px;border:1px solid black;'>";
								$table .= $sell_detail[$col]."</td>";
							}
						}
						$table .= "</tr>";
				}
				$template = str_replace("$col_string",$table, $template);
			}
			
			
			//Total Amount
			$total = currency_format($sell['sell_amount']);
			$template = str_replace("[total]",$total, $template);
			
			$template .="<input type='button' value='Print' id='print_button' onclick='window.print()'>
			<style>
				@media print{
					#print_button{
						display:none;
					}
				}
			</style>";
			$data['receipt_template'] = $template;
			$this->load->view('sell_receipt',$data);
		}
	}

	public function sell_report(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			if($this->input->post('from_date')){
				$data['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
			}else{
				$data['from_date'] = date('Y-m-d');
			}
			if($this->input->post('to_date')){
				$data['to_date'] = date('Y-m-d',strtotime($this->input->post('to_date')));
			}else{
				$data['to_date'] = date('Y-m-d');
			}
			if($this->input->post('item')){
				$data['selected_items'] = $this->input->post('item');
			}else{
				$data['selected_items'] = array();
			}
			
			if($this->input->post('group_by')){
				$data['group_by'] = $this->input->post('group_by');	
			}else{
				$data['group_by'] = "none";	
			}
			
			$from_date = $data['from_date'];
			$to_date = $data['to_date'];
			$selected_items = $data['selected_items'];
			$group_by = $data['group_by'];
		
			
			$data['def_dateformate']=$this->settings_model->get_date_formate();
			$data['currency_postfix'] = $this->settings_model->get_currency_postfix();
			$data['sell_report'] =  $this->stock_model->get_sell_report($from_date,$to_date,$selected_items,$group_by);
			$data['items'] = $this->stock_model->get_items();
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('stock/sell_report', $data);
			$this->load->view('templates/footer');
		}
		
	}
}

?>