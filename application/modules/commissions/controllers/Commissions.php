<?php

class Commissions extends CI_Controller {

	function __construct() {
        parent::__construct();
        
		$this->load->model('menu_model');
		$this->load->model('admin/admin_model');
		$this->load->model('module/module_model');
		$this->load->model('staff/staff_model');
		$this->load->model('patient/patient_model');
		$this->load->model('settings/settings_model');
		
		$this->lang->load('main');
		
		$this->load->helper('form');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->load->database();
    }
    
    function index(){
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {
			redirect('login/index');
        } else {
			$this->form_validation->set_rules('staff_name', 'Staff Name', 'required');
            if ($this->form_validation->run() === FALSE) {
				/** Do Nothing**/
            } else {
                $this->staff_model->save();
            }
            	$data['staffs'] =$this->staff_model->get_staffs();
            	
			$this->load->view('templates/header');
			$this->load->view('templates/menu');
			$this->load->view('index', $data);
			$this->load->view('templates/footer');
		}
	}
    
	public function edit($id) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->form_validation->set_rules('staff_name', 'Staff Name', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['staff'] = $this->staff_model->get_staff($id);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('staff/edit', $data);
                $this->load->view('templates/footer');
            } else {
                $this->staff_model->update();
                $data['staffs'] = $this->staff_model->get_staffs();
				$this->load->view('templates/header');
				$this->load->view('templates/menu');
				$this->load->view('index', $data);
				$this->load->view('templates/footer');
            }
        }
    }
	public function delete($id) {
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $this->staff_model->delete($id);
          	redirect('staff');
        }
    }
	
	public function delete_prescription_medicine($visit_id,$medicine_id){
		$this->prescription_model->delete_prescription_medicine($visit_id,$medicine_id);
		$this->edit_prescription($visit_id);
	}
	
}
?>
