<?php

class Template extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('template_model');
		$this->load->model('menu_model');
		$this->load->model('module/module_model');
		$this->load->model('patient/patient_model');
		
		$this->load->helper('url');
		$this->load->helper('file');
        $this->load->helper('form');
		$this->load->helper('directory');
        
		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->lang->load('main');
    }
	/*public function is_session_started(){
		if ( php_sapi_name() !== 'cli' ) {
			if ( version_compare(phpversion(), '5.4.0', '>=') ) {
				return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
			} else {
				return session_id() === '' ? FALSE : TRUE;
			}
		}
		return FALSE;
	}*/
    public function index() {
		/*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $data['templates'] = $this->template_model->get();
            $data['active_modules'] = $this->module_model->get_active_modules();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function form($template_id = NULL) {
        /*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
			$data = array();
			$data['active_modules'] = $this->module_model->get_active_modules();
            $this->form_validation->set_rules('template_name', 'Template Name', 'required');
            $this->form_validation->set_rules('template', 'Template Content', 'required');
            if ($this->form_validation->run() === FALSE) {
				if(isset($template_id)){
					$data['template'] = $this->template_model->get_template_from_id($template_id);
				}
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('form', $data);
                $this->load->view('templates/footer');
            } else {
                $this->template_model->save();
                $this->index();
            }
        }
    }
	public function set_as_default($template_id) {
		$this->template_model->set_as_default($template_id);
		$this->index();
	}
    public function delete($template_name) {
        /*if ( $this->is_session_started() === FALSE ){
			session_start();
		}
		//Check if user has logged in 
		if (!isset($_SESSION["user_name"]) || $_SESSION["user_name"] == '') {*/
		if (!$this->session->userdata('user_name') || $this->session->userdata('user_name') == '') {				
            redirect('login/index');
        } else {
            $note = $this->template_model->delete($template_name);
            $this->index($note);
        }
    }
}

?>
